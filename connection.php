<?php
 session_start();
 $error = array();

    $hostName = 'localhost';
    $userName = 'root';
    $password = '';
    $db_name = 'useraccounts';

    $db_conn2 = new mysqli($hostName, $userName, $password, $db_name);
?>
