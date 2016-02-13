<?php
    include_once('../includes/util.php');

    require_administrator();

	$rawtype = isset($_GET["type"]) ? $_GET["type"] : $_POST["type"];

	$type = clean_input("/^\.*/", clean_input("/[:\/\\\\\\\\`'\"\*]/", $rawtype));
	if ($type !=  $rawtype) {
	  http_response_code(500);
	  die("error");
	}

    $dirname = "E:\\Files\\$type";
    $deletename = "E:\\Deleted\\$type";

    if (!file_exists($dirname) || !is_dir($dirname) || !accesschk($_SESSION["username"], $dirname)) {
        http_response_code(501);
        die("error1");
    }

    rename($dirname, $deletename);
?>
