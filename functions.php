<?php
function CheckLogin()
{
	session_start();
	if(!isset($_SESSION["LoggedIn"]) || $_SESSION["LoggedIn"] != true)
	{
		header("Location: login.php");
	}
}

function Inlog()
{
	session_start();
	if($_SESSION == true)
	{
		header("Location: logout.php");
	}
}

function Destroy()
{
	session_destroy();
	header("Location: login.php");
}

function Connect()
{
	$host = "localhost";
	$dbnaam = "dbagendaphp";
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
	return $con;
}

function getCustomers()
{
	$con = Connect();
	$query = "SELECT customerid, firstname, lastname, phonenumber, city, address, dob, description FROM tbcustomers";
	$stm = $con->prepare($query);
	if($stm->execute())
	{
		return $stm->fetchAll (PDO::FETCH_OBJ);
	}
}

function showCustomers()
{
	echo"<table class='center' align='center'>
	<tr>
	<th>Id</th>
	<th>Voornaam</th>
	<th>Achternaam</th>
	<th>Telefoonnummer</th>
	<th>City</th>
	<th>Adres</th>
	<th>Geboortedatum</th>
	<th>Beschrijving</th>
	<th>Wijzigen</th>
	</tr>";
	foreach(getCustomers() as $customer)
	{
		echo
		"<tr class='hover'>
		<td>$customer->customerid</td>
		<td>$customer->firstname</td>
		<td>$customer->lastname</td>
		<td>$customer->phonenumber</td>
		<td>$customer->city</td>
		<td>$customer->address</td>
		<td>$customer->dob</td>
		<td>$customer->description</td>
		<td><a href='editcustomers.php?customerid=$customer->customerid&firstname=$customer->firstname&lastname=$customer->lastname&phonenumber=$customer->phonenumber&city=$customer->city&address=$customer->address&dob=$customer->dob&description=$customer->description'><input class='loneinput' style='float: left' type='submit' value='Wijzigen'></a></td>
		</tr>";
	}
	echo "</table>";
}

function insertCustomer($Firstname, $Lastname, $Phonenumber, $City, $Address, $DOB, $Description)
{
	$con = Connect();
	$query = "INSERT INTO tbcustomers (firstname, lastname, phonenumber, city, address, dob, description) "." VALUES ('$Firstname', '$Lastname', '$Phonenumber', '$City', '$Address', '$DOB', '$Description')";
	$stm = $con->prepare($query);
	if($stm->execute())
	{

	}
	else
	{
		echo "<br/><table align='center'><tr><td><b>Er is iets misgegaan met het invoeren van de klant.</b></td></tr></table>";
	}
}

function updateCustomer($Customerid, $Firstname, $Lastname, $Phonenumber, $City, $Address, $DOB, $Description)
{
	$con = Connect();
	$query = "UPDATE tbcustomers SET Firstname='$Firstname', lastname='$Lastname', phonenumber='$Phonenumber', city='$City', address='$Address', dob='$DOB', description='$Description' WHERE customerid=$Customerid";
	$stm = $con->prepare($query);
	if($stm->execute())
	{
		header("Location: customers.php");
	}
	else
	{
		echo "<br/><table align='center'><tr><td><b>Er is iets misgegaan met het wijzigen van de klant.</b></td></tr></table>";
	}
}



function showAppointments()
{
	echo"<table class='center' align='center'>
	<tr>
	<th>Id</th>
	<th>KlantenId</th>
	<th>Naam</th>
	<th>Begintijd</th>
	<th>Eindtijd</th>
	<th>Beschrijving</th>
	<th>Wijzigen</th>
	</tr>";
	foreach(getAppointments() as $appointment)
	{
		echo
		"<tr class='hover'>
		<td>$appointment->appointmentid</td>
		<td>$appointment->customerid</td>
		<td>$appointment->firstname $appointment->lastname</td>
		<td>$appointment->starttime</td>
		<td>$appointment->endtime</td>
		<td>$appointment->description</td>
		<td><a href='editappointments.php?appointmentid=$appointment->appointmentid&customerid=$appointment->customerid&firstname=$appointment->firstname&lastname=$appointment->lastname&starttime=$appointment->starttime&endtime=$appointment->endtime&description=$appointment->description'><input class='loneinput' style='float: left' type='submit' value='Wijzigen'></a></td>
		</tr>";
	}
	echo "</table>";
}

function insertAppointment($Customerid, $Starttime, $Endtime, $Description)
{
	$con = Connect();
	$query = "INSERT INTO tbappointments (customerid, starttime, endtime, description) "." VALUES ('$Customerid', '$Starttime', '$Endtime', '$Description')";
	$stm = $con->prepare($query);
	if($stm->execute())
	{
		
	}
}

