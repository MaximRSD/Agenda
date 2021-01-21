<?php
include "include.php";
$con = Connect();
Inlog();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inloggen</title>
</head>
<body>
<ul>
<?php
if($_SESSION != false)
{
	echo "<li><a href='customers.php'>Klanten</a></li>
  		  <li><a href='appointments.php'>Afspraken</a></li>";
}
?>
  <li style="float: right;"><a class="active" href="login.php">Login</a></li>
</ul>
<h1 style="margin-top: 55px;">
	Inloggen:
</h1>
<p>
<form method="POST">
	<table align="center">
		<tr>
			<th>Gebruikersnaam:</th>
			<td><input type="input" name="Username"></td>
		</tr>
		<tr>
			<th>Wachtwoord:</th>
			<td><input type="Password" name="Password"></td>
		</tr>
		<tr>
			<th></th>
			<td style="text-align: center;"><input class="forminput" type="submit" name="btnLogin" value="Inloggen"></td>
		</tr>
	</table>
</form>
<?php
if(isset($_POST["btnLogin"]))
{
$Username = $_POST["Username"];
foreach(getLoginDetails($Username) as $login)
		{
			$LoginUsername = $login->username;
			$LoginPassword = $login->password;
		}
	
	if(!isset($_SESSION["LoggedIn"]))
	{
		if($_POST["Username"] != null && $_POST["Password"] != null)
		{
			if($_POST["Username"] == $LoginUsername &&  $_POST["Password"] == $LoginPassword)
			{
				$_SESSION["LoggedIn"] = true;
				$_SESSION["Username"] = $LoginUsername;
         	    header("Location: logout.php");
			}
			else
			{
				echo "<br/><table align='center'><tr><td><b>Verkeerde inloggegevens</b></td></tr></table>";
			}
		}
		else
		{
			echo "<br/><table align='center'><tr><td><b>Vul inloggegevens in!</b></td></tr></table>";
		}
	}
}
?>
</p>
</body>
</html>