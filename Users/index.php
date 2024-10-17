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
include '../DB/db_connect.php';

$sql = "SELECT * FROM users";
$usersQuery = $db->prepare($sql);
$usersQuery->execute();
$users = $usersQuery->fetchAll();
?>

<a href="create.php">Create User</a>
<table border="1px">
    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Password</td>
            <td>Delete</td>
        </tr>
    </thead>

    <tbody>
    <?php
        foreach ($users as $user)
        {
            ?>

            <tr>
                <td><?php echo $user['id']?></td>
                <td><?php echo $user['name']?></td>
                <td><?php echo $user['email']?></td>
                <td><?php echo $user['password']?></td>
                <td>
                    <form method="post" action="../Controllers/UsersController.php">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']?>">
                        <input type="submit" value="Delete" name="action">
                    </form>
                </td>
            </tr>
    <?php
        }
    ?>

    </tbody>
</table>

</body>
</html>