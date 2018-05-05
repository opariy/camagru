
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
    var xmlhttp = getXmlHttp()

    xmlhttp.open('post', '/like/add-like', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('like' + elem.dataset.photoId).innerHTML = xmlhttp.responseText + ' likes';
        }
    };

    console.log(elem);

    xmlhttp.send("photo_id=" + elem.dataset.photoId);
    var data = getComputedStyle(elem);
    // console.log(data);
    elem.style.backgroundPositionY = (data.backgroundPositionY === '-201px') ? '-76px' : '-201px';
}
