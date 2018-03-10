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
<form id='register' action='/authorization/sign-up' method='post'
      accept-charset='UTF-8'>
    <fieldset >


        <div class="container">
            <h1>Sign Up</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>
            <label for="user_name"><b>User Name</b></label>
<!--            <input type="text" placeholder="Enter User Name" name="user_name" pattern="(?=^[a-z0-9_]){3,20}$" title="May only contain 3-20 alphanumerical symbols or underscores" id="user_name" required>-->
            <input type="text" placeholder="Enter User Name" name="user_name" id="user_name" required>


            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" id="email" maxlength="255" required>
<!--            "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$"-->

            <label for="psw"><b>Password</b></label>
<!--            <input type="password" placeholder="Enter Password" name="psw" id="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,255}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>-->
            <input type="text" placeholder="Enter Password" name="psw" id="psw" required>


            <label for="psw-repeat"><b>Repeat Password</b></label>
<!--            <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" maxlength="255" required>-->
            <input type="text" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" maxlength="255" required>


                <button type="button" class="cancelbtn">Cancel</button>
<!--                <button name="submit" type="submit" class="signupbtn">Sign Up</button>-->
            <input name="submit" type="submit" value=" Login ">

            <!--            </div>-->
        </div>


    </fieldset>
</form>
<?php
if(isset($_SESSION['logged_user']))
{
    echo '<pre>';
    var_dump($_SESSION['logged_user']);
    echo '</pre>';
}
?>

<!--<style>-->
<!--    * {box-sizing: border-box}-->
<!---->
<!--    /* Full-width input fields */-->
<!--    input[type=text], input[type=password] {-->
<!--        width: 100%;-->
<!--        padding: 15px;-->
<!--        margin: 5px 0 22px 0;-->
<!--        display: inline-block;-->
<!--        border: none;-->
<!--        background: #f1f1f1;-->
<!--    }-->
<!---->
<!--    input[type=text]:focus, input[type=password]:focus {-->
<!--        background-color: #ddd;-->
<!--        outline: none;-->
<!--    }-->
<!---->
<!--    hr {-->
<!--        border: 1px solid #f1f1f1;-->
<!--        margin-bottom: 25px;-->
<!--    }-->
<!---->
<!--    /* Set a style for all buttons */-->
<!--    button {-->
<!--        background-color: #4CAF50;-->
<!--        color: white;-->
<!--        padding: 14px 20px;-->
<!--        margin: 8px 0;-->
<!--        border: none;-->
<!--        cursor: pointer;-->
<!--        width: 100%;-->
<!--        opacity: 0.9;-->
<!--    }-->
<!---->
<!--    button:hover {-->
<!--        opacity:1;-->
<!--    }-->
<!---->
<!--    /* Extra styles for the cancel button */-->
<!--    .cancelbtn {-->
<!--        padding: 14px 20px;-->
<!--        background-color: #f44336;-->
<!--    }-->
<!---->
<!--    /* Float cancel and signup buttons and add an equal width */-->
<!--    .cancelbtn, .signupbtn {-->
<!--        float: left;-->
<!--        width: 50%;-->
<!--    }-->
<!---->
<!--    /* Add padding to container elements */-->
<!--    .container {-->
<!--        padding: 16px;-->
<!--    }-->
<!---->
<!--    /* Clear floats */-->
<!--    .clearfix::after {-->
<!--        content: "";-->
<!--        clear: both;-->
<!--        display: table;-->
<!--    }-->
<!---->
<!--    /* Change styles for cancel button and signup button on extra small screens */-->
<!--    @media screen and (max-width: 300px) {-->
<!--        .cancelbtn, .signupbtn {-->
<!--            width: 100%;-->
<!--        }-->
<!---->
<!--</style>-->
<!---->
<!--}-->



<!--<script>-->
<!--    // Get the modal-->
<!--    var modal = document.getElementById('id01');-->
<!---->
<!--    // When the user clicks anywhere outside of the modal, close it-->
<!--    window.onclick = function(event) {-->
<!--        if (event.target == modal) {-->
<!--            modal.style.display = "none";-->
<!--        }-->
<!--    }-->
<!--</script>-->