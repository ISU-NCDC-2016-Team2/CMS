<?php
	require_once("../includes/util.php");
	
	$users = ["Administrator", "pam", "cyril"];
	foreach ($users as $user) {
		echo "====$user====\n";
		$folders = scandir("E:\\Files\\");
		foreach ($folders as $folder) {
			if (accesschk($user, "E:\\Files\\$folder")) {
				echo "$folder :: true\n";
			} else {
				echo "$folder :: false\n";
			}
		}
	}
?>