<?php

namespace App\Controllers;


use App\Models\CommentsModel;
use Core\View;
use App\Models\PhotoModel;

class Camera extends \Core\Controller
{
    public static function addPhotoAction()
    {
        if (!isset($_SESSION['logged_user']) || empty($_SESSION['logged_user'])) {
            header("Location: /Authorization/log-in");
        } else {
            if (isset($_POST['submit'])) {
                $user_dir = "downloads/" . $_SESSION['logged_user']['user_id'];
                $img_name = time() . ".png";
                $img_path = $user_dir . '/' . $img_name;

                if (!file_exists('downloads')) {
                    mkdir('downloads');
                }
                if (!file_exists($user_dir)) {
                    mkdir($user_dir);
                }
                $base64 = $_POST['photo'];
                $data = explode(',', $base64);
                $photo = base64_decode($data[1]);
                file_put_contents($img_path, $photo);
                $source = imagecreatefrompng($img_path);
                imageflip($source, IMG_FLIP_HORIZONTAL);
                $frame = 'stickers/' . $_POST['frame'] . '.png';
                $frame = imagecreatefrompng($frame);
                imagecopyresized($source, $frame,
                    0, 0,
                    0, 0,
                    imagesx($source), imagesy($source),
                    imagesx($frame), imagesy($frame));
                imagejpeg($source, $img_path);
                PhotoModel::insertPhoto($img_name, $_SESSION['logged_user']['user_id']);
            }
            View::render('camera.php');
        }
    }

    public static function deletePhoto()
    {
        $user_id = PhotoModel::getPhotoById($_POST['photo_id'])['user_id'];
        $photo_name = PhotoModel::getPhotoById($_POST['photo_id'])['name'];

        $path = "downloads/". $user_id . "/". $photo_name;
        PhotoModel::deletePhoto($_POST['photo_id']);
        unlink($path);
    }

    public static function deleteComment()
    {
        echo 'deleted';
        CommentsModel::deleteComment($_POST['comment_id']);
    }

}