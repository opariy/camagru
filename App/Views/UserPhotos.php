
<?php

use \App\Models\PhotoModel;
use \App\Models\UserModel;


if(!isset($_SESSION['logged_user']) || empty($_SESSION['logged_user']))
{
    require_once ('nav_bar_not_logged.php');
}
else
{
    require_once ('nav_bar_logged.php');

//    echo 'user_id'.$user_id;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>


<script src="/js/like.js"></script>
<script src="/js/delete.js"></script>
<style>
    body {
        margin-bottom: 30px;
    }
    .textarea {
        overflow-wrap: break-word;
        /*width: 100px*/
        /*white-space: nowrap*/
        /*overflow: hidden*/
        /*text-overflow: ellipsis*/
    }


    .thumbnail {
        position: relative;
        width: 200px;
        height: 200px;
        overflow: hidden;
    }

    .img-table {
        margin: 10px 0;
    }

    .img-table img {
        /*position: relative;*/
        overflow: hidden;
        /*width:30%;*/
        width:100%;

        /*height:30%;*/
        height:auto;
        display:inline;
        /*margin: 10px 1.5%; !* spacing: 20px vertically, 5% horizontally *!*/
        /*-webkit-transform: translate(-50%,-50%);*/
        /*-ms-transform: translate(-50%,-50%);*/
        /*transform: translate(-50%,-50%);*/
        /*position: relative;*/
        /*overflow: hidden;*/
        /*width: 30%;*/
        /*height: 30%;*/


    }
    .img-table > a {
        max-width: 100%;
    }

    .post-form > form {
        display: flex;
        margin: 10px 0;
        align-content: stretch;
    }

    .like >a {


        /*display: flex;*/
        /*flex-direction: row;*/
        /*margin-top: 4px;*/

        background-image: url("/img/icons.png");
        background-position-x: -388px;
        background-position-y: -201px;

        /*-388px -76px*/

        background-repeat: no-repeat;
        background-size: 435px 406px;
        /*vertical-align: baseline;*/
        cursor: pointer;

        height: 24px;
        width: 24px;
        /*padding: 8px;*/
        /*padding-left: 43px;*/

        overflow: hidden;
        text-indent: 110%;
        display: inline-block;
        float: left;

    }

    .delete >a {


        /*display: flex;*/
        /*flex-direction: row;*/
        /*margin-top: 4px;*/

        background-image: url("/img/icons.png");
        background-position-x: -412px;
        background-position-y: -45px;

        /*-388px -76px*/

        background-repeat: no-repeat;
        background-size: 435px 406px;
        /*vertical-align: baseline;*/
        cursor: pointer;

        height: 24px;
        width: 24px;
        /*padding: 8px;*/
        /*padding-left: 43px;*/

        overflow: hidden;
        text-indent: 110%;
        display: inline-block;
        float: left;
        /*margin-left: 50px;*/

    }
    .pagination {
        width: auto;
        max-width: 400px;
        margin: 20px auto;
    }

</style>
<div>
    <?php echo UserModel::getUserById($user_id)['user_name'] ?>'s photos
</div>
<div class="container">
    <div class="row">
<?php
    $photos = PhotoModel::getAllUserPhotos($user_id);
    $count = PhotoModel::countAllUserPhotos($user_id);

    for ($i=0; $i<$count; $i++) { ?>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
<!--            <img src="--><?php //echo '/downloads/' . $user_id . '/' . $photos[$i]['name']; ?><!--">-->
            <div class="img-table"><a href="/../home/<?php echo $photos[$i]['id'] ?>/post"><img src="<?php echo '/downloads/' . $user_id . '/' . $photos[$i]['name']; ?>"></a></div>
        </div>
        <?php
    }
    ?>
    </div>
</div>


    <style>
        .img-table img {
            position: relative;
            overflow: hidden;
            /*width:30%;*/
            /*width:70px;*/

            height:30%;
            /*height:auto;*/
            display:inline;
            margin: 10px 1.5%; /* spacing: 20px vertically, 5% horizontally */
            /*-webkit-transform: translate(-50%,-50%);*/
            /*-ms-transform: translate(-50%,-50%);*/
            /*transform: translate(-50%,-50%);*/
            /*position: relative;*/
            /*overflow: hidden;*/
            /*width: 30%;*/
            /*height: 30%;*/


        }
    </style>

</html>
<?php
require_once ('footer.php');
?>