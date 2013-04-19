<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
	$title = "money-back-dev";
	
	$rootUrl = 'http://www.maudi.nl/money-back-dev/';
	$repositoryUrlPart = 'xml/';
	$currentDate = date(Ymd);

	$dirUp = "../";

	require_once($dirUp."includes/domain.php"); 
	require_once($dirUp."includes/repository.php"); 
	require_once($dirUp."includes/functions.php"); 
	require_once($dirUp."head.php");

	$allPersons;
	$allLocations;
	$allEvents;
	
	$currentPerson;
	$eventsForPerson;
	$transactionsPerson;
	
?>

<body>
	<h1>Read</h1>
	<a href="#" class="header" onclick="toggle_visibility('readPersons')">Persons</a>
	&nbsp;*&nbsp;
	<a href="#" class="header" onclick="toggle_visibility('readLocations')">Locations</a>
	&nbsp;*&nbsp;
	<a href="#" class="header" onclick="toggle_visibility('readLocationsForPerson')">LocationsForPerson</a>
	&nbsp;*&nbsp;
	<a href="#" class="header" onclick="toggle_visibility('readEvents')">Events</a>
	&nbsp;*&nbsp;
	<a href="#" class="header" onclick="toggle_visibility('readEventsForPerson')">EventsForPerson</a>
	&nbsp;*&nbsp;
	<a href="#" class="header" onclick="toggle_visibility('readTransactions')">Transactions</a>
	<br /><br />

	<?php
		include("read/readPersons.php");
		include("read/readLocations.php");
		include("read/readLocationsForPerson.php");
		include("read/readEvents.php");
		include("read/readEventsForPerson.php");
		include("read/readTransactions.php");
	?>
	<?php
		include("testfooter.php");
	?>
</body>

</html>