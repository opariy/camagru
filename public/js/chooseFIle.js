

'use strict';

function previewImage() {
    var file = document.getElementById('file').files[0];
    var camera = document.getElementById('camera');

    var canvas = document.getElementById('canvas');
    var button = document.getElementById('upload');
    var context = canvas.getContext('2d');




    var reader = new FileReader();
    reader.onload = function (event) {
        var url = event.target.result;
        var image = new Image();
        image.onload = function () {
            context.drawImage(image, 0, 0, 640, 480);
            image.value = canvas.toDataURL('image/png');

            var input_photo = document.getElementById('photo');
            input_photo.value = canvas.toDataURL('image/png');

            button.disabled = false;
            button.style.color = '#e0f2ed';
            button.style.backgroundColor = '#82b4b1';
            button.style.cursor = 'pointer';
            var frame = document.getElementById('frame');
            var frame_to_apply = document.getElementById('div_frame_result');
            switch (frame.value) {
                case 'winnie':
                    frame_to_apply.style.backgroundImage = 'url(/stickers/winnie.png)';
                    break;
                case 'beard_1':
                    frame_to_apply.style.backgroundImage = 'url(/stickers/beard_1.png)';
                    break;
                case 'bats':
                    frame_to_apply.style.backgroundImage = 'url(/stickers/bats.png)';
                    break;
            }

        }
        image.src = url;
    }
    reader.readAsDataURL(file);
}

document.getElementById('file').addEventListener('change', previewImage, false);