<?php
function asset($file)
{
    $path = $_SERVER['DOCUMENT_ROOT'] . $file;
    $version = file_exists($path) ? filemtime($path) : time();
    return $file . '?v=' . $version;
}


function execute_query($query, $params = [], $fetch = false, $save = false)
{
    global $db;

    if (!isset($db) || !$db || !($db instanceof mysqli)) {
        error_log('❌ DB Error: Подключение к БД не установлено');
        return null;
    }

    $stmt = mysqli_prepare($db, $query);

    if (!$stmt) {
        $error = mysqli_error($db);
        error_log('❌ DB Prepare Error: ' . $error);
        error_log('📝 SQL: ' . $query);
        error_log('📦 Params: ' . print_r($params, true));
        return null;
    }

    try {
        if (!empty($params)) {
            $specs = '';
            $bind_params = [];

            foreach ($params as $param) {
                if (is_int($param)) {
                    $specs .= 'i';
                } elseif (is_float($param)) {
                    $specs .= 'd';
                } elseif (is_null($param)) {
                    $specs .= 's';
                } else {
                    $specs .= 's';
                }
                $bind_params[] = $param;
            }

            if (!mysqli_stmt_bind_param($stmt, $specs, ...$bind_params)) {
                $error = mysqli_stmt_error($stmt);
                error_log('❌ DB Bind Error: ' . $error);
                mysqli_stmt_close($stmt);
                return null;
            }
        }

        if (!mysqli_stmt_execute($stmt)) {
            $error = mysqli_stmt_error($stmt);
            error_log('❌ DB Execute Error: ' . $error);
            error_log('📝 SQL: ' . $query);
            mysqli_stmt_close($stmt);
            return null;
        }

        if ($save === false) {
            $result = mysqli_stmt_get_result($stmt);

            if (!$result) {
                $error = mysqli_stmt_error($stmt);
                error_log('❌ DB Result Error: ' . $error);
                mysqli_stmt_close($stmt);
                return null;
            }

            $data = $fetch === 'all'
                ? mysqli_fetch_all($result, MYSQLI_ASSOC)
                : mysqli_fetch_assoc($result);

            mysqli_stmt_close($stmt);

            return $data ?? [];
        }

        $insert_id = mysqli_stmt_insert_id($stmt);

        mysqli_stmt_close($stmt);

        return $insert_id > 0 ? $insert_id : true;
    } catch (Throwable $e) {
        error_log('❌ DB Exception: ' . $e->getMessage());
        error_log('📝 SQL: ' . $query);
        error_log('📋 Stack: ' . $e->getTraceAsString());

        if (isset($stmt) && $stmt) {
            mysqli_stmt_close($stmt);
        }
        return null;
    }
}

function e($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function date_for_news($date)
{
    $months = [
        1 => 'января',
        2 => 'февраля',
        3 => 'марта',
        4 => 'апреля',
        5 => 'мая',
        6 => 'июня',
        7 => 'июля',
        8 => 'августа',
        9 => 'сентября',
        10 => 'октября',
        11 => 'ноября',
        12 => 'декабря'
    ];

    $date = new DateTime($date);
    $day = $date->format('j');
    $month = $months[(int)$date->format('n')];
    $year = $date->format('Y');

    return "$day $month $year г.";
}

function verifyTurnstile($response)
{
    if (empty($response)) {
        return false;
    }

    $secret = "0x4AAAAAACpYY_3EddPJDynODPzdWTgnk60";
    $ip = $_SERVER['REMOTE_ADDR'];
    $verify = file_get_contents('https://challenges.cloudflare.com/turnstile/v0/siteverify', false, stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query([
                'secret' => $secret,
                'response' => $response,
                'remoteip' => $ip,
                'timeout' => 10
            ])
        ]
    ]));
    if ($verify === false) {
        return true;
    }



    $captcha_success = json_decode($verify);
    return $captcha_success->success ?? false;
}


require_once __DIR__ . '/vendor/autoload.php';

function formatHtmlSafe($text)
{
    static $purifier = null;

    if ($purifier === null) {
        $config = HTMLPurifier_Config::createDefault();

        $config->set('HTML.Allowed', 'p,br,b,strong,i,em,u,ul,ol,li,h1,h2,h3,h4,a[href],img[src|alt],blockquote,code,pre,hr,table,thead,tbody,tr,th,td');

        $config->set('URI.AllowedSchemes', ['http' => true, 'https' => true]);

        $purifier = new HTMLPurifier($config);
    }

    return $purifier->purify($text);
}
