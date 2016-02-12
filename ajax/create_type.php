<?php
  include_once("../includes/util.php");

  require_administrator();

  $type = clean_input("/^\.*/", clean_input("/[:\/\\\\\\\\`'\"\*]/", isset($_GET["type"]) ? $_GET["type"] : $_POST["type"]));
  $users = clean_input("/[^a-zA-Z0-9_,]/", isset($_GET["users"]) ? $_GET["users"] : $_POST["users"]);
  if ($type != $_GET["type"] || $users != $_GET["users"]) ? $_GET["users"] : $_POST["users"]) {
      http_response_code(500);
      die("error");
  }

  $dirname = "E:\\Files\\$type";

  if (file_exists($dirname) || is_dir($dirname)) {
      http_response_code(501);
      die("error1");
  }

  mkdir($dirname);

  foreach(explode(",", $users) as $user) {
      try {
          exec(escapeshellcmd("icacls.exe $dirname /grant team2.isucdc.com\\$user"));
      } catch(Exception $e) {
      }
  }

  echo("Creating $dirname");
?>
