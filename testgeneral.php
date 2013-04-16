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
	
	if (isset($_POST['testUpload'])) {
		include("test/uploadProcess.php");
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
		include("test/upload.php");
	?>
	<?php
		include("testfooter.php");
	?>
</body>

</html>