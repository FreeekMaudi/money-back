<div id="readPersons" style="display:none;">
<?php
	global $allPersons;

	getPersons();

	foreach ($allPersons as $person)
	{
		echo "id: ".$person->get_id();
		echo " - ";
		echo "Name: ".$person->get_name();
		echo " - ";
		echo "Password: ".$person->get_password();
		echo " - ";
		echo "Persons: ".$person->getGroupPersonsNames()."(".$person->get_groupPersonsIds().")";
		echo "<br /><br />";
	}
?>
</div>