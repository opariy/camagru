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
<style>
    #nav {
        /*background-color: lightgrey;*/
        /*position: relative;*/
        height: 150px;
    }
</style>
<body>


<div class="container">
    <div class="row" id="nav">
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="text-align: center;"><h3><a href = "/">home</a></h3></div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="text-align: center;"><h3><a href = "/camera/add-photo">camera</a></h3></div>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="text-align: center;">
            <h3 >Hi, <a href = "/profile/index"><?php echo $_SESSION['logged_user']['user_name'] ?></a>
            <h3><a href = "/authorization/log-out">sign out</a></h3>
        </div>


    </div>
</div>


<?php
require_once ('footer.php');
?>
</html>

