<div id="dltEvent" style="display:block;">
	EVENT
	<br /><br />
<?php
	$i = count($allEvents) + 1;
	
	//Non-Existing
	//$oldOne = new Event($i, "Beth Hart", "http://bethhart.com", "", "20121121", "1", "1,2");
	//Existing
	$locationFound = getLocationByName("Fake");
	$existingOne = getEventByDateAndLocation("20130101", $locationFound->get_id());

	if ($existingOne != null)
	{
		$outputSave = $existingOne->delete();
		
		if (gettype($outputSave) == "string")
		{
			echo $outputSave;
		}
	}
	else
	{
		echo "Event does not exist, could not be found";
	}

?>
</div>