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
        $user_name = UserModel::getUserById($user_id)['user_name'];
        $email = UserModel::getUserById($user_id)['email'];
        $message = "
				<html lang='en'>
				<head>
					<title>Your photo received a new comment!</title>
				</head>
				<body>
				<p>Hello, <b>@" . $user_name . "</b>!</p>
				<p>Your <a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . '/home/'. $photo_id. '/post'. "' title='camagru'>photo</a> has received the following comment <i>\"" . $comment . "\"</i> from <b>@". $commenter_name . "</p>
				</body>
				</html>
			";
        $headers = "Content-type: text/html; charset=\"UTF-8\"\r\n";
        mail($email, "[camagru] New Comment", $message, $headers);
    }
}