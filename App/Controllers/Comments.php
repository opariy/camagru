<?php


namespace App\Controllers;
use \App\Models\CommentsModel;
use App\Models\PhotoModel;
use \App\Models\UserModel;

class Comments extends \Core\Controller
{
    public static function sendCommentNotification($photo_id, $comment)
    {
        $commenter_name = $_SESSION['logged_user']['user_name'];
        $user_id = PhotoModel::getPhotoById($photo_id)['user_id'];
//        var_dump($user_id);
        $user_name = PhotoModel::getPhotoById($photo_id)['user_id'];
        $email = UserModel::getUserById($user_id)['email'];

        echo "commenter " . $commenter_name . "user name " . $user_name . "email " . $email;
        //add right link
//        $message = "
//				<html lang='en'>
//				<head>
//					<title>Your photo received a new comment!</title>
//				</head>
//				<body>
//				<p>Hello, <b>@" . $user_name . "</b>!</p>
//				<p>Your <a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . "' title='camagru'>photo</a> has received the following comment" . $comment . "from ". $commenter_name . "</p>
//				<hr>
//				</body>
//				</html>
//			";
        $headers = "Content-type: text/html; charset=\"UTF-8\"\r\n";
//        mail($email, "[camagru] New Comment", $message, $headers);
    }
}