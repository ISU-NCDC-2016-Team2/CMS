<?php
	include('../includes/util.php');

	if (!isset($_GET["authtoken"])) {
		echo("ERROR: MISSING PARAMETERS");
		http_response_code(400);
	} else {
		$user = decrypt_authtoken($_GET["authtoken"]);
		$authfile = fopen("../.admins", "r");
		if ($authfile) {
			echo("Authfile opened\r\n");
			echo("Authenticating user $user\r\n");
			$authorized = false;
			while (($line = fgets($authfile)) !== false) {
				$line = trim($line);
				echo("Comparing to $line\r\n");
				if (strcmp($line, $user) == 0) {
					echo("Authorized!");
					$authorized = true;
				}
			}
			if ($authorized) {
				http_response_code(200);
			} else {
				http_response_code(403);
			}
		} else {
			http_response_code(400);
		}
	}
?>
