<?php
function redirection($url)
{
    if (headers_sent()) {
        echo '<meta http-equiv="refresh" content="0;URL=' . $url . '">';
    } else {
        header("Location: " . $url);
    }
    exit();
}

function e($value)
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function flash($type, $message)
{
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }
    $_SESSION['flash_type'] = $type;
    $_SESSION['flash_message'] = $message;
}

function show_flash()
{
    if (session_status() != PHP_SESSION_ACTIVE) {
        session_start();
    }

    if (isset($_SESSION['flash_message'])) {
        $type = isset($_SESSION['flash_type']) ? $_SESSION['flash_type'] : 'info';
        echo '<div class="alert alert-' . e($type) . '">';
        echo e($_SESSION['flash_message']);
        echo '</div>';
        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_type']);
    }
}
function current_user_role()
{
    return isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'admin';
}

function redirect_to($url)
{
    redirection($url);
}
?>
