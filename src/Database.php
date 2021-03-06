<?php

namespace Ryodevz;

class Database
{
    private static $host;

    private static $username;

    private static $password;

    private static $database;

    private static function conn()
    {
        $conn = new \mysqli(self::$host, self::$username, self::$password, self::$database);

        if ($conn->connect_errno > 0) {
            die('Unable to connect to database [' . $conn->connect_error . ']');

            return;
        }

        return $conn;
    }

    private static function setConfig()
    {
        $db = require 'config/simpleauth.php';

        self::$host = $db['database']['host'];
        self::$username = $db['database']['username'];
        self::$password = $db['database']['password'];
        self::$database = $db['database']['database'];

        return true;
    }

    public static function query($query)
    {
        self::setConfig();

        return self::conn()->query($query);
    }
}
