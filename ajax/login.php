<?php
#include('../includes/util.php');
if (!isset($_POST['username']) or !isset($_POST['password']) or $_POST['username'] == '' or $_POST['password'] == '') {
    http_response_code(400);
} else {
    $user = $_POST['username'];
    $password = $_POST['password'];

    $ldap = ldap_connect("dc.team2.isucdc.com");
    
    if ($bind = ldap_bind($ldap, $user, $password)) {
        http_response_code(200);
        echo(encrypt_authtoken($_GET['username']));
    } else {
        http_response_code(403);
    }
}
