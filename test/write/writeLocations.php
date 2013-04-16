<div id="writeLocations" style="display:none;">
<?php

	global $allLocations;

	getLocations();

	echo "<br />".count($allLocations)." locations read.";
	saveLocations();
	echo "<br />".count($allLocations)." locations written.";

	$count = count($allLocations);
	echo "<br />".$count." locations read and written.";

?>
</div>