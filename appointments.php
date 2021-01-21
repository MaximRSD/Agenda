<?php
include "include.php";
$con = Connect();
CheckLogin();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Afspraak invoeren</title>
</head>
<body>
<ul>
  <li><a href="customers.php">Klanten</a></li>
  <li><a class="active" href="appointments.php">Afspraken</a></li>
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
	Afspraak invoeren van klanten:
</h1>
<p>
<form method="POST">
	<table align="center">
		<tr>
			<th>Naam:</th>
			<td>
				<select name="SelectName" style="width: 99.5%">
					<?php
					foreach(getEditAppointmentCustomers($Customerid) as $customer)
					{
						echo "<option value='$customer->customerid'>$customer->customerid $customer->firstname $customer->lastname</option>";
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<th>Begintijd:</th>
			<td><input type="datetime-local" name="Starttime"></td>
		</tr>
		<tr>
			<th>Eindtijd:</th>
			<td><input type="datetime-local" name="Endtime"></td>
		</tr>
		<tr>
			<th>Beschrijving:</th>
			<td><input style="width: 99.5%" type="input" name="Description"></td>
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
	if(!empty($_POST["SelectName"]) && !empty($_POST["Starttime"]) && !empty($_POST["Endtime"]))
	{

		$Customerid = $_POST["SelectName"];
		$Starttime = $_POST["Starttime"];
		$Endtime = $_POST["Endtime"];
		$Description = $_POST["Description"];
		insertAppointment($Customerid, $Starttime, $Endtime, $Description);
	}
	else
	{
		echo "<br/><table align='center'><tr><td><b>Vul alle velden in!</b></td></tr></table>";
	}
}
?>
</p>
<h1>
	Lijst afspraken van klanten:
</h1>
<p>
<?php
showAppointments();
?>
</p>
</body>
</html>