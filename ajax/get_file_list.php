<?php
	$type = $_GET["type"];
	$files = scandir("../files/$type");
	echo "{ \"files\" : [";
	foreach($files as $file) {
		if($file == "." or $file == ".." or $file == ".users")
			continue;

		echo("\"$file\",");
	}
	echo "\"\"]}";
?>
