<?php
	class UserController extends AppController
	{
		public function login()
		{
			
			$userid = Param::get('uid');
			$pw = Param::get('pw');
			eh(url('thread/index'));
			$this->set(get_defined_vars());
		}

		public function registration()
		{

		}

		public function registration_end()
		{
			$user = new User;
			$userinfo = array();
			$userinfo['username'] = Param::get('username');
			$userinfo['pw'] = Param::get('pw');
			$userinfo['lastname'] = Param::get('lastname');
			$userinfo['firstname'] = Param::get('firstname');
			$userinfo['middlename'] = Param::get('middlename');

			$user->setUserInfo($userinfo);
			$user->create();
			$this->set(get_defined_vars());                    
         
		}
	}

?>