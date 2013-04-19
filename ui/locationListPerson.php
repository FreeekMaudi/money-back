<?php
	// Locations

	global $locationsForPerson;

	setLocationsForPerson();
	
	echo '<div class="locationList">'."\n";
	echo "\t".'<span class="header">Locaties</span>'."\n";
	echo '<a href="#" onclick="toggle_visibility(&#039;formLocation&#039;);" onmouseover="roll_over(&#039;addImgL&#039;, &#039;img/add_mo.png&#039;)" onmouseout="roll_over(&#039;addImgL&#039;, &#039;img/add.png&#039;)">'."\n";
	echo '<img src="img/add.png" name="addImgL" height="25px" alt="Locatie toevoegen" title="Locatie toevoegen" border="0" /></a>'."\n";
	echo "\t".'<br />'."\n";

	foreach ($locationsForPerson as $location)
	{
		include('locationInfo.php');
	}
	echo '</div>'."\n";	
?>