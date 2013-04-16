<?php

	class Person
	{
		// properties
		private $id;
		function get_id() { return $this->id; }
		private $name;
		function get_name() { return $this->name; }
		private $password;
		function get_password() { return $this->password; }
		private $groupPersonsIds;
		function get_groupPersonsIds() { return $this->groupPersonsIds; }
		private $groupPersons;
		function get_groupPersons() { return $this->groupPersons; }
		
		private $events;
		
		// constructor
		function __construct($new_id, $new_name, $new_password, $new_groupPersonsIds)
		{
			$this->id = $new_id;
			$this->name = $new_name;
			$this->password = $new_password;
			$this->groupPersonsIds = $new_groupPersonsIds;
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
		
		// set methods
		function setGroupPersons()
		{
			$this->groupPersons = getPersonsWithIdsString($this->groupPersonsIds);
		}
		
		//getComleteGroupPersons, this person included
		function getCompleteGroupPersons()
		{
			$completeGroup = $groupPersons;
			$completeGroup[$this->get_id()] = $this;

			return $completeGroup;
		}
		// Persons
		function getGroupPersonsNames()
		{
			$names = "";
			foreach ($this->groupPersons as $person)
			{
				$names = $names.$person->get_name().", ";
			}
			return substr($names, 0, -2);
		}
		
		// save
		// - if new Person doesn't already exist
		// - create nescessary directories and xml files
		// - save by writing to xml
		function save()
		{
			if ($this->personDoesNotExist())
			{
				$outputCreateDS = $this->createDirectoryStructure();
				if (gettype($outputCreateDS) == "string")
					return $outputCreateDS;
				
				global $allPersons;
				$allPersons[$this->get_id()] = $this;
				writePersonsToXML();
			}
			else
			{
				return "Name does already exist!";
			}
			
			return true;
		}

		function saveEventForPerson($eventForPerson)
		{
			global $eventsForPerson;
			getEventsForPerson($this);

			if (!array_key_exists($eventForPerson->get_id(), $eventsForPerson))
			{
				$eventsForPerson[$eventForPerson->get_id()] = $eventForPerson;
				writeEventsForPersonToXML($this);
			}
			else
			{
				return "Event does already exist for Person!";
			}

		}
		
		/// private methods
		
		// Check if the name of the new Person already exists
		private function personDoesNotExist()
		{
			return personNameDoesNotExist($this->name);
		}

		// Create the nescessary directories and xml files
		private function createDirectoryStructure()
		{
			global $rootUrl, $repositoryUrlPart;

			$stillOK = mkdir($repositoryUrlPart.$this->name, 0755);

			if ($stillOK) {
				$stillOK = mkdir($repositoryUrlPart."_history/".$this->name, 0755);
			} else {
				rmdir($repositoryUrlPart."_history/".$this->name);
				return "Something went wrong creating directory: ".$this->get_name();
			}

			if ($stillOK) {
				copy($repositoryUrlPart."_templates/money.xml", $repositoryUrlPart.$this->name."/money.xml");
			} else {
				rmdir($repositoryUrlPart.$this->name);
				rmdir($repositoryUrlPart."_history/".$this->name);
				return "Something went wrong creating history directory: ".$this->get_name();
			}

			if ($stillOK) {
				copy($repositoryUrlPart."_templates/events.xml", $repositoryUrlPart.$this->name."/events.xml");
			} else {
				ulink($repositoryUrlPart.$this->name."/money.xml");
				rmdir($rootUrl.$repositoryUrlPart.$this->name);
				rmdir($rootUrl.$repositoryUrlPart."_history/".$this->name);
				return "Something went wrong copying money template for: ".$this->get_name();
			}
			
			if (!$stillOK) {
				ulink($repositoryUrlPart.$this->name."/money.xml");
				ulink($repositoryUrlPart.$this->name."/events.xml");
				rmdir($rootUrl.$repositoryUrlPart.$this->name);
				rmdir($rootUrl.$repositoryUrlPart."_history/".$this->name);
				return "Something went wrong copying events template for: ".$this->get_name();
			}
			
			return true;
		
		}
	}
?>