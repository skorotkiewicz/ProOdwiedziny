<?php

// Skrypt OdwiedzinyPro ver 2.1
// Wszelkie prawa zastrzeżone!
// Copyright © 2011 ITUnix.eu. All rights reserved. 

// Witamy w pliku konfiguracyjnym, tutaj trzeba podać swoje dane do bazy MySQL.

$username = "user"; // Twój login do Bazy MySQL
$password = "pass"; // Twoje hasło do Bazy MySQL
$hostname = "localhost"; // Adres serwera MySQL (standardowo localhost)
$database = "baza"; // Twoja nazwa bazy MySQL


$tabela    = "odwiedziny"; // Opcjonalnie, nie zmieniaj!
$limits        = 10; // Ile wyswietleń odwiedziń na jednej stronie
$session       = 'rsvrtgvcr'; // Twój unikalny ciąg znaków
$adminPassword = 'admin'; // Twoje hasło do panelu odwiedziń






// Poniżej proszę nic nie zmieniać!
mysql_connect($hostname, $username, $password) or die(mysql_error());
mysql_select_db($database) or die(mysql_error());
?>
