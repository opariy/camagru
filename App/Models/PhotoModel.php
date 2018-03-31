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
//            echo $offset;
            $sql = "SELECT * FROM `photos` ORDER BY `id` DESC LIMIT 9 OFFSET $offset;";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $row = $stmt->fetchAll();
        } catch (\PDOException $e) {
            $e->getMessage();
        }
        return ($row);
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
}