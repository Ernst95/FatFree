<?php

class ServiceController extends Controller {

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

            $service = new Service($this->db);

            $result = $service->getAll($disabled);

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

            $service = new Service($this->db);

            $result = $service->getById($id);

            if(empty($result)) {
                
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Service id does not exist'
                ));
    
                return;
    
            }

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

    function getService($f3, $params) {

        header('Content-type:application/json');

        try {

            $name = $params['name'];

            if(empty($name)) {

                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));

                return;
            }

            $service = new Service($this->db);

            $result = $service->getByName($name);

            if(empty($result)) {
                
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Service name does not exist'
                ));
    
                return;
    
            }

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

            $name = $params['name'];
    
            if(empty($data['name']) || empty($data['price'])) {
    
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));
    
                return;
    
            }

            $service = new Service($this->db);
    
            if(!empty($name)) {
            
                $result = $service->getByName($name);
    
                if(empty($result)) {
                
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Service name does not exist'
                    ));
        
                    return;
        
                }

                $data['name'] = $params['name'];
                $data['modified'] = date('Y-m-d H:i:s');
        
                $service->create($data);
    
                echo json_encode(array(
                    'success' => true,
                    'message' => 'Service successfully updated'
                ));
    
                return;
    
            }
            else {
        
                $result = $service->getByName($data['name']);
    
                if(!empty($result)) {
                
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Service name already exist'
                    ));
        
                    return;
        
                }
    
                $data['created'] = date('Y-m-d H:i:s');
                $data['disabled'] = 0;
    
                $service->create($data);
    
                echo json_encode(array(
                    'success' => true,
                    'message' => 'Service successfully created'
                ));
    
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

            $name = $params['name'];

            if(empty($name)) {
    
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Missing one or more required fields'
                ));
                
                return;
            
            }
    
            $service = new Service($this->db);
    
            $result = $service->getByName($name);
    
            if(empty($result)) {
    
                echo json_encode(array(
                    'success' => false,
                    'message' => 'Service name does not exist'
                ));
    
                return;
    
            }
    
            $data['modified'] = date('Y-m-d H:i:s');
            $data['name'] = $name;
            $data['disabled'] = 1;
    
            $service->delete($data);
    
            echo json_encode(array(
                'success' => true,
                'message' => 'Service successfully deleted'
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