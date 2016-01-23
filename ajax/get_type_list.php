<?php
	$files = scandir("../files");
	echo "{ \"types\" : [";
	foreach($files as $file) {
		if($file == "." or $file == ".." or $file == ".users")
			continue;

		echo("\"$file\",");
	}
	echo "\"\"]}";
?>
