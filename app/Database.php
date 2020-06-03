<?php

namespace app;

use PDO;

class Database
{
    protected static $pdo;

    public static function getPdo()
    {
        if (!isset(static::$pdo)) {
            static::$pdo = new PDO('mysql:host=127.0.0.1;dbname=task1448;charset=utf8', 'task1448', 'tbEhKcAR');
        }
        return static::$pdo;
    }
}
