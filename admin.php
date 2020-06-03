<?php

include 'autoload.php';

use app\Order as Order;

if ($_POST) {
    if (!empty($_POST['selected_ids'])) {
        foreach ($_POST['selected_ids'] as $id) {

            Order::deleteById($id);
        }
    }
}

$data = Order::loadAll();


include 'app/template/_admin.php';
