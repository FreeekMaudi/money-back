<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
	$title = "money-back-dev";
	
	$rootUrl = 'http://www.maudi.nl/money-back-dev/';
	$repositoryUrlPart = 'xml/';

	$dirUp = "../";

	require_once($dirUp."includes/domain.php"); 
	require_once($dirUp."includes/repository.php"); 
	require_once($dirUp."includes/functions.php"); 
	require_once($dirUp."head.php");

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
		getPersons();
		getLocations();
		getEvents();

	?>
		<h1>Add</h1>
		<a href="#" class="header" onclick="toggle_visibility('addLocation')">addLocation</a>
		&nbsp;*&nbsp;
		<a href="#" class="header" onclick="toggle_visibility('addEvent')">addEvent</a>
		&nbsp;*&nbsp;
	<?php
		include("add/addLocation.php");
		include("add/addEvent.php");
	?>
	<?php
		include("testfooter.php");
	?>
</body>

</html>