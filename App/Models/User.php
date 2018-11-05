<?php

class User extends DB\SQL\Mapper{

    public function __construct(DB\SQL $db) {
        parent::__construct($db, 'user');
    }

    public function getAll() {
        /*$this->load();
        return $this->query;*/

        $query = "SELECT * FROM user";

        $result = $this->db->exec($query);

        return $result;
    
    }

    public function getById($userid) {
        /*$this->load(array('userId=?', $userid));
        return $this->query;*/

        $query = "SELECT * FROM user WHERE userId = '$userid'";

        $result = $this->db->exec($query);

        return $result;

    }

    public function getByEmail($email) {

        $query = "SELECT * FROM user WHERE email = '$email'";

        $result = $this->db->exec($query);

        return $result;

    }

    public function getByMobileNumber($mobileNumber) {

        $query = "SELECT * FROM user WHERE mobileNumber '$mobileNumber'";

        $result = $this->db->exec($query);

        return $result;
    
    }

    public function getByUserGroupId($userGroupId) {

        $query = "SELECT * FROM user WHERE userGroupId '$userGroupId'";

        $result = $this->db->exec($query);

        return $result;
    
    }

}

?>