<?php

$host ='localhost';
$user = 'root';
$password='root';
$database= "Project1";

$dsn = "mysql:host=$host;dbname=$database";


try{
    $db = new PDO($dsn,$user,$password);
}catch (Exception $e)
{
    echo $e->getMessage();
}
