<?php
namespace App\Controllers;

use App\Models\CommentsModel;
use App\Models\PhotoModel;
use \Core\View;

class Home extends \Core\Controller {

    public function indexAction() {

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
            $photo_path = "/downloads/". $photo['user_id']. "/  ". $photo['name']. ".jpg";
            $picture[] = ['likes' => $photo['likes'], 'path' => $photo_path, 'user_id' => $photo['user_id'], 'photo_id'=> $photo['id']];
        }
        $args['pages'] = array($page - 2, $page - 1, $page + 0, $page + 1, $page + 2);
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
//        View::render('nav_bar_not_logged.php');
//        View::render('home.php');
        View::render('home.php', $args);
    }


    public function postAction () {
        $photo_id = $this->route_params['id'];
        $photo = PhotoModel::getPhotoById($photo_id);
        $photo_path = "/downloads/". $photo['user_id'] . "/  ". $photo['name'] . ".jpg";
        $picture[] = ['likes' => $photo['likes'], 'path' => $photo_path, 'user_id' => $photo['user_id'], 'photo_id'=> $photo['id']];
//        echo 'hey';
        $args['picture'] = $picture;
        View::render('post.php', $args);

    }

    protected function before () {

//        View::render('Home/index.php', ['name' => 'Sasha', 'colours' => ['red', 'green', 'blue']]);
//        echo "=before= ";
    }

    protected function after () {
//        echo " =after= ";
    }
}