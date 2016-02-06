<?php
    include_once('../includes/util.php');
    require_authenticated();

	$dirname = "E:\\Files\\";

	if (!file_exists($dirname) || !is_dir($dirname)) {
		http_response_code(501);
		die("error1");
	}

	/*
	{"folders": [
		{
		"type": $dirname,
		"uri": "/show.php?type=$dirname" -- with actual uri safe encoding
		}
	]}
	*/

    if (!accesschk($_SESSION["username"], $dirname)) {
		http_response_code(500);
		die("error2");
    }

	$folders = scandir($dirname);

    $output = ["folders" => []];
	foreach($folders as $folder) {
		if (substr($folder, 0, 1) != ".") {
            if (file_exists("$dirname\\$folder") && is_dir("$dirname\\$folder") && accesschk($_SESSION["username"], $folder)) {
                $obj = ["type" => $dirname, "uri" => "/show.php?type=" . urlencode($dirname)];
                $output["folders"][] = $obj;
            }
        }
	}

    echo json_encode($output);
?>
