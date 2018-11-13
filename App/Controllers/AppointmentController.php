<?php

    class ServiceController extends Controller {

        function beforeroute() {

            date_default_timezone_set("Africa/Johannesburg");

            $userToken = new UserToken($this->db);

            $token = $this->f3->get('HEADERS.Token');

            $result = $userToken->verifyToken($token);

            if(empty($result) <= 0 || $result['expiryDate'] < date('Y-m-d H:i:s')) {
                $this->f3->error(403);
            }

        }

        function getAll($f3, $params) {

            header('Content-type:application/json');

            $disabled = $params['disabled'];

            if($disabled < 0) {

                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));

                return;

            }

            $appointment = new Appointment($this->db);

            $result = $appointment->getAll($disabled);

            echo json_encode(array(
                'success' => true,
                'count' => count($result),
                'results' => $result
            ));

        }

        function getById($f3, $params) {

            header('Content-type:application/json');

            date_default_timezone_set("Africa/Johannesburg");

            $id = $params['id'];

            if(empty($id)) {

                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));

                return;
            }

            $appointment = new Appointment($this->db);

            $result = $appointment->getById($id);

            echo json_encode(array(
                'success' => true,
                'count' => count($result),
                'results' => $result
            ));

        }

        function create($f3, $params) {

            header('Content-type:application/json');
    
            date_default_timezone_set("Africa/Johannesburg");
    
            $data = json_decode($f3->get('BODY'), true);
    
            if(empty($data['date']) || empty($data['custUserId']) || empty($data['empUserId']) || empty($data['serviceId'])) {
    
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));
    
                return;
    
            }

            $service = new Service($this->db);

            $result = $service->getById($data['serviceId']);
    
            if(empty($result)) {
            
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Service does not exist'
                ));
    
                return;
    
            }

            $user = new User($this->db);

            $result = $user->getById($data['custUserId']);
    
            if(empty($result) || ($result['userGroupId'] != 1)) {
            
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Customer does not exist'
                ));
    
                return;
    
            }

            $result = $user->getById($data['empUserId']);
    
            if(empty($result) || ($result['userGroupId'] != 2) || ($result['userGroupId'] != 3)) {
            
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Employee does not exist'
                ));
    
                return;
    
            }

            $appointment = new Appointment($this->db);
    
            if(!empty($params['id'])) {
    
                $id = $params['id'];
        
                $result = $appointment->getById($id);
    
                if(empty($result)) {
                
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Appointment does not exist'
                    ));
        
                    return;
        
                }

                $data['id'] = $params['id'];
                $data['modified'] = date('Y-m-d H:i:s');
        
                $appointment->create($data);
    
                echo json_encode(array(
                    'success' => true,
                    'message' => 'Appointment successfully updated'
                ));
    
                return;
    
            }
            else {
    
                $data['created'] = date('Y-m-d H:i:s');
                $data['disabled'] = 0;
    
                $appointment->create($data);
    
                echo json_encode(array(
                    'success' => true,
                    'message' => 'Appointment successfully created'
                ));
    
            }
            
        }

        function delete($f3, $params) {

            header('Content-type:application/json');
    
            $id = $params['id'];
    
            if(empty($id)) {
    
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));
                
                return;
            
            }
    
            $appointment = new Appointment($this->db);
    
            $result = $appointment->getById($id);
    
            if(count($result) <= 0) {
    
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Appointment does not exist'
                ));
    
                return;
    
            }
    
            $data['modified'] = date('Y-m-d H:i:s');
            $data['id'] = $id;
            $data['disabled'] = 1;
    
            $appointment->delete($data);
    
            echo json_encode(array(
                'success' => true,
                'message' => 'Appointment successfully deactivated'
            ));
    
        }

    }

?>