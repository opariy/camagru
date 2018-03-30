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
<div>We sent you a password reinitialisation email. Go get it! </div>
<div>Didn't get an email? Click <a href = "/Authorization/restore-pass">here</a>
</body>
</html>
<?php
//if(isset($_SESSION['logged_user']))
//{
//    echo '<pre>';
//    var_dump($_SESSION['logged_user']);
//    echo '</pre>';
//}
?>




