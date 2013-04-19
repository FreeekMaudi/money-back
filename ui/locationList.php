<?php
	// Locations
	global $allLocations, $logged_in;
	getLocations();

	echo '<div class="locationList">'."\n";
	echo "\t".'<span class="header">Locaties</span>'."\n";
	echo "\t".'<br />'."\n";

	foreach ($allLocations as $location)
	{
		include('locationInfo.php');
	}
	echo '</div>'."\n";	
?>