<?php
	//$locationsSorted = array_sort($allLocations, 'name', SORT_DESC);

	$locationsSorted = $allLocations;
	usort($locationsSorted, array('Location', '_cmpAscName'));

	foreach ($locationsSorted as $location)
	{
		echo $location->get_id().' - '.$location->get_name()."\n";
	}
?>