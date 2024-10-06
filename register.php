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

<h1>ABDO System</h1>
<form method="POST" action="backend.php">
    <input type="text" name="user_name" placeholder="Enter your name"><br><br>
    <input type="email" name="user_email" placeholder="Enter your Email"><br><br>
    <input type="date"  name="birth_date"><br><br>
    <input type="radio" name="gender" value="male"> Male
    <input type="radio" name="gender" value="female" > Female <br><br>
    <input type="checkbox" name="courses[]" value="'php"> PHP
    <input type="checkbox" name="courses[]" value="js"> JS
    <input type="checkbox" name="courses[]" value="asp"> Asp
    <input type="checkbox" name="courses[]" value="ruby"> Ruby <br><br>
    <input type="password" name="user_password" placeholder="Emter your password"><br><br>
    <input type="submit" value="register" name="action">
</form>

</body>
</html>