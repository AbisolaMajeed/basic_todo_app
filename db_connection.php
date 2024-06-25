<?php 
$err = "";

    $hostName = 'localhost';
    $userName = 'root';
    $password = '';
    $db_name = 'todolist';

    $dbconn = new mysqli($hostName, $userName, $password, $db_name);
   
?>