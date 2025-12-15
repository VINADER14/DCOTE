<?php
session_start();
require 'config.php';
require 'help_funcs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors=[];

    $email=e(trim($_POST['email'] ??''));
    $password=e($_POST['password'] ??'');
    $hashRow = execute_query('SELECT password_hash FROM users WHERE email=?', [$email], true);
    $hash = $hashRow['password_hash'] ?? null;
    if (!empty($hash)){
        $passed = password_verify($password, $hash);
        if ($passed===true) {
            $usernameRow = execute_query('SELECT username FROM users WHERE email=?', [$email], true);
            $username = $usernameRow['username'] ?? null;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
            header('Location: dcote.php');
            exit;
        }
        else {
            $errors[]='Неверная почта или пароль';
        }
    }
    else {
        $errors[]='Неверная почта или пароль';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход | DCOTE</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-image">
            <img src="images/kei_ayano_reg.jpg" alt="base_dcote_image">
        </div>
        <div class="auth-form">
            <div class="auth-header">
                <div class="login-link">Нет аккаунта?
                    <button class="login-btn" onclick="window.location.href='registration.php'">Регистрация</button>
                </div>
            </div>
            <h1>Добро пожаловать в DCOTE!</h1>
            <p>Войдите в аккаунт</p>
            <form method="post">
                <label for="email">Эл. почта</label>
                <input type="email" id="email" name="email" class="<?= !empty($errors) ? 'error-field' : '' ?>" required>
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" class="<?= !empty($errors) ? 'error-field' : '' ?>" required>
                <button type="submit" class="submit-btn">Войти</button>
                <?php if (!empty($errors)): ?>
                    <?php foreach ($errors as $error): ?>
                        <span class="error-message"><?= $error ?></span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>