<?php
include('../includes/util.php');
if (empty($_GET['type'])) {
	http_response_code(400);
} else {
  system("rmdir /s /q ..\\files\\".$_GET['type']);
}
?>
