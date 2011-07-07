<?php

// Skrypt OdwiedzinyPro ver 2.0
// Wszelkie prawa zastrzeżone!
// Copyright © 2011 ITUnix.eu. All rights reserved. 

include 'config.php';


function clean_text($wert) {

if (!empty($wert)) {
$wert = strip_tags($wert);
$wert = htmlentities($wert, ENT_QUOTES, "UTF-8");
$wert = trim($wert);
$wert = stripslashes($wert);
$wert = mysql_real_escape_string($wert);
}
return $wert;

}



$ip 		= $_SERVER['REMOTE_ADDR'];
$useragent 	= $_SERVER['HTTP_USER_AGENT'];
$godzina 	= date('Y-m-j, H:i:s');
	
$uid 		= md5(uniqid(rand(), true));
$uidDone 	= substr($uid,0,5);



  $_SESSION['user'] = $uidDone;
  mysql_query("INSERT INTO $tabela SET ip='".$ip."', useragent='".$useragent."', godzina='".$godzina."', uid='".$uidDone."', nick='".clean_text($_GET['guest_nick'])."', link='".clean_text($_GET['guest_id'])."', awatar='".$_GET['guest_avatar']."' "); 

?>
