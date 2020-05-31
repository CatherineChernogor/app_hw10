<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <style>
        <?= include 'app/css/index.css' ?>
    </style>
</head>

<body>
    <?php if (!empty($successMessage)) : ?>
        <p><?= $successMessage ?></p>
    <?php else : ?>
        <form method="POST" action="">
            <div class="form-group"><strong>Регистрация на конференцию</strong></div>
            <div class="form-group">
                <label>Имя</label>
                <input type="text" name='firstName' value="<?= htmlspecialchars($_POST['firstName'] ?? '') ?>">
                <span class="error"><?= $errors['firstName'] ?? '' ?></span>
            </div>
            <div class="form-group">
                <label>Фамилия</label>
                <input type="text" name='lastname' value="<?= htmlspecialchars($_POST['lastname'] ?? '') ?>">
                <span class="error"><?= $errors['lastname'] ?? '' ?></span>
            </div>
            <div class="form-group">
                <label>Телефон</label>
                <input type="tel" name='phone' value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                <span class="error"><?= $errors['phone'] ?? '' ?></span>
            </div>
            <div class="form-group">
                <label>Почта</label>

                <input type="email" name='email' value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                <span class="error"><?= $errors['email'] ?? '' ?></span>
            </div>

            <div class="form-group">
                <label>Интересующая тематика конференции</label>
                <select name='theme' value="<?= $_POST['theme'] ?? '' ?>">
                    <option value="">--</option>
                    <?php foreach ($order->getThemes() as $themeID => $themeName) : ?>
                        <option value="<?= $themeID ?>" <?= !empty($_POST['theme']) && $_POST['theme'] == $themeID ? ' selected' : '' ?>><?= $themeName ?></option>
                    <?php endforeach ?>
                </select>
                <span class="error"><?= $errors['theme'] ?? '' ?></span>
            </div>

            <div class="form-group" value="<?= $_POST['payment'] ?? '' ?>">
                <label>Предпочитаемый метод оплаты участия</label>
                <select name='payment'>
                    <option value="">--</option>
                    <?php foreach ($order->getPayments() as $paymentID => $paymentName) : ?>
                        <option value="<?= $paymentID ?>" <?= !empty($_POST['payment']) && $_POST['payment'] == $paymentID ? ' selected' : '' ?>><?= $paymentName ?></option>
                    <?php endforeach ?>
                </select>
                <span class="error"><?= $errors['payment'] ?? '' ?></span>
            </div>

            <div class="form-group">
                <label>Согласен получать рассылку о конференции</label>
                <input type="checkbox" name='notif' <?= !empty($_POST['notif']) ? 'checked' : '' ?>>
                <span class="error"><?= $errors['notif'] ?? '' ?></span>
            </div>
            <div class="form-group">
                <input type="submit" value="Send">
            </div>
        </form>
    <?php endif; ?>

</body>

</html>