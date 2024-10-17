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
<h2>Create User</h2>
<form method="post" action="../Controllers/UsersController.php">
    <input type="text" name="name" required placeholder="Enter your name"><br>
    <input type="email" name="email" required placeholder="Enter your email"><br>
    <input type="password" name="password" required placeholder="Enter your password"><br>
    <input type="submit" name="action" value="store">
</form>

</body>
</html>