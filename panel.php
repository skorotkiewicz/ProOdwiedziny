<?php session_start(); ob_start();  
 
// Skrypt OdwiedzinyPro ver 2.0
// Wszelkie prawa zastrzeżone!
// Copyright © 2011 ITUnix.eu. All rights reserved. 
?>
<html> 
    <head> 
	<title>Panel odwiedziń</title> 
	<link rel="stylesheet" href="style" type="text/css" /> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="author" content="itunix.eu" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
	<link rel="stylesheet" href="style.css" type="text/css" />
	<script type="text/javascript" >
$(function () {
    $('.delete_update').live("click", function () {
        var ID = $(this).attr("id");
        var dataString = 'msg_id=' + ID;
        if (confirm("Na pewno chcesz usunąć tę wizytę?")) {

            $.ajax({
                type: "POST",
                url: "delateIps.php",
                data: dataString,
                cache: false,
                success: function (html) {
                    $(".bar" + ID).slideUp('slow', function () {
                        $(this).remove();
                    });
                }
            });

        }
        return false;
    });

});
	</script>
    </head>
<?php
include 'config.php';

if (!$_SESSION[$session]) { ?>
<center>
<div class="SplashInfo">
   <h1>ProOdwiedziny ver 5</h1>
	<p><form action="panel.php" method="post">
		Hasło: <input type="password" name="pass">
		<input type="submit" name="addcom" value="Zaloguj" >
	</form></p>
</div>
</center>
<?php
}


if ($_POST['pass'] == $adminPassword) {
	$_SESSION[$session] = uniqid();
	header('Location: panel.php'); 
}
if ($_SESSION[$session]) {
?>

Witaj! 
<a href="panel.php">Odwiedziny</a> | 
<a href="?podstrona=nick">Usuń wszystkie odwiedziny danego użytkownika</a> | 
<a href="?podstrona=logout">Wyloguj</a>
<hr />

<?php

if ($_GET['podstrona'] == 'logout') {
session_unset();
session_destroy();
header('Location: panel.php'); 
}



elseif ($_GET['podstrona'] == 'nick') {
?>
	<form action="?podstrona=nick" method="post">
		Podaj Nick osoby którą chcesz usunąć z listy odwiedziń: <input type="text" name="nick">
		<input type="submit" value="Usuń..." >
	</form>
<?php


if ($_POST['nick']) {
$nick=$_POST['nick'];
$nick = mysql_escape_String($nick);
$sql = "delete from $tabela where nick='$nick'";
mysql_query( $sql);
header('Location: panel.php'); 
}
}


else {

?>


<div class="main">


	<div id="demoContent">
    
        <div id="contentLeft">

<div id="twitter-container">


<?php



echo '<ul class="statuses">';

	$adjacents = 3;
	$query = "SELECT COUNT(*) as num FROM $tabela ";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	$targetpage = "panel.php";


if ($limits <= 0) {
	$limit = 15;
}
else {
	$limit = $limits;
}
 		
	$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit;
	else
		$start = 0;
	
	$sql = "SELECT * FROM $tabela ORDER BY id DESC LIMIT $start, $limit ";
	$result = mysql_query($sql);
	

	if ($page == 0) $page = 1;
	$prev = $page - 1;
	$next = $page + 1;
	$lastpage = ceil($total_pages/$limit);
	$lpm1 = $lastpage - 1;
	

	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";

		if ($page > 1) 
			$pagination.= " <a href=\"$targetpage?page=$prev\">« Poprzednia</a> ";
		else
			$pagination.= " <span class=\"disabled\">« Poprzednia</span> ";	

		if ($lastpage < 7 + ($adjacents * 2))
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= " <span class=\"current\">$counter</span> ";
				else
					$pagination.= " <a href=\"$targetpage?page=$counter\">$counter</a> ";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))
		{
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\">$counter</span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\">$counter</a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\">$lpm1</a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\">$lastpage</a> ";		
			}

			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= " <a href=\"$targetpage?page=1\">1</a> ";
				$pagination.= " <a href=\"$targetpage?page=2\">2</a> ";
				$pagination.= " ... ";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\">$counter</span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\">$counter</a> ";					
				}
				$pagination.= " ... ";
				$pagination.= " <a href=\"$targetpage?page=$lpm1\">$lpm1</a> ";
				$pagination.= " <a href=\"$targetpage?page=$lastpage\">$lastpage</a> ";		
			}

			else
			{
				$pagination.= " <a href=\"$targetpage?page=1\">1</a> ";
				$pagination.= " <a href=\"$targetpage?page=2\">2</a> ";
				$pagination.= " ... ";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= " <span class=\"current\">$counter</span> ";
					else
						$pagination.= " <a href=\"$targetpage?page=$counter\">$counter</a> ";					
				}
			}
		}
		
		if ($page < $counter - 1) 
			$pagination.= " <a href=\"$targetpage?page=$next\">Następna »</a> ";
		else
			$pagination.= " <span class=\"disabled\">Następna »</span> ";
		$pagination.= "</div>\n";		
	}
?>

<?php
		while($row = mysql_fetch_array($result))
		{

if(!$row['awatar']) {	
$avatar = 'http://avatars.zapytaj.com.pl/noimg.gif';
}
else {
$avatar = $row['awatar'];
}

?>	
<?php echo '<li class="bar'.$row['id'].'">'; ?>

	<a href="http://zapytaj.com.pl/Profile/user_<?php echo $row['link']; ?>.html" target="_blank"><img class="avatar" src="<?php echo $avatar; ?>" width="48" height="48" alt="avatar" /></a>

	<div class="tweetTxt">
	<strong><a href="http://zapytaj.com.pl/Profile/user_<?php echo $row['link']; ?>.html" target="_blank"><?php echo $row['nick']; ?></a></strong> <?php echo $row['godzina']; ?>

	<a href="#" id="<?php echo $row['id']; ?>" class="delete_update submitButton" style="float:right">[ USUŃ #<?php echo $row['id']; ?> ]</a>

	<div class="date"><?php echo $row['ip']; ?><br /><?php echo $row['useragent']; ?></div>
	</div>
	<div class="clear"></div>
	</li>


<?php	
}
?>
<a class="pagination"><?=$pagination?></a>

</div>
	</ul> 
	</div>
	</div>
</div>
<?php
} 
}
?>
