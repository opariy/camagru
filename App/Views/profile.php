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
<!--<form action='change-password.php' method='post' id="register-form">-->
<!--    --><?php //echo $message; ?>
<!--    <input class="password-field" type='password' name='oldpw' value='--><?php //echo $user_name; ?><!--' placeholder="Current Password"><br />-->
<!--    <input  class="password-field" type='password' name='newpw' placeholder="New Password"><br />-->
<!--    <input class="password-field" type='password' name='conpw' placeholder="Confrim Password">-->
<!--    <input class="button" type='submit' name='change' value='Change' />-->



    <div id="profile">
        <h2>edit your profile</h2>
        <form action="/profile/index" method="post">
            <label>user name :</label>
            <input id="new_user_name" name="new_user_name" type="text" value='<?php echo $_SESSION['logged_user']['user_name']; ?>' >
            <label>email :</label>
            <input id="new_email" name="new_email"  type="email" value='<?php echo $_SESSION['logged_user']['email']; ?>' >
<!--            <label>old password :</label>-->
<!--            <input id="password" name="password"  type="password" >-->
            <input name="submit" type="submit" value=" save ">
            <!--            $username=$_POST['username'];-->
        </form>
    </div>
    <h2><a href = "/profile/change-password">Change password</a></h2>


</form>

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


