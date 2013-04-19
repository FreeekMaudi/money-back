<div id="readEvents" style="display:none;">
	EVENT
	<br /><br />
<?php
	global $allEvents;
	getEvents();
	setNextEvent();

	foreach ($allEvents as $event)
	{
		echo "id: ".$event->get_id();
		echo "<br />";
		echo "Name: ".$event->get_name();
		echo " - ";
		echo "Url: ".$event->get_url();
		echo " - ";
		echo "Image: ".$event->get_image();
		echo " - ";
		echo "Date: ".$event->get_date();
		echo "<br />";
		echo "Location: ".$event->getLocationName();
		echo " - ";
		echo "Persons: ".$event->getPersonsNames()."(".$event->getPersonsIdsString().")";
		echo " - ";
		echo "isNext: ".$event->get_isNext();
		echo "<br /><br />";
	}
?>
</div>