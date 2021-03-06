function closure(t) {
	var type = t;
	return function() {
		if (this.status == 200)	 {
			console.log("Adding type: " + type);
            $("#dropdown-items").append("<li><a href=\"#\" onclick=\"setCategory('" +
                    type + "')\">" + type + "</a></li>");
		}
	}
}

function populate_types() {
	console.log("Received type list: " + this.responseText);
    var types = JSON.parse(this.responseText).folders;
	
    for (var i = 0; i < types.length; i++) {
		var typename = types[i];
		if (typename.type != "") {
			$("#dropdown-items").append("<li><a href=\"#\" onclick=\"setCategory('" + typename.type + "')\">" + typename.type + "</a></li>");
		}
    }
}

function uploadComplete() {
    console.log("Upload Complete");
    if (this.status == 200) {
        $("#after-nav").append('<div class="alert alert-success" role="alert">Uploaded!</div>');
    } else {
        $("#after-nav").append('<div class="alert alert-danger" role="alert">Oops! Something broke: ' +
                this.responseText + '</div>');
    }

}

function doUpload() {
    $("#select-button").prop('disabled', true);
    $("#type-chooser").prop('disabled', true);
    $("#upload-button").prop('disabled', true);
    var req = new XMLHttpRequest();
    req.addEventListener("load", uploadComplete);
    req.open("POST", "/ajax/upload.php");
    req.send(new FormData($("#form-upload")[0]));
    console.log("Uploading");
    $("#after-nav").append('<div class="alert alert-info" role="alert">Uploading...</div>');
}

function setCategory(cat) {
    $("#category-chooser").val(cat);
    $("#upload-button").show();
}

function selectFile() {
    $("#file-chooser").trigger("click");
}

function loadTypes() {
    $("#type-chooser").show();

    var req = new XMLHttpRequest();
    req.addEventListener("load", populate_types);
    req.open("GET", "/ajax/get_type_list.php");
    req.send();
}

function do_onload() {
    $("#file-chooser").change(loadTypes);
}

window.onload = do_onload;
