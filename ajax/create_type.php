<?php
  $target = "";
  $users = "";
  if (isset($_POST["type"]))
    $target = $_POST["type"];

  if (isset($_GET["type"]))
    $target = $_GET["type"];

  if (isset($_POST["users"]))
    $users = $_POST["users"];

  if (isset($_GET["users"]))
    $users = $_GET["users"];

  if ($target != "")
    system("mkdir ..\\files\\$target");

  if ($users != "") {
    $userfile = fopen("../files/$target/.users", a);
    foreach(explode(",", $users) as $user) {
      fputs($userfile, "$user\n");
    }
    fclose($userfile);
  }

  echo("Creating $target");
?>
