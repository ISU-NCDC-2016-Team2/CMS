<?php
# CSRF Protection
#
?>

<html>
  <head>
    <?php include('includes/util.php'); ?>
    <?php include('includes/head.php'); ?>

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
      <?php include('includes/nav.php'); ?>

      <div class="row marketing" id="after-nav">
        <h3>Files</h3>
        <ul id="files-list">
      </div>
  </body>
</html>
