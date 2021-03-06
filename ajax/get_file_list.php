<?php
    include_once('../includes/util.php');
    require_authenticated();

	$type = clean_input("/^\.*/", clean_input("/[:\/\\\\\\\\`'\"\*]/", $_GET["type"]));
	if ($type != $_GET["type"]) {
		http_response_code(500);
		die("error");
	}

	$dirname = "E:\\Files\\$type";

	if (!file_exists($dirname) || !is_dir($dirname)) {
		http_response_code(501);
		die("error1");
	}

	/*
	{ "files": [
		{
		"type": $dirname,
		"filename": $scandir[n],
		"uri": "/ajax/download.php?type=$dirname&filename=$scandir[n]"            -- with actual uri safe encoding
		}
	]}
	*/

    if (!accesschk($_SESSION["username"], $dirname)) {
		http_response_code(500);
		die("error2");
    }

	$files = scandir($dirname);

    $output = ["files" => []];
	foreach($files as $file) {
		if (substr($file, 0, 1) != ".") {
            if (file_exists("$dirname\\$file") && !is_dir("$dirname\\$file") && accesschk($_SESSION["username"], $dirname)) {
                $obj = ["filename" => $file, "type" => $type, "uri" => "/ajax/download.php?type=" . urlencode($type) . "&filename=" . urlencode($file)];
                $output["files"][] = $obj;
            }
        }
	}

    echo json_encode($output);
?>
