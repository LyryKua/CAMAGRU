/**
 * Created by khrechen on 9/30/17.
 */
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
	xmlhttp.open('post', '/like/set-like', true);
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById('like' + elem.dataset.photoId).innerHTML = xmlhttp.responseText + ' likes';
		}
	};
	xmlhttp.send("photo_id=" + elem.dataset.photoId);
	// console.log(elem.style.backgroundPositionX);
	var data = getComputedStyle(elem);
	elem.style.backgroundPositionX = (data.backgroundPositionX === '-50px') ? '-25px' : '-50px';
	// console.log(data.backgroundPositionX === '-50px');
}