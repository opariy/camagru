<?php


namespace App\Models;


class LikesModel extends \Core\Model
{
    public static function addLikeAction($photo_id)
    {
        $row = false;
        echo 'mama mula ramy';

        $user_id = $_SESSION['logged_user']['user_name'];

//        try {
//            $db = static::getDB();
//            $sql = 'INSERT INTO `comments`(`user_name`, `user_id`, `photo_id`, `body`) VALUES (:user_name, :user_id, :photo_id, :text);';
//            $stmt = $db->prepare($sql);
//            $stmt->bindParam(':user_name', $_SESSION['logged_user']['user_name']);
//            $stmt->bindParam(':user_id', $_SESSION['logged_user']['user_id']);
//            $stmt->bindParam(':photo_id', $photo_id);
//            $stmt->bindParam(':text', $text);
//            $stmt->execute();
//        } catch (\PDOException $e) {
//            $e->getMessage();
//            echo $e;
//        }
//        return ($row);
    }

}