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
<div>
    first
</div>
<div>
    second
</div>
<div>
    third
</div>
<div>
    first
</div>
<div>
    second
</div>
<div>
    third
</div>
<div>
    first
</div>
<div>
    second
</div>
<div>
    third
</div>
<div>
    first
</div>
<div>
    second
</div>
<div>
    third
</div>
<?php
if(isset($_SESSION['logged_user']))
{
    echo '<pre>';
    var_dump($_SESSION['logged_user']);
    echo '</pre>';
}
?>