<div id="readEventsForPerson" style="display:none;">
<?php
	global $allPersons, $eventsForPerson;
	getPersons();

	foreach ($allPersons as $person)
	{
		echo "Person: ".$person->get_name()."<br />";
		getEventsForPerson($person);

		foreach ($eventsForPerson as $eventPerson) 
		{
			echo "id: ".$eventPerson->get_id();
			echo " - ";
			echo "Name: ".$eventPerson->get_name();
			echo " - ";
			echo "Url: ".$eventPerson->get_url();
			echo " - ";
			echo "Image: ".$eventPerson->get_image();
			echo " - ";
			echo "Date: ".$eventPerson->get_date();
			echo " - ";
			echo "Location: ".$eventPerson->getLocationName();
			echo " - ";
			echo "Persons: ".$eventPerson->getPersonsNames()."(".$eventPerson->getPersonsIdsString().")";
			echo "<br /><br />";
		}
	}
?>
</div>