<?php

namespace App\Controllers;

use \App\Models\LikesModel;


class Like extends \Core\Controller
{
    public function addLikeAction () {
//        LikesModel::addLike($_POST['photo_id']);
        // отримуэмо кылькысть лайкыв для окремого фото
        $likes = 42;
        echo $likes;

    }
}