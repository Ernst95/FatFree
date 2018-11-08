<?php

class UserController extends Controller {

    function beforeroute() {

        /*$userId = $this->f3->get('SESSION.USER_ID');
        $password = $this->f3->get("SESSION.PASSWORD");
        
        if(empty($userId) || empty($password)) {
            $this->f3->error(403);
        }*/

        $userToken = new UserToken($this->db);

        $token = $this->f3->get('HEADERS.Token');

        $result = $userToken->verifyToken($token);

        if(count($result) <= 0 || $result['expiryDate'] < date('Y-m-d H:i:s')) {
            $this->f3->error(403);
        }

    }

    function getAll($f3, $params) {
        
        header('Content-type:application/json');

        $user = new User($this->db);

        $result = $user->getAll();

        /*if(count($result) < 0) {
            echo json_encode(array(
                'success' => false,
                'message' => 'User does not exist'
            ));
            return;
        }*/

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

        $data = json_decode($f3->get('BODY'), true);

        if(!empty($params['userId'])) {

            $data['userId'] = $userId;

            $user = new User($this->db);
    
            $result = $user->getById($userId);

            if(count($result) <= 0) {
            
                echo json_encode(array(
                    'success' => false,
                    'message' => 'User does not exist'
                ));
    
                return;
    
            }

            $user->create($data);

            echo json_encode(array(
                'success' => true,
                'message' => 'User successfully updated'
            ));

        }
        else {

            $user->create($data);

            echo json_encode(array(
                'success' => true,
                'message' => 'User successfully created'
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

        if(count($result) <= 0) {

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