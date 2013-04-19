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

		private $knownByPerson;
		function set_knownByPerson($knownByPerson) { $this->knownByPerson = $knownByPerson;}
		function get_knownByPerson() { return $this->knownByPerson; }
		
	
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
			$this->knownByPerson = false;
		}

		// compares
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
		
		// add
		// - if new Location doesn't already exist
		// - save by writing to xml
		function add()
		{
			if ($this->locationDoesNotExist())
			{
				$this->save();
			}
			else
			{
				return "ADD: Location name does already exist!";
			}
			
			return true;
		}

		// update
		// - if the new Location does already exist
		// - save by writing to xml
		function update()
		{
			if (!($this->locationDoesNotExist()))
			{
				$this->save();
			}
			else
			{
				return "UPD: Location name does not exist!";
			}
			
			return true;
		}

		// delete
		// - find index Location to delete
		// - delete Location
		// - save by writing to xml
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
		
		// save the location
		private function save()
		{
			global $allLocations;

			$index = getKeyById($allLocations, $this->get_id());

			$allLocations[$index] = $this;
			writeLocationsToXML();

			return true;
		}

		// Check if the name of the new Locaton already exists
		private function locationDoesNotExist()
		{
			return locationNameDoesNotExist($this->name);
		}
		
	}
?>