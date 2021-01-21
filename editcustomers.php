<?php
include "include.php";
CheckLogin();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Klant wijzigen in database</title>
</head>
<body>
<ul>
  <li><a class="active" href="customers.php">Klanten</a></li>
  <li><a href="appointments.php">Afspraken</a></li>
<?php
if($_SESSION != false)
{
	echo "<li style='float: right;'><a href='login.php'>Logout</a></li>";
	echo "<li style='float: right;'><a href='addaccounts.php'>Accounts</a></li>";
}
else
{
	echo "<li style='float: right;'><a href='login.php'>Login</a></li>";
}
?>
</ul>
<h1 style="margin-top: 55px;">
	Klant wijzigen:
</h1>
<p>
<form method="POST">
	<table align="center">
		<tr>
			<th>Voornaam:</th>
			<td><input type="text" name="Firstname" value="<?php echo $_GET['firstname']; ?>"></td>
		</tr>
		<tr>
			<th>Achternaam:</th>
			<td><input type="text" name="Lastname" value="<?php echo $_GET['lastname']; ?>"></td>
		</tr>
		<tr>
			<th>Telefoonnummer:</th>
			<td><input type="text" name="Phonenumber" value="<?php echo $_GET['phonenumber']; ?>"></td>
		</tr>
		<tr>
			<th>Stad:</th>
			<td><input type="text" name="City" value="<?php echo $_GET['city']; ?>"></td>
		</tr>
		<tr>
			<th>Adres:</th>
			<td><input type="text" name="Address" value="<?php echo $_GET['address']; ?>"></td>
		</tr>
		<tr>
			<th>Geboortedatum:</th>
			<td><input style="width: 100%" type="date" name="DOB" value="<?php echo $_GET['dob']; ?>"></td>
		</tr>
		<tr>
			<th>Beschrijving:</th>
			<td><input type="text" name="Description"></td>
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
	if(!empty($_POST["Firstname"]) && !empty($_POST["Lastname"]) && !empty($_POST["Phonenumber"]) && !empty($_POST["City"]) && !empty($_POST["Address"]) && !empty($_POST["DOB"]))
	{
		$Customerid = $_GET["customerid"];
		$Firstname = $_POST["Firstname"];
		$Lastname = $_POST["Lastname"];
		$Phonenumber = $_POST["Phonenumber"];
		$City = $_POST["City"];
		$Address = $_POST["Address"];
		$DOB = $_POST["DOB"];
		$Description = $_POST["Description"];
		updateCustomer($customerid, $Firstname, $Lastname, $Phonenumber, $City, $Address, $DOB, $Description);
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