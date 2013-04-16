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
	<a href="#" class="header" onclick="toggle_visibility('writePersons')">writePersons</a>
	&nbsp;*&nbsp;
	<a href="#" class="header" onclick="toggle_visibility('writeLocations')">writeLocations</a>
	&nbsp;*&nbsp;
	<a href="#" class="header" onclick="toggle_visibility('writeEvents')">writeEvents</a>
	&nbsp;*&nbsp;
	<a href="#" class="header" onclick="toggle_visibility('writeTransactions')">writeTransactions</a>
	<br /><br />

	<?php
		include("write/writePersons.php");
		include("write/writeLocations.php");
		include("write/writeEvents.php");
		// include("write/writeTransactions.php");
	?>
	<?php
		include("testfooter.php");
	?>
</body>

</html>