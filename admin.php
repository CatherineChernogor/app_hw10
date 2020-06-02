<?php
mb_internal_encoding('UTF-8');

include 'autoload.php';

use app\Order as Order;

if ($_POST) {
    if (!empty($_POST['selected_ids'])) {

        $contents = file_get_contents('data.txt');
        $contents = trim($contents);

        $items = explode("\n", $contents);

        $new_content = [];
        $deleted_content = [];


        foreach ($items as $item) {

            $deleted = false;
            foreach ($_POST['selected_ids'] as $id) {

                $item = trim($item);
                $cols = explode('||', $item);
                if ($cols[0] === $id) {
                    $deleted = true;
                }
            }
            if (!$deleted)
                $new_content[] = $item;
            else
                $deleted_content[] = $item;
        }
        file_put_contents('data.txt', implode("\n", $new_content) . "\n");
        file_put_contents('deleted_data.txt', implode("\n", $deleted_content) . "\n", FILE_APPEND);
    }
}
$order = new Order;

$data = $order->read('data.txt');
$del_data = $order->read('deleted_data.txt');

include 'app/template/_admin.php';