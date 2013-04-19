<?php

	global $allLocations, $msgLocation, $rootUrl, $currentPersonName, $selectedLocationId;

	if (is_null($selectedLocationId))
	{
		$fileToUpload = $_FILES["image"];
		if (is_null($fileToUpload))
			$fileToUpload = $_FILES;

		if (uploadFile($fileToUpload, '/img/locations/'))
		{
			readLocations();
			
			$i = count($allLocations) + 1;

			$image = $_FILES['image']['name'];
			if ($image == "")
				$image = "location.png";

			$newOne = new Location(
				$i, 
				$_POST["venue"], 
				$_POST["venue_url"], 
				$image, 
				$_POST["street"], $_POST["number"], $_POST["city"], 
				$_POST["p_name"], $_POST["p_street"], $_POST["p_number"]);
			
			$outputSave = $newOne->add();
			
			if (gettype($outputSave) == "string")
			{
				$msgLocation = $outputSave;
			}

		}
		else
			$msgLocation = "Uploading image didn't succeed.";
	}
	else
	{
		$existingLocation = getLocationById($selectedLocationId);

		$chgOne = new Location(
			$selectedLocationId,
			$_POST["venue"], 
			$_POST["venue_url"], 
			$existingLocation->get_image(), 
			$_POST["street"], $_POST["number"], $_POST["city"], 
			$_POST["p_name"], $_POST["p_street"], $_POST["p_number"]);

			$outputSave = $chgOne->update();

			if (gettype($outputSave) == "string")
			{
				$msgLocation = $outputSave;
			}
	}

	if ($msgLocation <> "")
		$msgLocation = "?msgLocation=".$msgLocation;

?>