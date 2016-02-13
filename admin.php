<?php
    include_once('includes/util.php');

    require_administrator();
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once('includes/head.php'); ?>
		<script src="js/admin.js"></script>
	</head>
	<body>
		<div class="container">
			<?php include_once('includes/nav.php'); ?>

			<div class="row marketing">
				<h3>Document Types</h3>
				<button type="button" class="btn btn-primary admin-function" onclick="$('#add-type-form').show()">
					Add New Document Type
				</button>
				<div id="add-type-form" style="display: none;">
					<label>New Type</label><input type="text" id="new-type-name"> <br/>
					<label>Users (Comma-separated)</label><input type="text" id="new-type-users">
					<button type="button" class="btn btn-primary" onclick="createNewType()">Create</button>
				</div>
				<hr>
				<h2>Remove types</h2>
				<p>Click on any of the following types to remove them.</p>
				<ul id="type-list">
				</ul>
</html>
