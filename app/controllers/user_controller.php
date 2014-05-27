<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/1/13
 * Time: 9:28 PM
 * To change this template use File | Settings | File Templates.
 */

class UserController extends AppController
{
    public function login()
    {
        is_logged_in();

        $user = new User();
        $page = Param::get('page_next', 'login');
        $username = Param::get('username');
        $user->username = $username;
        $user->password = Param::get('password');

        if ($page == User::LOGIN) {
            try {
                if ($user->login()) {
                    $_SESSION['username'] = $username;
                    try {
                        $character = Character::get($username);
                        $_SESSION['char_name'] = $character->getName();
                        $page2 = 'character/character_main';
                    } catch(RecordNotFoundException $e) {
                        $page2 = 'character/character_create';
                    }
                }
            } catch(ValidationException $e) {
                $page = 'login';
            } catch(RecordNotFoundException $e) {
                $page = 'login';
            }
        }

        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function register()
    {
        is_logged_in();

        $user = new User();
        $page = Param::get('page', 'register_end');
        $user->username = Param::get('username');
        $user->password = Param::get('password');
        $user->rep_password = Param::get('rep_pass');
        $user->email = Param::get('email');

        if ($page == User::REGISTER_OK) {
            try {
                $user->register();
            } catch (ValidationException $e) {
                $page = 'register';
            }
        }
        $this->set(get_defined_vars());
        $this->render($page);

    }

    public function logout()
    {
        session_unset();
        session_destroy();
        redirect('user/login');
    }
}