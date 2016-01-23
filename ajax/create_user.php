<?php
include('../includes/util.php');
if (!isset($_GET['username']) or !isset($_GET['password'])) {
	http_response_code(400);
} else {
  $authenticated = false;
  $pwfile = fopen("../.passwords", "a");
  $user = $_GET['username'];
  $password = $_GET['password'];
  if($pwfile) {
    fputs($pwfile, $user.":".hash_password($password)."\n");
  }
}
