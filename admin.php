<?php
# CSRF Protection
#
?>

<html>
	<head>
		<?php include('includes/util.php'); ?>
		<?php include('includes/head.php'); ?>

		<script src="js/admin.js"></script>
	</head>
	<body>
		<div class="container">
			<?php include('includes/nav.php'); ?>

			<div class="row marketing">
				<h3>Document Types</h3>
				<button type="button" class="btn btn-primary admin-function" onclick="$('#add-type-form').show()"
						style="display: none;">
					Add New Document Type
				</button>
				<div id="add-type-form" style="display: none;">
					<label>New Type</label><input type="text" id="new-type-name"> <br/>
					<label>Users (Comma-separated)</label><input type="text" id="new-type-users">
					<button type="button" class="btn btn-primary" onclick="createNewType()">Create</button>
				</div>
				<ul>
<?php
$types = scandir("files");
foreach($types as $type) {
	if($type == "." or $type == "..")
		continue;

	echo("<li id=\"type-list-item-$type\">");
	echo("<button type=\"button\" class=\"glyphicon glyphicon-remove admin-function\" ");
	echo("onclick=\"delete_type('$type')\" style=\"display: none;\"></button>");
	echo($type);
	echo("</li>\n");
}
?>
				</ul>
				<h3>Users</h3>
				<button type="button" class="btn btn-primary admin-function" onclick="$('#add-user-form').show()"
						style="display: none;">
					Add New User
				</button>
				<div id="add-user-form" style="display: none;">
					<label>Name</label><input type="text" id="new-user-name"> <br/>
					<label>Password</label><input type="text" id="new-user-password">
					<button type="button" class="btn btn-primary" onclick="createNewUser()">Create</button>
        </div>
<?php
$pwfile = fopen(".passwords", "r");
if($pwfile) {
  while (($line = fgets($pwfile)) !== false) {
    $user = explode(":", $line)[0];
    echo("<li id=\"user-list-item-$user\">");
    echo("<button class=\"glyphicon glyphicon-remove admin-function\" ");
    echo("onclick=\"delete_user('$user')\" style=\"display: none;\"></button>");
    echo($user);
    echo("</li>\n");
  }
}
?>
</html>
