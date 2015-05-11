<?php
class UserController extends AppController
{

    public function registration()
    {
        $params = array(
            'username' => Param::get('username'),
            'firstname' => Param::get('firstname'),
            'lastname' => Param::get('lastname'),
            'password' => Param::get('password'),
            'middlename' => Param::get('middlename')
            );

        $user = new User();

        $user->setUserInfo($params);
        $page = Param::get('page_next', 'registration');

        switch ($page) {    
            case 'registration':
            break;

            case 'registration_end':
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

        $error = false;
        $url = '';
        $isLoggedIn = false;

        // if($isLoggedIn){
            $params = array(
                'username' => Param::get('username', ''),
                'password' => Param::get('password', '')
            );
            $login = new Login($params);
            try {
                $login->checkInput();
                $login->accept();
            } catch (ValidationException $e) {
                $error = true;
            } catch (RecordNotFoundException $e) {
                $login->error = true;
            }
            if (!$login->hasError() && !($error)) { 
                $_POST['username'] = $login->username;
                redirect('login_end');     
             }
        //}

        if (isset($_SESSION['username'])) {
            eh(url('thread/index'));            
        }
        $this->set(get_defined_vars());

    }

    public function login_end()
    {

    }





}
?>