<?php
    include('../includes/util.php');

    if (!check_authenticated()) {
        http_response_code(403);
    } else {
        http_response_code(200);
    }
?>  
