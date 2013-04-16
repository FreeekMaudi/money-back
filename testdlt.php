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
		getPersons();
		getLocations();
		getEvents();

	?>
		<br /><br />
		<a href="#" class="header" onclick="toggle_visibility('dltEvent')">dltEvent</a>
		&nbsp;*&nbsp;
		<a href="#" class="header" onclick="toggle_visibility('dltLocation')">dltLocation</a>
		&nbsp;*&nbsp;
	<?php
		include("test/dltEvent.php");
		include("test/dltLocation.php");
	?>
	<?php
		include("testfooter.php");
	?>
</body>

</html>