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
<form id='register' action='/authorization/reset-password' method='post'
      accept-charset='UTF-8'>
    <fieldset >


        <div class="container">
            <h1>Enter New Password</h1>
            <p>Please do whatever.</p>
            <hr>

            <label for="psw"><b>Password</b></label>
            <!--            <input type="password" placeholder="Enter Password" name="psw" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,255}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>-->
            <input type="text" placeholder="Enter New Password" name="psw" id="psw" required>


            <label for="psw-repeat"><b>Repeat Password</b></label>
            <!--            <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" maxlength="255" required>-->
            <input type="text" placeholder="Repeat New assword" name="psw-repeat" id="psw-repeat" maxlength="255" required>


            <button type="button" class="cancelbtn">Cancel</button>
            <!--                <button name="submit" type="submit" class="signupbtn">Sign Up</button>-->
            <input name="submit1" type="submit" value=" Save ">

            <!--            </div>-->
        </div>


    </fieldset>
</form>
<?php
//if(isset($_SESSION['logged_user']))
//{
//    echo '<pre>';
//    var_dump($_SESSION['logged_user']);
//    echo '</pre>';
//}
?>