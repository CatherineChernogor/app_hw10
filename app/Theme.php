<?php

namespace app;

class Theme extends Model
{
    public $id;
    public $name;

    protected static $table = 'subjects';
    protected static $columns = [
        'id',
        'name',
    ];
}
