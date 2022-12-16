<?php

require_once __DIR__.'../config.php';

session_start();

if(isset($_GET['user'])) {
    $_SESSION['user_id'] = $_GET['user'];
}

$action = isset($_GET['action']) ? $_GET['action'] : null;

switch ($action) {
    case 'Log-In':
        require_once __DIR__.'../resource_login.php';
        break;
    case 'Log-Out':
        require_once __DIR__.'../Controller/logout.php';
        break;
    case 'Home':
        require_once __DIR__.'../resource_home.php';
        break;
    default:
        require_once __DIR__.'../resource_login.php';
        break;
}

?>