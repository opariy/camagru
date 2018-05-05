<?php

namespace App\Controllers;

use \App\Models\LikesModel;
use \App\Models\PhotoModel;
use \App\Models\UserModel;


class Like extends \Core\Controller
{
    public function AddLike()
    {
        if(!isset($_SESSION['logged_user']) || empty($_SESSION['logged_user']))
        {
            header("Location: /Authorization/log-in");
        }
        else {
            if (isset($_POST['photo_id'])) {
                $photo_id = $_POST['photo_id'];
                $liker_id = $_SESSION['logged_user']['user_id'];
                if (LikesModel::findPair($liker_id, $photo_id)) {
                    LikesModel::deletePair($liker_id, $photo_id);
                    PhotoModel::decrementLike($photo_id);
                } else {
                    LikesModel::addPair($liker_id, $photo_id);
                    PhotoModel::incrementLike($photo_id);
                    $owner_id = PhotoModel::getPhotoById($photo_id)['user_id'];
                    if ((UserModel::getUserById($owner_id))['notifications']) {
                    $this->LikeNotification($photo_id);
                    }
                }
                echo PhotoModel::getPhotoById($photo_id)['likes'];
            }
            else {
                header("Location: /");
            }
        }
    }

    protected function LikeNotification($photo_id)
    {
        $liker_name = $_SESSION['logged_user']['user_name'];
        $owner_id = PhotoModel::getPhotoById($photo_id)['user_id'];
        $owner_name = UserModel::getUserById($owner_id)['user_name'];
        $email = UserModel::getUserById($owner_id)['email'];
        $message = "
				<html lang='en'>
				<head>
					<title>Your photo received a new like!</title>
				</head>
				<body>
				<p>Hello, <b>@" . $owner_name . "</b>!</p>
				<p><b>@". $liker_name . "</b> liked your <a href='" . $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . '/home/'. $photo_id. '/post'. "' title='camagru'>photo</a></p>
				</body>
				</html>
			";
        $headers = "Content-type: text/html; charset=\"UTF-8\"\r\n";
        mail($email, "[camagru] New Like", $message, $headers);
    }
}