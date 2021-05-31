<?php

class AppointmentController extends Controller {

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

            $disabled = $params['disabled'];

            if($disabled < 0) {

                $f3->error(400, 'Missing one or more required fields');

                exit;

            }

            $appointment = new Appointment($this->db);

            $result = $appointment->getAll($disabled);

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

            $id = $params['id'];

            if(empty($id)) {

                $f3->error(400, 'Missing one or more required fields');

                exit;

            }

            $appointment = new Appointment($this->db);

            $result = $appointment->getById($id);

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

            $appointment = new Appointment($this->db);

            $user = new User($this->db);
        
            if(empty($params['id'])) {

                if(empty($data['date']) || empty($data['custUserId']) || empty($data['empUserId'])) {
    
                    $f3->error(400, 'Missing one or more required fields');

                    exit;
            
                }
                
                $result = $user->getById($data['custUserId'])[0];
        
                if(empty($result) || ($result['userGroupId'] != 1)) {

                    $f3->error(400, 'Customer does not exist');

                    exit;
        
                }
    
                $result = $user->getById($data['empUserId'])[0];
        
                if(empty($result) || (($result['userGroupId'] != 2) && ($result['userGroupId'] != 3))) {
  
                    $f3->error(400, 'Employee does not exist');

                    exit;
        
                }
    
                $data['created'] = date('Y-m-d H:i:s');
                $data['disabled'] = 0;
                $data['status'] = 'p';
    
                $appointment->create($data);
    
                Response::successMessage('Appointment successfully created');

                exit;
    
            }
            else {

                $id = $params['id'];
        
                $result = $appointment->getById($id);
    
                if(empty($result)) {
                
                    $f3->error(400, 'Appointment does not exist');

                    exit;
        
                }

                $data['id'] = $params['id'];
                $data['modified'] = date('Y-m-d H:i:s');
        
                $appointment->create($data);
    
                Response::successMessage('Appointment successfully updated');
    
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

            $id = $params['id'];

            if(empty($id)) {
    
                $f3->error(400, 'Missing one or more required fields');

                exit;
            
            }
    
            $appointment = new Appointment($this->db);
    
            $result = $appointment->getById($id);
    
            if(empty($result)) {
    
                $f3->error(400, 'Appointment does not exist');

                exit;
    
            }
    
            $data['modified'] = date('Y-m-d H:i:s');
            $data['id'] = $id;
            $data['disabled'] = 1;
            $data['status'] = 'x';
    
            $appointment->delete($data);

            Response::successMessage('Appointment successfully deleted');

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