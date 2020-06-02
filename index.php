<?php

include 'autoload.php';

use app\Order;

$order = new Order;

if (isset($_SESSION['successMessage'])) {
    $successMessage = $_SESSION['successMessage'];
    unset($_SESSION['successMessage']);
}
if ($_POST) {

    $order->fill($_POST);

    if ($order->validate() && $order->save()) {

        $_SESSION['successMessage'] = "Спасибо, ваши данные сохранены";
        header('Location: index.php');
        exit;
    } else {
        $errors = $order->getErrors();
    }
}

include 'app/template/form.php';
