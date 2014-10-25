window.onload = function() {
	if($("error")) {
		var error = $("error").innerHTML;
		if(error != "") {
			alert(error);
		}

	}
	if($('addalbum')) {
		$('addalbum').observe("click", make_album);
	}

	var albums = $$(".renamebutton");
	
	for(var i = 0; i < albums.length; i++) {
		albums[i].observe("click", rename_album);
	}

	albums = $$(".deletebutton");
	
	for(var i = 0; i < albums.length; i++) {
		albums[i].observe("click", delete_album);
	}
	
	if($$('.title')) {
		$$('.title')[0].observe("click", toMenu);
	}

	if($('pic-feedback')) {
		var text = $('pic-feedback').innerHTML;
		if(text != '') {
			if(text == 'directory') {
				alert('Please choose an album');
			} else if (text == 'file') {
				alert('Please choose a valid image under 2 MB');
			} else if (text == 'success') {
				alert('File uploaded!')
			}
		}
	}
}

function make_album() {

	var name = $('albumname').value;
	var place = 'username';

	if(name != '') {
		new Ajax.Request("create-directory.php", {
			method:"post",
			parameters:{"place":place, "name":name},
			onSuccess: ajaxCreateDir
		});
	}
}

function rename_album(event) {

	var name = event.target.value;
	var place = 'username';

	var newname = prompt("Please enter the new album name for " + name, name);

	if(newname != '') {
		new Ajax.Request("rename-directory.php", {
			method:"post",
			parameters:{"place":place, "name":name, "newname":newname},
			onSuccess: ajaxCreateDir
		});
	}
}


function delete_album(event) {

	var name = event.target.value;
	var place = 'username';
	
	if(confirm("Are you sure you want to delete " + name + " and all of its contents?")) {
		new Ajax.Request("delete-directory.php", {
			method:"post",
			parameters:{"place":place, "name":name},
			onSuccess: ajaxCreateDir
		});
	}
}


function ajaxCreateDir(ajax) {
	/*var res = ajax.responseText;
	alert(res);*/
	location.reload();
}

function toMenu () {
	window.location.href = "http://students.washington.edu/kershm/photos"
}