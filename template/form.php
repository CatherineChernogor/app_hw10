<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/reg.css" rel="stylesheet">
    <title>Registration</title>
</head>

<body>

    <?php if (!empty($successMessage)) : ?>
        <p><?= $successMessage ?></p>

    <?php else : ?>

        <form method="POST" action="">
            <div class="form-group"><strong>Регистрация на конференцию</strong></div>
            <div class="form-group">
                <label>Имя</label>
                <input type="text" name='firstName' value="<?= isset($_POST['firstName']) ? $_POST['firstName'] : '' ?>">
                <span class="error"><?= isset($errors['firstName']) ? $errors['firstName'] : '' ?></span>
            </div>
            <div class="form-group">
                <label>Фамилия</label>
                <input type="text" name='lastname' value="<?= isset($_POST['lastname']) ? $_POST['lastname'] : '' ?>">
                <span class="error"><?= isset($errors['lastname']) ? $errors['lastname'] : '' ?></span>
            </div>
            <div class="form-group">
                <label>Телефон</label>
                <input type="tel" name='phone' value="<?= isset($_POST['phone']) ? $_POST['phone'] : '' ?>">
                <span class="error"><?= isset($errors['phone']) ? $errors['phone'] : '' ?></span>
            </div>
            <div class="form-group">
                <label>Почта</label>

                <input type="email" name='email' value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
                <span class="error"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
            </div>


            <?php var_dump($order) ?>

            <div class="form-group">
                <label>Интересующая тематика конференции</label>
                <select name='theme' value="<?= isset($_POST['theme']) ? $_POST['theme'] : '' ?>">
                    <option value="">--</option>
                    <?php foreach ($order->getThemes() as $themeID => $themeName) : ?>
                        <option value="<?= $themeID ?>" <?= !empty($_POST['theme']) && $_POST['theme'] === $themeID ? ' selected' : '' ?>><?= $themeName ?></option>
                    <?php endforeach ?>
                </select>
                <span class="error"><?= isset($errors['theme']) ? $errors['theme'] : '' ?></span>
            </div>
            <div class="form-group" value="<?= isset($_POST['payment']) ? $_POST['payment'] : '' ?>">
                <label>Предпочитаемый метод оплаты участия</label>
                <select name='payment'>
                    <option value="">--</option>
                    <?php foreach ($order->getPayments() as $paymentID => $paymentName) : ?>
                        <option value="<?= $paymentID ?>" <?= !empty($_POST['theme']) && $_POST['theme'] === $paymentID ? ' selected' : '' ?>><?= $paymentName ?></option>
                    <?php endforeach ?>
                </select>
                <span class="error"><?= isset($errors['payment']) ? $errors['payment'] : '' ?></span>
            </div>
            <div class="form-group">
                <label>Согласен получать рассылку о конференции</label>
                <input type="checkbox" name='notif' <?= !empty($_POST['notif']) ? 'checked' : '' ?>>
                <span class="error"><?= isset($errors['notif']) ? $errors['notif'] : '' ?></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Send">
            </div>
        </form>
    <?php endif; ?>

</body>

</html>