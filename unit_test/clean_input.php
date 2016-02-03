<?php
    include_once('../includes/util.php');

    $inputs = array("file\'b", "../testing", "../testing`", "../testing:`", "../\"`", "..\\..\\testing2", "../..//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\.\\\\\\...\\\\\\/error");
    foreach ($inputs as $a) {
        $sanitized = clean_input("/^\.*/", clean_input("/[:\/\\\\\\\\`'\"]/", $a));
        if ($sanitized == $a) {
            die("Cleaninput on $a failed!");
        } else {
            echo("Input: $a; output: $sanitized\n");
        }
    }
?>
