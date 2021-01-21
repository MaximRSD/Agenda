<?php
include "include.php";
CheckLogin();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Account toevoegen voor klanten</title>
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
	Account wijzigen:
</h1>
<p>
<form method="POST">
	<table align="center">
		<tr>
			<th>Username:</th>
			<td><input type="text" name="Username" value="<?php echo $_GET['username']; ?>"></td>
		</tr>
		<tr>
			<th>Password:</th>
			<td><input type="text" name="Password" value="<?php echo $_GET['password']; ?>"></td>
		</tr>
		<tr>
			<th>Repeat Password:</th>
			<td><input type="text" name="PasswordRepeat" value="<?php echo $_GET['password']; ?>"></td>
		</tr>
		<tr>
			<th></th>
			<td style="text-align: center;"><input class="forminput" type="submit" name="Insert" value="Wijzigen"></td>
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
			$Userid = $_GET["userid"];
			$Username = $_POST["Username"];
			$Password = $_POST["Password"];
			updateAccount($Userid, $Username, $Password);
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
</body>
</html>