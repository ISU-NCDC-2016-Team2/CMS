<?php
  include_once("../includes/util.php");

  require_administrator();

  $rawtype = isset($_GET["type"]) ? $_GET["type"] : $_POST["type"];
  $rawusers = isset($_GET["users"]) ? $_GET["users"] : $_POST["users"];
  
  $type = clean_input("/^\.*/", clean_input("/[:\/\\\\\\\\`'\"\*]/", $rawtype));
  $users = clean_input("/[^a-zA-Z0-9_,]/", $rawusers);
  if ($type !=  $rawtype || $users != $rawusers) {
      http_response_code(500);
      die("error");
  }

  $dirname = "E:\\Files\\$type";

  if (file_exists($dirname) || is_dir($dirname)) {
      http_response_code(501);
      die("error1");
  }

  mkdir($dirname);
  
  if (!file_exists($dirname) || !is_dir($dirname)) {
      http_response_code(501);
      die("error2");
  }

  foreach(explode(",", $users) as $user) {
      try {
		  error_log("icacls.exe $dirname /grant team2.isucdc.com\\$user:F");
          exec("icacls.exe $dirname /grant team2.isucdc.com\\$user:F", $a, $b);
		  error_log(implode('//', $a) . " $b");
      } catch(Exception $e) {
      }
  }

  echo("Creating $dirname");
?>
