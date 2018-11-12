<?php

    class Service extends DB\SQL\Mapper {
        
        public function __construct(DB\SQL $db) {
            parent::__construct($db, 'service');
        }

        public function getAll() {

            $query = "SELECT * FROM service";
    
            $result = $this->db->exec($query);
    
            return $result;
        
        }

        public function getByName() {

            $this->load(array('name = ?', $name));

            return $this->cast;

        }

    }

?>