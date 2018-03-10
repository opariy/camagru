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
    <div id="login">
        <h2>Login Form</h2>
        <form action="/authorization/log-in" method="post">
            <label>User Name :</label>
            <input id="name" name="user_name" placeholder="user_name" type="text" required>
            <label>Password :</label>
            <input id="password" name="password" placeholder="**********" type="password" required>
            <input name="submit" type="submit" value=" Login ">
        </form>
    </div>
    <h2><a href = "/authorization/reset-password">Forgot Password?</a></h2>

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