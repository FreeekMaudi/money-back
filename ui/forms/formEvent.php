<?php
	global $currentPerson
?>
<form action="<?php echo $PHP_SELF;?>" method="post" enctype="multipart/form-data">
<input type='hidden' name='newEvent' value='newEvent'/>
<fieldset>
<legend>Nieuw concert</legend>
<p><label>Artiest</label><br /><input class="text" type="text" name="artist" />
<label>Site artiest</label><br /><input class="text" type="text" name="artist_url" />
<label>Datum (YYYYMMDD)</label><br /><input class="text" type="text" name="date" />
<input type="hidden" name="MAX_FILE_SIZE" value="500000" />
<label>Plaatje</label><br /><input class="button" type="file" name="image" accept="image/gif, image/jpeg, image/png" />
<label>@</label><br />
<select name="location">
<?php
	$locationsSorted = $allLocations;
	foreach ($locationsSorted as $location)
	{
		echo '<option value="'.$location->get_id().'">'.$location->get_name().'</option>'."\n";
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
	 		echo '<option value="'.$person->get_id().'">'.$person->get_name().'</option>'."\n";
	}
?>
</select>
</p>
<p class="submit"><input class="button" type="submit" value="Toevoegen" /></p>
</fieldset>
</form>