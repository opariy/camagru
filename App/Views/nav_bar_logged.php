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
<!--<h1>Welcome --><?php //echo $login_session; ?><!--</h1>-->
<h2><a href = "/">Home sweet home</a></h2>
<h2><a href = "/authorization/log-out">Sign Out</a></h2>
<h2><a href = "/profile/index">My Profile</a></h2>
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

