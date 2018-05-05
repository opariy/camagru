// 'use strict';

function getXmlHttp() {
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }

    return xmlhttp;
}


function deleteImage(photoId) {

    var xmlhttp = getXmlHttp()
    xmlhttp.open('post', '/camera/delete-photo', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // document.getElementById('like' + photoId.dataset.deletePhotoId).innerHTML = xmlhttp.responseText;
        }
    };

    xmlhttp.send("photo_id=" + photoId.dataset.deletePhotoId);
    window.location.href = window.location.pathname + window.location.search + window.location.hash;
}
