<?php

    class UserToken extends DB\SQL\Mapper {

        public function __construct(DB\SQL $db) {
            parent::__construct($db, 'usertoken');
        }

        public function generateToken($data) {

            try {
    
                $token = bin2hex(random_bytes(64));

                $data['token'] = $token;

                $this->load(array('userId = ?', $data['userId']));

                $this->copyFrom($data);
        
                $this->save();
                
                return $token;

            }
            catch(Exception $e) {
                
                throw new Exception($e);

            }

        }

        public function verifyToken($data) {

            try {
    
                $this->load(array('token = ?', $data));

                return $this->cast(); 

            }
            catch(Exception $e) {
                
                throw new Exception($e);

            }

        }

    }

?>