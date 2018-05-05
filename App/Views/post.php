<?php
use \App\Models\CommentsModel;
use \App\Controllers\Comments;

if(!isset($_SESSION['logged_user']) || empty($_SESSION['logged_user'])) {
    require_once ('nav_bar_not_logged.php');
} else {
    require_once ('nav_bar_logged.php');
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="/js/delete.js"></script>
    <script src="/js/like.js"></script>
    <script src="/js/deleteComment.js"></script>

    <meta charset="utf-8">
</head>
<body>

<?php

if (isset($_POST['submit'])) {
    CommentsModel::addComment($_POST['photo_id'], htmlspecialchars($_POST['comment']));
    Comments::sendCommentNotification($_POST['photo_id'], $_POST['comment']);
    $url = '/home/'.$_POST['photo_id'].'/post';
    header("Location: $url");
    exit();
}
?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="img-table"><img src="<?php echo $picture[0]['path']; ?>"></div>
                <?php
                if (isset($_SESSION['logged_user'])) {
                    ?>

                    <section class="like_comment_share">
                        <div class="like">
                            <a data-photo-id="<?= $picture[0]['photo_id']; ?>"  onclick ="addLike(this)">Like</a>
                        </div>
                    </section>

                    <?php
                    if ($_SESSION['logged_user']['user_id'] == $picture[0]['user_id']) {
                        ?>
                        <div class="delete">
                            <a data-delete-photo-id="<?= $picture[0]['photo_id']; ?>"  onclick ="deleteImage(this)">Delete</a>
                        </div>
                    <?php
                    }
                }
                ?>
                <div class="likes" id="like<?php echo $picture[0]['photo_id']; ?>"><?php if ($picture[0]['likes'] == 1) {echo $picture[0]['likes']. ' like';} else {echo $picture[0]['likes']. ' likes';}?>


<!--                    <div class="likes" id="like--><?php //echo $picture[0]['photo_id']; ?><!--">--><?php //echo $picture[0]['likes']; ?><!-- likes-->
                </div>


                 <?php
                $comments = CommentsModel::getCommentsForPhoto($picture[0]['photo_id']);
                if (!empty($comments)) {
                    ?>
                    <div class="comment"></div>
                    <?php            for ($count = 0; $count < count($comments); $count++) { ?>
                        <div><b>@ <?php  echo $comments[$count]['user_name'] ?> </b>: <?php echo $comments[$count]['body'] ?> </div>
                        <div>
                            <a class="delete_comment" id="comment<?php echo $comments[$count]['id']; ?>" data-delete-comment-id="<?= $comments[$count]['id']; ?>"  onclick ="deleteComment(this)">Delete Comment</a>
                        </div>
                    <?php }
                }

                if (isset($_SESSION['logged_user'])) {
                    ?>
                    <div><form action="/home/<?php echo $picture[0]['photo_id'] ?>/post" method="post">
                            <!--                <input placeholder="add your comment" name="comment" type="text" maxlength="300">-->
                            <textarea placeholder="add your comment" required name="comment"  maxlength="300"></textarea>
                            <input type="hidden" name="photo_id" value="<?php echo $picture[0]['photo_id']; ?>">
                            <input name="submit" type="submit" value=" Send ">
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>

<style>
    .img-table img {
        /*position: relative;*/
        overflow: hidden;
        /*width:30%;*/
        width:400px;

        /*height:30%;*/
        height:auto;
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

    .delete_comment {


        /*display: flex;*/
        /*flex-direction: row;*/
        /*margin-top: 4px;*/

        background-image: url("/img/icons.png");
        background-position-x: -413px;
        background-position-y: -112px;

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
        /*display: inline-block;*/
        float: right;
        /*margin-left: 50px;*/
    }

    .comment_deleted {


        /*background-image: url("/img/icons.png");*/
        /*background-position-x: -413px;*/
        /*background-position-y: -112px;*/


        /*background-repeat: no-repeat;*/
        /*background-size: 435px 406px;*/
        /*cursor: pointer;*/

        /*height: 24px;*/
        /*width: 24px;*/

        /*overflow: hidden;*/
        /*text-indent: 110%;*/
        float: right;
        /*margin-left: 50px;*/
    }


</style>
</body>
<?php
require_once ('footer.php');
?>
</html>



