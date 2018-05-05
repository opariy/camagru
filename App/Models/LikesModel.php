<?php
namespace App\Models;

class LikesModel extends \Core\Model
{
    public static function likeAction($photo_id) {
        $user_id = $_SESSION['logged_user']['user_name'];
        if (self::findPair($user_id, $photo_id)) {
        }
    }

    public static function addPair($user_id, $photo_id)
    {
        try {
            $db = static::getDB();
            $sql = '
			INSERT INTO `likes` (
				`user_id`, `photo_id`)
			VALUES (
				:user_id, :photo_id);
			';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':photo_id', $photo_id);
            $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function deletePair($user_id, $photo_id)
    {
        try {
            $db = static::getDB();
            $sql = '
			DELETE FROM `likes`
			WHERE `user_id` = :user_id AND `photo_id` = :photo_id;
			';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':photo_id', $photo_id);
            $stmt->execute();
            } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function findPair($user_id, $photo_id)
    {
        try {
            $db = static::getDB();
            $sql = '
			SELECT * FROM `likes`
			WHERE `user_id` = :user_id AND `photo_id` = :photo_id;
			';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':photo_id', $photo_id);
            $stmt->execute();
            if ($stmt->fetch(\PDO::FETCH_ASSOC) === false) {
                return false;
            }
        } catch (\PDOException $e) {
            $e->getMessage();
        }
        return true;
    }
}