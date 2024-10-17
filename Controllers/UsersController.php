<?php

global $db;
include '../DB/db_connect.php';

if(isset($_POST['action']))
{

if ($_POST['action'] == 'store') {
    store();
}


if (isset($_POST['action']) && $_POST['action'] == 'Delete') {
    delete();
}


if($_POST['action'] == 'update')
{
  update();
}


}else{
    echo 'request not valid';

}





/** my functions */

function store()
{
    global $db;
    $validation = checkInputsRequired(['name','email','password']);
    if(count($validation) != 0)
    {
        var_dump($validation);
        exit();
    }
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $isExists = checkIfExists($email,'users');
    if($isExists != 0)
    {
        echo 'this email is used before';
        exit;
    }

    $sql = "INSERT INTO users(name,email,password) VALUES(?,?,?)";

    $addUser = $db->prepare($sql);
    $addUser->execute([$name, $email, $password]);

    header('Location: ../Users/index.php');
}


function delete()
{
    global $db;
    $userId = $_POST['user_id'];

    $sql = "DELETE FROM users WHERE id=?";

    $deleteUser = $db->prepare($sql);
    $deleteUser->execute([$userId]);

    header('Location: ../Users/index.php');
}

function update()
{
    global $db;
    $sql = "UPDATE users SET name=?,email=?,password=? WHERE id=?";
    $updateUser = $db->prepare($sql);
    $updateUser->execute([
        'abdo updated',
        'abdo_after_update@update.update',
        '123456',
        19
    ]);
}

function checkInputsRequired($inputs)
{
    $errors = [];
    foreach ($inputs as $input)
    {
        if(!isset($_POST[$input]))
        {
           $errors[$input] = $input . ' is required';
        }
    }

    return $errors;
}

function checkIfExists($email, $table)
{
    global $db;
    $sql = "SELECT id FROM {$table} WHERE email=?";
    $exists = $db->prepare($sql);
    $exists->execute([$email]);
    $userCount = $exists->rowCount();
    return $userCount;
}