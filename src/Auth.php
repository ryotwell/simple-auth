<?php

namespace Ryodevz;

use Ryodevz\Database;
use Ryodevz\User;

class Auth
{
    public static $config;

    public static function user()
    {
        return (isset($_SESSION['_user_data_']) ? new User($_SESSION['_user_data_']) : new User([
            'username' => null
        ]));
    }

    public static function sessionStart()
    {
        return session_start();
    }

    public static function setConfig()
    {
        $config = require 'config/simpleauth.php';
        self::$config = $config;

        return self::$config;
    }

    public static function login()
    {
        self::setConfig();

        if (isset($_POST[self::$config['auth']['login']['fields']['btnLogin']])) {
            $data = self::getFields(self::$config['auth']['login']['fields']);

            $user = Database::query("SELECT * FROM " . self::$config['database']['users_table']['table'] . " WHERE `" . self::$config['database']['users_table']['username'] . "` = '{$data['username']}'")->fetch_assoc();

            if ($user > 0) {
                if (self::$config['auth']['login']['password_hash'] == true) {
                    if (password_verify($data['password'], $user[self::$config['database']['users_table']['password']])) {
                        $_SESSION['_user_data_'] = [
                            'username' => $user['username'],
                        ];

                        return self::redirect(self::$config['auth']['login']['redirect']['success']);
                    }
                } else {
                    if ($data['password'] == $user[self::$config['database']['users_table']['password']]) {
                        $_SESSION['_user_data_'] = [
                            'username' => $user['username'],
                        ];

                        return self::redirect(self::$config['auth']['login']['redirect']['success']);
                    }
                }
            }
            return self::redirect(self::$config['auth']['login']['base'] . '?error=Invalid ' . self::$config['database']['users_table']['username'] . ' or ' . self::$config['database']['users_table']['password'] . '.');
        }
    }

    public static function logout()
    {
        return session_unset();
    }

    public static function error()
    {
        return (!empty($_GET['error']) ? $_GET['error'] : null);
    }

    public static function getFields(array $submit)
    {
        return [
            'username' => $_POST[$submit['username']],
            'password' => $_POST[$submit['password']]
        ];
    }

    public static function redirect($link)
    {
        return header('location: ' . $link);
    }

    public static function print_($data)
    {
        return print_r(json_encode($data));
    }
}
