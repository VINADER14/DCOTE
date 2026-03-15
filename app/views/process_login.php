<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors=[];
    $blocked = false;
    $hash = null;
    $userId = null;
    
    $failed_attempts = $_SESSION['login_attempts'] ?? 0;
    $last_attempt = $_SESSION['last_login_attempt'] ?? 0;

    if ($failed_attempts >= 5 && (time() - $last_attempt) < 300) {
        $errors[] = 'Слишком много попыток. Подождите 5 минут';
        $blocked=true;
    } else {
        if (time() - $last_attempt > 300) {
            $failed_attempts = 0;
        }
    }

    $login=trim($_POST['login'] ??'');
    $password=trim($_POST['password'] ??'');

    if (!verifyTurnstile($_POST['cf-turnstile-response'] ?? '')) {
        $errors[] = 'Проверка безопасности не пройдена';
    }

    if (empty($login)) {
        $errors[] = 'Имя пользователя или почта обязательны';
    } elseif (strlen($login) > 50) {
        $errors[] = 'Имя пользователя или почта не должны быть длиннее 50 символов';
    }

    if (empty($password)) {
        $errors[] = 'Пароль обязателен';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Пароль должен быть не менее 6 символов';
    }

    if(empty($errors) && !$blocked) {
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $userRow = execute_query('SELECT user_id,password_hash FROM users WHERE email=?', [$login], true);
        } else {
            $userRow = execute_query('SELECT user_id,password_hash FROM users WHERE username=?', [$login], true);
        }
        $hash = $userRow['password_hash'] ?? null;
        $userId = $userRow['user_id'] ?? null;
    }

    if (!empty($hash)&& !$blocked && empty($errors)){
        $passed = password_verify($password, $hash);
        if ($passed===true) {
            unset($_SESSION['login_attempts']);
            unset($_SESSION['last_login_attempt']);
            session_regenerate_id(true);
            $_SESSION['verified'] = true;
            $_SESSION['user_id'] = $userId;
            header('Location: /');
            exit;
        }
        else {
            $errors[]='Неверная почта или пароль';
            $_SESSION['login_attempts'] = $failed_attempts + 1;
            $_SESSION['last_login_attempt'] = time();
        }
    } elseif (!$blocked && empty($errors)) {
    $errors[] = 'Неверная почта или пароль';
    $_SESSION['login_attempts'] = $failed_attempts + 1;
    $_SESSION['last_login_attempt'] = time();
}


    $_SESSION['notification'] = [
            'type' => 'error',
            'message' => implode(', ', $errors)
        ];
        $_SESSION['old_input'] = [
        'login' => $_POST['login'] ?? '',
    ];
        header('Location: /login');
        exit;
}