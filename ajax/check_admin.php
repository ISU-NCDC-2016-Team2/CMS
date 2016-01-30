<?php
	include_once('../includes/util.php');

    if (!check_administrator()) {
        http_response_code(403);
    } else {
        http_response_code(200);
    }
?>
