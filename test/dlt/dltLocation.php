<div id="dltLocation" style="display:block;">
	dltLocation
<?php
	
	//Non-Existing
	//$oldOne = new Location(0, "Fake", "http://bethhart.com", "", "", "", "", "", "", "");
	//Existing
	$existingOne = getLocationByName("Fake");

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
		echo "Location does not exist, could not be found";
	}

?>
</div>