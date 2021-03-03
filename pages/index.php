<?php
session_start();
include '../page_incs/db_connect.inc.php';
$MySQL = connect_mysql();
// Page is set to home (home.php) by default, so when the visitor visits that will be the page they see.
$page = isset($_GET['page']) && file_exists($_GET['page'] . '.php') ? $_GET['page'] : 'home';
// Include and show the requested page
include $page . '.php';

//session_unset();
//session_destroy();
?>