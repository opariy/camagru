'use strict';

var constraints = {
    video: {
        width: { ideal: 640 },
        height: { ideal: 400 },
        aspectRatio: { ideal: 1.7777777778 }
    }
};



var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var video = document.getElementById('video');
var input_photo = document.getElementById('photo');
var frame = document.getElementById('frame');
var button = document.getElementById('upload');


var frame_to_apply = document.getElementById('div_frame_result');
function handleSuccess(stream) {
    window.stream = stream; // stream available to console


    video.src = window.URL.createObjectURL(stream);

}
function handleError(error) {
    console.log('navigator.getUserMedia error: ', error);

}



navigator.mediaDevices.getUserMedia(constraints).then(handleSuccess).catch(handleError);
function snapPhoto() {
    button.disabled = false;
    button.style.color = '#e0f2ed';
    button.style.backgroundColor = '#82b4b1';
    button.style.cursor = 'pointer';

    context.drawImage(video, 0, 0);
    var data = canvas.toDataURL('image/png');
    input_photo.value = data;


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

