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

if(isset($_POST['action']))
{

if ($_POST['action'] == 'store') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "INSERT INTO users(name,email,password) VALUES(?,?,?)";

    $addUser = $db->prepare($sql);
    $addUser->execute([$name, $email, $password]);

    echo 'user was added';
}



if (isset($_POST['action']) && $_POST['action'] == 'Delete') {

    $userId = $_POST['user_id'];

    $sql = "DELETE FROM users WHERE id=?";

    $deleteUser = $db->prepare($sql);
    $deleteUser->execute([$userId]);

    echo 'user was deleted';
}


}else{
    echo 'request not valid';

}