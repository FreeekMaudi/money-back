<?php

	function readEventsFromXML()
	{
		global $rootUrl, $repositoryUrlPart;

		$events;
		$doc = new DOMDocument();
		$doc->load($rootUrl.$repositoryUrlPart.'events.xml');
		$xmlEvents = $doc->getElementsByTagName("event");

		foreach($xmlEvents as $xmlEvent)
		{
			$ids = $xmlEvent->getElementsByTagName("eventId");
			$id = $ids->item(0)->nodeValue;

			$elements = $xmlEvent->getElementsByTagName("name");
			$name = $elements->item(0)->nodeValue;

			$elements = $xmlEvent->getElementsByTagName("url");
			$url = $elements->item(0)->nodeValue;
			
			$elements = $xmlEvent->getElementsByTagName("image");
			$image = $elements->item(0)->nodeValue;

			$elements = $xmlEvent->getElementsByTagName("date");
			$date = $elements->item(0)->nodeValue;
			
			$elements = $xmlEvent->getElementsByTagName("locationId");
			$locationId = $elements->item(0)->nodeValue;
			$location = getLocationById($locationId);
			
			$elements = $xmlEvent->getElementsByTagName("persons");
			$personIdsString = $elements->item(0)->nodeValue;
			$persons = getPersonsWithIdsString($personIdsString);

			$events[$id] = new Event($id, $name, $url, $image, $date, $location, $persons);
		}

		usort($events, array('Event', '_cmpDescDate'));
		return $events;
	}

	function writeEventsToXML()
	{
		global $repositoryUrlPart, $allEvents;
		usort($allEvents, array('Event', '_cmpAscDate'));
		copy($repositoryUrlPart."events.xml", $repositoryUrlPart."_history/".date("YmdGi")."events.xml");

		$doc = new DOMDocument();
		$doc->formatOutput = true;

		$root = $doc->createElement("events");
		$doc->appendChild($root);

		foreach($allEvents as $event)
		{
			$ev = $doc->createElement("event");

			$id = $doc->createElement("eventId");
			$id->appendChild($doc->createTextNode($event->get_id()));
			$ev->appendChild($id);

			$element = $doc->createElement("name");
			$element->appendChild($doc->createTextNode($event->get_name()));
			$ev->appendChild($element);

			$element = $doc->createElement("url");
			$element->appendChild($doc->createTextNode($event->get_url()));
			$ev->appendChild($element);

			$element = $doc->createElement("image");
			$element->appendChild($doc->createTextNode($event->get_image()));
			$ev->appendChild($element);

			$element = $doc->createElement("date");
			$element->appendChild($doc->createTextNode($event->get_date()));
			$ev->appendChild($element);

			$element = $doc->createElement("locationId");
			$element->appendChild($doc->createTextNode($event->getLocationId()));
			$ev->appendChild($element);

			$element = $doc->createElement("persons");
			$element->appendChild($doc->createTextNode($event->getPersonsIdsString()));
			$ev->appendChild($element);

			$root->appendChild($ev);
		}
		
		$file_handle = fopen($repositoryUrlPart.'events.xml','w'); 
		fwrite($file_handle,$doc->saveXML()); 
		fclose($file_handle);
		
	}
	
	// NOT USED
	// function readEventsForPersonFromXML($eventsForPersonForXML)
	// {
	// 	global $rootUrl, $repositoryUrlPart;

	// 	$eventsForPerson;
	// 	$doc = new DOMDocument();
	// 	$doc->load($rootUrl.$repositoryUrlPart.$eventsForPersonForXML->get_name().'/events.xml');
	// 	$xmlEvents = $doc->getElementsByTagName("event");

	// 	$i = 0;
	// 	foreach($xmlEvents as $xmlEvent)
	// 	{
	// 		$ids = $xmlEvent->getElementsByTagName("eventId");
	// 		$id = $ids->item(0)->nodeValue;
	// 		$eventsForPerson[$i] = getEventById($id);
	// 		$i++;
	// 	}

	// 	usort($eventsForPerson, array('Event', '_cmpDescDate'));
	// 	return $eventsForPerson;
	// }

	// NOT USED
	// function writeEventsForPersonToXML($eventsForPersonToXML)
	// {
	// 	global $repositoryUrlPart, $eventsForPerson;
		
	// 	usort($eventsForPerson, array('Event', '_cmpDescDate'));
	// 	$personDir = $eventsForPersonToXML->get_name().'/';
	// 	copy($repositoryUrlPart.$personDir."events.xml", $repositoryUrlPart."/_history/".$personDir.date("YmdGi")."events.xml");

	// 	$doc = new DOMDocument();
	// 	$doc->formatOutput = true;

	// 	$root = $doc->createElement("events");
	// 	$doc->appendChild($root);

	// 	foreach($eventsForPerson as $event)
	// 	{
	// 		$ev = $doc->createElement("event");

	// 		$id = $doc->createElement("eventId");
	// 		$id->appendChild($doc->createTextNode($event->get_id()));
	// 		$ev->appendChild($id);

	// 		$root->appendChild($ev);
	// 	}
		
	// 	$file_handle = fopen($repositoryUrlPart.$personDir.'events.xml','w'); 
	// 	fwrite($file_handle,$doc->saveXML()); 
	// 	fclose($file_handle);
		
	// }
	
	function getEvents()
	{
		global $allEvents;
		
		if ($allEvents == null)
			$allEvents = readEventsFromXML();
		
	}
	
	function readEvents()
	{
		global $allEvents;
		
		$allEvents = readEventsFromXML();
		
	}

	function saveEvents()
	{
		writeEventsToXML();
	}

	function getEventsForPerson($eventPerson)
	{
		global $allEvents, $eventsForPerson;
		
		if ($allEvents == null)
			$allEvents = readEventsFromXML();

		if ($eventPerson != null)
		{
			//$eventsForPerson = readEventsForPersonFromXML($eventPerson);
			foreach ($allEvents as $event)
			{
				foreach ($event->get_persons() as $person) {
					if ($person->get_id() == $eventPerson->get_id())
					{
						$eventsForPerson[$event->get_id()] = $event;
					}
				}
			}
		}
		
	}

	function getEventsForPersons()
	{
		global $oppositePerson, $eventsForPerson;
		
		$eventsForPersonTMP = null;

		foreach ($eventsForPerson as $eventPersons)
		{
			if ($eventPersons->doesPersonGo($oppositePerson))
			{
				$eventsForPersonTMP[$eventPersons->get_id()] = $eventPersons;
			}
		}

		$eventsForPerson = $eventsForPersonTMP;
	}

	function getEventById($idToSearch)
	{
		global $allEvents;
		getEvents();
		
		foreach ($allEvents as $existingEvent)
		{
			if ($existingEvent->get_id() == $idToSearch)
				return $existingEvent;
		}
		return null;
	}
	
	function eventDoesNotExist($newEvent)
	{
		global $allEvents;
		getEvents();

		foreach ($allEvents as $existingEvent)
		{
			if ($existingEvent->get_date() == $newEvent->get_date() && $existingEvent->getLocationId() == $newEvent->getLocationId())
				return false;
		}
		return true;
	}

	function getEventByDateAndLocation($eventDate, $eventLocationId)
	{
		global $allEvents;
		getEvents();

		foreach ($allEvents as $existingEvent)
		{
			if ($existingEvent->get_date() == $eventDate && $existingEvent->getLocationId() == $eventLocationId)
				return $existingEvent;
		}
		return null;
	}

?>