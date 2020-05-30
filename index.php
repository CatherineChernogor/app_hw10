<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

include 'autoload.php';

use app\Order;

$order = new Order;
include 'app/template/form.php';

if ($_POST) {

    $order->fill($_POST);

    if ($order->validate() && $order->save()) {
        
        $successMessage = "Спасибо, ваши данные сохранены";
    } else {
        $errors = $order->getErrors();
        var_dump($errors);
    }
}