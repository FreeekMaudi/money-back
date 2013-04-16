<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
	$title = "money-back-dev";
	
	$rootUrl = 'http://www.maudi.nl/money-back-dev/';
	$repositoryUrlPart = 'xml/';

	require_once("includes/domain.php"); 
	require_once("includes/repository.php"); 
	require_once("includes/functions.php"); 
	require_once("head.php");

	$allPersons;
	$allLocations;
	$allEvents;
	$allGroups;
	
	$currentPerson;
	$eventsForPerson;
	$transactionsPerson;
	
?>

<body>
	<?php
	//	include("test/readEvents.php");
		// getPersons();
		// getLocations();
		// getEvents();

	?>
		<br /><br />
		<a href="#" class="header" onclick="toggle_visibility('readPersons')">readPersons</a>
		&nbsp;*&nbsp;
		<a href="#" class="header" onclick="toggle_visibility('readLocations')">readLocations</a>
		&nbsp;*&nbsp;
		<a href="#" class="header" onclick="toggle_visibility('readEvents')">readEvents</a>
		&nbsp;*&nbsp;
		<a href="#" class="header" onclick="toggle_visibility('readEventsForPerson')">readEventsForPerson</a>
		&nbsp;*&nbsp;
		<a href="#" class="header" onclick="toggle_visibility('readTransactions')">readTransactions</a>
		<br /><br />

	<?php
		include("test/readPersons.php");
		include("test/readLocations.php");
		include("test/readEvents.php");
		include("test/readEventsForPerson.php");
		include("test/readTransactions.php");
	?>
	<?php
		include("testfooter.php");
	?>
</body>

</html>