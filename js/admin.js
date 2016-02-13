function delete_type(t) {
    var type = t;
	if (confirm("Are you sure that you want to remove the type " + t + "?")) {
		console.log("Deleting " + type);


		var cb_remove = function() {
			console.log("Removing " + "#type-list-item-" + type);
			window.location.reload();
		}

		var req = new XMLHttpRequest();
		req.addEventListener("load", cb_remove);
		req.open("GET", "/ajax/delete_type.php?type=" + type);
		req.send();	
	}
}

function createNewType() {
    var req = new XMLHttpRequest();
    var cb_refresh = function() {
        window.location.reload();
    }
    var params = "type=" + $("#new-type-name").val() + "&users=" + $("#new-type-users").val();
    req.addEventListener("load", cb_refresh);
    req.open("POST", "/ajax/create_type.php?" + params);
    req.send(params);
}

function render_file_list() {
	var req = new XMLHttpRequest();
	$("#type-list").html("");

	req.addEventListener("load", cb_add_types);
	req.open("GET", "/ajax/get_type_list.php");
	req.send();
}

function cb_add_types() {
	console.log("Received type list: " + this.responseText);
	var folders = JSON.parse(this.responseText).folders;
	console.log("Folders: " + this.responseText + "\n\n");
	for (var i = 0; i < folders.length; i++) {
		var typename = folders[i];
		if (typename.type != "") {
			$("#type-list").append('<li><a href="#" onclick="delete_type(\'' + typename.type + '\')">Delete ' + typename.type + '</a></li>');
		}
	}
}


window.onload = render_file_list();

