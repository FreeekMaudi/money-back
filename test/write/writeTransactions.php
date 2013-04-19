<div id="writeTransactions" style="display:none;">
	TRANSACTION
	<br /><br />
<?php

	global $transactionsPerson;

	$person = getPersonByName("Maudi");
	$transactionsPerson = readTransactionsFromXMLForPerson($person);
	writeTransactionsToXML($person);

	$count = count($transactionsPerson);
	echo $count." transactions read and written";
?>
</div>