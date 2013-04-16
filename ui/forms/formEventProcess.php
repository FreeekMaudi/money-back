<?php

	$fileToUpload = $_FILES["image"];
	if (is_null($fileToUpload))
		$fileToUpload = $_FILES;

	global $allEvents, $msgEvent, $currentPerson;
	
	if (uploadFile($fileToUpload, '/img/events/'))
	{
		readEvents();

		$i = count($allEvents) + 1;

		$image = $_FILES['image']['name'];
		if ($image == "")
			$image = "event.png";
		$personIds = "";
		if (isset($_POST["persons"]))
		{
			foreach ($_POST["persons"] as $selectedPerson)
				$personIds = $personIds.$selectedPerson.",";
		}
		$personIds = $personIds.$currentPerson->get_id();

		$newOne = new Event(
			$i, 
			$_POST["artist"], 
			$_POST["artist_url"], 
			$image, 
			$_POST["date"], 
			$_POST["location"],
			$personIds);
		
		$outputSave = $newOne->save();
		
		if (gettype($outputSave) == "string")
		{
			$msgEvent = $outputSave;
		}
	}
	else
		$msgEvent = "Uploading image didn't succeed.";

	if ($msgEvent <> "")
		$msgEvent = "?msgEvent=".$msgEvent;

?>