<?php
session_start();
require 'config.php';
require 'help_funcs.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors=[];

    $username=e(trim($_POST['username'] ??''));
    $email=e(trim($_POST['email'] ??''));
    $password=e($_POST['password'] ??'');
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    if (execute_query('SELECT * FROM users WHERE email=?',[$email],true)!==null) {
        $errors[]='Пользователь с такой почтой уже существует';
    }
        if (empty($username)) {
        $errors[] = 'Имя пользователя обязательно';
    }
    
    if (empty($email)) {
        $errors[] = 'Email обязателен';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Некорректный формат email';
    }
    
    if (empty($password)) {
        $errors[] = 'Пароль обязателен';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Пароль должен быть не менее 6 символов';
    }


    if (empty($errors)) {
        execute_query("INSERT INTO users (role_id,username,nickname,password_hash,email,last_read_chapter_id,created_at) VALUES (?,?,?,?,?,?,?)",
        [1,$username,$username,$password_hash,$email,0, date('Y-m-d H:i:s')],save:true);
        header('Location: login.php');
        exit;
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
        <div class="auth-image">
            <img src="images/kei_ayano_reg.jpg" alt="kei_ayano_reg">
        </div>
        <div class="auth-form">
            <div class="auth-header">
                <div class="login-link">Уже есть аккаунт?
                    <button class="login-btn">Войти</button>
                </div>
            </div>
            <h1>Добро пожаловать в DCOTE!</h1>
            <p>Создайте аккаунт</p>
            <?php if (!empty($errors)): ?>
                <div class="error-container">
                    <ul class="error-list">
                        <?php foreach ($errors as $error): ?>
                            <li class="error-item"><?= $error ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form method="post">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" class="submit-btn">Регистрация</button>
            </form>
        </div>
    </div>
</body>
</html>
