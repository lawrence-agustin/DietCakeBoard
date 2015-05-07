<?php
	class User extends AppModel
	{

			public $validation = array(
	                    
		        'username' => array(
		               'length' => array(                        
		                     'validate_between', 8, 20,
		                ),        
		          ),

		         'password' => array(                    
		               'length' => array(                
		                      'validate_between', 8, 200,
		                ),
		          ),

		         'lastname' => array(                    
		               'length' => array(                
		                      'validate_between', 8, 200,
		                ),
		          ),
		         'firstname' => array(                    
		               'length' => array(                
		                      'validate_between', 8, 200,
		                ),
		          ),
		         'middlename' => array(                    
		               'length' => array(                
		                      'validate_between', 8, 200,
		                ),
		          ),



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
			$this->password = $userInfo['pw'];
			$this->lastName = $userInfo['lastname'];
			$this->firstName = $userInfo['firstname'];
			$this->middleName = $userInfo['middlename'];
		}


		public function create()
		{
			$db = DB::conn();
			$db->begin();

			$db->query('INSERT INTO user SET username=?, password=?, lastname=?, firstname=?, middlename=?',
						array($this->userName, $this->password, $this->lastName, $this->firstName, $this->middleName));
			$this->id = $db->lastInsertId();
			$db->commit();
		
		}

		public function authenticateUser($username,$password)
		{
			$db = DB::conn();
			$db->begin();
			$user = $db->query('SELECT * FROM user WHERE username = ? AND password = ?', $username, $password);
			

			if(!$user){
				throw new RecordNotFoundException('Incorrect username')
			}

		}



	

	}
	
?>