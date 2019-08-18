<?php

class ServiceController extends Controller {

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

            $service = new Service($this->db);

            $result = $service->getAll($disabled);

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

            $service = new Service($this->db);

            $result = $service->getById($id);

            if(empty($result)) {

                $f3->error(400, 'Service id does not exist');

                exit;
    
            }

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

    function getService($f3, $params) {

        header('Content-type:application/json');

        try {

            $name = $params['name'];

            if(empty($name)) {

                $f3->error(400, 'Missing one or more required fields');

                exit;

            }

            $service = new Service($this->db);

            $result = $service->getByName($name);

            if(empty($result)) {
                
                $f3->error(400, 'Service name does not exist');

                exit;
    
            }

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

            $name = $params['name'];
    
            if(empty($data['name']) || empty($data['price'])) {
    
                $f3->error(400, 'Missing one or more required fields');

                exit;
    
            }

            $service = new Service($this->db);
    
            if(!empty($name)) {
            
                $result = $service->getByName($name);
    
                if(empty($result)) {
                
                    $f3->error(400, 'Service name does not exist');

                    exit;
        
                }

                $data['name'] = $params['name'];
                $data['modified'] = date('Y-m-d H:i:s');
        
                $service->create($data);

                Response::successMessage('Service successfully updated');
    
                exit;
    
            }
            else {
        
                $result = $service->getByName($data['name']);
    
                if(!empty($result)) {
                
                    $f3->error(400, 'Service name already exists');

                    exit;
        
                }
    
                $data['created'] = date('Y-m-d H:i:s');
                $data['disabled'] = 0;
    
                $service->create($data);
    
                Response::successMessage('Service successfully created');

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

            $name = $params['name'];

            if(empty($name)) {
    
                $f3->error(400, 'Missing one or more required fields');

                exit;
            
            }
    
            $service = new Service($this->db);
    
            $result = $service->getByName($name);
    
            if(empty($result)) {
    
                $f3->error(400, 'Service name does not exist');

                exit;
    
            }
    
            $data['modified'] = date('Y-m-d H:i:s');
            $data['name'] = $name;
            $data['disabled'] = 1;
    
            $service->delete($data);
    
            Response::successMessage('Service successfully deleted');

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