<?php

	global $allEvents, $msgEvent, $rootUrl, $currentPerson, $selectedEventId;

	if (is_null($selectedEventId))
	{
		$fileToUpload = $_FILES["image"];
		if (is_null($fileToUpload))
			$fileToUpload = $_FILES;

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
			
			$outputSave = $newOne->add();
			
			if (gettype($outputSave) == "string")
			{
				$msgEvent = $outputSave;
			}
		}
		else
			$msgEvent = "Uploading image didn't succeed.";
	}
	else
	{
		$existingEvent = getEventById($selectedEventId);

		$personIds = "";
		if (isset($_POST["persons"]))
		{
			foreach ($_POST["persons"] as $selectedPerson)
				$personIds = $personIds.$selectedPerson.",";
		}
		$personIds = $personIds.$currentPerson->get_id();


		$chgOne = new Event(
			$selectedEventId,
			$_POST["artist"], 
			$_POST["artist_url"], 
			$existingEvent->get_image(), 
			$_POST["date"], 
			$_POST["location"], 
			$personIds);

			$outputSave = $chgOne->update();

			if (gettype($outputSave) == "string")
			{
				$msgLocation = $outputSave;
			}
	}

	if ($msgEvent <> "")
		$msgEvent = "?msgEvent=".$msgEvent;

?>