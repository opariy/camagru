<?php
use \App\Models\CommentsModel;
use \App\Controllers\Comments;
use \App\Models\UserModel;
use \App\Models\LikesModel;
if(!isset($_SESSION['logged_user']) || empty($_SESSION['logged_user'])) {
    require_once ('nav_bar_not_logged.php');
} else {
    require_once ('nav_bar_logged.php');
}
if (isset($_POST['submit'])) {
    CommentsModel::addComment($_POST['photo_id'], htmlspecialchars($_POST['comment']));
    if ((UserModel::getUserById($_SESSION['logged_user']['user_id']))['notifications']) {
        Comments::sendCommentNotification($_POST['photo_id'], $_POST['comment']);
    }
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="/js/like.js"></script>
    <script src="/js/delete.js"></script>
    <script src="/js/deleteComment.js"></script>
</head>

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

    .liked > a {


        /*display: flex;*/
        /*flex-direction: row;*/
        /*margin-top: 4px;*/

        background-image: url("/img/icons.png");
        background-position-x: -388px;
        background-position-y: -76px;

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

    .not_liked > a {


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



    .pagination {
        width: auto;
        max-width: 400px;
        margin: 20px auto;
    }

</style>


<body>

<div class="container">
    <?php echo $message;?>
    <div class="row">
        <?php
        $index = 0;
        for ($j = $index; $j < $index + count($picture); $j++) { ?>
        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <a href = '/profile/<?php echo $picture[$j]['user_id'];?>/user'><?php echo $picture[$j]['author_user_name']; ?></a>
            <div class="img-table"><a href = "home/<?php echo $picture[$j]['photo_id'] ?>/post"><img src="<?php echo $picture[$j]['path']; ?>" ></a></div>
            <?php
            if (isset($_SESSION['logged_user'])) {
            if (LikesModel::findPair($_SESSION['logged_user']['user_id'], $picture[$j]['photo_id'])) {
                $liked_class = 'class="liked"';
            }   else {
                $liked_class = 'class="not_liked"';
            }
            ?>
            <div <?= $liked_class; ?></div>
            <a data-photo-id="<?= $picture[$j]['photo_id']; ?>"  onclick ="addLike(this)">Like</a>
        </div>
    <?php
    if ($_SESSION['logged_user']['user_id'] == $picture[$j]['user_id']) {
        ?>
        <div class="delete">
            <a data-delete-photo-id="<?= $picture[$j]['photo_id']; ?>"  onclick ="deleteImage(this)">Delete</a>
        </div>
    <?php }}
    ?>
        <div class="likes" id="like<?php echo $picture[$j]['photo_id']; ?>"><?php echo $picture[$j]['likes'];?> likes
        </div>
        <?php
        $comments = CommentsModel::getCommentsForPhoto($picture[$j]['photo_id']);
        if (!empty($comments)) {
            if (count($comments) < 4) {
                $max_comment_or_3 = count($comments);
            } else {
                $max_comment_or_3 = 3;
            }
            ?>
            <div class="comment"></div>
            <?php            for ($count = 0; $count < $max_comment_or_3; $count++) { ?>
                <div class="textarea">
                    <b>@<?php echo $comments[$count]['user_name'] ?> </b>: <?php echo $comments[$count]['body'] ?>
                    <div>
                        <a class="delete_comment" id="comment<?php echo $comments[$count]['id']; ?>" data-delete-comment-id="<?= $comments[$count]['id']; ?>"  onclick ="deleteComment(this)">Delete Comment</a>
                    </div>
                </div>
            <?php }
            if (count($comments) > $max_comment_or_3 ) {
                echo '<a href = "home/'. $picture[$j]['photo_id'] . '/post">see more..</a>';
            }
        }
        if (isset($_SESSION['logged_user'])) {
            ?>
            <div class="post-form">
                <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                    <textarea placeholder="add your comment" required name="comment"  maxlength="300"></textarea>
                    <input type="hidden" name="photo_id" value="<?php echo $picture[$j]['photo_id']; ?>">
                    <input name="submit" type="submit" value=" Send ">
                </form>
            </div>
        <?php }
        ?>
    </div>
    <?php } ?>
</div>
</div>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php foreach ($pages as $number => $item) : ?>
            <?php if ($item > 0 && $item <= $max_page) : ?>
                <?php if ($number == 2) : ?>
                    <li class="page-item active"><a class="page-link" href="/?page=<?php echo $item; ?>"><?php echo $item; ?></a></li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link" href="/?page=<?php echo $item; ?>"><?php echo $item; ?></a></li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; ?>

    </ul>
</nav>
<?php
include_once ('footer.php');
?>
</body>
</html>