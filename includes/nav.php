<?php

# CSRF Protection
#

?>

<div class="header clearfix" id="navbar">
<nav>
  <ul class="nav nav-pills pull-right">
  <li role="presentation" class="active"><a <?php href("/");?>>Home</a></li>
  <li role="presentation"><a <?php href("/upload.php"); ?>>Upload New Document</a></li>
  <li role="presentation"><a <?php href("/admin.php"); ?>>Admin</a></li>
  <li role="presentation"><a href="<?php echo($base); ?>">Log Out</a></li>
  </ul>
</nav>
<h3 class="text-muted">CDC Document Management System</h3>
</div>
