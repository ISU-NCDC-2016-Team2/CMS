<?php include_once("util.php"); ?>

<div class="header clearfix" id="navbar">
<nav>
  <ul class="nav nav-pills pull-right">
  <li role="presentation" class="active"><a href="/">Home</a></li>
  <?php
  if (check_authenticated()) {?>
  <li role="presentation"><a href="/upload.php">Upload New Document</a></li>
  <?php }
  if (check_administrator()) {?>
  <li role="presentation"><a href="/admin.php">Admin</a></li>
  <?php } if (check_authenticated()) { ?>
  <li role="presentation"><a href="/ajax/logout.php">Log Out</a></li>
  <?php } ?>
  </ul>
</nav>
<h3 class="text-muted">CDC Document Management System</h3>
</div>
