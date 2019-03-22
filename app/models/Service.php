<?php

    class Service extends DB\SQL\Mapper {
        
        public function __construct(DB\SQL $db) {
            parent::__construct($db, 'service');
        }

        public function getAll($disabled) {

            try {
 
                $query = "SELECT * FROM service WHERE disabled = $disabled";
        
                $result = $this->db->exec($query);
        
                return $result;

            }
            catch(Exception $e) {

                throw new Exception($e);

            }
        
        }

        public function getByName($name) {

            try {

                $query = "SELECT * FROM service WHERE name = '$name' AND disabled = 0";

                $result = $this->db->exec($query);
        
                return $result;

            }
            catch(Exception $e) {

                throw new Exception($e);

            }

        }

        public function getById($id) {

            try {

                $query = "SELECT * FROM service WHERE id = '$id' AND disabled = 0";

                $result = $this->db->exec($query);
        
                return $result;

            }
            catch(Exception $e) {

                throw new Exception($e);

            }

        }

        public function create($data) {

            try {

                $this->load(array('name = ?', $data['name']));

                $this->copyFrom($data);
    
                $this->save();

            }
            catch(Exception $e) {

                throw new Exception($e);

            }

        }

        public function delete($data) {

            try {

                $this->load(array('name = ?', $data['name']));

                $this->copyFrom($data);
    
                $this->save();

            }
            catch(Exception $e) {

                throw new Exception($e);

            }

        }

    }

?>