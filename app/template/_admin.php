<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
</head>

<body>
    <h1>admin page</h1>
    <form method="POST">
        <button type="submit">Delete Selected</button>

        <table border="1px">
            <thead>
                <th>ID: </th>
                <th>IP: </th>
                <th>Имя: </th>
                <th>Фамилия: </th>
                <th>Телефон: </th>
                <th>Почта: </th>
                <th>Тема Конференции: </th>
                <th>Оплата: </th>
                <th>Согласие на рассылку: </th>
                <th>Дата регистрации: </th>

            </thead>
            <tbody>
                <?php foreach ($data as $id => $item) : ?>
                <?php if (!$item->deleted_at): ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_ids[]" value="<?= $item->id ?>">
                            <strong> <?= $item->id ?> </strong>
                        </td>

                        <td><?= htmlspecialchars($item->ip) ?></td>
                        <td><?= htmlspecialchars($item->firstname) ?></td>
                        <td><?= htmlspecialchars($item->lastname) ?></td>
                        <td><?= htmlspecialchars($item->phone) ?></td>
                        <td><?= htmlspecialchars($item->email) ?></td>
                        <td><?= htmlspecialchars($item->theme) ?></td>
                        <td><?= htmlspecialchars($item->payment) ?></td>
                        <td><?= htmlspecialchars($item->mailing) ?></td>
                        <td><?= htmlspecialchars($item->created_at) ?></td>

                    </tr>
                    <?php endif ?>
                <?php endforeach ?>
            </tbody>
        </table>

    </form>

</body>

</html>