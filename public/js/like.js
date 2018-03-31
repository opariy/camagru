
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

function addLike(elem) {
    // alert('hey');
    // console.log(elem);
    //
    var xmlhttp = getXmlHttp()
    xmlhttp.open('post', '/like/add-like', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var tmp = document.getElementById('like' + elem.dataset.photoId);
            tmp.innerHTML = xmlhttp.responseText + ' likes';
            console.log(tmp)
        }
    };
    xmlhttp.send("photo_id=" + elem.dataset.photoId);
    // console.log(document.getElementById('tmp'));
    var data = getComputedStyle(elem);
    elem.style.backgroundPositionX = (data.backgroundPositionX === '-50px') ? '-25px' : '-50px';
}