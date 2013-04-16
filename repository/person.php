<?php

	function readPersonsFromXML()
	{
		global $rootUrl, $repositoryUrlPart;

		$persons;
		$doc = new DOMDocument();
		if ($doc->load($rootUrl.$repositoryUrlPart.'persons.xml'))
		{
			$xmlPersons = $doc->getElementsByTagName("person");
			
			foreach($xmlPersons as $xmlPerson)
			{
				$ids = $xmlPerson->getElementsByTagName("personId");
				$id = $ids->item(0)->nodeValue;

				$elements = $xmlPerson->getElementsByTagName("name");
				$name = $elements->item(0)->nodeValue;

				$elements = $xmlPerson->getElementsByTagName("password");
				$password = $elements->item(0)->nodeValue;
				
				$elements = $xmlPerson->getElementsByTagName("groupPersons");
				$groupPersonIds = $elements->item(0)->nodeValue;

				$persons[$id] = new Person($id, $name, $password, $groupPersonIds);
			}

			usort($persons, array('Person', '_cmpAscName'));
		}

		return $persons;
	}

	function writePersonsToXML()
	{
		global $repositoryUrlPart, $allPersons;
		usort($allPersons, array('Person', '_cmpAscId'));
		copy($repositoryUrlPart."persons.xml", $repositoryUrlPart."_history/".date("YmdGi")."persons.xml");

		$doc = new DOMDocument();
		$doc->formatOutput = true;

		$root = $doc->createElement("persons");
		$doc->appendChild($root);

		foreach($allPersons as $person)
		{
			$p = $doc->createElement("person");

			$id = $doc->createElement("personId");
			$id->appendChild($doc->createTextNode($person->get_id()));
			$p->appendChild($id);

			$element = $doc->createElement("name");
			$element->appendChild($doc->createTextNode($person->get_name()));
			$p->appendChild($element);

			$element = $doc->createElement("password");
			$element->appendChild($doc->createTextNode($person->get_password()));
			$p->appendChild($element);

			$element = $doc->createElement("groupPersons");
			$element->appendChild($doc->createTextNode($person->get_groupPersonsIds()));
			$p->appendChild($element);

			$root->appendChild($p);
		}
		
		$file_handle = fopen($repositoryUrlPart.'persons.xml','w'); 
		fwrite($file_handle,$doc->saveXML()); 
		fclose($file_handle);
	}
	
	function getPersons()
	{
		global $allPersons;
		
		if ($allPersons == null)
		{
			$allPersons = readPersonsFromXML();
			setGroupPersons();
		}
		
	}

	function setGroupPersons()
	{
		global $allPersons;

		foreach ($allPersons as $person)
		{
			$person->setGroupPersons();
		}
	}

	function savePersons()
	{
		writePersonsToXML();
	}

	function personNameDoesNotExist($newName)
	{
		global $allPersons;
		foreach ($allPersons as $existingPerson)
		{
			if ($existingPerson->get_name() == $newName)
				return false;
		}
		return true;
	}
	
	function getPersonById($idToSearch)
	{
		global $allPersons;
		getPersons();
		
		foreach ($allPersons as $existingPerson)
		{
			if ($existingPerson->get_id() == $idToSearch)
				return $existingPerson;
		}
		return null;
	}
	
	function getPersonByName($nameToSearch)
	{
		global $allPersons;
		getPersons();
		
		foreach ($allPersons as $existingPerson)
		{
			if ($existingPerson->get_name() == $nameToSearch)
				return $existingPerson;
		}
		return null;
	}
	
	function getPersonsWithIdsString($idsString)
	{
		$personsFound;
		$personIds = explode(',', $idsString);
		foreach ($personIds as $personId)
		{
			$personsFound[$personId] = getPersonById($personId);
		}
		usort($personsFound, array('Person', '_cmpAscName'));

		return $personsFound;
	}
	
?>