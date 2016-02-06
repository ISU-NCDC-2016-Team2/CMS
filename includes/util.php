<?php

$base = "http://files.team2.isucdc.com";

function clean_input($regex, $input) {
    $lstring = preg_replace($regex, '', str_replace(chr(0), '', $input));
    $string = strip_tags($lstring);
    while ($string != $lstring) {
        $lstring = $string;
        $string = stripslashes(strip_tags($lstring));
    }

    return stripslashes($string);
}

function destroy_session() {
    if (session_id() == "") {
        session_start();
    }

    if ( isset( $_COOKIE[session_name()] ) ) {
        setcookie( session_name(), "", time()-3600, "/" );
    }

    $_SESSION = array();

    session_destroy();
}

function verify_session() {
    if (session_id() == "") {
        session_start();
    }

    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        if ($_SERVER['HTTP_USER_AGENT'] != $_SESSION['user_agent'] || $_SERVER['REMOTE_ADDR'] != $_SESSION['remote_ip']) {
            destroy_session();
            die("Bad session.");
        }

        if ($_SESSION['last_request'] < time() - 300 || $_SESSION['start_time'] < time() - 1800) {
            destroy_session();
            die("Old session.");
        }

        $_SESSION['last_request'] = time();

        session_regenerate_id(true);
    }
}

function check_authenticated() {
    verify_session();

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
        return false;
    }

    return true;
}

function require_authenticated() {
    verify_session();

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
        die("Not logged in.");
    }
}

function check_administrator() {
    verify_session();

    if (!isset($_SESSION['admin']) || $_SESSION['admin'] == false) {
        return false;
    }

    return true;
}

function require_administrator() {
    require_authenticated();

    if (!isset($_SESSION['admin']) || $_SESSION['admin'] == false) {
        die("Not administrator.");
    }
}

function accesschk($user, $folder) {
	// Author Joel May
	$cmd = "accesschk -w -q -d " . escapeshellarg("TEAM2\\$user") . " " . escapeshellarg($folder);
	$out = exec($cmd);
	if ($out == "RW " . $folder) {
		return true;
	} else {
		return false;
	}
}


/**
 * This function searchs in LDAP tree entry specified by samaccountname and
 * returns its DN or epmty string on failure.
 *
 * @param resource $ad
 *          An LDAP link identifier, returned by ldap_connect().
 * @param string $samaccountname
 *          The sAMAccountName, logon name.
 * @param string $basedn
 *          The base DN for the directory.
 * @return string
 */
function getDN($ad, $samaccountname, $basedn)
{
  $result = ldap_search($ad, $basedn, "(samaccountname={$samaccountname})", array(
    'dn'
  ));
  if (! $result)
  {
    return '';
  }

  $entries = ldap_get_entries($ad, $result);
  if ($entries['count'] > 0)
  {
    return $entries[0]['dn'];
  }

  return '';
}

/**
 * This function retrieves and returns Common Name from a given Distinguished
 * Name.
 *
 * @param string $dn
 *          The Distinguished Name.
 * @return string The Common Name.
 */
function getCN($dn)
{
  preg_match('/[^,]*/', $dn, $matchs, PREG_OFFSET_CAPTURE, 3);
  return $matchs[0][0];
}

/**
 * This function checks group membership of the user, searching only in
 * specified group (not recursively).
 *
 * @param resource $ad
 *          An LDAP link identifier, returned by ldap_connect().
 * @param string $userdn
 *          The user Distinguished Name.
 * @param string $groupdn
 *          The group Distinguished Name.
 * @return boolean Return true if user is a member of group, and false if not
 *         a member.
 */
function checkGroup($ad, $userdn, $groupdn)
{
  $result = ldap_read($ad, $userdn, "(memberof={$groupdn})", array(
    'members'
  ));
  if (! $result)
  {
    return false;
  }

  $entries = ldap_get_entries($ad, $result);

  return ($entries['count'] > 0);
}

/**
 * This function checks group membership of the user, searching in specified
 * group and groups which is its members (recursively).
 *
 * @param resource $ad
 *          An LDAP link identifier, returned by ldap_connect().
 * @param string $userdn
 *          The user Distinguished Name.
 * @param string $groupdn
 *          The group Distinguished Name.
 * @return boolean Return true if user is a member of group, and false if not
 *         a member.
 */
function checkGroupEx($ad, $userdn, $groupdn)
{
  $result = ldap_read($ad, $userdn, '(objectclass=*)', array(
    'memberof'
  ));
  if (! $result)
  {
    return false;
  }

  $entries = ldap_get_entries($ad, $result);
  if ($entries['count'] <= 0)
  {
    return false;
  }

  if (empty($entries[0]['memberof']))
  {
    return false;
  }

  for ($i = 0; $i < $entries[0]['memberof']['count']; $i ++)
  {
    if ($entries[0]['memberof'][$i] == $groupdn)
    {
      return true;
    }
    elseif (checkGroupEx($ad, $entries[0]['memberof'][$i], $groupdn))
    {
      return true;
    }
  }

  return false;
}

?>
