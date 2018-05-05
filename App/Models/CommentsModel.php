<?php
namespace App\Models;

class CommentsModel extends \Core\Model
{
    public static function getCommentsForPhoto($photo_id)
    {
        $row = false;

        try {
            $db = static::getDB();
            $sql = 'SELECT * FROM `comments` WHERE `photo_id` = ? ORDER BY `id` DESC';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $photo_id);
            $stmt->execute();
            $row = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            $e->getMessage();
            echo $e;
        }
        return ($row);
    }

    public static function deleteComment($id)
    {
        try {
            $db = static::getDB();
            $sql = '
			DELETE FROM `comments`
			WHERE `id` = :id;
			';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }


    public static function addComment($photo_id, $text)
    {
        $row = false;
        try {
            $db = static::getDB();
            $sql = 'INSERT INTO `comments`(`user_name`, `user_id`, `photo_id`, `body`) VALUES (:user_name, :user_id, :photo_id, :text);';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':user_name', $_SESSION['logged_user']['user_name']);
            $stmt->bindParam(':user_id', $_SESSION['logged_user']['user_id']);
            $stmt->bindParam(':photo_id', $photo_id);
            $stmt->bindParam(':text', $text);
            $stmt->execute();
        } catch (\PDOException $e) {
            $e->getMessage();
            echo $e;
        }
        return ($row);
    }
}