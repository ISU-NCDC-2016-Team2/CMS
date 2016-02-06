<?php
    include_once('../includes/util.php');

    require_authenticated();

	$files = scandir("E:\\Files\\$type");
	echo "{ \"types\" : [";
	foreach($files as $file) {
		if($file == "." or $file == ".." or $file == ".users")
			continue;

		echo("\"$file\",");
	}
	echo "\"\"]}";
?>
