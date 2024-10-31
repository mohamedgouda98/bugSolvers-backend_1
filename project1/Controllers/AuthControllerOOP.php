<?php

/**
 * register function. => Done
 * login function. => Done
 * validate inputs is required => Done
 * validate email is not exists. => Done
 * set user to session and redirect to home => Done
 * display errors => Done
 *
 */


session_start();
global $db;
include '../db/db.php';


class AuthControllerOOP implements AuthControllerInterface, LogoutInterface
{
    public $errors = [];

    public function register()
    {
        global $db;
        $email = $_POST['email'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        Validation::validateRequired(['name','phone','email','password']);
        Validation::validateEmailIsExists($email);
        Validation::displayErrors('../register.php');


        $sql = "INSERT INTO users(name,email,phone,password) VALUES(?,?,?,?)";
        $user = $db->prepare($sql);
        $user->execute([$name,$email,$phone,$password]);

        $this->setUserToSession($email);
    }
    public function login()
    {
        global $db;
        $email = $_POST['email'];
        $password = $_POST['password'];

        Validation::validateRequired(['name','phone','email','password']);
        Validation::displayErrors('../register.php');


        $sql = "SELECT *  FROM users WHERE email=? AND password=?";
        $user = $db->prepare($sql);
        $user->execute([$email,$password]);
        if($user->rowCount() == 0)
        {
            $this->errors[] = "email or password is wrong";
            $_SESSION['errors'] = $this->errors;
            header('Location: ../login.php');
            die();
        }

        $this->setUserToSession($email);
    }

    private function setUserToSession($email)
    {
        global $db;
        $sql = "SELECT * FROM users WHERE email=?";
        $user = $db->prepare($sql);
        $user->execute([$email]);
        $userData = $user->fetch();

        $_SESSION['user_id'] = $userData['id'];
        header('Location:../home.php');
    }


    public function logout()
    {
        // TODO: Implement logout() method.
    }
}



class Home implements LogoutInterface
{
    public function logout()
    {

    }
}

class Validation
{
    public static $errors = [];
    public static function validateRequired($inputs = [])
    {
        foreach ($inputs as $input)
        {
            if(empty($_POST[$input]))
            {
                Validation::$errors[] =  $input . ' is required';
            }
        }
        return true;
    }

    public static function validateEmailIsExists($email)
    {
        global $db;
        $sql = "SELECT id FROM users WHERE email=?";
        $user = $db->prepare($sql);
        $user->execute([$email]);

        if($user->rowCount() != 0 )
        {
           Validation::$errors[] = "Email is exists";
        }
        return true;
    }


    public static function displayErrors($redirect)
    {
        $_SESSION['errors'] = Validation::$errors;
        header('Location:' . $redirect);
        die();
    }
}

interface AuthControllerInterface
{
    public function register();

    public function login();

}


interface LogoutInterface
{
    public function logout();
}






if(isset($_POST['action']))
{
    $user = new AuthControllerOOP();

    if($_POST['action'] == 'Register')
    {
        $user->register();

    }elseif($_POST['action'] == 'Login')
    {
        $user->login();
    }

}else{
    echo 'invalid request';
}




?>