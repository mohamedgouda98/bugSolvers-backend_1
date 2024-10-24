<?php
session_start();


global $db;
include '../db/db.php';

if(isset($_POST['action']))
{
    if($_POST['action'] == 'Register')
    {
       register();
    }elseif ($_POST['action'] == 'Login')
    {
        login();
    }
}else{
    echo 'invalid request';
}

function register()
{
    global $db;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $validation= validateRequired(['name' =>$name, 'email' =>$email, 'phone' => $phone, 'password' =>$password]);

    if(gettype($validation) == 'array')
    {
        $_SESSION['errors'] = $validation;
        header('Location:../register.php');
        die();
    }

    $validateEmail = validateEmailExists($email);
    if($validateEmail == 1)
    {
        $_SESSION['errors'] = ['email is exists in database'];
        header('Location:../register.php');
        die();
    }

    $sql = 'INSERT INTO users(name,email,phone,password) VALUES(?,?,?,?)';

    $createUser = $db->prepare($sql);
    $createUser->execute([
        $name,
        $email,
        $phone,
        $password
    ]);

    setUserToSession($email);

    $_SESSION['msg'] = 'heelo, <b>' . $name . '</b> your account is created';

    header('Location: ../home.php');
}

function login()
{
    global $db;
    $email = $_POST['email'];
    $password = $_POST['password'];

    $validation = validateRequired(['email' => $email, 'password' => $password]);
    if(gettype($validation) == 'array')
    {
        $_SESSION['errors'] = $validation;
        header('Location:../login.php');
        die();
    }

    $sql = "SELECT * FROM users WHERE email=? AND password=?";
    $userStmt = $db->prepare($sql);
    $userStmt->execute([$email,$password]);
    if($userStmt->rowCount() == 0)
    {
        $_SESSION['errors'] = ['email' => 'email not exists in database'];
        header('Location:../login.php');
        die();
    }
    $user = $userStmt->fetchAll();
    $_SESSION['user_id'] = $user[0]['id'];
    $_SESSION['user_name'] = $user[0]['name'];
    $_SESSION['user_email'] = $user[0]['email'];

    header('Location:../home.php');

}

function setUserToSession($email)
{
    global $db;
    $sql = "SELECT id FROM users WHERE email=?";
    $userStat = $db->prepare($sql);
    $userStat->execute([$email]);
    $user = $userStat->fetchAll();
    $_SESSION['user_id'] = $user[0]['id'];

}


function validateRequired($inputs)
{
    $errors = [];
    foreach ($inputs as $key => $value)
    {
        if(empty($value))
        {
            $errors [] = $key . ' is required';
        }
    }

    if(count($errors) != 0)
    {
        return $errors;
    }
    return true;
}


function validateEmailExists($email)
{
    global $db;
    $sql = "SELECT id FROM users WHERE email=?";
    $isExists = $db->prepare($sql);
    $isExists->execute([$email]);
    return $isExists->rowCount();
}