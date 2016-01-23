<?php

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=".explode('/',$_GET['path'])[1]);
readfile("../files/".$_GET['path']);

?>
