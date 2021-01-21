<?php
	$host = "localhost";
	$dbnaam = "dbagenda";
	$gebruiker = "root";
	$wachtwoord = "";
	
	try
	{
		$con = new PDO ("mysql:host=$host;dbname=$dbnaam", $gebruiker, $wachtwoord);
	}
	catch (PDOException $ex)
	{
		echo "Verbinding database mislukt!: $ex";
	}
?>