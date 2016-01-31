function delete_type(t) {
    var type = t;

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

