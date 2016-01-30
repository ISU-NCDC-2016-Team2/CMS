<?php
    include_once('includes/util.php');

    require_authenticated();
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include_once('includes/util.php'); ?>
    <?php include_once('includes/head.php'); ?>

	<script> var type = <?php
if (isset($_GET["type"])) {
	$type = $_GET["type"];
	echo("\"$type\"");
} else {
	echo("\"\"");
}
?>; </script>
    <script src="js/show.js"></script>
  </head>
  <body>
    <div class="container">
      <?php include_once('includes/nav.php'); ?>

      <div class="row marketing" id="after-nav">
        <h3>Files</h3>
        <ul id="files-list">
      </div>
  </body>
</html>