function getAppointments()
{
	$con = Connect();
	$query = "SELECT tbappointments.appointmentid, tbcustomers.customerid, tbcustomers.firstname, tbcustomers.lastname, tbappointments.starttime, tbappointments.endtime, tbappointments.description FROM tbappointments INNER JOIN tbcustomers ON tbappointments.customerid=tbcustomers.customerid ORDER BY appointmentid ASC";
	$stm = $con->prepare($query);
	if($stm->execute())
	{
		return $stm->fetchAll (PDO::FETCH_OBJ);
	}
}

function updateAppointment($Appointmentid, $Customerid, $Starttime, $Endtime, $Description)
{
	$con = Connect();
	$query = "UPDATE tbappointments SET appointmentid='$Appointmentid', customerid='$Customerid', starttime='$Starttime', endtime='$Endtime', description='$Description' WHERE appointmentid=$Appointmentid";
	$stm = $con->prepare($query);
	if($stm->execute())
	{
		header("Location: appointments.php");
	}
	else
	{
		echo "<br/><table align='center'><tr><td><b>Er is iets misgegaan met het wijzigen van de afspraak.</b></td></tr></table>";
	}
}

function insertAccount($Username, $Password)
{
	$con = Connect();
	$query = "INSERT INTO tblogin (username, password) "." VALUES ('$Username', '$Password')";
	$stm = $con->prepare($query);
	if($stm->execute())
	{

	}
	else
	{
		echo "<br/><table align='center'><tr><td><b>Er is iets misgegaan met het invoeren van de accountgegevens.</b></td></tr></table>";
	}
}


function updateAccount($Userid, $Username, $Password)
{
	$con = Connect();
	$query = "UPDATE tblogin SET username='$Username', password='$Password' WHERE userid=$Userid";
	$stm = $con->prepare($query);
	if($stm->execute())
	{
		Header("Location: addaccounts.php");
	}
	else
	{
		echo "<br/><table align='center'><tr><td><b>Er is iets misgegaan met het invoeren van de accountgegevens.</b></td></tr></table>";
	}
}


function getEditAppointmentCustomers()
{
	$con = Connect();
	$query = "SELECT customerid, firstname, lastname FROM tbcustomers";
	$stm = $con->prepare($query);
	if($stm->execute())
	{
		return $stm->fetchAll(PDO::FETCH_OBJ);
	}
}


function showEditAppointmentCustomers($Customerid)
{
	foreach(getEditAppointmentCustomers() as $customer)
	{
		if($customer->customerid != $Customerid)
		{
			echo "<option value='$customer->customerid'>$customer->customerid $customer->firstname $customer->lastname</option>";
		}
		else
		{
			echo "<option selected='selected' value='$customer->customerid'>$customer->customerid $customer->firstname $customer->lastname</option>";
		}
	}
}


function getLoginDetails($Username)
{
	$con = Connect();
	$query = "SELECT username, password FROM tblogin WHERE username='$Username'";
	$stm = $con->prepare($query);
	if($stm->execute())
	{
		return $result = $stm->fetchAll (PDO::FETCH_OBJ);
	}
}

function getAppointmentsPerCustomer($Customerid)
{
	$con = Connect();
	$query = "SELECT tbappointments.appointmentid, tbcustomers.customerid, tbcustomers.firstname, tbcustomers.lastname, tbappointments.starttime, tbappointments.endtime, tbappointments.description FROM tbappointments INNER JOIN tbcustomers ON tbappointments.customerid=tbcustomers.customerid WHERE tbappointments.customerid = '$Customerid' ORDER BY appointmentid ASC";
	$stm = $con->prepare($query);
	if($stm->execute())
	{
		return $stm->fetchAll (PDO::FETCH_OBJ);
	}
}


function showAppointmentsPerCustomer($CustomeridPerCustomer)
{
	echo"<table class='center' align='center'>
	<tr>
	<th>Id</th>
	<th>KlantenId</th>
	<th>Naam</th>
	<th>Begintijd</th>
	<th>Eindtijd</th>
	<th>Beschrijving</th>
	<th>Wijzigen</th>
	</tr>";
	foreach(GetAppointmentsPerCustomer($CustomeridPerCustomer) as $appointment)
	{
		echo
		"<tr class='hover'>
		<td>$appointment->appointmentid</td>
		<td>$appointment->customerid</td>
		<td>$appointment->firstname $appointment->lastname</td>
		<td>$appointment->starttime</td>
		<td>$appointment->endtime</td>
		<td>$appointment->description</td>
		<td><a href='editappointments.php?appointmentid=$appointment->appointmentid&customerid=$appointment->customerid&firstname=$appointment->firstname&lastname=$appointment->lastname&starttime=$appointment->starttime&endtime=$appointment->endtime&description=$appointment->description'><input class='loneinput' style='float: left' type='submit' value='Wijzigen'></a></td>
		</tr>";
	}
	echo "</table>";
}
?>