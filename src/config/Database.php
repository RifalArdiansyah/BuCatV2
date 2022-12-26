<?php

namespace Config;

use PDO;

class Database {
    private static $db_host = 'localhost';
    private static $db_name = 'db_uang';
    private static $db_user = 'root';
    private static $db_pass = '';
    
    private static $conn;

    public static function getConnection() {
        if (self::$conn == null) {
            self::$conn = new PDO("mysql:host=".self::$db_host.";dbname=".self::$db_name, self::$db_user, self::$db_pass);
        }
        return self::$conn;
    }
}