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

            $appointmentService = new AppointmentService($this->db);

            $disabled = $params['disabled'];

            if($disabled < 0) {

                $f3->error(400, 'Missing one or more required fields');

                exit;

            }

            $result = $appointmentService->getAll($disabled);

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
    
            $appointmentService = new AppointmentService($this->db);
    
            $result = $appointmentService->getAppointmentById($params['appointmentId']);
    
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

}

?>