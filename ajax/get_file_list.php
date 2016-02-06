<?php
    include_once('../includes/util.php');
    require_authenticated();

	$type = clean_input("/^\.*/", clean_input("/[:\/\\\\\\\\`'\"]/", $_GET["type"]));
	if ($type != $_GET["type"]) {
		http_response_code(500);
		die("error");
	}

	$dir_name = "E:\\Files\\$type";

	if (!file_exists($dirname) || !is_dir($dirname)) {
		http_response_code(501);
		die("error1");
	}

	// TODO -- ACTUAL JSON ANYONE!?
	// TODO -- Verify user can read directory
	/*
	{ "files": [
		{
		"type": $dirname,
		"filename": $scandir[n],
		"uri": "/ajax/download.php?type=$dirname&filename=$scandir[n]"            -- with actual uri safe encoding
		}
	]}
	*/
	$files = scandir($dirname);
	echo "{ \"files\" : [";
	foreach($files as $file) {
		if($file == "." or $file == ".." or $file == ".users")
			continue;
		echo("\"$file\",");
	}
	echo "\"\"]}";
?>
