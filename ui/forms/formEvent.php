<?php
	global $selectedEventId, $currentPerson;

	$defaultName; $defaultUrl; $defaultImage;
	$defaultDate; $defaultLocation; $defaultPersons;

	$actionUrl = $rootUrl.$currentPerson->get_name();
	$formLegend = "Nieuw";
	$formSubmit = "Toevoegen";

	if (!(is_null($selectedEventId)))
	{
		$event = getEventById($selectedEventId);
		if (isset($event))
		{
			$eventId = $event->get_id();
			$defaultName = $event->get_name();
			$defaultUrl = $event->get_url();
			$defaultImage = $event->get_image();
			$defaultDate = $event->get_date();
			$defaultLocation = $event ->get_location();
			$defaultPersons = $event->get_persons();

			$actionUrl = $actionUrl."-E".$eventId;
			$formLegend = "Wijzig";
			$formSubmit = "Wijzigen";
		}
	}
?>
<form action=<?php echo '"'.$actionUrl.'"';?> method="post" enctype="multipart/form-data">
<input type='hidden' name='newEvent' value='newEvent'/>
<fieldset>
<legend><?php echo $formLegend; ?> event</legend>
<p><label>Wie/Wat</label><br /><input class="text" type="text" name="artist" value=<?php echo '"'.$defaultName.'"'; ?> />
<label>Site</label><br /><input class="text" type="text" name="artist_url" value=<?php echo '"'.$defaultUrl.'"'; ?> />
<label>Datum (YYYYMMDD)</label><br /><input class="text" type="text" name="date" value=<?php echo '"'.$defaultDate.'"'; ?> />
<input type="hidden" name="MAX_FILE_SIZE" value="500000" />
<label>Plaatje</label><br /><input class="button" type="file" name="image" accept="image/gif, image/jpeg, image/png" value=<?php echo '"'.$defaultImage.'"'; ?> />
<label>@</label><br />
<select name="location">
<?php
	$locationsSorted = $allLocations;
	foreach ($locationsSorted as $location)
	{
		$locationSelected ="";
		if (isset($event) && $location->get_id() == $defaultLocation->get_id())
			$locationSelected = " selected";
		echo '<option'.$locationSelected.' value="'.$location->get_id().'">'.$location->get_name().'</option>'."\n";
	}
?>
</select>
<label>Met</label><br />
<select multiple name="persons[]">
<?php
	$personsSorted = $allPersons;
	foreach ($personsSorted as $person) 
	{
		if ($currentPerson->get_id() <> $person->get_id())
		{
			$personSelected = "";
			if (isset($event) && $event->doesPersonGo($person))
				$personSelected = " selected";
	 		echo '<option'.$personSelected.' value="'.$person->get_id().'">'.$person->get_name().'</option>'."\n";
		}
	}
?>
</select>
</p>
<p class="submit"><input class="button" type="submit" value=<?php echo '"'.$formSubmit.'"'; ?> /></p>
</fieldset>
</form>