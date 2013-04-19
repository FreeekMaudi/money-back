<?php

	global $logged_in, $currentPerson;

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
	$thisKnownByPerson = $location->get_knownByPerson();

	$cssClass = "";
	if ($thisKnownByPerson)
		$cssClass = ' class="known"';

	echo "\t".'<a href="#" onclick="toggle_visibility(&#039;location'.$thisId.'&#039;);"'.$cssClass.'>'.$thisName.'</a>'."\n";

	if ($thisKnownByPerson)
	{
		echo '<a href="'.$currentPerson->get_name().'-L'.$thisId.'" onmouseover="roll_over(&#039;chgImgL'.$thisId.'&#039;, &#039;img/chg_mo.png&#039;)" onmouseout="roll_over(&#039;chgImgL'.$thisId.'&#039;, &#039;img/chg.png&#039;)">'."\n";
		echo '<img src="img/chg.png" name="chgImgL'.$thisId.'" height="15px" alt="Locatie wijzigen" title="Locatie wijzigen" border="0" /></a>'."\n";	
	}

	echo "\t".'<div id="location'.$thisId.'" style="display:none;">'."\n";
	echo "\t\t".'<a href="'.$thisUrl.'" target="_blank" alt="'.$thisName.'" title="'.$thisName.'">'."\n";
	echo "\t\t".'<img src="img/locations/'.$thisImage.'" width="100px" border="0" /></a><br />'."\n";
	echo "\t\t".$thisAddressStreet.' '.$thisAddressNumber.' '.$thisAddressCity.'<br />'."\n";
	if ($thisPAddressName <> "")
		echo "\t\t".'P: '.$thisPAddressName.' '.$thisPAddressStreet.' '.$thisPAddressNumber.'<br />'."\n";
	echo "\t".'</div>'."\n";
?>