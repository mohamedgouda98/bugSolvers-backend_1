<?php

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $allowEmail = "abdo@gmail.com";
    $allowPassword = "12345678";

    $userEmail = $_REQUEST['email'];
    $userPassword = $_REQUEST['password'];

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
    echo "Just POST Requests, redirect to login page";
}
