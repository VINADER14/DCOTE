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
            <img src="images/kei_ayano_reg.jpg" alt="kei_ayano_reg">
        </div>
        <div class="auth-form">
            <div class="auth-header">
                <div class="login-link">Нет аккаунта?
                    <button class="login-btn">Регистрация</button>
                </div>
            </div>
            <h1>Добро пожаловать в DCOTE!</h1>
            <p>Войдите в аккаунт</p>
            <form method="post">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <button type="submit" class="submit-btn">Войти</button>
            </form>
        </div>
    </div>
</body>
</html>