<div id="dltEvent" style="display:block;">
	dltEvent
<?php
	$i = count($allEvents) + 1;
	
	//Non-Existing
	//$oldOne = new Event($i, "Beth Hart", "http://bethhart.com", "", "20121121", "1", "1,2");
	//Existing
	$existingOne = getEventByDateAndLocation("20130101","1");

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