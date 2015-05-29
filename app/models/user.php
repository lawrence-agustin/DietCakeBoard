<?php
class User extends AppModel
{

    public $validation = array(                        
        'username'      => array('length' => array('validate_between', 8, 20), 'exists' => array('userExists')),
        'password'      => array('length' => array('validate_between', 8, 20)),
        'lastname'      => array('length' => array('validate_between', 3, 20), 'valid'  => array('validate_name')),
        'firstname'     => array('length' => array('validate_between', 3, 20), 'valid'  => array('validate_name')),
        'middlename'    => array('length' => array('validate_between', 3, 20), 'valid'  => array('validate_name')),
        'email'         => array('length' => array('validate_between', 10,35), 'valid'  => array('validate_email'), 'exists' => array('emailExists')),
    );

    public function __construct()
    {
        $this->username = '';
        $this->password = '';
        $this->lastname = '';
        $this->firstname = '';
        $this->middlename = '';
        $this->email = '';
        $this->userInfo = array();
    }

    public function setUserInfo($userInfo)
    {
        $this->username     = $userInfo['username'];
        $this->password     = $userInfo['password'];
        $this->lastname     = $userInfo['lastname'];
        $this->firstname    = $userInfo['firstname'];
        $this->middlename   = $userInfo['middlename'];
        $this->email        = $userInfo['email'];
    }

    public function create()
    {
        if (!$this->validate()) {
            throw new ValidationException('Invalid Input');
        }

        try
        {
            $db = DB::conn();
            $params = array( 
                'username'      => $this->username,
                'firstname'     => $this->firstname,
                'lastname'      => $this->lastname,
                'middlename'    => $this->middlename,
                'password'      => $this->password,
                'email'         => $this->email,
                );
            $db->insert('user',$params);        
            $this->id = $db->lastInsertId();

        } catch (Exception $e){
            throw $e;
        }
    }

    public static function getUserId($username)
    {
        $db = DB::conn();
        $row = $db->row('SELECT user_id FROM user WHERE username = ?', array($username));
        if (!$row) {
            throw new RecordNotFoundException("Error, record not found");
        }
        return $row['user_id'];
    }

    public static function getUsername($id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT username FROM user WHERE user_id = ?', array($id));
        if (!$row) {
            throw new RecordNotFoundException("Error, record not found");
        }
        return $row['username'];
    }

    public static function getInfoById($id)
    {
        try {
            $db = DB::conn();
            $row = $db->row('SELECT * FROM user WHERE user_id = ?', array($id));
        } catch (Exception $e) {
            throw new Exception("Error, record not found");
        }
        return $row;
    }

    public function userExists($username)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM user WHERE username = ? ', array($username));
        if (!$row) {
            return true;
        }
        return false;
    }

    public function emailExists($email)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM user WHERE email = ? ', array($email));
        if (!$row) {
            return true;
        }
        return false;
    }

}
?>