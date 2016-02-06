<?php
    include_once('../includes/util.php');
    require_authenticated();

	$type = clean_input("/^\.*/", clean_input("/[:\/\\\\\\\\`'\"\*]/", $_POST["type"]));
	if ($type != $_POST["type"]) {
		http_response_code(500);
		die("error");
	}

	$dirname = "E:\\Files\\$type";

	if (!file_exists($dirname) || !is_dir($dirname)) {
		http_response_code(501);
		die("error1");
	}

    $allowed_extensions = array("jpeg", "jpg", "doc", "odt", "pdf", "txt", "html", "png", "js", "bmp", "xls", "xslx");

    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $name = basename(clean_input("/^\.*/", clean_input("/[:\/\\\\\\\\`'\"\*]/", $file['name'])));
        $extension = substr($name, strrpos($name, '.') + 1);
        $tmp = $file['tmp_name'];

        if (in_array($extension, $allowed_extensions) === false) {
            http_response_code(403);
            die("Extension not allowed");
        } else {
            if (!file_exists("$dirname\\$name") && accesschk($_SESSION["username"], $dirname)) {
                move_uploaded_File($tmp, "$dirname\\$name");
            }

            http_response_code(200);
        }

    } else {
        http_response_code(400);
        die("Missing parameters on POST request");
    }

?>
