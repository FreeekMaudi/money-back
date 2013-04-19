<div id="readLocations" style="display:none;">
	LOCATION
	<br /><br />
<?php
	global $allLocations;
	getLocations();

	foreach ($allLocations as $location)
	{
		echo "id: ".$location->get_id();
		echo "<br />";
		echo "Name: ".$location->get_name();
		echo " - ";
		echo "Url: ".$location->get_url();
		echo " - ";
		echo "Image: ".$location->get_image();
		echo " - ";
		echo "Address street: ".$location->get_addressStreet();
		echo " - ";
		echo "Address number: ".$location->get_addressNumber();
		echo " - ";
		echo "Address city: ".$location->get_addressCity();
		echo " - ";
		echo "P Name: ".$location->get_pAddressName();
		echo " - ";
		echo "P Address street: ".$location->get_pAddressStreet();
		echo " - ";
		echo "P Address number: ".$location->get_pAddressNumber();
		echo "<br /><br />";
	}
?>
</div>