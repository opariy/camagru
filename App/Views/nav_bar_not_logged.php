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
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"><h3><a href = "/">home</a></h3></div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="text-align: right;">
            <h3><a href = "/Authorization/log-in">log in</a></h3>
            <h3><a href = "/Authorization/sign-up">sign up</a></h3>
        </div>
    </div>
</div>
</body>


<?php
require_once ('footer.php');
?>
</html>



