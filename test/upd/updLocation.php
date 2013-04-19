<div id="updLocation" style="display:block;">
	LOCATION
	<br /><br />
<?php
	
	//Non-Existing
	//$oldOne = new Location(0, "Fake", "http://bethhart.com", "", "", "", "", "", "", "");
	//Existing
	$existingOne = getLocationByName("Fake");

	if ($existingOne != null)
	{
		if ($existingOne->get_url() == "Fake-url")
			$url = "Fake-url-CHANGED";
		else
			$url = "Fake-url";

		$existingOne = new Location(
			$existingOne->get_id(),
			$existingOne->get_name(),
			$url,
			$existingOne->get_image(),
			$existingOne->get_addressStreet,
			$existingOne->get_addressNumber(),
			$existingOne->get_addressCity(),
			$existingOne->get_pAddressName(),
			$existingOne->get_pAddressStreet(),
			$existingOne->get_pAddressNumber(),
			$existingOne->get_knownByPerson()
			);


		$outputSave = $existingOne->update();
		
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