<?php
class UserController extends AppController
{
    public function login()
    {

    }

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
}
?>