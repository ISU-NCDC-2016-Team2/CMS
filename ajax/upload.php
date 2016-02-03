<?php
    include_once('../includes/util.php');

    require_authenticated();

  $target = "";
  if (isset($_POST["type"])) {
    $target = $_POST["type"];
  }

  $allowed_extensions = array("jpeg", "jpg", "doc", "odt", "pdf", "txt", "html", "png", "js", "bmp", "xls", "xslx");

  if (isset($_FILES['file']) and !empty($target)) {
    $file = $_FILES['file'];
    $name = $file['name'];
    $tmp = $file['tmp_name'];
    $extension = explode('.', $name)[1];

    if (in_array($extension, $allowed_extensions) === false) {
      die("Extension not allowed");
      http_response_code(403);
    } else {
      http_response_code(200);
    }

    move_uploaded_File($tmp, "../files/".$target."/".$name);

  } else {
    http_response_code(400);
    die("Missing parameters on POST request");
  }

?>
