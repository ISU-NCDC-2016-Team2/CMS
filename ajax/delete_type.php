<?php
    include_once('../includes/util.php');

    require_administrator();

    $type = clean_input("/^\.*/", clean_input("/[:\/\\\\\\\\`'\"\*]/", isset($_GET["type"]) ? $_GET["type"] : $_POST["type"]));
    if ($type != $_GET["type"]) ? $_GET["type"] : $_POST["type"] || $filename != $_GET["filename"]) {
        http_response_code(500);
        die("error");
    }

    $dirname = "E:\\Files\\$type";
    $deletename = "E:\\Deleted\\$type";

    if (!file_exists($dirname) || !is_dir($dirname)) {
        http_response_code(501);
        die("error1");
    }

    rename($dirname, $deletename);
?>
