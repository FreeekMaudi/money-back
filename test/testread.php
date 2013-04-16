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
	
	$currentPerson;
	$eventsForPerson;
	$transactionsPerson;
	
?>

<body>
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
		include("read/readPersons.php");
		include("read/readLocations.php");
		include("read/readEvents.php");
		include("read/readEventsForPerson.php");
		include("read/readTransactions.php");
	?>
	<?php
		include("testfooter.php");
	?>
</body>

</html>