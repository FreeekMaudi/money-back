<?php

	function convertMonthNumberToShortDescr($month)
	{
		$monthNr = convertMonthNumberToTwoLong($month);
		
		switch ($monthNr)
		{
			case "01":
				return "jan";
			case "02":
				return "feb";
			case "03":
				return "mrt";
			case "04":
				return "apr";
			case "05":
				return "mei";
			case "06":
				return "jun";
			case "07":
				return "jul";
			case "08":
				return "aug";
			case "09":
				return "sep";
			case "10":
				return "okt";
			case "11":
				return "nov";
			case "12":
				return "dec";
		}
	}
	
	function convertMonthNumberToTwoLong($monthNr)
	{
		if (strlen($monthNr) < 2)
			return "0".$monthNr;
		else
			return $monthNr;
	}
	
	function getName()
	{
		return substr($_SERVER['PHP_SELF'], 12, -4);
	}
?>