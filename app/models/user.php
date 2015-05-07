<?php
    class User extends AppModel
    {

            public $validation = array(
                        
                'userName' => array('length' => array('validate_between', 8, 20)),
                'password' => array('length' => array('validate_between', 8, 20)),
                'lastName' => array('length' => array('validate_between', 8, 20)),
                'firstName' => array('length' => array('validate_between', 8, 20)),
                'middleName' => array('length' => array('validate_between', 8, 20))

             );
            
        private $userName;
        private $password;
        private $lastName;
        private $firstName;
        private $middleName;

        private $userInfo;

        public function __construct()
        {
            $this->userName = '';
            $this->password = '';
            $this->lastName = '';
            $this->firstName = '';
            $this->middleName = '';
            $this->userInfo = array();
        }

        public function setUserInfo($userInfo)
        {
            $this->userName = $userInfo['username'];
            $this->password = $userInfo['password'];
            $this->lastName = $userInfo['lastname'];
            $this->firstName = $userInfo['firstname'];
            $this->middleName = $userInfo['middlename'];
        }


        public function create()
        {
            
            if (!$this->validate()) {
                throw new ValidationException('invalid Input');
            }
            
            try
            {
                $db = DB::conn();
                $params = array( 
                    'username' => $this->userName,
                    'firstname' => $this->firstName,
                    'lastname' => $this->lastName,
                    'middlename' => $this->middleName,
                    'password' => $this->password
                );
                $db->insert('user',$params);
                $this->created = true;          
                $this->id = $db->lastInsertId();
                $db->commit();
            }catch (Exception $e){
                throw $e;
            }


        
        }

        // public function create()
        // {
        //     if(!$this->validate()){
        //     throw new ValidationException('Invalid Comment');
        //     }
        //     $db = DB::conn();
        //     $db->begin();

        //     $params = array($this->userName, $this->password, $this->lastName, $this->firstName, $this->middleName);
        //     $db->insert('user',$params);
                      
        //     $this->id = $db->lastInsertId();
        //     $db->commit();


        
        // }


        // public function create()
        // {

        //     try {
        //         $db = DB::conn(); 
        //         $db->begin();
        //         $params = array( 
        //             'userName' => $this->userName,
        //             'firstName' => $this->firstName,
        //             'lastName' => $this->lastName,
        //             'middleName' => $this->middleName,
        //             'password' => $this->password
        //         );
        //         $db->insert('user', $params); 
        //         $db->commit();

        //     } catch(Exception $e) {
        //         $db->rollback();
        //         throw $e;
        //     }
        // }

        // public function authenticateUser($userName,$password)
        // {
        //     $db = DB::conn();
        //     $db->begin();
        //     $user = $db->query("SELECT * FROM user WHERE userName = ?", array($userName));
        //     $password = $db->query("SELECT * FROM user WHERE password = ?", array($password));          

        //     if(!$user){
        //         throw new RecordNotFoundException('Incorrect userName'); return false;
        //     }
        //     else if(!$password){
        //         throw new RecordNotFoundException('Incorrect password'); return false;
        //     }
        //     else{
        //         return true;
        //     }


        }



    

    
    
?>