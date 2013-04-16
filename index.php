<?php
	$title = "money-back-dev";
	
	$rootUrl = 'http://www.maudi.nl/money-back-dev/';
	$subDir = 'money-back-dev';
	$repositoryUrlPart = 'xml/';
	$dirUp = "";

	require_once("includes/domain.php"); 
	require_once("includes/repository.php"); 
	require_once("includes/functions.php"); 

	$requestURI = explode('/', $_SERVER['REQUEST_URI']);
	$scriptName = explode('/', $_SERVER['SCRIPT_NAME']);

	$currentPersonName = '';
	$opppositePersonName = '';
	
	$uri_parameters = array_values($requestURI);
	
	if ($uri_parameters[1] == $subDir)
	{
		if ($uri_parameters[2] != null)
		{
			$uri_parameters_persons = explode('-', $uri_parameters[2]);
			$currentPersonName = $uri_parameters_persons[0];
			$oppositePersonName = $uri_parameters_persons[1] != null ? $uri_parameters_persons[1] : '';
		}
	}
	else
	{
		if ($uri_parameters[1] != null)
		{
			$uri_parameters_persons = explode('-', $uri_parameters[1]);
			$currentPersonName = $uri_parameters_persons[0];
			$oppositePersonName = $uri_parameters_persons[1] != null ? $uri_parameters_persons[1] : '';
		}
	}

	$allPersons;
	$allLocations;
	$allEvents;
	$allGroups;
	
	$currentPerson;
	$oppositePerson;
	$eventsForPerson;
	$groupForPerson;
	$locationsPerson;
	$transactionsPersons;
	
	$msgLocation = null;
	if (isset($_GET['msgLocation']))
		$msgLocation = $_GET['msgLocation'];

	$msgEvent = null;
	if (isset($_GET['msgEvent']))
		$msgEvent = $_GET['msgEvent'];

	
	if (isset($_COOKIE['pass'])) {
		$currentPerson = getPersonByName($currentPersonName);
		$oppositePerson = $oppositePersonName <> '' ? getPersonByName($oppositePersonName) : null;
		if ($currentPerson != null && $currentPerson->get_password() == $_COOKIE['pass'])
			$logged_in = true;
		else
			$logged_in = false;
	} else {
		$logged_in = false;
	}

	if (isset($_POST['currentPersonName']))
		if ($_POST['currentPersonName'] == "") {
		setcookie ("pass", "", time() - 3600);
		header("Location: {$_SERVER['REQUEST_URI']}");
	}
	
	if (isset($_POST['pass'])) {
		$passIn = $_POST['pass'];
		$passInHash = hash('md5', $passIn);
		$currentPersonName = $_POST['currentPersonName'];
		setcookie('pass', $passInHash);
		header("Location: {$_SERVER['REQUEST_URI']}{$currentPersonName}");
	}
	
	if (isset($_POST['newLocation'])) {
		include("ui/forms/formLocationProcess.php");
		if ($msgLocation <> "")
			$msgLocation = "?msgLocation=".$msgLocation;
		header("Location: {$_SERVER['REQUEST_URI']}{$msgLocation}");
	}
	
	if (isset($_POST['newEvent']) || isset($_POST['chgEvent'])) {
		include("ui/forms/formEventProcess.php");
		if ($msgEvent <> "")
			$message = "?msgEvent=".$msgEvent;
		header("Location: {$_SERVER['REQUEST_URI']}{$message}");
	}

	// if (isset($_POST['newMoney'])) {
		// include("forms/formMoneyProcess.php");
		// header("Location: {$_SERVER['PHP_SELF']}?vs1={$vs1}");
	// }

	require_once("head.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
	<div class='container'>
	<?php
		getPersons();
		getLocations();
		getEvents();
		// include("ui/eventList.php");
		// echo hash('md5', "Maudini")."<br />";
		// echo hash('md5', "Nien")."<br />";
		// echo hash('md5', "Chrizzls")."<br />";
		// echo hash('md5', "HappyS")."<br />";

		if ($logged_in) {
			getEventsForPerson($currentPerson);
			getLocations();

			echo '<div class="locationList">'."\n";
			include("ui/locationList.php");

			if ($title == 'money-back-dev')
				echo "<a href='test'>test</a>\n";

			echo '<div id="formLocation" style="display:none;">'."\n";
			include("ui/forms/formLocation.php");
			echo '</div>'."\n";
			if ($msgLocation != null)
			{
				echo $msgLocation."<br />";
			}

			echo '<div id="formEvent" style="display:none;">'."\n";
			include("ui/forms/formEvent.php");
			echo '</div>'."\n";
			if ($msgEvent != null)
			{
				echo $msgEvent."<br />";
			}



			if ($oppositePerson != null) {
			// Transaction Page
				echo '<div id="formMoney" style="display:none;">'."\n";
				include("ui/forms/formMoney.php");
				echo '</div>'."\n";
			}
			echo '</div>'."\n";	

			if ($oppositePerson == null) {
			// Person Page
				echo '<div class="eventList">'."\n";
				include("ui/eventListPerson.php");
				echo '</div>'."\n";
			} else {
			// Transaction Page
				getEventsForPersons();
				getTransactionsForPersons();
				echo '<div class="eventListTransactions">'."\n";
				include("ui/eventListPersonTransaction.php");
				echo '</div>'."\n";
			}
				
			include('ui/forms/afmelden.php');

		} else {
		// Home Page
			include("ui/locationList.php");
			include("ui/eventList.php");
			include('ui/forms/aanmelden.php');
		}
	?>
	</div>
</body>

</html>