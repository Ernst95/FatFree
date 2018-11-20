<?php 

    class AppointmentServiceController extends Controller {

        function beforeroute() {

            $userToken = new UserToken($this->db);

            $token = $this->f3->get('HEADERS.Token');

            $result = $userToken->verifyToken($token);

            if(empty($result) || $result['expiryDate'] < date('Y-m-d H:i:s')) {
                $this->f3->error(403);
            }

        }

        function getAll($f3, $params) {

            header('Content-type:application/json');

            $appointmentService = new AppointmentService($this->db);

            $disabled = $params['disabled'];

            if($disabled < 0) {

                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));

                return;

            }

            $result = $appointmentService->getAll($disabled);

            echo json_encode(array(
                'success' => true,
                'count' => count($result),
                'results' => $result
            ));

        }

        function getById($f3, $params) {

            header('Content-type:application/json');

            if(empty($params['appointmentId']) || empty($params['serviceId'])) {

                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));

                return;

            }

            $appointmentService = new AppointmentService($this->db);

            $result = $appointmentService->getById($params['appointmentId'], $params['serviceId']);

            echo json_encode(array(
                'success' => true,
                'count' => count($result),
                'results' => $result
            ));                      

        }

        function getAppointmentById($f3, $params) {

            header('Content-type:application/json');

            if(empty($params['appointmentId'])) {

                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));

                return;

            }

            $appointmentService = new AppointmentService($this->db);

            $result = $appointmentService->getAppointmentById($params['appointmentId']);

            echo json_encode(array(
                'success' => true,
                'count' => count($result),
                'results' => $result
            ));

        }

        function create($f3, $params) {

            header('Content-type:application/json');
       
            $data = json_decode($f3->get('BODY'), true);

            $appointmentService = new AppointmentService($this->db);

            $appointment = new Appointment($this->db);

            $service = new Service($this->db);
        
            if(empty($params['appointmentId']) && empty($params['serviceId'])) {

                if(empty($data['appointmentId']) || empty($data['serviceId']) || empty($data['quantity'])) {
    
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Missing one or more required fields'
                    ));
        
                    return;
        
                }
                
                $result = $appointment->getById($data['appointmentId'])[0];
        
                if(empty($result)) {
                
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Appointment does not exist'
                    ));
        
                    return;
        
                }
    
                $result = $service->getById($data['serviceId'])[0];
        
                if(empty($result)) {
                
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Service does not exist'
                    ));
        
                    return;
        
                }
    
                $data['created'] = date('Y-m-d H:i:s');
                $data['disabled'] = 0;
    
                $appointmentService->create($data);
    
                echo json_encode(array(
                    'success' => true,
                    'message' => 'Appointment service successfully created'
                ));
    
            }
            else {

                if(empty($params['appointmentId']) || empty($params['serviceId'])) {

                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Missing one or more required fields'
                    ));

                    return;

                }
        
                $result = $appointmentService->getById($params['appointmentId'], $params['serviceId']);
    
                if(empty($result)) {
                
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Appointment service does not exist'
                    ));
        
                    return;
        
                }

                $data['appointmentId'] = $params['appointmentId'];
                $data['serviceId'] = $params['serviceId'];
                $data['modified'] = date('Y-m-d H:i:s');
        
                $appointmentService->create($data);
    
                echo json_encode(array(
                    'success' => true,
                    'message' => 'Appointment service successfully updated'
                ));
    
                return;
            
            }
            
        }

        function delete($f3, $params) {

            header('Content-type:application/json');

            if(empty($params['appointmentId']) || empty($params['serviceId'])) {

                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));

                return;

            }

            $appointmentService = new AppointmentService($this->db);

            $result = $appointmentService->getById($params['appointmentId'], $params['serviceId']);

            if(empty($result)) {

                echo json_encode(array(
                    'success' => false,
                    'message' => 'Appointment service does not exist'
                ));

                return;

            }

            $data['appointmentId'] = $params['appointmentId'];
            $data['serviceId'] = $params['serviceId'];
            $data['modified'] = date('Y-m-d H:i:s');
            $data['disabled'] = 1;

            $appointmentService->delete($data);

            echo json_encode(array(
                'success' => true,
                'message' => 'Appointment service successfully deactivated'
            ));

        }

    }

?>