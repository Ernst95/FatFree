<?php

    class Service extends DB\SQL\Mapper {
        
        public function __construct(DB\SQL $db) {
            parent::__construct($db, 'service');
        }

        public function getAll($disabled) {

            $query = "SELECT * FROM service WHERE disabled = $disabled";
    
            $result = $this->db->exec($query);
    
            return $result;
        
        }

        public function getByName($name) {

            $query = "SELECT * FROM service WHERE name = '$name' AND disabled = 0";

            $result = $this->db->exec($query);
    
            return $result;

        }

        public function getById($id) {

            $query = "SELECT * FROM service WHERE id = '$id' AND disabled = 0";

            $result = $this->db->exec($query);
    
            return $result;

        }

        public function create($data) {

            $this->load(array('name = ?', $data['name']));

            $this->copyFrom($data);

            $this->save();

        }

        public function delete($data) {

            $this->load(array('name = ?', $data['name']));

            $this->copyFrom($data);

            $this->save();

        }

    }

?>