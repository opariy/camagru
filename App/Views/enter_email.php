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
<body>
<div id="main">
    <h2>Forgot password?</h2>
        <h2>Please enter your email</h2>
        <form action="/authorization/reset-password" method="post">
            <label>Email :</label>
            <input id="email" name="email" placeholder="email" type="email" required>
            <input name="submit" type="submit" value=" Login ">
        </form>
</div>
</body>
</html>
<?php
if(isset($_SESSION['logged_user']))
{
    echo '<pre>';
    var_dump($_SESSION['logged_user']);
    echo '</pre>';
}
?>
