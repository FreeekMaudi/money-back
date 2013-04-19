<div id="newTransaction" style="display:none;">
	TRANSACTION
	<br />
<?php
	global $currentPerson;
	$currentPerson = getPersonById("1");

	$i = $_SERVER['REQUEST_TIME'];
	
	$person2 = getPersonById("2");
	
	$newOne = new Transaction($i, $currentPerson, $person2, "zomaar", "30,33", "20120510", "1");
	//$newOne = new Event($i, "Happy BirthDay", "http://www.maudi.nl/money-back-dev/", "", "20120727", "1", $newOnePersons);
	
	$outputSave = $newOne->save();
	
	if (gettype($outputSave) == "string")
	{
		echo $outputSave;
	}
	else
	{
		echo "<br />YEAH!!!!<br />";
	}
?>
</div>