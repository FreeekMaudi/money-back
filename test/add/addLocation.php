<div id="addLocation" style="display:block;">
	LOCATION
	<br />
<?php
	$i = count($allLocations) + 1;

	// Existing
	//$newOne = new Location(0, "Tivoli", "http://www.maudi.nl", "tivoli.png", "Musicallan", "453", "Utrecht", "Eronder", "Musicallaan", "241");
	// Non-Existing
	$newOne = new Location($i, "Fake", "http://www.maudi.nl", "tivoli.png", "Musicallan", "453", "Utrecht", "Eronder", "Musicallaan", "241");

	$outputSave = $newOne->add();
	
	if (gettype($outputSave) == "string")
	{
		echo $outputSave;
	}
?>
</div>