<?php

	function readLocationsFromXML()
	{
		global $rootUrl, $repositoryUrlPart;

		$locations;
		$doc = new DOMDocument();
		$doc->load($rootUrl.$repositoryUrlPart.'locations.xml');
		$xmlLocations = $doc->getElementsByTagName("location");
		
		foreach($xmlLocations as $xmlLocation)
		{
			$ids = $xmlLocation->getElementsByTagName("locationId");
			$id = $ids->item(0)->nodeValue;

			$elements = $xmlLocation->getElementsByTagName("venue");
			$name = $elements->item(0)->nodeValue;

			$elements = $xmlLocation->getElementsByTagName("venue_url");
			$url = $elements->item(0)->nodeValue;
			
			$elements = $xmlLocation->getElementsByTagName("venue_img");
			$image = $elements->item(0)->nodeValue;

			$adress = $xmlLocation->getElementsByTagName("address");
			$aNode = $adress->item(0);
			$aAttrNode = $aNode->getAttributeNode("street");
			$aStreet = $aAttrNode->value;
			$aAttrNode = $aNode->getAttributeNode("number");
			$aNumber = $aAttrNode->value;
			$aAttrNode = $aNode->getAttributeNode("city");
			$aCity = $aAttrNode->value;

			$p_adress = $xmlLocation->getElementsByTagName("P_address");
			$paNode = $p_adress->item(0);
			$paAttrNode = $paNode->getAttributeNode("name");
			$paName = $paAttrNode->value;
			$paAttrNode = $paNode->getAttributeNode("street");
			$paStreet = $paAttrNode->value;
			$paAttrNode = $paNode->getAttributeNode("number");
			$paNumber = $paAttrNode->value;

			$locations[$id] = new Location($id, $name, $url, $image, $aStreet, $aNumber, $aCity, $paName, $paStreet, $paNumber);
		}

		usort($locations, array('Location', '_cmpAscName'));
		return $locations;
		
	}

	function writeLocationsToXML()
	{
		global $repositoryUrlPart, $allLocations;
		usort($allLocations, array('Location', '_cmpAscName'));
		copy($repositoryUrlPart."locations.xml", $repositoryUrlPart."_history/".date("YmdGi")."locations.xml");

		$doc = new DOMDocument();
		$doc->formatOutput = true;

		$root = $doc->createElement("locations");
		$doc->appendChild($root);

		foreach($allLocations as $location)
		{
			$loc = $doc->createElement("location");

			$id = $doc->createElement("locationId");
			$id->appendChild($doc->createTextNode($location->get_id()));
			$loc->appendChild($id);

			$element = $doc->createElement("venue");
			$element->appendChild($doc->createTextNode($location->get_name()));
			$loc->appendChild($element);

			$element = $doc->createElement("venue_url");
			$element->appendChild($doc->createTextNode($location->get_url()));
			$loc->appendChild($element);

			$element = $doc->createElement("venue_img");
			$element->appendChild($doc->createTextNode($location->get_image()));
			$loc->appendChild($element);

			$element = $doc->createElement("address");
			$loc->appendChild($element);
			
			$attribute = $doc->createAttribute('street');
			$element->appendChild($attribute);
			$attributeText = $doc->createTextNode($location->get_addressStreet());
			$attribute->appendChild($attributeText);

			$attribute = $doc->createAttribute('number');
			$element->appendChild($attribute);
			$attributeText = $doc->createTextNode($location->get_addressNumber());
			$attribute->appendChild($attributeText);

			$attribute = $doc->createAttribute('city');
			$element->appendChild($attribute);
			$attributeText = $doc->createTextNode($location->get_addressCity());
			$attribute->appendChild($attributeText);

			$element = $doc->createElement("P_address");
			$loc->appendChild($element);
			
			$attribute = $doc->createAttribute('name');
			$element->appendChild($attribute);
			$attributeText = $doc->createTextNode($location->get_pAddressName());
			$attribute->appendChild($attributeText);

			$attribute = $doc->createAttribute('street');
			$element->appendChild($attribute);
			$attributeText = $doc->createTextNode($location->get_pAddressStreet());
			$attribute->appendChild($attributeText);

			$attribute = $doc->createAttribute('number');
			$element->appendChild($attribute);
			$attributeText = $doc->createTextNode($location->get_pAddressNumber());
			$attribute->appendChild($attributeText);

			$root->appendChild($loc);
			
		}
		
		$file_handle = fopen($repositoryUrlPart.'locations.xml','w'); 
		fwrite($file_handle,$doc->saveXML()); 
		fclose($file_handle);
	}
	
	function getLocations()
	{
		global $allLocations;
		
		if ($allLocations == null)
			$allLocations = readLocationsFromXML();
		
	}

	function readLocations()
	{
		global $allLocations;
		
		$allLocations = readLocationsFromXML();
		
	}

	function saveLocations()
	{
		writeLocationsToXML();
	}

	function getLocationsForPerson()
	{
		global $eventsForPerson, $locationsPerson;
		
		foreach ($eventsForPerson as $eventPerson)
		{
			if (!isset($locationsPerson[$eventPerson->getLocationId()]))
			{
				$locationsPerson[$eventPerson->getLocationId()] = $eventPerson->get_location();
			}
		}
	}

	function locationNameDoesNotExist($newName)
	{
		global $allLocations;
		getLocations();

		foreach ($allLocations as $existingLocation)
		{
			if ($existingLocation->get_name() == $newName)
				return false;
		}
		return true;
	}
	
	function getLocationById($idToSearch)
	{
		global $allLocations;
		getLocations();
		
		foreach ($allLocations as $existingLocation)
		{
			if ($existingLocation->get_id() == $idToSearch)
				return $existingLocation;
		}
		return null;
	}

	function getLocationByName($nameToSearch)
	{
		global $allLocations;
		getLocations();
		
		foreach ($allLocations as $existingLocation)
		{
			if ($existingLocation->get_name() == $nameToSearch)
				return $existingLocation;
		}
		return null;
	}
?>