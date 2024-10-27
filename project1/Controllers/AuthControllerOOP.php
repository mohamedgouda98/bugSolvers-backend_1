<?php
session_start();
global $db;
include '../db/db.php';
class AuthControllerOOP
{
    public $name;
    public $email;
    public $phone;
    public $password;

    public $errors = [];
    public function register(){
        global $db;
        $this->validateRequired([
            'name' => $this->name,
            'email' =>$this->email,
            'phone' =>$this->phone,
            'password' => $this->password
        ]);
        $this->validateEmailExists($this->email);

       if(count($this->errors) != 0)
       {
           $_SESSION['errors'] = $this->errors;
           header('Location:../register.php');
           die();
       }

        $sql = 'INSERT INTO users(name,email,phone,password) VALUES(?,?,?,?)';

        $createUser = $db->prepare($sql);
        $createUser->execute([
            $this->name,
            $this->email,
            $this->phone,
            $this->password
        ]);

        $this->setUserToSession($this->email);

        $_SESSION['msg'] = 'hello, <b>' . $this->name . '</b> your account is created';

        header('Location: ../home.php');

    }


    private function validateRequired($inputs)
    {
        foreach ($inputs as $key => $value)
        {
            if(empty($value))
            {
                $this->errors [] = $key . ' is required';
            }
        }
        return true;
    }


    private function validateEmailExists($email)
    {
        global $db;
        $sql = "SELECT id FROM users WHERE email=?";
        $isExists = $db->prepare($sql);
        $isExists->execute([$email]);
        if($isExists->rowCount() != 0)
        {
            $this->errors[] = 'this email is exists';
        }
    }


    private function setUserToSession($email)
    {
        global $db;
        $sql = "SELECT id FROM users WHERE email=?";
        $userStat = $db->prepare($sql);
        $userStat->execute([$email]);
        $user = $userStat->fetchAll();
        $_SESSION['user_id'] = $user[0]['id'];
    }


}


if(isset($_POST['action']))
{
    $user = new AuthControllerOOP();
    if($_POST['action'] == 'Register')
    {
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->phone = $_POST['phone'];
        $user->register();
    }

}else{
    echo 'invalid request';
}



?>