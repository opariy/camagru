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
<body>
<div class="container">
    <?php if (is_string($message)) { echo $message;}  ?>

    <div id="profile">
        <h2>edit your profile</h2>
        <form action="/profile/index" method="post">
            <div>i want to receive  email notifications:
<!--                <input type="radio" name="radio"  id="radioButton">-->
<!--                <input type="radio" value="1">-->
<!--                <input type="radio" checked="checked">-->
                <input id="checkBox" name="notify" <?php if ($notify) { echo 'checked';} ?> type="checkbox">

            </div>

            <label>user name :</label>

            <input id="new_user_name" name="new_user_name" type="text" value='<?php echo $_SESSION['logged_user']['user_name']; ?>' >

            <label>email :</label>
            <input id="new_email" name="new_email"  type="email" value='<?php echo $_SESSION['logged_user']['email']; ?>' >
<!--            <label>old password :</label>-->
<!--            <input id="password" name="password"  type="password" >-->
            <input name="submit" type="submit" value=" save ">
        </form>
        <h2><a href = "/profile/change-password">change password</a></h2>
    </div>
</div>



</form>

</body>
<?php
require_once ('footer.php');
?>
</html>


