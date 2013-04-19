<?php
	global $selectedLocationId, $currentPersonName;

	$defaultName; $defaultUrl; $defaultImage;
	$defaultStreet; $defaultNumber; $defaultCity;
	$defaultPname; $defaultPstreet; $defaultPnumber;

	$actionUrl = $rootUrl.$currentPersonName;
	$formLegend = "Nieuwe";
	$formSubmit = "Toevoegen";

	if (!(is_null($selectedLocationId)))
	{
		$location = getLocationById($selectedLocationId);
		if (isset($location))
		{
			$locationId = $location->get_id();
			$defaultName = $location->get_name();
			$defaultUrl = $location->get_url();
			$defaultImage = $location->get_image();
			$defaultStreet = $location->get_addressStreet();
			$defaultNumber = $location ->get_addressNumber();
			$defaultCity = $location->get_addressCity();
			$defaultPname = $location->get_pAddressName();
			$defaultPstreet = $location->get_pAddressStreet();
			$defaultPnumber = $location->get_pAddressNumber();

			$actionUrl = $actionUrl."-L".$locationId;
			$formLegend = "Wijzig";
			$formSubmit = "Wijzigen";
		}
	}
?>
<form action=<?php echo '"'.$actionUrl.'"';?> method="post" enctype="multipart/form-data">
<input type='hidden' name='newLocation' value='newLocation'/>
<fieldset>
<legend><?php echo $formLegend; ?> locatie</legend>
<p><label>Naam</label><br /><input class="text" type="text" name="venue" value=<?php echo '"'.$defaultName.'"'; ?> />
<label>Site locatie</label><br /><input class="text" type="text" name="venue_url" value=<?php echo '"'.$defaultUrl.'"'; ?> />
<input type="hidden" name="MAX_FILE_SIZE" value="500000" />
<label>Plaatje</label><br /><input class="button" type="file" name="image" accept="image/gif, image/jpeg, image/png" value=<?php echo '"'.$defaultImage.'"'; ?> />
<label>Straat</label><br /><input class="text" type="text" name="street" value=<?php echo '"'.$defaultStreet.'"'; ?> />
<label>Nummer</label><br /><input class="text" type="text" name="number" value=<?php echo '"'.$defaultNumber.'"'; ?> />
<label>Plaats</label><br /><input class="text" type="text" name="city" value=<?php echo '"'.$defaultCity.'"'; ?> />
<label>P naam</label><br /><input class="text" type="text" name="p_name" value=<?php echo '"'.$defaultPname.'"'; ?> />
<label>P straat</label><br /><input class="text" type="text" name="p_street" value=<?php echo '"'.$defaultPstreet.'"'; ?> />
<label>P nummer</label><br /><input class="text" type="text" name="p_number" value=<?php echo '"'.$defaultPnumber.'"'; ?> /></p>
<p class="submit"><input class="button" type="submit" value=<?php echo '"'.$formSubmit.'"'; ?> /></p>
</fieldset>
</form>