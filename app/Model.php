<?php

namespace app;

use PDO;

abstract class Model
{
    protected static $table;
    protected static $columns = [];

    public static function loadAll()
    {
        $db = Database::getPdo();
        $sql = $db->prepare('SELECT `' . implode('`,`', static::$columns) . '` FROM `' . static::$table . '` ;');
        $sql->execute();
        $content = $sql->fetchAll(PDO::FETCH_CLASS, static::class);
        return $content;
    }
}
