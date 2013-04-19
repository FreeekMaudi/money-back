<div id="readLocationsForPerson" style="display:none;">
	LOCATION FOR PERSON
	<br /><br />
<?php
	global $allPersons, $allLocations;
	getPersons();

	foreach ($allPersons as $person)
	{
		echo "Person: ".$person->get_name()."<br />";
		getEventsForPerson($person);
		setLocationsForPerson();

		foreach ($allLocations as $locationPerson) 
		{
			echo "id: ".$locationPerson->get_id();
			echo " - ";
			echo "Name: ".$locationPerson->get_name();
			echo " - ";
			echo "Url: ".$locationPerson->get_url();
			echo " - ";
			echo "Image: ".$locationPerson->get_image();
			echo "<br />";
			echo "AddressStreet: ".$locationPerson->get_addressStreet();
			echo " - ";
			echo "AddressNumber: ".$locationPerson->get_addressNumber();
			echo " - ";
			echo "AddressCity: ".$locationPerson->get_addressCity();
			echo " - ";
			echo "P AddressName: ".$locationPerson->get_pAddressName();
			echo " - ";
			echo "P AddressStreet: ".$locationPerson->get_pAddressStreet();
			echo " - ";
			echo "P AddressNumber: ".$locationPerson->get_addressStreet();
			echo "<br />";
			echo "Known by person: ".$locationPerson->get_knownByPerson();
			echo "<br /><br />";
		}
	}
?>
</div>