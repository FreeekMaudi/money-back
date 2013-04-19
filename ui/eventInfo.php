<?php
	global $currentPerson, $currentDate;

	$thisId = $event->get_id();
	$thisName = $event->get_name();
	$thisUrl = $event->get_url();
	$thisImage = $event->get_image();
	$thisDate = $event->get_date();
	$thisLocation = $event->get_location();
	$thisIsNext = $event->get_isNext();

	$eventYear = substr($thisDate, 0, 4);
	
	if ($prevYear <> 0 && $eventYear <> $prevYear)
	{
		echo "\t".'</table>'."\n";
		echo '</div>'."\n";
		echo '<div style="clear:both;"></div>'."\n";
	}
	
	if ($eventYear <> $prevYear)
	{
		$display = 'display:block;';
		if ($shownEvents > 3)
			$display = 'display:none;';

		if ($prevYear == 0)
		{
			?>
			<table><tr><td width="350px">
			<?php
			echo '<a href="#" class="header" onclick="toggle_visibility(&#039;year'.$eventYear.'&#039;);">'.$eventYear.'</a>'."\n";
			?>
			</td><td width="150px" class="header pink" style="text-align:center;"></td>
			<?php
				echo "\t\t\t".'<td width="25px">'."\n";
				echo "\t\t\t".'</td>'."\n";
			?>
			<td width="150px" class="header pink" style="text-align:center;"></td></tr></table>
			<?php
		}
		else
		{
			echo '<a href="#" class="header" onclick="toggle_visibility(&#039;year'.$eventYear.'&#039;);">'.$eventYear.'</a>'."\n";
		}
		echo '<div id="year'.$eventYear.'" style="'.$display.'">'."\n";
		echo "\t".'<table class="event">'."\n";
	}
	
	$datacells = "<td></td><td></td><td></td><td></td>";
	if(isset($currentPerson))
		$datacells = "<td></td>";
	$backgroundClass = "";
	if ($thisIsNext) {
		$backgroundClass = " nextEvent";	
		echo "\t\t".'<tr class="event'.$backgroundClass.'">'.$datacells.'</tr>'."\n";
	}

	echo "\t\t".'<tr class="event">'."\n";

	// Event cells
	// Month and date
	echo "\t\t\t".'<td width="100px">'."\n";
	echo "\t\t\t".'<div class="month">'.convertMonthNumberToShortDescr(substr($thisDate, 4, 2)).'</div>'."\n";
	echo "\t\t\t".'<div class="day">'.substr($thisDate, 6, 2).'</div>'."\n";
	echo "\t\t\t".'</td>'."\n";
	// Image
	echo "\t\t\t".'<td width="90px">'."\n";
	if ($thisImage == "event.png") {
		$href = "#";
		$alt = "plaatje toevoegen";
	} else {
		$href = $thisUrl;
		$alt = $thisName;
	}
	$image = '<img src="img/events/'.$thisImage.'" height="80px" border="0" />';
	echo "\t\t\t\t".'<a href="'.$href.'" target="_blank" alt="'.$alt.'" title="'.$alt.'">'.$image.'</a>'."\n";
	echo "\t\t\t".'</td>'."\n";

	echo "\t\t\t".'<td width="25px">'."\n";
	if (isset($currentPerson))
	{
		$imgSrc = 'chg.png';
		$imgMoSrc = 'chg_mo.png';
		$imgAltTitle = 'Wijzig concert';
		echo "\t\t\t\t".'<a href="'.$currentPerson->get_name().'-E'.$thisId.'" onmouseover="roll_over(&#039;chgImgE'.$thisId.'&#039;, &#039;img/chg_mo.png&#039;)" onmouseout="roll_over(&#039;chgImgE'.$thisId.'&#039;, &#039;img/chg.png&#039;)">'."\n";
		echo "\t\t\t\t".'<img src="img/chg.png" name="chgImgE'.$thisId.'" height="15px" alt="Event wijzigen" title="Event wijzigen" border="0" /></a>'."\n";	
	}
	echo "\t\t\t".'</td>'."\n";
	// Name and Location
	echo "\t\t\t".'<td width="150px">'."\n";
	echo "\t\t\t\t".$thisName.'<br />'."\n";
	echo "\t\t\t\t".'<a href="#" onclick="toggle_visibility(&#039;location'.$thisLocation->get_id().'&#039;);">'.$thisLocation->get_name().'</a>'."\n";
	echo "\t\t\t\t".'<br />'."\n";
	echo "\t\t\t".'</td>'."\n";

	if (isset($currentPerson))
	{
		// Who of the group are going?
		echo "\t\t\t".'<td width="100px">'."\n";
		echo "<span class='pink'>".$event->getPersonsNames()."</span>";
		echo "\t\t\t".'</td>'."\n";
		
		echo "\t\t".'</tr>'."\n";
	}

	$prevYear = $eventYear;
	$shownEvents++;
?>