/* show.js */

function render_file_list() {
	var req = new XMLHttpRequest();
	
	function cb_add_files() {
		console.log("Received file list: " + this.responseText);
		files = JSON.parse(this.responseText).files;
        console.log("Files: " + files);
		for (index = 0; index < files.length; index++) {
            filename = files[index];
            if (filename != "") {
			$("#files-list").append('<li><button type="button" class="btn-primary" onclick="download_file(\'' + filename + '\')">Download</button>' + filename + '</li>');
            }
		}
	}
	req.addEventListener("load", cb_add_files);
	req.open("GET", "/ajax/get_file_list.php?type=" + type);
	req.send();
}

function download_file(filename) {
	$("#after-nav").prepend('<div class="alert alert-success" role="alert">Downloading</div>');
	$("#after-nav").append('<iframe style="display:none" width="1" height="1" frameborder="0" src="' + "/ajax/download.php?path=" + type + "/" + filename + '"></iframe>');
}

window.onload = render_file_list();
