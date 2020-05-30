<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
</head>

<body>
    <h1>admin page: present list</h1>
    <form method="POST">
        <button type="submit">Delete Selected</button>

        <table border="1px">
            <thead>
                <th>ID: </th>
                <th>Дата: </th>
                <th>IP: </th>
                <th>Имя: </th>
                <th>Фамилия: </th>
                <th>Телефон: </th>
                <th>Почта: </th>
                <th>Тема Конференции: </th>
                <th>Оплата: </th>
                <th>Согласие на рассылку: </th>

            </thead>
            <tbody>
                <?php foreach ($data as $id => $item) : ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_ids[]" value="<?= $id ?>">
                            <strong> <?= $id ?> </strong>
                        </td>


                        <td><?= $item['date'] ?></td>
                        <td><?= $item['ip'] ?></td>
                        <td><?= $item['firstName'] ?></td>
                        <td><?= $item['lastname'] ?></td>
                        <td><?= $item['phone'] ?></td>
                        <td><?= $item['email'] ?></td>
                        <td><?= $item['theme'] ?></td>
                        <td><?= $item['payment'] ?></td>
                        <td><?= $item['notif'] ?></td>

                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>


        <h1>admin page: deleted list</h1>

        <table border="1px">
            <thead>
                <th>ID: </th>
                <th>Дата: </th>
                <th>IP: </th>
                <th>Имя: </th>
                <th>Фамилия: </th>
                <th>Телефон: </th>
                <th>Почта: </th>
                <th>Тема Конференции: </th>
                <th>Оплата: </th>
                <th>Согласие на рассылку: </th>
            </thead>
            <tbody>
                <?php foreach ($del_data as $del_id => $del_item) :
                ?>
                    <tr>
                        <td><strong> <?= $del_id ?> </strong></td>
                        <td><?= $del_item['date'] ?></td>
                        <td><?= $del_item['ip'] ?></td>
                        <td><?= $del_item['firstName'] ?></td>
                        <td><?= $del_item['lastname'] ?></td>
                        <td><?= $del_item['phone'] ?></td>
                        <td><?= $del_item['email'] ?></td>
                        <td><?= $del_item['theme'] ?></td>
                        <td><?= $del_item['payment'] ?></td>
                        <td><?= $del_item['notif'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>


    </form>


</body>

</html>