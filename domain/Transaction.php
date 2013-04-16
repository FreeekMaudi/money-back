<?php

	class Transaction
	{
		// properties
		private $id;
		function get_id() { return $this->id; }
		private $personCRD;
		function get_personCRD() { return $this->personCRD; }
		private $personDBT;
		function get_personDBT() { return $this->personDBT; }
		private $name;
		function get_name() { return $this->name; }
		private $amount;
		function get_amount() { return $this->amount; }
		private $date;
		function get_date() { return $this->date; }
		private $event;
		function get_event() { return $this->event; }
		
		// constructor
		function __construct($new_id, $new_personCRD, $new_personDBT, $new_name, $new_amount, $new_date, $new_event)
		{
			$this->id = $new_id;
			
			if (gettype($new_personCRD) == "string")
				$this->personCRD = getPersonById($new_personCRD);
			else
				$this->personCRD = $new_personCRD;
				
			if (gettype($new_personDBT) == "string")
				$this->personDBT = getPersonById($new_personDBT);
			else
				$this->personDBT = $new_personDBT;

			$this->name = $new_name;
			$this->amount = $new_amount;
			$this->date = $new_date;

			if (gettype($new_event) == "string")
				$this->event = getEventById($new_event);
			else
				$this->event = $new_event;
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
		// compareOnDateEvent 
		function _cmpAscDateEvent($m, $n)
		{
			if ($m->event->get_date() == $n->event->get_date()) 
			{
				return 0;
			}
			return ($m->event->get_date() < $n->event->get_date()) ? -1 : 1;
		}
		function _cmpDescDateEvent($m, $n)
		{
			if ($m->event->get_date() == $n->event->get_date()) 
			{
				return 0;
			}
			return ($m->event->get_date() > $n->event->get_date()) ? -1 : 1;
		}
		

		/// more methods
		
		// get methods

		
		// save
		// - save by writing to personal transactions xml CRD person
		// - save by writing to personal transactions xml DBT person
		function save()
		{
			global $transactionsPerson, $currentPerson;

			// currentPerson
			$transactionsPerson[$this->get_id()] = $this;
			writeTransactionsToXML($currentPerson);

			// oppositePerson
			if ($this->get_personCRD()->get_name() == $currentPerson->get_name())
				$oppositePerson = $this->get_personDBT();
			else
				$oppositePerson = $this->get_personCRD();
			$transactionsPerson = readTransactionsFromXMLForPerson($oppositePerson);
			$transactionsPerson[$this->get_id()] = $this;
			writeTransactionsToXML($oppositePerson);
	
			return true;
		}
		
		/// private methods
		
		
	}
?>