<div id="readEvents" style="display:none;">
<?php
	global $allEvents;
	getEvents();

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
		echo "<br /><br />";
	}
?>
</div>