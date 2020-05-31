<?php
mb_internal_encoding('UTF-8');


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

//present list
$contents = file_get_contents('data.txt');
$contents = trim($contents);

$items = explode("\n", $contents);

$data = [];

foreach ($items as $item) {

    $id        = '';
    $date      = '';
    $ip        = '';
    $firstName = '';
    $lastname  = '';
    $phone     = '';
    $email     = '';
    $theme     = '';
    $email     = '';
    $payment   = '';
    $notif     = '';

    $item = trim($item);
    $cols = explode('||', $item);

    $id        = $cols[0];
    $date      = $cols[1];
    $ip        = $cols[2];
    $firstName = $cols[3];
    $lastname  = $cols[4];
    $phone     = $cols[5];
    $email     = $cols[6];
    $theme     = $config['themes'][(int) $cols[7]];
    $payment   = $config['payments'][(int) $cols[8]];
    $notif     = $cols[9];

    $data[$id] = [
        'date'      => $date,
        'ip'        => $ip,
        'firstName' => $firstName,
        'lastname'  => $lastname,
        'phone'     => $phone,
        'email'     => $email,
        'theme'     => $theme,
        'payment'   => $payment,
        'notif'     => $notif,
    ];
}


//deleted list
$deleted_contents = file_get_contents('deleted_data.txt');
$deleted_contents = trim($deleted_contents);

$del_items = explode("\n", $deleted_contents);

$del_data = [];
foreach ($del_items as $del_item) {

    $id        = '';
    $date      = '';
    $ip        = '';
    $firstName = '';
    $lastname  = '';
    $phone     = '';
    $email     = '';
    $theme     = '';
    $email     = '';
    $payment   = '';
    $notif     = '';

    $del_item = trim($del_item);
    $del_cols = explode('||', $del_item);

    $id        = $del_cols[0];
    $date      = $del_cols[1];
    $ip        = $del_cols[2];
    $firstName = $del_cols[3];
    $lastname  = $del_cols[4];
    $phone     = $del_cols[5];
    $email     = $del_cols[6];
    $theme     = $config['themes'][(int) $del_cols[7]];
    $payment   = $config['payments'][(int) $del_cols[8]];
    $notif     = $del_cols[9];

    $del_data[$id] = [
        'date'      => $date,
        'ip'        => $ip,
        'firstName' => $firstName,
        'lastname'  => $lastname,
        'phone'     => $phone,
        'email'     => $email,
        'theme'     => $theme,
        'payment'   => $payment,
        'notif'     => $notif,
    ];
}


