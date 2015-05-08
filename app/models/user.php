<?php
class User extends AppModel
{

    public $validation = array(                        
        'username' => array('length' => array('validate_between', 8, 20)),
        'password' => array('length' => array('validate_between', 8, 20)),
        'lastname' => array('length' => array('validate_between', 3, 20)),
        'firstname' => array('length' => array('validate_between', 3, 20)),
        'middlename' => array('length' => array('validate_between', 3, 20))
        );


    public function __construct()
    {
        $this->username = '';
        $this->password = '';
        $this->lastname = '';
        $this->firstname = '';
        $this->middlename = '';
        $this->userInfo = array();
    }

    public function setUserInfo($userInfo)
    {
        $this->username = $userInfo['username'];
        $this->password = $userInfo['password'];
        $this->lastname = $userInfo['lastname'];
        $this->firstname = $userInfo['firstname'];
        $this->middlename = $userInfo['middlename'];
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
                'username' => $this->username,
                'firstname' => $this->firstname,
                'lastname' => $this->lastname,
                'middlename' => $this->middlename,
                'password' => $this->password
                );
            $db->insert('user',$params);
            $this->created = true;          
            $this->id = $db->lastInsertId();

        }catch (Exception $e){
            throw $e;
        }
    }
}
?>