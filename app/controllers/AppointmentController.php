<?php

class AppointmentController extends Controller {

    function beforeroute() {
        
        //Check to make sure token passed is valid
        try {

            $userToken = new UserToken($this->db);

            $token = $this->f3->get('HEADERS.Token');

            $result = $userToken->verifyToken($token);

            if(empty($result) || $result['expiryDate'] < date('Y-m-d H:i:s')) {
                $this->f3->error(403);
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
        catch(Exception $e) {

            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));

        }

    }

    function getById($f3, $params) {

        header('Content-type:application/json');

        try {

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
        catch(Exception $e) {

            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));

        }

    }

    function create($f3, $params) {

        header('Content-type:application/json');
    
        try {

            $data = json_decode($f3->get('BODY'), true);

            $appointment = new Appointment($this->db);

            $user = new User($this->db);
        
            if(empty($params['id'])) {

                if(empty($data['date']) || empty($data['custUserId']) || empty($data['empUserId'])) {
    
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Missing one or more required fields'
                    ));
        
                    return;
        
                }
                
                $result = $user->getById($data['custUserId'])[0];
        
                if(empty($result) || ($result['userGroupId'] != 1)) {
                
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Customer does not exist'
                    ));
        
                    return;
        
                }
    
                $result = $user->getById($data['empUserId'])[0];
        
                if(empty($result) || (($result['userGroupId'] != 2) && ($result['userGroupId'] != 3))) {
                
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Employee does not exist'
                    ));
        
                    return;
        
                }
    
                $data['created'] = date('Y-m-d H:i:s');
                $data['disabled'] = 0;
    
                $appointment->create($data);
    
                echo json_encode(array(
                    'success' => true,
                    'message' => 'Appointment successfully created'
                ));
    
            }
            else {

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

        }
        catch(Exception $e) {

            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));

        }
        
    }

    function delete($f3, $params) {

        header('Content-type:application/json');

        try {

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
        catch(Exception $e) {

            echo json_encode(array(
                'success' => false,
                'message' => $e->getMessage()
            ));

        }

    }

}

?>