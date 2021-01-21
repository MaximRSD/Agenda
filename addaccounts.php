<?php
include "include.php";
$con = Connect();
CheckLogin();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Klanten toevoegen</title>
</head>
<body>
<ul>
  <li><a href="customers.php">Klanten</a></li>
  <li><a href="appointments.php">Afspraken</a></li>
<?php
if($_SESSION != false)
{
	echo "<li style='float: right;'><a href='login.php'>Logout</a></li>";
	echo "<li style='float: right;'><a  class='active' href='addaccounts.php'>Accounts</a></li>";
}
else
{
	echo "<li style='float: right;'><a href='login.php'>Login</a></li>";
}
?>
</ul>
<h1 style="margin-top: 55px;">
	Account invoeren:
</h1>
<p>
<form method="POST">
	<table align="center">
		<tr>
			<th>Username:</th>
			<td><input type="text" name="Username"></td>
		</tr>
		<tr>
			<th>Password:</th>
			<td><input type="text" name="Password"></td>
		</tr>
		<tr>
			<th>herhaal Password:</th>
			<td><input type="text" name="PasswordRepeat"></td>
		</tr>
		<tr>
			<th></th>
			<td style="text-align: center;"><input class="forminput" type="submit" name="Insert" value="Invoeren"></td>
		</tr>
	</table>
</form>
<?php
if(isset($_POST["Insert"]))
{
	if(!empty($_POST["Username"]) && !empty($_POST["Password"]) && !empty($_POST["PasswordRepeat"]))
	{
		if($_POST["Password"] == $_POST["PasswordRepeat"])
		{
			$Username = $_POST["Username"];
			$Password = $_POST["Password"];
			insertAccount($Username, $Password);
		}
		else
		{
			echo "<br/><table align='center'><tr><td><b>Vul overeenkomende wachtwoorden in!</b></td></tr></table>";
		}
	}
	else
	{
		echo "<br/><table align='center'><tr><td><b>Vul alle velden in!</b></td></tr></table>";
	}
}
?>
</p>
<h1>
	Lijst accounts:
</h1>
<p>
<?php
$query = "SELECT userid, username, password FROM tblogin";
$stm = $con->prepare($query);
if($stm->execute())
{
	echo"<table class='center' align='center'>
	<tr>
	<th>Id</th>
	<th>Gebruikersnaam</th>
	<th>Wachtwoord</th>
	</tr>";
	$result = $stm->fetchAll (PDO::FETCH_OBJ);
	foreach($result as $account)
	{
		echo
		"<tr class='hover'>
		<td>$account->userid</td>
		<td>$account->username</td>
		<td>$account->password</td>
		<td><a href='editaccounts.php?userid=$account->userid&username=$account->username&password=$account->password'><input class='loneinput' style='float: left' type='submit' value='Wijzigen'></a></td>
		</tr>";
	}
	echo "</table>";
}
else
{
	echo "<h1>Er is iets misgegaan. </h1>";
}
?>
</p>
</body>
</html>