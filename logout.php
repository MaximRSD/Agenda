<?php
include "include.php";
CheckLogin();
$Username = "admin";
$Password = "root";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
</head>
<body>
<ul>
  <li><a href="customers.php">Klanten</a></li>
  <li><a href="appointments.php">Afspraken</a></li>
  <li style="float: right;"><a class="active" href="login.php">Logout</a></li>
  <li style='float: right;'><a href="addaccounts.php">Accounts</a></li>
</ul>
<h1 style="margin-top: 55px;">
	<?php echo "U bent momenteel ingelogd als: ".$_SESSION["Username"]; ?>
</h1>
<h1>
	Uitloggen:
</h1>
<p>
<form method="POST">
	<table align="center">
		<tr>
			<td style="text-align: center;"><input class="loneinput" type="submit" name="btnLogout" value="Uitloggen"></td>
		</tr>
	</table>
</form>
<?php
if(isset($_POST["btnLogout"]))
{
	Destroy();
}
?>
</p>
</body>
</html>