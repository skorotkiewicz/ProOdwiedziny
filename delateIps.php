<?php session_start();

// Skrypt OdwiedzinyPro ver 2.0
// Wszelkie prawa zastrzeżone!
// Copyright © 2011 ITUnix.eu. All rights reserved. 

include 'config.php';


if($_POST['msg_id'])
{
$id=$_POST['msg_id'];
$id = mysql_escape_String($id);
$sql = "DELETE FROM $tabela WHERE id='$id'";
mysql_query( $sql);
}


?>
