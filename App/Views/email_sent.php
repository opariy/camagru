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
<!--<div>--><?//= $args['message']?><!--</div>-->
<div>Your created account has not been activated yet. Please activate it by clicking the activation link that has been send to your email. </div>
<div>Didn't get an email? Click <a href = "/Authorization/resend-mail">here</a>
<!--<a href = "/authorization/sign-up">Sign up with a different email</a>-->
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




