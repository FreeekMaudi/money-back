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
	
	if (isset($_POST['testUpload'])) {
		include("general/uploadProcess.php");
		header("Location: {$_SERVER['REQUEST_URI']}");
	}

?>

<body>
	<?php
		getPersons();
		getLocations();
		getEvents();

	?>
		<br /><br />
		<a href="#" class="header" onclick="toggle_visibility('upload')">upload</a>
		&nbsp;*&nbsp;
	<?php
		include("general/upload.php");
	?>
	<?php
		include("testfooter.php");
	?>
</body>

</html>