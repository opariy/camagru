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
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
<form id='register' action='/authorization/sign-up' method='post'
      accept-charset='UTF-8'>
    <fieldset >


        <div class="container">
            <?php if (is_string($message)) { echo $message;}  ?>
            <h1>sign up</h1>
            <p>please fill in this form to create an account.</p>
            <hr>
            <label for="user_name"><b>user name</b></label>

            <input type="text" placeholder="Enter User Name" name="user_name" pattern="[a-z0-9_]{3,20}" title="May only contain 3-20 alphanumerical symbols or underscores" required>

            <label for="email"><b>email</b></label>
            <input type="email" placeholder="enter email" name="email" id="email" maxlength="255" required>

            <label for="psw"><b>password</b></label>
<!--            <input type="password" placeholder="Enter Password" name="psw" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,255}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>-->
            <input type="password" placeholder="enter password" name="psw" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,255}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>

            <label for="psw-repeat"><b>repeat password</b></label>
<!--            <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" maxlength="255" required>-->
            <input type="password" placeholder="repeat password" name="psw-repeat" id="psw-repeat" maxlength="255" required>
            <input name="submit" type="submit" value=" go ">
        </div>


    </fieldset>
</form>
<?php
require_once ('footer.php');
?>