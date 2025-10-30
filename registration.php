<?php
session_start();
require 'config.php';
require 'help_funcs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors=[];
    $errors_username=[];
    $errors_email=[];
    $errors_password=[];

    $username=e(trim($_POST['username'] ??''));
    $email=e(trim($_POST['email'] ??''));
    $password=e($_POST['password'] ??'');
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    if (execute_query('SELECT * FROM users WHERE email=?',[$email],true)!==null) {
        $errors_email[]='Пользователь с такой почтой уже существует';
    }
        if (empty($username)) {
        $errors_username[] = 'Имя пользователя обязательно';
    }
    
    if (empty($email)) {
        $errors_email[] = 'Email обязателен';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors_email[] = 'Некорректный формат email';
    }
    
    if (empty($password)) {
        $errors_password[] = 'Пароль обязателен';
    } elseif (strlen($password) < 6) {
        $errors_password[] = 'Пароль должен быть не менее 6 символов';
    }


    if (empty($errors_email) AND empty($errors_password) AND empty($errors_username)) {
        execute_query("INSERT INTO users (role_id,username,nickname,password_hash,email,last_read_chapter_id,created_at) VALUES (?,?,?,?,?,?,?)",
        [1,$username,$username,$password_hash,$email,0, date('Y-m-d H:i:s')],save:true);
        header('Location: login.php');
        exit;
        }
    else {
        $errors= array_merge($errors_username, $errors_email, $errors_password);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация | DCOTE</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <div class="auth-container">
        <div class='auth-image'>
            <img src="images/kei_ayano_reg.jpg" alt="kei_ayano_reg">
        </div>
        <div class="auth-form">
            <div class="auth-header">
                <div class="login-link">Уже есть аккаунт?
                    <button class="login-btn" onclick="window.location.href='login.php'">Войти</button>
                </div>
            </div>
            <h1>Добро пожаловать в DCOTE!</h1>
            <p>Создайте аккаунт</p>
            <form method="post">
                <div class='field_group'>
                    <label for="username">ЮЗЕРНЕЙМ</label>
                    <input type="text" id="username" name="username" class="<?= !empty($errors_username) ? 'error-field' : '' ?>"  required>
                </div>
                <div class='field_group'>
                    <label for="email">Эл. почта</label>
                    <input type="email" id="email" name="email" class="<?= !empty($errors_email) ? 'error-field' : '' ?>" required>
                </div>
                <div class='field_group'>
                    <label for="password">
                        Пароль
                        <div class="tooltip">
                        <img src="images/info.png" alt="Информация" class="info">
                        <span class="tooltip-text">Минимум 6 символов, хотя бы одна буква и цифра</span>
                        </div>
                    </label>
                    <input type="password" id="password" name="password" pattern="^(?=.*[a-z])(?=.*\d).{6,}$" class="<?= !empty($errors_password) ? 'error-field' : '' ?>" required>
                </div>
                <div class='field_group'>
                    <button type="submit" class="submit-btn">Регистрация</button>
                    <?php if (!empty($errors)): ?>
                        <?php foreach ($errors as $error): ?>
                            <span class="error-message"><?= $error ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

