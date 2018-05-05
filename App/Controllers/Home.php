<?php
namespace App\Controllers;

use App\Models\PhotoModel;
use App\Models\UserModel;
use \Core\View;

class Home extends \Core\Controller {

    public function indexAction() {

        $args['message'] = "";

        $allPhotos = PhotoModel::countAllPhotos();
        $max_page = ceil($allPhotos / 9);
        if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $max_page) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $offset = ($page - 1) * 9;
        $photos = PhotoModel::get9Photos($offset);
        $picture = array();
        foreach ($photos as $photo) {
            $photo_path = "/downloads/". $photo['user_id']. "/". $photo['name'];
            $author_user_name = UserModel::getUserById($photo['user_id'])['user_name'];
            $picture[] = ['likes' => $photo['likes'], 'path' => $photo_path, 'user_id' => $photo['user_id'], 'photo_id'=> $photo['id'], 'author_user_name' => $author_user_name];
        }
        $args['pages'] = array($page - 2, $page - 1, $page, $page + 1, $page + 2);
        $args['max_page'] = $max_page;
        $args['picture'] = $picture;

        if (isset($_SESSION['s_email'])) {
            unset ($_SESSION['s_email']);
        }
        if (isset($_SESSION['re_email'])) {
            unset ($_SESSION['re_email']);
        }
        if (isset($_SESSION['try_log_u_name'])) {
            unset ($_SESSION['try_log_u_name']);
        }
        View::render('home.php', $args);
    }


    public function postAction () {

        $photo_id = $this->route_params['id'];
        $photo = PhotoModel::getPhotoById($photo_id);
        if (!$photo) {
            header("Location: /");
        }
        else {
            $photo_path = "/downloads/". $photo['user_id']. "/". $photo['name'];
            $author_user_name = UserModel::getUserById($photo['user_id'])['user_name'];
            $picture[] = ['likes' => $photo['likes'], 'path' => $photo_path, 'user_id' => $photo['user_id'], 'photo_id'=> $photo['id'], 'author_user_name' => $author_user_name];
            $args['picture'] = $picture;
            View::render('post.php', $args);
        }
    }

    protected function before () {

    }

    protected function after () {
    }
}