<div id="addEventForPerson" style="display:block;">
<?php

	$person = getPersonById("1");
	$newEvent = new Event(count($allEvents) + 1, "Nieuwste", "http://www.maudi.nl/money-back-dev/", "", "20130101", "2", "1");

	$outputSave = $person->saveEventForPerson($newEvent);

	if (gettype($outputSave) == "string")
	{
		echo $outputSave;
	}
?>
</div>