<?php

	class Event
	{
		// properties
		private $id;
		function get_id() { return $this->id; }
		private $name;
		function get_name() { return $this->name; }
		private $url;
		function get_url() { return $this->url; }
		private $image;
		function get_image() { return $this->image; }
		private $date;
		function get_date() { return $this->date; }
		private $location;
		function get_location() { return $this->location; }
		private $persons;
		function get_persons() { return $this->persons; }
		
		// constructor
		function __construct($new_id, $new_name, $new_url, $new_image, $new_date, $new_location, $new_persons)
		{
			$this->id = $new_id;
			$this->name = $new_name;
			$this->url = $new_url;
			$this->image = $new_image;
			$this->date = $new_date;

			if (gettype($new_location) == "string")
				$this->location = getLocationById($new_location);
			else
				$this->location = $new_location;

			if (gettype($new_persons) == "string")
				$this->persons = getPersonsWithIdsString($new_persons);
			else
				$this->persons = $new_persons;
		}
		// compareOnDate 
		function _cmpAscDate($m, $n)
		{
			if ($m->date == $n->date) 
			{
				return 0;
			}
			return ($m->date < $n->date) ? -1 : 1;
		}
		function _cmpDescDate($m, $n)
		{
			if ($m->date == $n->date) 
			{
				return 0;
			}
			return ($m->date > $n->date) ? -1 : 1;
		}
		

		/// more methods
		
		// getEvents
		function getPersonsNames()
		{
			$names = "";
			foreach ($this->persons as $person)
			{
				$names = $names.$person->get_name().", ";
			}
			return substr($names, 0, -2);
		}
		function getPersonsIdsString()
		{
			$names = "";
			foreach ($this->persons as $person)
			{
				$names = $names.$person->get_id().",";
			}
			return substr($names, 0, -1);
		}
		function getLocationName()
		{
			return $this->location->get_name();
		}
		function getLocationId()
		{
			return $this->location->get_id();
		}

		function doesPersonGo($personToGo)
		{
			$personDoesGo = false;
			foreach ($this->get_persons() as $personGoes)
			{
				if ($personGoes->get_name() == $personToGo->get_name())
				{
					$personDoesGo = true;
					break;
				}
			}
			return $personDoesGo;
		}

		// save
		// - if new Event doesn't already exist
		// - save by writing to events xml
		// - save by writing to personal events xml
		function save()
		{
			if ($this->eventDoesNotExist())
			{
				global $allEvents;
				$allEvents[$this->get_id()] = $this;
				writeEventsToXML();
			}
			else
			{
				return "SAVE: Event does already exist!";
			}
			
			return true;
		}

		function delete()
		{
			global $allEvents;

			$index = getKeyById($allEvents, $this->get_id());

			if ($index !== null)
			{
				unset($allEvents[$index]);
				writeEventsToXML();
			}
			else
			{
				return "DLT: Event doesn't exist!";
			}
			
			return true;
		}
		
		// Check if the date and location of the new Event already exists
		private function eventDoesNotExist()
		{
			return eventDoesNotExist($this);
		}
		
	}
?>