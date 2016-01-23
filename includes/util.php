<?php

$base = "http://files.teamN.isucdc.com";
if (isset($_GET["authtoken"])) {
        $authtoken = $_GET["authtoken"];
} else {
        $authtoken = "";
}

$key = "bu83bonu85vuixr24xkt95y";
$atbase = "a13e038fe3e8bc386d32412";

function hash_password($password) {
  $atbase = $GLOBALS['atbase'];
  return '$sha256:'.bin2hex($atbase ^ $password).':'.bin2hex($password);
}

function encrypt_authtoken($username) {
        $padded_username = $username;
        $atbase = $GLOBALS['atbase'];
        $key = $GLOBALS['key'];

        for ($i = strlen($padded_username); $i < strlen($key); $i++) {
          $padded_username = $padded_username."0";
        }
        return bin2hex($padded_username ^ $key).bin2hex($atbase ^ $key).$atbase.':'.bin2hex($username);
}

function decrypt_authtoken($authtoken) {
        $atbase = $GLOBALS['atbase'];
        $key = $GLOBALS['key'];

        $unpadded_authtoken = explode(":", bin2hex(hex2bin($authtoken) ^ hex2bin($key)).$atbase);
        return hex2bin(end(explode(':',$authtoken)));
}

function href($url, $p = "") {
        $base = $GLOBALS['base'];
        $authtoken = $GLOBALS['authtoken'];
        if (empty($p)) {
                if (!empty($authtoken)) {
                        echo("href=\"$base$url?authtoken=$authtoken\"");
                } else {
                        echo("href=\"$base$url\"");
                }
        } else {
                if (!empty($authtoken)) {
                        echo("href=\"$base$url?$p&authtoken=$authtoken\"");
                } else {
                        echo("href=\"$base$url?$p\"");
                }
        }
}

?>
