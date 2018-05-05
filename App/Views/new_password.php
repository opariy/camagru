<?php

if(!isset($_SESSION['logged_user']) || empty($_SESSION['logged_user']))
{
    require_once ('nav_bar_not_logged.php');
}
else
{
    require_once ('nav_bar_logged.php');
}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<form id='register' action='/authorization/reset-password' method='post'
      accept-charset='UTF-8'>
    <fieldset >

<!--        --><?php //echo $email; ?>

        <div class="container">
            <h1>Enter New Password</h1>
            <p>Please do whatever.</p>
            <hr>

            <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="enter password" name="psw" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,255}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
<!--            <input type="text" placeholder="Enter New Password" name="psw" id="psw" required>-->

            <label for="psw-repeat"><b>Repeat Password</b></label>
                        <input type="password" placeholder="repeat password" name="psw-repeat" id="psw-repeat" maxlength="255" required>
<!--            <input type="text" placeholder="Repeat New assword" name="psw-repeat" id="psw-repeat" maxlength="255" required>-->
            <input type="hidden" name="email" value="<?php echo $email; ?>">


            <button type="button" class="cancelbtn">Cancel</button>
            <input name="submit1" type="submit" value=" Save ">
        </div>


    </fieldset>
</form>
<?php
require_once ('footer.php');
?>
