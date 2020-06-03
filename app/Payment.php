<?php

namespace app;

class Payment extends Model
{
    public $id;
    public $name;

    protected static $table = 'payments';
    protected static $columns = [
        'id',
        'name',
    ];
}
