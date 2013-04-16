<?php

	class Location
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
		private $addressStreet;
		function get_addressStreet() { return $this->addressStreet; }
		private $addressNumber;
		function get_addressNumber() { return $this->addressNumber; }
		private $addressCity;
		function get_addressCity() { return $this->addressCity; }
		private $pAddressName;
		function get_pAddressName() { return $this->pAddressName; }
		private $pAddressStreet;
		function get_pAddressStreet() { return $this->pAddressStreet; }
		private $pAddressNumber;
		function get_pAddressNumber() { return $this->pAddressNumber; }
		
		private $events;
		
		// constructor
		function __construct($new_id, $new_name, $new_url, $new_image, 
								$new_addressStreet, $new_addressNumber, $new_addressCity, 
								$new_pAddressName, $new_pAddressStreet, $new_pAddressNumber)
		{
			$this->id = $new_id;
			$this->name = $new_name;
			$this->url = $new_url;
			$this->image = $new_image;
			$this->addressStreet = $new_addressStreet;
			$this->addressNumber = $new_addressNumber;
			$this->addressCity = $new_addressCity;
			$this->pAddressName = $new_pAddressName;
			$this->pAddressStreet = $new_pAddressStreet;
			$this->pAddressNumber = $new_pAddressNumber;
		}
		// compareOnName 
		function _cmpAscName($m, $n)
		{
			if ($m->name == $n->name) 
			{
				return 0;
			}
			return ($m->name < $n->name) ? -1 : 1;
		}
		function _cmpDescName($m, $n)
		{
			if ($m->name == $n->name) 
			{
				return 0;
			}
			return ($m->name > $n->name) ? -1 : 1;
		}
		// compareOnId 
		function _cmpAscId($m, $n)
		{
			if ($m->id == $n->id) 
			{
				return 0;
			}
			return ($m->id < $n->id) ? -1 : 1;
		}
		function _cmpDescId($m, $n)
		{
			if ($m->id == $n->id) 
			{
				return 0;
			}
			return ($m->id > $n->id) ? -1 : 1;
		}
		

		/// more methods
		
		// getEvents
		function getEvents()
		{
			//foreach ($foundGroups as $event)
			//{
			//	$events[$i++] = $event;
			//}
			//return $events;
		}
		
		// getGroups
		function getGroups()
		{
			//foreach ($foundGroups as $group)
			//{
			//	$groups[$i++] = $group;
			//}
			//return $groups;
		}
		
		// save
		// - if new Location doesn't already exist
		// - create nescessary directories and xml files
		// - save by writing to xml
		function save()
		{
			if ($this->locationDoesNotExist())
			{
				global $allLocations;
				$allLocations[$this->get_id()] = $this;
				writeLocationsToXML();
			}
			else
			{
				return "SAVE: Location name does already exist!";
			}
			
			return true;
		}

		function delete()
		{
			global $allLocations;

			$index = getKeyById($allLocations, $this->get_id());

			if ($index !== null)
			{
				unset($allLocations[$index]);
				writeLocationsToXML();
			}
			else
			{
				return "DLT: Location doesn't exist!";
			}
			
			return true;			
		}
		
		/// private methods
		
		// Check if the name of the new Locaton already exists
		private function locationDoesNotExist()
		{
			return locationNameDoesNotExist($this->name);
		}
		
	}
?>