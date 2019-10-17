<?php

class UserController extends Controller {

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

            $user = new User($this->db);

            $result = $user->getAll($disabled);

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

    function getUser($f3, $params) {
        
        header('Content-type:application/json');

        try {

            $userId = $params['userId'];

            if(empty($userId)) {

                $f3->error(400, 'Missing one or more required fields');

                exit;

            }

            $user = new User($this->db);

            $result = $user->getById($userId);

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

            $user = new User($this->db);

            $data = json_decode($f3->get('BODY'), true);

            if(empty($params['userId'])) {

                $result = $user->getByEmail($data['email']);
                
                if(!empty($result)) {
        
                    $f3->error(400, 'Email already exist');

                    exit;

                }
        
                $result = $user->getByMobileNumber($data['mobileNumber']);
                
                if(!empty($result)) {
        
                    $f3->error(400, 'Email already exist');

                    exit;

                }

                if(empty($data['title']) || empty($data['firstName']) || empty($data['lastName']) || empty($data['dateOfBirth']) || empty($data['gender']) || empty($data['mobileNumber']) || empty($data['telephoneNumber']) || empty($data['email']) || empty($data['userGroupId'])) {

                    $f3->error(400, 'Missing one or more required fields');

                    exit;

                }

                if(($data['userGroupId'] == 2 || $data['userGroupId'] == 3) && empty($data['password'])) {

                    $f3->error(400, 'Missing password field');

                    exit;

                }

                do {

                    $data['userId'] = $data['firstName'] . $data['lastName'][0] . bin2hex(random_bytes(2));

                    $result = $user->getById($data['userId']);

                } while(!empty($result));

                $data['password'] = md5($data['password']);
                $data['created'] = date('Y-m-d H:i:s');
                $data['disabled'] = 0;

                $user->create($data);

                Response::successResponse(array('userId' => $data['userId']));

                exit;

            }
            else {

                $data['userId'] = $params['userId'];
        
                $result = $user->getById($data['userId']);

                if(empty($result)) {
        
                    $f3->error(400, 'User does not exist');

                    exit;
        
                }

                $result = $user->getByEmail($data['email'])[0];
                
                if(!empty($result) && ($result['userId'] != $params['userId'])) {
        
                    $f3->error(400, 'Email already exist');

                    exit;

                }
        
                $result = $user->getByMobileNumber($data['mobileNumber'])[0];
                
                if(!empty($result) && ($result['userId'] != $params['userId'])) {
        
                    $f3->error(400, 'Mobile number already exist');

                    exit;

                }

                unset($data['password']);

                $user->create($data);

                Response::successResponse(array('userId' => $data['userId']));

                exit;

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

            $userId = $params['userId'];

            if(empty($userId)) {

                $f3->error(400, 'Missing one or more required fields');

                exit;
            
            }

            $user = new User($this->db);

            $result = $user->getById($userId);

            if(empty($result)) {

                $f3->error(400, 'User does not exist');

                exit;

            }

            $data['modified'] = date('Y-m-d H:i:s');
            $data['userId'] = $userId;
            $data['disabled'] = 1;

            $user->delete($data);

            Response::successMessage('User successfully deleted');

            exit;

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