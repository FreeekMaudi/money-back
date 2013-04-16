<div id="readTransactions" style="display:none;">
<?php
	global $transactionsPerson;
	$person1 = getPersonByName("Maudi");
	$person2 = getPersonById("2");
	$person3 = getPersonById("3");
	$person4 = getPersonById("4");

	$personsTransactions[0]=$person1;
	$personsTransactions[1]=$person2;
	$personsTransactions[2]=$person3;
	$personsTransactions[3]=$person4;

	echo "<br /><br />";

	foreach ($personsTransactions as $personTransactions)
	{
		$transactionsPerson = readTransactionsFromXMLForPerson($personTransactions);
		echo "Transactions for ".$personTransactions->get_name()."<br />";

		if (count($transactionsPerson) > 0)
		{
			foreach ($transactionsPerson as $transactionPerson)
			{
				echo "id: ".$transactionPerson->get_id();
				echo "<br />";
				echo "crd: ".$transactionPerson->get_personCRD()->get_name();
				echo " - ";
				echo "dbt: ".$transactionPerson->get_personDBT()->get_name();
				echo " - ";
				echo "Name: ".$transactionPerson->get_name();
				echo " - ";
				echo "Amount: ".$transactionPerson->get_amount();
				echo " - ";
				echo "<br />";
				echo "Date: ".$transactionPerson->get_date();
				echo " - ";
				echo "Event: ".$transactionPerson->get_event()->get_name()."(".$transactionPerson->get_event()->get_id().")";
				echo "<br /><br />";
			}
		}

		foreach ($personsTransactions as $oppositePerson)
		{
			if ($oppositePerson->get_name() <> $personTransactions->get_name())
			{
				echo "Clearing transactions: ".$personTransactions->get_name()." VS ".$oppositePerson->get_name()."<br />";
				$clearedAmount = getClearedAmount($transactionsPerson, $oppositePerson);
				if ($clearedAmount > 0)
					echo $personTransactions->get_name()." is ".$clearedAmount." richer<br />";
				else if ($clearedAmount < 0)
					echo $oppositePerson->get_name()." is ".($clearedAmount * -1)." poorer<br />";
				else
					echo $oppositePerson->get_name()." and you are even<br />";
			}
		}
		echo "<br /><br />";

	}
	
	echo $_SERVER['REQUEST_TIME'] ;
?>
</div>