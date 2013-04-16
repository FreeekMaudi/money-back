<div id="newPerson" style="display:none;">
<?php
	$i = count($allPersons) + 1;

	$newOne = new Person($i, "Someone", "none");
	$outputSave = $newOne->save();
	
	if (gettype($outputSave) == "string")
	{
		echo $outputSave;
	}
?>
</div>