<?php

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $user_name = $_REQUEST['user_name'];
    $user_email = $_REQUEST['user_email'];
    $user_password = $_REQUEST['user_password'];

    echo "Welcome {$user_name} your account is created";

}else{
    echo "Just POST request";
}