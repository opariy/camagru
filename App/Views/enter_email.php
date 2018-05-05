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
    <?php if ($message) { echo $message; } ?>
    <div id="main">
        <h2>Forgot password?</h2>
        <h2>Please enter your email</h2>
        <form action="/authorization/reset-password" method="post">
            <label>Email :</label>
            <input id="email" name="email" placeholder="email" type="email" required>
            <input name="submit" type="submit" value=" Login ">
        </form>
    </div>
</div>
</body>
<?php
require_once ('footer.php');
?>
</html>
