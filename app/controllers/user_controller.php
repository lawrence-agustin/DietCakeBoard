<?php
class UserController extends AppController
{
    const REGISTRATION = 'registration';
    const REGISTRATION_END = 'registration_end';
    
    public function registration()
    {
        $params = array(
            'username' => Param::get('username'),
            'firstname' => Param::get('firstname'),
            'lastname' => Param::get('lastname'),
            'password' => Param::get('password'),
            'middlename' => Param::get('middlename'),
            'email' => Param::get('email'),
            );

        $user = new User();
        $user->setUserInfo($params);
        $page = Param::get('page_next', 'registration');

        switch ($page) {    
            case self::REGISTRATION:
                break;

            case self::REGISTRATION_END:
                try {
                    $user->create();
                } catch (ValidationException $e) {
                    $page = 'registration';
                }
                break;

            default:
                throw new NotFoundException("{$page} is not found");
                break;
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function login()
    {
        if(!isset($_SESSION["username"])) 
        {
            $check = Param::get('call', false);
            $error = false;

            if($check)
            {
                $params = array(
                    'username' => Param::get('username', ''),
                    'password' => Param::get('password', '')
                );
                $login = new Login($params);
                try {
                    $login->checkInput();
                    $login->accept();
                } 
                catch (ValidationException $e) {
                    $error = true;
                } 
                catch (RecordNotFoundException $e) {
                    $login->error = true;
                }

                if (!$login->hasError() && !($error)) {       
                    $redirect_url = "thread/index";     
                    session_start();
                    $_SESSION["username"] = Param::get('username');
                    $_SESSION["user_id"] = User::getUserId($_SESSION["username"]);
                    $_SESSION["alreadyLoggedIn"] = true;
                    redirect("login_end");
                }
            }
            if (isset($_SESSION['username'])) {
                redirect("user/login_end");
            }
            $this->set(get_defined_vars());
        }
        else redirect(url('user/login_end'));
    }

    public function login_end()
    {
        $username = $_SESSION["username"];
        $userId = User::getUserId($username);
        $this->set(get_defined_vars());
    }

    public function profile()
    {
        if(isset($_SESSION["username"])) {
            $user_id = Param::get('user_id');
            $user_info = User::getInfoById($user_id);
            $this->set(get_defined_vars());
        }
        else redirect(url('user/login_notice'));
    }



    public function logout()
    {
        session_destroy();
    }

    public function login_notice()
    {
    }





}
?>