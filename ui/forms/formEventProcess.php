<?php

	$fileToUpload = $_FILES["image"];
	if (is_null($fileToUpload))
		$fileToUpload = $_FILES;

	global $allEvents, $msgEvent, $currentPerson;
	
	if (uploadFile($fileToUpload, '/img/events/'))
	{
		readEvents();

		$i = count($allEvents) + 1;

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
			$_FILES['image']['name'], 
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