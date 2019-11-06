<?php 

class AppointmentServiceController extends Controller {

    function beforeroute() {

        //Check to make sure token passed is valid
        try {

            $userToken = new UserToken($this->db);

            $token = $this->f3->get('HEADERS.Token');

            $result = $userToken->verifyToken($token);

            if(empty($result) || $result['expiryDate'] < date('Y-m-d H:i:s')) {
                $this->f3->error(403, 'Invalid token');
            }

        }
        catch(Exception $e) {

            header('Content-type:application/json');

            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));
            
            exit;

        }        

    }

    function getAll($f3, $params) {

        header('Content-type:application/json');

        try {

            $appointmentServices = new AppointmentService($this->db);

            $disabled = $params['disabled'];

            if($disabled < 0) {
                $f3->error(400, 'Missing one or more required fields');
                exit;
            }

            $appointmentServicesData = $appointmentServices->getAll($disabled);

            $increment = 0;

            foreach($appointmentServicesData as $data) {
    
                $appointments = new Appointment($this->db);

                $appointmentsData = $appointments->getById($data['appointmentId']);
    
                $result[$increment] = array(
                    'id' => $appointmentsData[0]['id'],
                    'date' => $appointmentsData[0]['date'],
                    'customerId' => $appointmentsData[0]['custUserId'],
                    'employeeId' => $appointmentsData[0]['empUserId'],
                );

                $users = new User($this->db);
    
                $customerData = $users->getById($appointmentsData[0]['custUserId']);
    
                $result[$increment]['customer'] = array(
                        'id' => $customerData[0]['id'],
                        'userId' => $customerData[0]['userId'],
                        'firstName' => $customerData[0]['firstName'],
                        'lastName' => $customerData[0]['lastName']
                );
    
                $employeeData = $users->getById($appointmentsData[0]['empUserId']);
    
                $result[$increment]['employee'] = array(
                    'id' => $employeeData[0]['id'],
                    'userId' => $employeeData[0]['userId'],
                    'firstName' => $employeeData[0]['firstName'],
                    'lastName' => $employeeData[0]['lastName']
                );
    
                $services = new Service($this->db);
    
                $result[$increment]['service'] = array();

                $appointmentServicesData2 = $appointmentServices->getAppointmentById($data['appointmentId']);
    
                foreach($appointmentServicesData2 as $value) {
                    $servicesData = $services->getById($value['serviceId']);
                    array_push($result[$increment]['service'], array(
                        'id' => $servicesData[0]['id'],
                        'name' => $servicesData[0]['name'],
                        'price' => $servicesData[0]['price']
                        )
                    );    
                }

                $increment++;

            }               

            Response::successResponse($result);

            exit;

        }
        catch(Exception $e) {

            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));

            exit;

        } 

    }

    function getById($f3, $params) {

        header('Content-type:application/json');

        try {
                
            if(empty($params['appointmentId']) || empty($params['serviceId'])) {

                $f3->error(400, 'Missing one or more required fields');

                exit;

            }

            $appointmentService = new AppointmentService($this->db);

            $result = $appointmentService->getById($params['appointmentId'], $params['serviceId']);

            Response::successResponse($result);

            exit;

        }
        catch(Exception $e) {

            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));

            exit;

        }                       

    }

    function getAppointmentById($f3, $params) {

        header('Content-type:application/json');

        try {

            if(empty($params['appointmentId'])) {
                $f3->error(400, 'Missing one or more required fields');
                exit;
            }
    
            $appointmentServices = new AppointmentService($this->db);

            $data = $appointmentServices->getAppointmentById($params['appointmentId']);

            $appointments = new Appointment($this->db);

            $users = new User($this->db);

            $appointmentsData = $appointments->getById($data[0]['appointmentId']);

            $result[0] = array(
                'id' => $appointmentsData[0]['id'],
                'date' => $appointmentsData[0]['date'],
                'customerId' => $appointmentsData[0]['custUserId'],
                'employeeId' => $appointmentsData[0]['empUserId'],
            );

            $customerData = $users->getById($appointmentsData[0]['custUserId']);

            $result[0]['customer'] = array(
                    'id' => $customerData[0]['id'],
                    'userId' => $customerData[0]['userId'],
                    'firstName' => $customerData[0]['firstName'],
                    'lastName' => $customerData[0]['lastName']
            );

            $employeeData = $users->getById($appointmentsData[0]['empUserId']);

            $result[0]['employee'] = array(
                'id' => $employeeData[0]['id'],
                'userId' => $employeeData[0]['userId'],
                'firstName' => $employeeData[0]['firstName'],
                'lastName' => $employeeData[0]['lastName']
            );

            $services = new Service($this->db);

            $result[0]['service'] = array();

            foreach($data as $value) {
                $servicesData = $services->getById($value['serviceId']);
                array_push($result[0]['service'], array(
                    'id' => $servicesData[0]['id'],
                    'name' => $servicesData[0]['name'],
                    'price' => $servicesData[0]['price']
                    )
                );    
            }                  
    
            Response::successResponse($result);   

            exit;

        }
        catch(Exception $e) {

            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));

            exit;

        } 

    }

    function create($f3, $params) {

        header('Content-type:application/json');
    
        try {

            
            $data = json_decode($f3->get('BODY'), true);

            $appointmentService = new AppointmentService($this->db);

            $appointment = new Appointment($this->db);

            $service = new Service($this->db);
        
            if(empty($params['appointmentId']) && empty($params['serviceId'])) {

                if(empty($data['appointmentId']) || empty($data['serviceId']) || empty($data['quantity'])) {
                    
                    $f3->error(400, 'Missing one or more required fields');

                    exit;
        
                }
                
                $result = $appointment->getById($data['appointmentId'])[0];
        
                if(empty($result)) {

                    $f3->error(400, 'Appointment does not exist');

                    exit;
        
                }

                $result = $service->getById($data['serviceId'])[0];
        
                if(empty($result)) {
                
                    $f3->error(400, 'Service does not exist');

                    exit;
        
                }

                $data['created'] = date('Y-m-d H:i:s');
                $data['disabled'] = 0;

                $appointmentService->create($data);

                Response::successMessage('Appointment service successfully created');

                exit;

            }
            else {

                if(empty($params['appointmentId']) || empty($params['serviceId'])) {

                    $f3->error(400, 'Missing one or more required fields');

                    exit;

                }
        
                $result = $appointmentService->getById($params['appointmentId'], $params['serviceId']);

                if(empty($result)) {
                
                    $f3->error(400, 'Appointment does not exist');

                    exit;
        
                }

                $data['appointmentId'] = $params['appointmentId'];
                $data['serviceId'] = $params['serviceId'];
                $data['modified'] = date('Y-m-d H:i:s');
        
                $appointmentService->create($data);

                Response::successMessage('Appointment service successfully updated');

                exit;
            
            }

        }
        catch(Exception $e) {

            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));

            exit;

        }
        
    }

    function delete($f3, $params) {

        header('Content-type:application/json');

        try {
            
            if(empty($params['appointmentId']) || empty($params['serviceId'])) {

                $f3->error(400, 'Missing one or more required fields');

                exit;
    
            }
    
            $appointmentService = new AppointmentService($this->db);
    
            $result = $appointmentService->getById($params['appointmentId'], $params['serviceId']);
    
            if(empty($result)) {
    
                $f3->error(400, 'Appointment does not exist');

                exit;
    
            }
    
            $data['appointmentId'] = $params['appointmentId'];
            $data['serviceId'] = $params['serviceId'];
            $data['modified'] = date('Y-m-d H:i:s');
            $data['disabled'] = 1;
    
            $appointmentService->delete($data);
            
            Response::successMessage('Appointment service successfully deactivated');

            exit;
    
        }
        catch(Exception $e) {

            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));

            exit;

        }

    }

    function getAppointmentByYearAndMonthByUserId($f3, $params) {

        header('Content-type:application/json');

        try {
                
            if(empty($params['userId']) || empty($params['year']) || empty($params['month'])) {
                $f3->error(400, 'Missing one or more required fields');
                exit;
            }

            $appointmentService = new AppointmentService($this->db);

            $result = $appointmentService->getAppointmentByYearAndMonthByUserId($params['userId'], $params['year'], $params['month']);

            for($i=1; $i <= 31; $i++) {
                $records[$i] = array();
            }

            foreach($result as $value) {
                array_push($records[(int)$value['day']], $value);
            }

            Response::successResponse($records);

            exit;

        }
        catch(Exception $e) {

            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));

            exit;

        }                       

    }

}

?>