/* show.js */
function render_file_list() {
	$("#files-list").html("");

	var req = new XMLHttpRequest();
	if (type == "") {
		req.addEventListener("load", cb_add_types);
		req.open("GET", "/ajax/get_type_list.php");
	} else {
		req.addEventListener("load", cb_add_files);
		req.open("GET", "/ajax/get_file_list.php?type=" + encodeURIComponent(type));
	}
	req.send();
}

function cb_add_types() {
	console.log("Received type list: " + this.responseText);
	var folders = JSON.parse(this.responseText).folders;
	console.log("Folders: " + this.responseText + "\n\n");
	for (var i = 0; i < folders.length; i++) {
		var typename = folders[i];
		if (typename.type != "") {
			$("#files-list").append('<li><a href="' + typename.uri + '">' + typename.type + '</a></li>');
		}
	}
}

function cb_add_files() {
	console.log("Received file list: " + this.responseText);
	var files = JSON.parse(this.responseText).files;
	console.log("Files: " + this.responseText + "\n\n");
	for (var i = 0; i < files.length; i++) {
		var filename = files[i];
		if (filename.filename != "") {
			$("#files-list").append('<li><a href="' + filename.uri + '" target="_blank">' + filename.type + "\\" + filename.filename + '</a></li>');
		}
	}
}

window.onload = render_file_list();
