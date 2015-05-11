<?php
class LoginController extends AppController 
{
    public function login()
    {
        $isLoggedIn = false;
        $error = false;
        $url = '';
        if($isLoggedIn){
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
                eh(url('thread/index'));
            }
        }

        if (isset($_SESSION['username'])) {
            eh(url('thread/index'));            
        }
        $this->set(get_defined_vars());

    }
}
?>

