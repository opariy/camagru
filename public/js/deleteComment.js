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


    if (confirm('Are you sure you want to delete this photo?')) {

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
}


function deleteComment(elem) {
    console.log(elem);
    var xmlhttp = getXmlHttp()
    xmlhttp.open('post', '/camera/delete-comment', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('comment' + elem.dataset.deleteCommentId).innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.send("comment_id=" + elem.dataset.deleteCommentId);
    console.log(document.getElementById(elem.id).className);
    document.getElementById(elem.id).classList.remove("delete_comment");
    document.getElementById(elem.id).classList.add("comment_deleted");
    elem.style.color = "red";
    elem.style.fontStyle = "italic";
}

