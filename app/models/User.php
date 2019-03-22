<?php

class User extends DB\SQL\Mapper{

    public function __construct(DB\SQL $db) {
        parent::__construct($db, 'user');
    }

    public function getAll($disabled) {

        try {

            $query = "SELECT * FROM user WHERE disabled = $disabled";

            $result = $this->db->exec($query);
    
            return $result;

        }
        catch(Exception $e) {

            throw new Exception($e);

        }
    
    }

    public function getById($userId) {

        try {

            $query = "SELECT * FROM user WHERE userId = '$userId' AND disabled = 0";

            $result = $this->db->exec($query);
    
            return $result;

        }
        catch(Exception $e) {

            throw new Exception($e);

        }

    }

    public function getByEmail($email) {

        try {

            $query = "SELECT * FROM user WHERE email = '$email' AND disabled = 0";

            $result = $this->db->exec($query);
    
            return $result;

        }
        catch(Exception $e) {

            throw new Exception($e);

        }

    }

    public function getByMobileNumber($mobileNumber) {

        try {

            $query = "SELECT * FROM user WHERE mobileNumber = '$mobileNumber' AND disabled = 0";

            $result = $this->db->exec($query);
    
            return $result;

        }
        catch(Exception $e) {

            throw new Exception($e);

        }
    
    }

    public function getByUserGroupId($userGroupId) {

        try {

            $query = "SELECT * FROM user WHERE userGroupId = '$userGroupId' AND disabled = 0";

            $result = $this->db->exec($query);
    
            return $result;

        }
        catch(Exception $e) {

            throw new Exception($e);

        }
    
    }

    public function create($data) {

        try {

            $this->load(array('userId = ?', $data['userId']));

            $this->copyFrom($data);
    
            $this->save();

        }
        catch(Exception $e) {

            throw new Exception($e);

        }

    }

    public function delete($data) {

        try {

            $this->load(array('userId = ?', $data['userId']));

            $this->copyFrom($data);
    
            $this->save();

        }
        catch(Exception $e) {

            throw new Exception($e);

        }

    }

}

?>