<?php
include('../includes/util.php');
if (!isset($_GET['username']) or !isset($_GET['password'])) {
	http_response_code(400);
} else {
  $authenticated = false;
  $pwfile = fopen("../.passwords", "r");
  $user = $_GET['username'];
  $password = $_GET['password'];
  if($pwfile) {
    while (($line = fgets($pwfile)) !== false) {
      $line = trim($line);
      if (!strcmp($user, explode(":", $line)[0]) and !strcmp($password, hex2bin(end(explode(":", $line)))))
        $authenticated = true;
    }
  }
	if ($authenticated) {
		http_response_code(200);
		echo(encrypt_authtoken($_GET['username']));
	} else {
		http_response_code(403);
	}
}
