var column = true;

function create_render_callback(t) {
	var type = t;
	return function() {
		if (this.status == 200)	 {
			console.log("Adding type: " + type);
			var toAppend = '<button class="btn btn-primary" onClick="do_show(\'' + 
			    type + '\')">' + type + "</button></br>";
			if (column) {
			    $("#left-list").append(toAppend);
			} else {
			    $("#right-list").append(toAppend);
			}
			column = !column;
		}
	}
}

function populate_types() {
    types = JSON.parse(this.responseText).types;

    for(index = 0; index < types.length; index++) {
        if(types[index] == "")
            continue;

        var req = new XMLHttpRequest();
        req.addEventListener("load", create_render_callback(types[index]));
        req.open("GET", base + "/ajax/check_auth.php?type=" + types[index]  + "&authtoken=" + authtoken);
        req.send()
    }
}

function do_show(type) {
    window.location.replace(base + "/show.php?type=" + type + "&authtoken=" + authtoken);
}

function do_onload() {
    if (authtoken == "") {
        $("#navbar").hide();
    } else {
        $("#login").hide();
        var req = new XMLHttpRequest();
        req.addEventListener("load", populate_types);
        req.open("GET", base + "/ajax/get_type_list.php");
        req.send();
    }
}

function doLogin() {
    params = "username=" + $("#username").val() + "&password=" + $("#password").val();

    var req = new XMLHttpRequest();

    function cb_login() {
        if (this.status == 200) {
            window.location.replace(base + "?authtoken=" + this.responseText);
        } else {
            $("#login-inner").prepend('<div class="alert alert-danger">Invalid username or password</div>');
        }
    }

    req.addEventListener("load", cb_login);
    req.open("GET", base + "/ajax/login.php?" + params);
    req.send();
}

window.onload = do_onload;
