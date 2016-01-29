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
    types = JSON.parse(this.responseText).types;

    for(index = 0; index < types.length; index++) {
        if(types[index] == "")
            continue;

	var req = new XMLHttpRequest();
	req.addEventListener("load", closure(types[index]));
	req.open("GET", base + "/ajax/check_auth.php?type=" + types[index]  + "&authtoken=" + authtoken);
	req.send()
    }
}

function uploadComplete() {
    console.log("Upload Complete");
    if (this.status == 200)
        $("#after-nav").append('<div class="alert alert-success" role="alert">Uploaded!</div>');
    else
        $("#after-nav").append('<div class="alert alert-danger" role="alert">Oops! Something broke: ' + 
                this.responseText + '</div>');

}

function doUpload() {
    $("#select-button").prop('disabled', true);;
    $("#type-chooser").prop('disabled', true);;
    $("#upload-button").prop('disabled', true);;
    var req = new XMLHttpRequest();
    req.addEventListener("load", uploadComplete);
    req.open("POST", base + "/ajax/upload.php?authtoken=" + authtoken);
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
    req.open("GET", base + "/ajax/get_type_list.php?authtoken=" + authtoken);
    req.send();
}

function do_onload() {
    $("#file-chooser").change(loadTypes);
}

window.onload = do_onload;
