var myRequest = new XMLHttpRequest();

//1st part: visibility of elements
function Add(){
	document.getElementById('addForm').style.visibility = 'visible';
}

function EditBook(){
	document.getElementById('editButtons').style.visibility = 'visible';
	document.getElementById('RemoveForm').style.visibility = 'hidden';
}

function Remove(){
	document.getElementById('RemoveForm').style.visibility = 'visible';
}

function EditList(){
	document.getElementById('updateListForm').style.visibility = 'visible';
}

//2nd part: work		
function okAddNew(){
	var url = "action.php";
	var phone = document.getElementById('phone').value;
	var name = document.getElementById('name').value;
	var params = "ph=" + phone + "&nm=" + name;
	var http = new XMLHttpRequest();
	http.open("GET", url+"?"+params, true);
	http.onreadystatechange = function(){
		if(http.readyState == 4 && http.status == 200) {
			alert(http.responseText);
			if (http.responseText == "We have it already"){
				document.getElementById('weHave').style.visibility = 'visible';
			}
		}
	}
	http.send(null);
}
		
function RemoveRecord(){
	var url = "action.php";
	var phone = document.getElementById('RemovePhone').value;
	var params = "Rph=" + phone;
	var http = new XMLHttpRequest();
	http.open("GET", url+"?"+params, true);
	http.onreadystatechange = function(){
		if(http.readyState == 4 && http.status == 200) {
			alert("2" + http.responseText);
		}
	}
	http.send(null);
}

function StopAdd(){
	window.location.reload()
}

function EditRecord(){
	var url = "action.php";
	var phone = document.getElementById('phone').value;
	var name = document.getElementById('name').value;
	var params = "Eph=" + phone + "&Enm=" + name;
	var http = new XMLHttpRequest();
	http.open("GET", url+"?"+params, true);
	http.onreadystatechange = function(){
		if(http.readyState == 4 && http.status == 200) {
					alert(http.responseText);
		}
	}
	http.send(null);
}
		
function UpdateByList(){
	var url = "action.php";
	var upFile="test.txt";
	var params = "Upf=" +upFile;
	var http = new XMLHttpRequest();
	http.open("GET", url+"?"+params, true);
	http.onreadystatechange = function(){
		if(http.readyState == 4 && http.status == 200) {
			alert("3" + http.responseText);
		}
	}
	http.send(null);
}

function getFileUrl(url){
	var linkUrl = document.createElement("a");
	linkUrl.download = url.substring((url.lastIndexOf("/") + 1), url.length);
	linkUrl.href = url;
	document.body.appendChild(linkUrl);
	linkUrl.click();
	document.body.removeChild(linkUrl);
	delete linkUrl;
};