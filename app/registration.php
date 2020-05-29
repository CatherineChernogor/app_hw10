<?php
include 'autoload.php';

use app\Order;

include 'template/form.php';

$order = new Order;

if ($_POST) {

    $order->fill($_POST);

    if ($order->validate() && $order->save()) {
        
        $successMessage = "Спасибо, ваши данные сохранены";
    } else {

        $errors = $order->getErrors();
    }
}
