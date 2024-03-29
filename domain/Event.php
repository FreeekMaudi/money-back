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
	
		private $isNext;
		function set_isNext($isNext) { $this->isNext = $isNext; }
		function get_isNext() { return $this->isNext; }
		
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

			$this->isNext = false;
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

		// add
		// - if new Event doesn't already exist
		// - save by writing to xml
		function add()
		{
			if ($this->eventDoesNotExist())
			{
				$this->save();
			}
			else
			{
				return "ADD: Event (date, location) does already exist!";
			}
			
			return true;
		}

		// update
		// - if the new Event does already exist
		// - save by writing to xml
		function update()
		{
			if (!($this->eventDoesNotExist()))
			{
				$this->save();
			}
			else
			{
				return "UPD: Event (date, location) does not exist!";
			}
			
			return true;
		}

		// delete
		// - find index Event to delete
		// - delete Event
		// - save by writing to xml		
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

		/// private methods
		
		// save the event
		private function save()
		{
			global $allEvents;

			$index = getKeyById($allEvents, $this->get_id());
			$allEvents[$index] = $this;
			writeEventsToXML();
			
			return true;
		}

		// Check if the date and location of the new Event already exists
		private function eventDoesNotExist()
		{
			return eventDoesNotExist($this);
		}
		
	}
?>