<?php

use \App\Models\PhotoModel;

if(!isset($_SESSION['logged_user']) || empty($_SESSION['logged_user']))
{
    require_once ('nav_bar_not_logged.php');
}
else
{
    require_once ('nav_bar_logged.php');
}
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .stickers {
            background-size: 150px;
            background-repeat: no-repeat;
            background-position: center;
            height: 150px;
            width: 100%;
        }

        .beard_1 {
            background-image: url(/stickers/beard_1.png);
        }

        .bats {
            background-image: url(/stickers/bats.png);
        }

        .winnie {
            background-image:  url(/stickers/winnie.png);
        }

        #div_frame {
            background-repeat: no-repeat;
            background-size: 100% 100%;
            width: 640px;
            height: 400px;
            margin-left: 15px;
            position: absolute;
            top:0;
            left: 0;
        }


        video {
            transform: scaleX(-1);
            z-index: 0;
        }

        #div_frame_result {
            background-repeat: no-repeat;
            background-size: 100% 100%;
            background-position: center;
            width: 640px;
            height: 400px;
            position: absolute;
            z-index: 1;
        }

        body {
            margin-bottom: 30px;
        }

        #canvas {
            transform: scaleX(-1);
            position: absolute;
            z-index: 0;
        }

        .relative_container {
            position: relative;
        }

        .img-table img {
            border-radius: 4px;  /* Rounded border */
            border: 1px solid #ddd;
            padding: 5px;
            object-fit: contain;
            display:block;
            max-width: 70%;
            height:auto;
            margin: 10px 1.5%; /* spacing: 20px vertically, 5% horizontally */
        }

    </style>
</head>
<body>
    <div class="container-fluid" >
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2">
            <div class="row beard_1 stickers" onclick="beard_1()"></div>
            <div class="row bats stickers" onclick="bats()"></div>
            <div class="row winnie stickers" onclick="winnie()"></div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 relative_container">
            <video id="video" autoplay width="640" height="400">VIDEO</video>
            <div id="div_frame" ></div>
            <div >
                    <button id="snap" disabled style="float: left;"  onclick="snapPhoto()">Snap Photo</button>
                    <form style="float: right action="#" method="post">
                        <div class="caption">
                            or <input type="file" disabled accept="image/*" id="file">
                        </div>
                        <input type="hidden" name="photo" value="" id="photo">
                        <input type="hidden" name="frame" value="" id="frame">
                        <button type="submit" name="submit" disabled id="upload" >UPLOAD</button>
                    </form>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5" >
            <canvas id="canvas" width="640" height="400">CANVAS</canvas>
            <div id="div_frame_result"></div>
        </div>
    </div>
</div>
    <div class="row">
        <?php
        $photos = PhotoModel::getAllUserPhotos($_SESSION['logged_user']['user_id']);
        $count = PhotoModel::countAllUserPhotos($_SESSION['logged_user']['user_id']);
        for ($i=0; $i<$count; $i++) { ?>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-2">
                <div class="img-table"><a href = "/../home/<?php echo $photos[$i]['id'] ?>/post"><img src="<?php echo '/downloads/'. $photos[$i]['user_id']. '/'. $photos[$i]['name']; ?>" ></a></div>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    var snap = document.getElementById('div_frame');
    var input_frame = document.getElementById('frame');

    function beard_1() {
        snap.style.backgroundImage = 'url(/stickers/beard_1.png)';
        input_frame.value = 'beard_1';
        document.getElementById('snap').disabled = false;
        document.getElementById('file').disabled = false;

    }

    function bats() {
        snap.style.backgroundImage = 'url(/stickers/bats.png)';
        input_frame.value = 'bats';
        document.getElementById('snap').disabled = false;
        document.getElementById('file').disabled = false;

    }

    function winnie() {
        snap.style.backgroundImage = 'url(/stickers/winnie.png)';
        input_frame.value = 'winnie';
        document.getElementById('snap').disabled = false;
        document.getElementById('file').disabled = false;
    }
</script>
</body>
<?php
require_once ('footer.php');
?>
<script src="/js/camera.js"></script>
<script src="/js/chooseFile.js"></script>
</html>