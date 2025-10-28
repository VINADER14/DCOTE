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

?>