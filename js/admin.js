function delete_type(t) {
    var type = t;

    console.log("Deleting " + type);


    var cb_remove = function() {
        console.log("Removing " + "#type-list-item-" + type);
        $("#type-list-item-" + type).remove();
    }

    var req = new XMLHttpRequest();
    req.addEventListener("load", cb_remove);
    req.open("GET", base + "/ajax/delete_type.php?type=" + type + "&authtoken=" + authtoken);
    req.send();
}

function delete_user(t) {
    var user = t;

    console.log("Deleting " + user);


    var cb_remove = function() {
        console.log("Removing " + "#user-list-item-" + user);
        $("#user-list-item-" + user).remove();
    }

    var req = new XMLHttpRequest();
    req.addEventListener("load", cb_remove);
    req.open("GET", base + "/ajax/delete_user.php?username=" + user + "&authtoken=" + authtoken);
    req.send();
}

function createNewType() {
    var req = new XMLHttpRequest();
    var cb_refresh = function() {
        window.location.reload();
    }
    var params = "type=" + $("#new-type-name").val() + "&users=" + $("#new-type-users").val();
    req.addEventListener("load", cb_refresh);
    req.open("POST", base + "/ajax/create_type.php?authtoken=" + authtoken + '&' + params);
    req.send(params);
}

function createNewUser() {
    var req = new XMLHttpRequest();
    var cb_refresh = function() {
        window.location.reload();
    }
    var params = "username=" + $("#new-user-name").val() + "&password=" + $("#new-user-password").val();
    req.addEventListener("load", cb_refresh);
    req.open("POST", base + "/ajax/create_user.php?authtoken=" + authtoken + '&' + params);
    req.send(params);
}

function do_onload() {
    var req = new XMLHttpRequest();

    function cb_render() {
        console.log("Got auth result: " + this.status);
        if (this.status == 200) {
            console.log("Authorized!");
            $(".admin-function").show();
        }
    }

    req.addEventListener("load", cb_render);
    req.open("GET", base + "/ajax/check_admin.php?authtoken=" + authtoken);
    req.send();
}

window.onload = do_onload
