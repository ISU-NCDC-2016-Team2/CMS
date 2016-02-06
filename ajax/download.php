<?php
    include_once('../includes/util.php');
    require_authenticated();

    $type = clean_input("/^\.*/", clean_input("/[:\/\\\\\\\\`'\"\*]/", $_GET["type"]));
	$filename = clean_input("/^\.*/", clean_input("/[:\/\\\\\\\\`'\"\*]/", $_GET["filename"]));
	if ($type != $_GET["type"] || $filename != $_GET["filename"]) {
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
		if (substr($file, 0, 1) != "." && $file == $filename) {
            if (file_exists("$dirname\\$filename") && !is_dir("$dirname\\$filename") && accesschk($_SESSION["username"], $dirname)) {
                header("Content-Type: application/octet-stream");
                header("Content-Disposition: attachment; filename=$filename");
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize("$dirname\\$filename"));
                readfile("$dirname\\$filename");
            }
        }
	}
?>
