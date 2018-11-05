<?php

class UserController extends Controller {

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
                'message' => 'Missing fields'
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

}


?>