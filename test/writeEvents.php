<div id="writeEvents" style="display:none;">
<?php

	global $allEvents;

	getEvents();

	echo "<br />".count($allEvents)." events read.";
	saveEvents();
	echo "<br />".count($allEvents)." events written.";

	$count = count($allEvents);
	echo "<br />".$count." events read and written.";

?>
</div>