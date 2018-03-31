<?php
namespace App\Models;

//use \Core\Model;

class UserModel extends \Core\Model
{
    public static function addUser($user_name, $email, $password)
    {
        try {
            $db = static::getDB();

            $sql = 'INSERT INTO `users`(`user_name`, `email`, `password`) VALUES (:user_name, :email, :password);';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':user_name', $user_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
        } catch (\PDOException $e) {
            echo $e->getMessage();
            $e->getMessage();
        }
    }

    public static function getUserByName($user_name)
    {
        try {
            $db = static::getDB();
            $sql = 'SELECT * FROM `users` WHERE `user_name` = ?';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $user_name);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo $e->getMessage();
            $e->getMessage();
        }
        return $row;
    }

    public static function getUserById($id)
    {
        try {
            $db = static::getDB();
            $sql = 'SELECT * FROM `users` WHERE `user_id` = ?';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo $e->getMessage();
            $e->getMessage();
        }
        return $row;
    }

    public static function updateNameEmail($user_name, $new_user_name, $new_email)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE users SET user_name = :new_user_name, email = :new_email WHERE user_name = :user_name";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':user_name', $user_name);
            $stmt->bindParam(':new_user_name', $new_user_name);
            $stmt->bindParam(':new_email', $new_email);
            if ($stmt->execute()) {
                return true;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            $e->getMessage();
        }
        return false;
    }

    public static function updatePassword($user_name, $password)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE users SET password = :password WHERE user_name = :user_name";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':user_name', $user_name);
            $stmt->bindParam(':password', $password);
            if ($stmt->execute()) {
                return true;
            }

        } catch (\PDOException $e) {
            echo $e->getMessage();
            $e->getMessage();
        }
        return false;
    }

    public static function getUserByEmail($email)
    {
        try {
            $db = static::getDB();
            $sql = 'SELECT * FROM `users` WHERE `email` = ?';
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $email);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {
            echo $e->getMessage();
            $e->getMessage();
        }
        return $row;
    }

    public static function updateHash($email, $hash)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE users SET hash = :hash WHERE email = :email";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':hash', $hash);
            if ($stmt->execute()) {
                return true;
            }

        } catch (\PDOException $e) {
            echo $e->getMessage();
            $e->getMessage();
        }
        return false;
    }


    public static function Activate($email)
    {
        try {
            $db = static::getDB();
            $sql = "UPDATE users SET activated = 1 WHERE email = :email";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':email', $email);
            if ($stmt->execute()) {
                return true;
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            $e->getMessage();
        }
        return false;
    }

}