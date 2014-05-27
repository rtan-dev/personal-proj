<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 11/1/13
 * Time: 9:28 PM
 * To change this template use File | Settings | File Templates.
 */

class User extends AppModel
{
    const LOGIN = 'login_success';
    const REGISTER_OK = 'register_end';

    public $rep_password;
    public $page;
    private $is_failed_login = false;

    public $validation = array(
        'username' => array(
            'length' => array(
                'validate_between', 6, 15,
            ),
            'valid' => array(
                'validate_format'
            )
        ),
        'password' => array(
            'length' => array(
                'validate_between', 8, 15
            )
        ),
        'email' => array(
            'valid' => array(
                'validate_email',
            )
        )
    );

    public function isEmailExists()
    {
        $db = DB::conn();

        $row = $db->row('SELECT * FROM user WHERE email=?', array($this->email));

        return $row;
    }

    public function isUserExisting()
    {
        $db = DB::conn();

        $row = $db->row('SELECT * FROM user WHERE username=?', array($this->username));

        return $row;
    }

    public function isPasswordMatching()
    {
        return $this->password == $this->rep_password;
    }

    public function register()
    {
        $this->validation['username']['valid'][] = $this->username;
        $this->validation['email']['valid'][] = $this->email;
        $this->validation['username']['valid'][] = $this->username;
        if (!$this->validate() || $this->isUserExisting() || !$this->isPasswordMatching() || $this->isEmailExists()) {
            throw new ValidationException('Invalid Registration Info!');
        }

        $db = DB::conn();
        $params = array(
            "username" => $this->username,
            "password" => md5($this->password),
            "email" => $this->email
        );
        $db->insert('user', $params);

    }

    public function login()
    {
        if (!$this->validate()) {
            throw new ValidationException('Invalid Login Credentials.');
        }

        $db = DB::conn();
        $row = $db->row(
            'SELECT * FROM user WHERE username=? AND password=?',
            array(
                $this->username,
                md5($this->password),
            )
        );

        if (!$row) {
            $this->is_failed_login = true;
            throw new RecordNotFoundException;
        }

        return $row;
    }

    public static function getUserID($username)
    {
        $db = DB::conn();

        $uid = $db->value('SELECT user_id FROM user WHERE username=?', array($username));

        return $uid;
    }

    public function isFailedLogin()
    {
        return $this->is_failed_login;
    }
}