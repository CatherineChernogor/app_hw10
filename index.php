<?php

include 'autoload.php';

use app\Order;

$order = new Order;

if ($_POST) {

    $order->fill($_POST);

    if ($order->validate() && $order->save()) {
        
        $successMessage = "Спасибо, ваши данные сохранены";
    } else {
        $errors = $order->getErrors();
    }
}

include 'app/template/form.php';