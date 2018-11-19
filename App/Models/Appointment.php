<?php

    class Appointment extends DB\SQL\Mapper {
        
        public function __construct(DB\SQL $db) {
            parent::__construct($db, 'appointment');
        }

        public function getAll($disabled) {

            $query = "SELECT * FROM appointment WHERE disabled = $disabled";
    
            $result = $this->db->exec($query);
    
            return $result;
        
        }

        public function getById($id) {

            $query = "SELECT * FROM appointment WHERE id = '$id' AND disabled = 0";

            $result = $this->db->exec($query);
    
            return $result;

        }

        public function create($data) {

            $this->load(array('id = ?', $data['id']));

            $this->copyFrom($data);

            $this->save();

        }

        public function delete($data) {

            $this->load(array('id = ?', $data['id']));

            $this->copyFrom($data);

            $this->save();

        }

    }

?>