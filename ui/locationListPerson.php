<?php
	// Locations
	global $locationsPerson;
	
	echo '<div class="locationList">'."\n";
	echo "\t".'<span class="header">Locaties</span>'."\n";
	echo '<a href="#" onclick="toggle_visibility(&#039;formLocation&#039;);" onmouseover="roll_over(&#039;addImgL&#039;, &#039;img/add_mo.png&#039;)" onmouseout="roll_over(&#039;addImgL&#039;, &#039;img/add.png&#039;)">'."\n";
	echo '<img src="img/add.png" name="addImgL" height="25px" alt="Locatie toevoegen" title="Locatie toevoegen" border="0" /></a>'."\n";
	echo "\t".'<br />'."\n";

	foreach ($locationsPerson as $location)
	{
		$thisId = $location->get_id();
		$thisName = $location->get_name();
		$thisUrl = $location->get_url();
		$thisImage = $location->get_image();
		$thisAddressStreet = $location->get_addressStreet();
		$thisAddressNumber = $location ->get_addressNumber();
		$thisAddressCity = $location->get_addressCity();
		$thisPAddressName = $location->get_pAddressName();
		$thisPAddressStreet = $location->get_pAddressStreet();
		$thisPAddressNumber = $location->get_pAddressNumber();
		
		echo "\t".'<a href="#" onclick="toggle_visibility(&#039;location'.$thisId.'&#039;);">'.$thisName.'</a>'."\n";
		echo "\t".'<div id="location'.$thisId.'" style="display:none;">'."\n";
		echo "\t\t".'<a href="'.$thisUrl.'" target="_blank" alt="'.$thisName.'" title="'.$thisName.'">'."\n";
		echo "\t\t".'<img src="img/locations/'.$thisImage.'" width="100px" border="0" /></a><br />'."\n";
		echo "\t\t".$thisAddressStreet.' '.$thisAddressNumber.' '.$thisAddressCity.'<br />'."\n";
		if ($thisPAddressName <> "")
			echo "\t\t".'P: '.$thisPAddressName.' '.$thisPAddressStreet.' '.$thisPAddressNumber.'<br />'."\n";
		echo "\t".'</div>'."\n";
	}

	echo '<div id="formLocation" style="display:none;">'."\n";
	include("ui/forms/formLocation.php");
	echo '</div>'."\n";

	echo '</div>'."\n";	
?>