<?php
    include_once('../includes/util.php');

    require_administrator();
if (empty($_GET['type'])) {
	http_response_code(400);
} else {
  system("rmdir /s /q ..\\files\\".$_GET['type']);
}
?>
