<?php


if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['action'] == 'login') {
    login($_REQUEST);
}


if($_SERVER['REQUEST_METHOD'] == 'POST' && $_REQUEST['action'] == 'register')
{
    register($_REQUEST);
}


function login($request)
{
    $validation = requestValidationEmpty($request);
    if(count($validation) == 0 ) {

        $userEmail = $request['email'];
        $userPassword = $request['password'];


        $allowEmail = "abdo@gmail.com";
        $allowPassword = "12345678";

        if ($userEmail == $allowEmail) {
            if ($userPassword == $allowPassword) {
                echo "welcome in ABDO system";
            } else {
                echo "invalid Password";
            }

        } else {
            echo "invalid Email";
        }
    }else{
        displayErrors($validation);
    }

}

function register($request)
{
    $validation = requestValidationEmpty($request,['courses','user_name']);

    if(count($validation) == 0) {

        $userName = $_REQUEST['user_name'];
        $userEmail = $_REQUEST['user_email'];
        $userPassword = $_REQUEST['user_password'];
        $birthDate = $_REQUEST['birth_date'];
        $gender = $_REQUEST['gender'];
        $courses = $_REQUEST['courses'];

        $courses = $_REQUEST['courses'];

        echo "Welcome {$userName} your account is created";
    }else{
        displayErrors($validation);
    }

}


function requestValidationEmpty($request, $expect=[])
{
    $errors = [];
    foreach ($request as $key => $value)
    {
        if(!in_array($key, $expect)  && empty($request[$key]))
        {
            $errors [$key] = 'is required';
        }
    }

    return $errors;
}


function displayErrors($errors)
{
    foreach ($errors as $key => $value)
    {
        echo '<h5 style="color:#f00"> '. $key .' </h5> ' . $value;
    }
}
