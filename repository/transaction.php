<?php

	function readTransactionsFromXMLForPersons($personForXML, $versusPerson)
	{
		global $rootUrl, $repositoryUrlPart;

 		if (gettype($personForXML) == "string")
			$personForXMLName = $personForXML;
		else
			$personForXMLName = $personForXML->get_name();
			
		if (gettype($versusPerson) == "string")
			$versusPersonId = $versusPerson;
		else
			$versusPersonId = $versusPerson->get_id();

		$transactions;
		$doc = new DOMDocument();
		$doc->load($rootUrl.$repositoryUrlPart.$personForXMLName.'/transactions.xml');
		$xmlTransactions = $doc->getElementsByTagName("transaction");
		
		foreach($xmlTransactions as $xmlTransaction)
		{
			$ids = $xmlTransaction->getElementsByTagName("transactionId");
			$id = $ids->item(0)->nodeValue;

			$elements = $xmlTransaction->getElementsByTagName("amount");
			$amount = $elements->item(0)->nodeValue;

			if ($amount > 0)
			{
				$elements = $xmlTransaction->getElementsByTagName("crd");
				$crd = $elements->item(0)->nodeValue;
				
				$elements = $xmlTransaction->getElementsByTagName("dbt");
				$dbt = $elements->item(0)->nodeValue;
				
				if ($crd == $versusPersonId || $dbt == $versusPersonId)
				{

					$elements = $xmlTransaction->getElementsByTagName("name");
					$name = $elements->item(0)->nodeValue;
					
					$elements = $xmlTransaction->getElementsByTagName("date");
					$date = $elements->item(0)->nodeValue;
					
					$elements = $xmlTransaction->getElementsByTagName("event_id");
					$eventId = $elements->item(0)->nodeValue;
					$event = getEventById($eventId);
					
					$transactions[$id] = new Transaction($id, $crd, $dbt, $name, $amount, $date, $event);
				}
			}
		}
		if (count($transactions) > 0)
		{
			usort($transactions, array('Transaction', '_cmpDescDateEvent'));
			usort($transactions, array('Transaction', '_cmpDescDate'));
		}
		return $transactions;
	}

	function writeTransactionsToXML($personToXML)
	{
		global $repositoryUrlPart, $transactionsPerson;
		$personDir = $personToXML->get_name().'/';
		copy($repositoryUrlPart.$personDir."transactions.xml", $repositoryUrlPart."/_history/".$personDir.date("YmdGi")."transactions.xml");
		
		$file_handle = fopen($repositoryUrlPart.$personDir.'transactions.xml','w'); 

		$doc = new DOMDocument();
		$doc->formatOutput = true;

		$root = $doc->createElement("transactions");
		$doc->appendChild($root);

		foreach($transactionsPerson as $transactionPerson)
		{
			$t = $doc->createElement("transaction");

			$id = $doc->createElement("transactionId");
			$id->appendChild($doc->createTextNode($transactionPerson->get_id()));
			$t->appendChild($id);

			$element = $doc->createElement("crd");
			$element->appendChild($doc->createTextNode($transactionPerson->get_personCRD()->get_id()));
			$t->appendChild($element);

			$element = $doc->createElement("dbt");
			$element->appendChild($doc->createTextNode($transactionPerson->get_personDBT()->get_id()));
			$t->appendChild($element);

			$element = $doc->createElement("name");
			$element->appendChild($doc->createTextNode($transactionPerson->get_name()));
			$t->appendChild($element);

			$element = $doc->createElement("amount");
			$element->appendChild($doc->createTextNode($transactionPerson->get_amount()));
			$t->appendChild($element);

			$element = $doc->createElement("date");
			$element->appendChild($doc->createTextNode($transactionPerson->get_date()));
			$t->appendChild($element);

			$element = $doc->createElement("event_id");
			$element->appendChild($doc->createTextNode($transactionPerson->get_event()->get_id()));
			$t->appendChild($element);

			$root->appendChild($t);
		}
		
		$file_handle = fopen($repositoryUrlPart.$personDir.'transactions.xml','w'); 
		fwrite($file_handle,$doc->saveXML()); 
		fclose($file_handle);
		
	}
	
	function readTransactionsFromXMLForPerson($personForXML)
	{
		global $rootUrl, $repositoryUrlPart;

 		if (gettype($personForXML) == "string")
			$personForXMLName = $personForXML;
		else
			$personForXMLName = $personForXML->get_name();
			
		$transactions;
		$doc = new DOMDocument();
		$doc->load($rootUrl.$repositoryUrlPart.$personForXMLName.'/transactions.xml');
		$xmlTransactions = $doc->getElementsByTagName("transaction");

		foreach($xmlTransactions as $xmlTransaction)
		{
			$ids = $xmlTransaction->getElementsByTagName("transactionId");
			$id = $ids->item(0)->nodeValue;

			$elements = $xmlTransaction->getElementsByTagName("amount");
			$amount = $elements->item(0)->nodeValue;

			if ($amount > 0)
			{
				$elements = $xmlTransaction->getElementsByTagName("crd");
				$crd = $elements->item(0)->nodeValue;
				
				$elements = $xmlTransaction->getElementsByTagName("dbt");
				$dbt = $elements->item(0)->nodeValue;
				
				$elements = $xmlTransaction->getElementsByTagName("name");
				$name = $elements->item(0)->nodeValue;
				
				$elements = $xmlTransaction->getElementsByTagName("date");
				$date = $elements->item(0)->nodeValue;
				
				$elements = $xmlTransaction->getElementsByTagName("event_id");
				$eventId = $elements->item(0)->nodeValue;
				$event = getEventById($eventId);
				
				$transactions[$id] = new Transaction($id, $crd, $dbt, $name, $amount, $date, $event);
				$counter++;
			}
		}

		if (count($transactions) > 0)
		{
			usort($transactions, array('Transaction', '_cmpDescDateEvent'));
			usort($transactions, array('Transaction', '_cmpDescDate'));
		}
		
		return $transactions;
	}

	function getTransactionsForPerson()
	{
		global $currentPerson, $transactionsPerson;
		
		if ($transactionsPerson != null)
			$transactionsPerson = readTransactionsFromXMLForPerson($currentPerson);
		
	}

	function getTransactionsForPersons()
	{
		global $currentPerson, $oppositePerson, $transactionsPersons;
		
		if ($transactionsPersons != null)
			$transactionsPersons = readTransactionsFromXMLForPersons($currentPerson, $oppositePerson);
		
	}
	
	function getTransactionsForPersonsWithEventId($eventId)
	{
		global $currentPerson, $oppositePerson, $transactionsPersons;
		
		if ($transactionsPersons == null)
			$transactionsPersons = readTransactionsFromXMLForPersons($currentPerson, $oppositePerson);
			
		$transactionsPersonsEvent = null;
		if ($transactionsPersons != null)
		{
			foreach ($transactionsPersons as $transactionPerson)
			{
				if ($transactionPerson->get_event()->get_id() == $eventId)
					$transactionsPersonsEvent[$transactionPerson->get_id()] = $transactionPerson;
			}
		}
		
		return $transactionsPersonsEvent;
	}
	
	function getClearedAmount($transactionsToClear, $forPerson)
	{
		$totalAmountForPerson = 0;
		if (count($transactionsToClear) == 0)
			return $totalAmountForPerson;
			
		foreach ($transactionsToClear as $transactionToClear)
		{
			$amount = explode(",", $transactionToClear->get_amount());
			if ($forPerson->get_name() == $transactionToClear->get_personCRD()->get_name())
				$totalAmountForPerson += (($amount[0] * 100 + $amount[1]) / 100);
			else if ($forPerson->get_name() == $transactionToClear->get_personDBT()->get_name())
				$totalAmountForPerson -= (($amount[0] * 100 + $amount[1]) / 100);
			else
				;
		}

		return $totalAmountForPerson;
	}

?>