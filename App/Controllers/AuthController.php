<?php

    class AuthController extends Controller {

        function authenticate($f3, $params) {

            header('Content-type:application/json');

            $data = json_decode($f3->get('BODY'), true);

            $user = new User($this->db);
            $result = $user->getById($data['userId'])[0];

            if(count($result) <= 0) {

                echo json_encode(array(
                    'success' => false,
                    'message' => 'Incorrect username or password'
                ));

                return;

            }

            if(md5($data['password']) == $result['password']) {

                /*$this->f3->set('SESSION.USER_ID', $result['userId']);
                $this->f3->set('SESSION.PASSWORD', $result['password']);*/    
                
                $userToken = new UserToken($this->db);

                $data['password'] = '';
                $data['expiryDate'] = date('Y-m-d H:i:s', strtotime('+5 hour', strtotime(date('Y-m-d H:i:s'))));
                $data['created'] = date('Y-m-d H:i:s');
                $data['disabled'] = 0;

                $token['token'] = $userToken->generateToken($data);

                echo json_encode(array(
                    'success' => true,
                    'result' => $token
                ));

                return;

            }
            else {

                echo json_encode(array(
                    'success' => false,
                    'message' => 'Incorrect username or password'
                ));

                return;
            
            }

        }

    }

?>