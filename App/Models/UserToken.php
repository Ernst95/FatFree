<?php

    class UserToken extends DB\SQL\Mapper {

        public function __construct(DB\SQL $db) {
            parent::__construct($db, 'usertoken');
        }

        public function generateToken($data) {

            $token = bin2hex(random_bytes(64));

            $data['token'] = $token;

            $this->load(array('userId = ?', $data['userId']));

            $this->copyFrom($data);
    
            $this->save();
            
            return $token;

        }

        public function verifyToken($data) {

            $this->load(array('token = ?', $data));

            return $this->cast(); 

        }

    }

?>