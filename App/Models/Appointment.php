<?php

    class Appointment extends DB\SQL\Mapper {
        
        public function __construct(DB\SQL $db) {
            parent::__construct($db, 'appointment');
        }

        public function getAll($disabled) {

            try {

                $query = "SELECT * FROM appointment WHERE disabled = $disabled";
    
                $result = $this->db->exec($query);
        
                return $result;

            }
            catch(Exception $e) {

                throw new Exception($e);

            }
        
        }

        public function getById($id) {

            try {

                $query = "SELECT * FROM appointment WHERE id = '$id' AND disabled = 0";

                $result = $this->db->exec($query);
        
                return $result;   

            }
            catch(Exception $e) {

                throw new Exception($e);

            }            
            
        }

        public function create($data) {

            try {

                $this->load(array('id = ?', $data['id']));

                $this->copyFrom($data);

                $this->save();   

            }
            catch(Exception $e) {

                throw new Exception($e);

            }

        }

        public function delete($data) {

            try {

                $this->load(array('id = ?', $data['id']));

                $this->copyFrom($data);
    
                $this->save();

            }
            catch(Exception $e) {

                throw new Exception($e);

            }
        }

    }

?>