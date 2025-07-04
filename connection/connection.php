<?php

class Database
{
    private static mysqli $instance;
    private static $db_host = "localhost";
    private static $db_name = "articles_db";
    private static $db_user = "root";
    private static $db_pass = null;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new mysqli(self::$db_host, self::$db_user, self::$db_pass, self::$db_name);
        }
        return self::$instance;
    }
}