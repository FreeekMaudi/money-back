<div id="writeTransactions" style="display:none;">
<?php

	global $transactionsPerson;

	$person = getPersonByName("Maudi");
	$transactionsPerson = readTransactionsFromXMLForPerson($person);
	writeTransactionsToXML($person);

	$count = count($transactionsPerson);
	echo $count." transactions read and written";
?>
</div>