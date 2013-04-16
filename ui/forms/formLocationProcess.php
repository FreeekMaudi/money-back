<?php

	$fileToUpload = $_FILES["image"];
	if (is_null($fileToUpload))
		$fileToUpload = $_FILES;

	global $allLocations, $msgLocation, $rootUrl, $currentPersonName;

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
		
		$outputSave = $newOne->save();
		
		if (gettype($outputSave) == "string")
		{
			$msgLocation = $outputSave;
		}

	}
	else
		$msgLocation = "Uploading image didn't succeed.";

	if ($msgLocation <> "")
		$msgLocation = "?msgLocation=".$msgLocation;

?>