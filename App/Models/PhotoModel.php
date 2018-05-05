<?php

namespace App\Models;


class PhotoModel extends \Core\Model
{
    public static function countAllPhotos()
    {
        $result = false;
        try {
            $db = static::getDB();
            $sql = 'SELECT COUNT(*) FROM `photos`';
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch()[0];
        } catch (\PDOException $e) {
            $e->getMessage();
        }
        return ($result);
    }


    public static function get9Photos($offset)
    {
        $row = false;
        try {
            $db = static::getDB();
            $sql = "SELECT * FROM `photos` ORDER BY `id` DESC LIMIT 9 OFFSET $offset;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return ($row);
    }

    public static function deletePhoto($photo_id)
    {
        try {
            $db = static::getDB();
            $sql = '
			DELETE FROM `photos`
			WHERE `id` = :photo_id;
			';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':photo_id', $photo_id);
            $stmt->execute();
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    public static function getAllUserPhotos($user_id)
    {
        $row = false;
        try {
            $db = static::getDB();
            $sql = "SELECT * FROM `photos` where `user_id` = ? ORDER BY `id` DESC;";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $user_id);
            $stmt->execute();
            $row = $stmt->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return ($row);
    }

    public static function countAllUserPhotos($user_id)
    {
        $result = false;
        try {
            $db = static::getDB();
            $sql = 'SELECT COUNT(*) FROM `photos` WHERE `user_id` = ?';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $user_id);
            $stmt->execute();
            $result = $stmt->fetch()[0];
        } catch (\PDOException $e) {
            $e->getMessage();
        }
        return ($result);
    }

    public static function getPhotoById($photo_id)
    {
        $row = false;
        try {
            $db = static::getDB();
            $sql = 'SELECT * FROM `photos` WHERE `id` = ?';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $photo_id);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo $e->getMessage();
            $e->getMessage();
        }
        return $row;;
    }

    public static function incrementLike($photo_id)
    {
        try {
            $db = static::getDB();
            $sql = '
			UPDATE `photos`
			SET `likes` = `likes` + 1
			WHERE `id` = :photo_id;
			';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':photo_id', $photo_id);
            $stmt->execute();
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    public static function decrementLike($photo_id)
    {
        try {
            $db = static::getDB();
            $sql = '
			UPDATE `photos`
			SET `likes` = `likes` - 1
			WHERE `id` = :photo_id;
			';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':photo_id', $photo_id);
            $stmt->execute();
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    public static function insertPhoto($img_name, $user_id) {
        try {
            $db = static::getDB();
            $sql = '
			INSERT INTO `photos` (
				`name`, `user_id`)
			VALUES (
				:img_name, :user_id);
			';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':img_name', $img_name);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }
}