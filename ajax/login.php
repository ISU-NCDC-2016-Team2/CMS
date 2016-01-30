<?php
    session_start();

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        http_response_code(200);
    }

    if (!isset($_POST['username']) or !isset($_POST['password']) or $_POST['username'] == '' or $_POST['password'] == '') {
        http_response_code(400);
    } else {
        $user = $_POST['username'];
        $password = $_POST['password'];

        $ldap = ldap_connect("10.3.0.2");

        if ($bind = ldap_bind($ldap, $user, $password)) {
            $_SESSION['username'] = $user;
            $_SESSION['auth_id'] = hash("sha256", openssl_random_pseudo_bytes(200));
            $_SESSION['start_time'] = time();
            $_SESSION['last_request'] = time();
            $_SESSION['logged_in'] = true;
            $_SESSION['admin'] = false; // TODO
            $_SESSION['file_access'] = [];
            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['remote_ip'] = $_SERVER['REMOTE_ADDR'];

            session_regenerate_id(true);

            http_response_code(200);
        } else {
            $_SESSION['logged_in'] = false;
            http_response_code(403);
        }
    }

    
?>
