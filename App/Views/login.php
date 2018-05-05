<?php

if(!isset($_SESSION['logged_user']) || empty($_SESSION['logged_user']))
{
    require_once ('nav_bar_not_logged.php');
}
else
{
    require_once ('nav_bar_logged.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php if (is_string($message)) { echo $message;}  ?>

    <div id="main">

        <div id="login">
            <h3>Login Form</h3>
            <form action="/authorization/log-in" method="post">
                <label>User Name :</label>
                <input id="name" name="user_name" placeholder="user_name" type="text" required>
                <label>Password :</label>
                <input id="password" name="password" placeholder="**********" type="password" required>
                <input name="submit-login" type="submit" value=" Login ">
            </form>
        </div>
        <h3><a href = "/authorization/reset-password">Forgot Password?</a></h3>

    </div>
</div>

</body>
<?php
require_once ('footer.php');
?>
</html>
