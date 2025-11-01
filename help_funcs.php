<?php
require 'config.php';


function execute_query($query, $params=null, $fetch=false, $save=false) {
    global $db;
    try {
        $stmt = mysqli_prepare($db, $query);
        if (!empty($params)) {
            $specs = '';
            foreach ($params as $param) {
                if (is_int($param)) $specs .= 'i';
                elseif (is_float($param)) $specs .= 'd';
                else $specs .= 's';
            }
            mysqli_stmt_bind_param($stmt, $specs, ...$params);
        }
        mysqli_stmt_execute($stmt);
        if ($save === false) {
            $result = mysqli_stmt_get_result($stmt);
            return $fetch === 'all' 
            ? (mysqli_fetch_all($result, MYSQLI_ASSOC) ?: null)
            : (mysqli_fetch_assoc($result) ?: null);
        }
    } catch (Exception $e){
        echo 'Ошибка в execute_query' . $e->getMessage();
        return null;
    }
}

function e($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function date_for_news($date) {
    $months = [
    1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля',
    5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа',
    9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря'
    ];

    $date = new DateTime($date);
    $day = $date->format('j');
    $month = $months[(int)$date->format('n')];
    $year = $date->format('Y');

    return "$day $month $year г.";
}


?>