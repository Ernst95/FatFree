<?php

class User extends DB\SQL\Mapper{

    public function __construct(DB\SQL $db) {
        parent::__construct($db, 'user');
    }

    public function getAll($disabled) {

        $query = "SELECT * FROM user WHERE disabled = $disabled";

        $result = $this->db->exec($query);

        return $result;
    
    }

    public function getById($userId) {

        $query = "SELECT * FROM user WHERE userId = '$userId' AND disabled = 0";

        $result = $this->db->exec($query);

        return $result;

    }

    public function getByEmail($email) {

        $query = "SELECT * FROM user WHERE email = '$email' AND disabled = 0";

        $result = $this->db->exec($query);

        return $result;

    }

    public function getByMobileNumber($mobileNumber) {

        $query = "SELECT * FROM user WHERE mobileNumber = '$mobileNumber' AND disabled = 0";

        $result = $this->db->exec($query);

        return $result;
    
    }

    public function getByUserGroupId($userGroupId) {

        $query = "SELECT * FROM user WHERE userGroupId = '$userGroupId' AND disabled = 0";

        $result = $this->db->exec($query);

        return $result;
    
    }

    public function create($data) {

        $this->load(array('userId = ?', $data['userId']));

        $this->copyFrom($data);

        $this->save();

    }

    public function delete($data) {

        $this->load(array('userId = ?', $data['userId']));

        $this->copyFrom($data);

        $this->save();

    }

}

?>