<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors=[];
    $errors_username=[];
    $errors_email=[];
    $errors_password=[];
    $errors_nickname=[];
    $errors_turnstile=[];

    $nickname=trim($_POST['nickname'] ??'');
    $username=trim($_POST['tag'] ??'');
    $email=trim($_POST['email'] ??'');
    $password=trim($_POST['password'] ??'');
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    if (!verifyTurnstile($_POST['cf-turnstile-response'] ?? '')) {
        $errors_turnstile[] = 'Проверка безопасности не пройдена';
    }
    if (execute_query('SELECT * FROM users WHERE email=?',[$email],true)!==null) {
        $errors_email[]='Пользователь с такой почтой уже существует';
    }
    if (execute_query('SELECT * FROM users WHERE username=?',[$username],true)!==null) {
        $errors_username[]='Пользователь с таким именем пользователя уже существует';
    }

    if (empty($username)) {
        $errors_username[] = 'Имя пользователя обязательно';
    } elseif (strlen($nickname) > 50) {
        $errors_username[] = 'Имя пользователя не должно быть длиннее 50 символов';
    }

    if (empty($nickname)) {
        $errors_nickname[] = 'Отображаемое имя обязательно';
    } elseif (strlen($nickname) > 50) {
        $errors_nickname[] = 'Отображаемое имя не должно быть длиннее 50 символов';
    }
    
    if (empty($email)) {
        $errors_email[] = 'Email обязателен';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors_email[] = 'Некорректный формат email';
    } elseif (strlen($email) > 50) {
        $errors_email[] = 'email не должен быть длиннее 50 символов';
    }
    
    if (empty($password)) {
        $errors_password[] = 'Пароль обязателен';
    } elseif (strlen($password) < 6) {
        $errors_password[] = 'Пароль должен быть не менее 6 символов';
    } elseif (!preg_match('/[a-zA-Zа-яА-ЯёЁ]/u', $password)) {
    $errors_password[] = 'Пароль должен содержать хотя бы одну букву';
    } elseif (!preg_match('/\d/', $password)) {
        $errors_password[] = 'Пароль должен содержать хотя бы одну цифру';
    } elseif (strlen($password) > 50) {
        $errors_password[] = 'Пароль не должен быть длиннее 50 символов';
    }
    $errors= array_merge($errors_username, $errors_email, $errors_password,$errors_nickname,$errors_turnstile);

    if (empty($errors)) {
        execute_query("INSERT INTO users (role_id,username,nickname,password_hash,email,last_read_chapter_id,created_at) VALUES (?,?,?,?,?,?,?)",
        [1,$username,$nickname,$password_hash,$email,0, date('Y-m-d H:i:s')],save:true);
        header('Location: /login');
        exit;
        }
    else {
        $_SESSION['notification'] = [
            'type' => 'error',
            'message' => implode(', ', $errors)
        ];
        $_SESSION['old_input'] = [
        'tag' => $_POST['tag'] ?? '',
        'email' => $_POST['email'] ?? '',
        'nickname' => $_POST['nickname'] ?? ''
    ];
        header('Location: /reg');
        exit;
    }
} ?>