/**
 * Created by khrechen on 10/4/17.
 */

'use strict';

function del(photoId) {
	var xmlhttp = getXmlHttp()
	xmlhttp.open('post', '/user/delete-post', true);
	xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
	xmlhttp.onreadystatechange = function () {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			// document.getElementById('like' + photoId).innerHTML = xmlhttp.responseText + ' likes';
			console.log('test');
		}
	};
	xmlhttp.send("photo_id=" + photoId);
	document.getElementById('main_section').removeChild(
		document.getElementById('article' + photoId)
	);
}