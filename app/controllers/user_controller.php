<?php
	class UserController extends AppController
	{
		public function login()
		{
			$userid = Param::get('uid');
			$pw = Param::get('pw');
			$this->set(get_defined_vars());
		}

		public function registration()
		{
			$user = new User;
			$this->set(get_defined_vars());

		}

		public function registration_end()
		{
			// $user = new User;
			 $userinfo = array();
			// if(!$user->validate()){
			// 	throw new ValidationException('Registration Unsuccessful');
				
			// }
			// else
			// {
				
				$userinfo['username'] = Param::get('username');
				$userinfo['password'] = Param::get('pw');
				$userinfo['lastname'] = Param::get('lastname');
				$userinfo['firstname'] = Param::get('firstname');
				$userinfo['middlename'] = Param::get('middlename');
				$this->set(get_defined_vars());
				// $userinfo['pw'] = Param::get('pw');
				// $userinfo['lastname'] = Param::get('lastname');
				// $userinfo['firstname'] = Param::get('firstname');
				// $userinfo['middlename'] = Param::get('middlename');



			// 	$user->setUserInfo($userinfo);
			// 	$user->create();
			// 	$this->set(get_defined_vars());
				  
			// }

			 
			                 
         
		}
	}

?>