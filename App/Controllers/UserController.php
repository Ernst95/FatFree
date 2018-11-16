<?php

class UserController extends Controller {

    function beforeroute() {

        date_default_timezone_set("Africa/Johannesburg");

        $userToken = new UserToken($this->db);

        $token = $this->f3->get('HEADERS.Token');

        $result = $userToken->verifyToken($token);

        if(empty($result) || $result['expiryDate'] < date('Y-m-d H:i:s')) {
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

        $user = new User($this->db);

        $result = $user->getAll($disabled);

        echo json_encode(array(
            'success' => true,
            'count' => count($result),
            'results' => $result
        ));

    }

    function getUser($f3, $params) {
        
        header('Content-type:application/json');

        $userId = $params['userId'];

        if(empty($userId)) {

            echo json_encode(array(
                'success' => false,
                'message' => 'Missing one or more required fields'
            ));

            return;

        }

        $user = new User($this->db);

        $result = $user->getById($userId);

        echo json_encode(array(
            'success' => true,
            'count' => count($result),
            'results' => $result
        ));

    }

    function create($f3, $params) {

        header('Content-type:application/json');

        date_default_timezone_set("Africa/Johannesburg");

        $user = new User($this->db);

        $data = json_decode($f3->get('BODY'), true);

        if(empty($params['userId'])) {

            $result = $user->getByEmail($data['email']);
            
            if(!empty($result)) {
    
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Email already exist'
                ));
    
                return;
            }
    
            $result = $user->getByMobileNumber($data['mobileNumber']);
            
            if(!empty($result)) {
    
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Mobile number already exist'
                ));
    
                return;
            }

            if(empty($data['title']) || empty($data['firstName']) || empty($data['lastName']) || empty($data['dateOfBirth']) || empty($data['gender']) || empty($data['mobileNumber']) || empty($data['telephoneNumber']) || empty($data['email']) || empty($data['userGroupId'])) {

                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));

                return;

            }

            if(($data['userGroupId'] == 2 || $data['userGroupId'] == 3) && empty($data['password'])) {

                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing password field'
                ));

                return;

            }

            do {

                $data['userId'] = $data['firstName'] . $data['lastName'][0] . bin2hex(random_bytes(2));

                $result = $user->getById($data['userId']);

            } while(!empty($result));

            $data['password'] = md5($data['password']);
            $data['created'] = date('Y-m-d H:i:s');
            $data['disabled'] = 0;

            $user->create($data);

            echo json_encode(array(
                'success' => true,
                'userId' => $data['userId']
            ));

        }
        else {

            $data['userId'] = $params['userId'];
    
            $result = $user->getById($data['userId']);

            if(empty($result)) {
            
                echo json_encode(array(
                    'success' => false,
                    'message' => 'User does not exist'
                ));
    
                return;
    
            }

            $result = $user->getByEmail($data['email'])[0];
            
            if(!empty($result) && ($result['userId'] != $params['userId'])) {
    
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Email already exist'
                ));
    
                return;
            }
    
            $result = $user->getByMobileNumber($data['mobileNumber'])[0];
            
            if(!empty($result) && ($result['userId'] != $params['userId'])) {
    
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Mobile number already exist'
                ));
    
                return;
            }

            unset($data['password']);

            $user->create($data);

            echo json_encode(array(
                'success' => true,
                'message' => 'User successfully updated'
            ));

        }
        
    }

    function delete($f3, $params) {

        header('Content-type:application/json');

        $userId = $params['userId'];

        if(empty($userId)) {

            echo json_encode(array(
                'success' => false,
                'message' => 'Missing one or more required fields'
            ));
            
            return;
        
        }

        $user = new User($this->db);

        $result = $user->getById($userId);

        if(empty($result)) {

            echo json_encode(array(
                'success' => false,
                'message' => 'User does not exist'
            ));

            return;

        }

        $data['modified'] = date('Y-m-d H:i:s');
        $data['userId'] = $userId;
        $data['disabled'] = 1;

        $user->delete($data);

        echo json_encode(array(
            'success' => true,
            'message' => 'User successfully deactivated'
        ));

    }

}


?>