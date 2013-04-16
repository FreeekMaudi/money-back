<div id="addEvent" style="display:block;">
	addEvent
<?php
	$i = count($allEvents) + 1;
	
	//Existing
	//$newOne = new Event($i, "Happy BirthDay", "http://www.maudi.nl/money-back-dev/", "", "20121025", "2", "2,3,4");
	//Non-Existing
	$newOnePersons = getPersonsWithIdsString("2,3,4");
	$newOne = new Event($i, "Beth Hart", "http://bethhart.com", "", "20130101", "1", "1,2");
	//$newOne = new Event($i, "Happy BirthDay", "http://www.maudi.nl/money-back-dev/", "", "20120727", "1", $newOnePersons);
	
	$outputSave = $newOne->save();
	
	if (gettype($outputSave) == "string")
	{
		echo $outputSave;
	}
?>
</div>