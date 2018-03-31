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
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<?php

if (isset($_POST['submit'])) {
    CommentsModel::addComment($_POST['photo_id'], $_POST['comment']);
    Comments::sendCommentNotification($_POST['photo_id'], $_POST['comment']);
    $url = '/home/'.$_POST['photo_id'].'/post';
    header("Location: $url");
    exit();
}
?>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="img-table"><img src="<?php echo $picture[0]['path']; ?>"></div>
                likes and stuuff (if logged)

                <section class="like_comment_share">
                    <div class="like">
                        <a data-photo-id= "<?php echo $picture[0]['photo_id']; ?>"  onclick ="addLike(this)">Like</a>
                    </div>
                </section>

                 <?php
                $comments = CommentsModel::getCommentsForPhoto($picture[0]['photo_id']);
                if (!empty($comments)) {
                    ?>
                    <div class="comment"></div>
                    <?php            for ($count = 0; $count < count($comments); $count++) { ?>
                        <div><b>@ <?php  echo $comments[$count]['user_name'] ?> </b>: <?php echo $comments[$count]['body'] ?> </div>
                    <?php }
                }

                if (isset($_SESSION['logged_user'])) {
                    ?>
                    <div><form action="/home/<?php echo $picture[0]['photo_id'] ?>/post" method="post">
                            <!--                <input placeholder="add your comment" name="comment" type="text" maxlength="300">-->
                            <textarea placeholder="add your comment" name="comment" maxlength="300"></textarea>
                            <input type="hidden" name="photo_id" value="<?php echo $picture[0]['photo_id']; ?>">
                            <input name="submit" type="submit" value=" Send ">
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>

<style>

    .thumbnail {
        position: relative;
        width: 200px;
        height: 200px;
        overflow: hidden;
    }

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


</style>

<script src="js/like.js"></script>


<!--                        <section class="like_comment_share">-->
<!--                        <div class="like">-->
<!--                            <a   data-photo-id = '; echo $picture[0]['photo_id']; echo 'onclick="addLike(this)">Like</a>-->
<!--                        </div>-->
<!--                        </section>-->
<!--                     <div class="likes" id="like'; echo $picture[$j]['photo_id']; echo '">'; echo $picture[$j]['likes']; echo 'likes-->
<!--                    </div>-->


</body>
</html>
<?php
//if(isset($_SESSION['logged_user']))
//{
//    echo '<pre>';
//    var_dump($_SESSION['logged_user']);
//    echo '</pre>';
//}
?>



