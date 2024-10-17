<?php

$host ='localhost';
$user = 'root';
$password='root';
$database= "Backend";

$dsn = "mysql:host=$host;dbname=$database";


try{
    $db = new PDO($dsn,$user,$password);
}catch (Exception $e)
{
    echo $e->getMessage();
}

$sql = "SELECT * FROM users";

$usersQuery = $db->prepare($sql);

$usersQuery->execute();

$users = $usersQuery->fetchAll();

foreach ($users as $user)
{
    echo 'user name = ' . $user['name'] . '<br>';
    echo 'user email = ' . $user['email'] . '<hr>';
}