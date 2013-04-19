<div id="updEvent" style="display:block;">
	EVENT
	<br /><br />
<?php

	//Non-Existing
	//$oldOne = new Event($i, "Beth Hart", "http://bethhart.com", "", "20121121", "1", "1,2");
	//Existing
	$locationFound = getLocationByName("Fake");
	$existingOne = getEventByDateAndLocation("20130101", $locationFound->get_id());

	if ($existingOne != null)
	{
		if ($existingOne->get_name() == "FAKE")
			$name = "FAKE-CHANGED";
		else
			$name = "FAKE";

		$existingOne = new Event(
			$existingOne->get_id(),
			$name,
			$existingOne->get_url(),
			$existingOne->get_image(),
			$existingOne->get_date(),
			$existingOne->get_location(),
			$existingOne->get_persons()
			);

		$outputSave = $existingOne->update();
		
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