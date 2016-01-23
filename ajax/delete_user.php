<?php
include('../includes/util.php');
if (!isset($_GET['username'])) {
	http_response_code(400);
} else {
  $authenticated = false;
  $pwfile = fopen("../.passwords", "r");
  $user = $_GET['username'];
  $newpwdata = "";
  if($pwfile) {
    while (($line = fgets($pwfile)) !== false) {
      if (strcmp($user, explode(":", $line)[0]))
        $newpwdata = $newpwdata.$line;
    }

    fclose($pwfile);
    file_put_contents("../.passwords", $newpwdata);
  }
}
