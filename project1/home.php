<?php
session_start();
if(isset($_SESSION['user_id'])){
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php

echo $_SESSION['msg'];

?>

<h2>Home Page</h2>

</body>
</html>

<?php
}else{
    header('Location:login.php');
}
?>