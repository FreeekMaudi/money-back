<?php
		global $currentPerson, $oppositePerson, $eventsForPerson;

		$thisId = $event->get_id();
		$thisName = $event->get_name();
		$thisUrl = $event->get_url();
		$thisImage = $event->get_image();
		$thisDate = $event->get_date();
		$thisLocation = $event->get_location();
		$thisTransactions = getTransactionsForPersonsWithEventId($event->get_id());

		
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
				</td><td width="150px" class="header pink" style="text-align:center;"><?php echo $currentPerson->get_name(); ?></td>
				<?php
					echo "\t\t\t".'<td width="25px">'."\n";
					$diffCost = getClearedAmount($transactionsPersons, $currentPerson);
					$margin = 0;
					if ($diffCost > $margin)
					{
						$imgSrc = "moneyToLeft.png";
						$imgMoSrc = "moneyToLeft_mo.png";
						$imgAltTitle = '&#8364;&nbsp;'.str_replace(".", ",", $diffCost).$decimal;
					}
					else if ($diffCost < $margin * -1)
					{
						$imgSrc = "moneyToRight.png";
						$imgMoSrc = "moneyToRight_mo.png";
						$imgAltTitle = '&#8364;&nbsp;'.str_replace(".", ",", $diffCost * -1).$decimal;
					}
					else
					{
						// if ($diffCost < 0)
							// $diffCost = $diffCost * -1;
						$imgSrc = "moneyOK.png";
						$imgMoSrc = "moneyOK_mo.png";
						$imgAltTitle = '&#8364;&nbsp;'.str_replace(".", ",", $diffCost.$decimal);
					}
					echo '<a href="#" onmouseover="roll_over(&#039;cost&#039;, &#039;img/'.$imgMoSrc.'&#039;)" onmouseout="roll_over(&#039;cost&#039;, &#039;img/'.$imgSrc.'&#039;)">'."\n";
					echo '<img src="img/'.$imgSrc.'" name="cost" height="25px" alt="'.$imgAltTitle.'" title="'.$imgAltTitle.'" border="0" /></a>'."\n";
					echo "\t\t\t".'</td>'."\n";
				?>
				<td width="150px" class="header pink" style="text-align:center;"><?php echo $oppositePerson->get_name(); ?></td></tr></table>
				<?php
			}
			else
			{
				echo '<a href="#" class="header" onclick="toggle_visibility(&#039;year'.$eventYear.'&#039;);">'.$eventYear.'</a>'."\n";
			}
			echo '<div id="year'.$eventYear.'" style="'.$display.'">'."\n";
			echo "\t".'<table>'."\n";
		}
		
		echo "\t\t".'<tr>'."\n";

		// Event cells
		echo "\t\t\t".'<td width="100px">'."\n";
		echo "\t\t\t".'<div class="month">'.convertMonthNumberToShortDescr(substr($thisDate, 4, 2)).'</div>'."\n";
		echo "\t\t\t".'<div class="day">'.substr($thisDate, 6, 2).'</div>'."\n";
		echo "\t\t\t".'</td>'."\n";
		echo "\t\t\t".'<td width="100px">'."\n";
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
		echo "\t\t\t".'<td width="150px">'."\n";
		echo "\t\t\t\t".$thisName.'<br />'."\n";
		echo "\t\t\t\t".'<a href="#" onclick="toggle_visibility(&#039;location'.$thisLocation->get_id().'&#039;);">'.$thisLocation->get_name().'</a>'."\n";

		echo "\t\t\t\t".'<br />'."\n";
		$imgSrc = 'chg.png';
		$imgMoSrc = 'chg_mo.png';
		$imgAltTitle = 'Wijzig concert';
		//echo '<a href="#" onmouseover="roll_over(&#039;chgEvent'.$event["id"].'&#039;, &#039;img/'.$imgMoSrc.'&#039;)" onmouseout="roll_over(&#039;chgEvent'.$event["id"].'&#039;, &#039;img/'.$imgSrc.'&#039;)" onclick="toggle_visibility(&#039;formEvent'.$event["id"].'&#039;);">'."\n";
		//echo '<img src="img/'.$imgSrc.'" name="chgEvent'.$event["id"].'" height="16px" alt="'.$imgAltTitle.'" title="'.$imgAltTitle.'" border="0" /></a>'."\n";

		echo "\t\t\t".'</td>'."\n";

		// Money cells
		//$moneyEvent = getMoneyBy($moneymoney, "event_id", $event["id"]);
		echo "\t\t\t".'<td width="150px" style="vertical-align:top;">'."\n";
		//$moneyEventWho = getMoneyBy($moneyEvent, "who", $name);
		if ($thisTransactions != null)
		{
			foreach ($thisTransactions as $singleTransaction)
			{
				if ($singleTransaction->get_personCRD()->get_name() == $currentPerson->get_name())
				{
					echo "\t\t\t\t".'<div style="float:left;margin-left:20px;width:80px;">'.$singleTransaction->get_name().'</div>'."\n";
					echo "\t\t\t\t".'<div style="float:right;text-align:right;margin-right:10px;width:40px;">'.$singleTransaction->get_amount()."</div>\n";
				}
			}
			echo "\t\t\t".'</td>'."\n";
			echo "\t\t\t".'<td width="25px">&nbsp;'."\n";
			echo "\t\t\t".'</td>'."\n";
			echo "\t\t\t".'<td width="150px" style="vertical-align:top;">'."\n";

			foreach ($thisTransactions as $singleTransaction)
			{
				if ($singleTransaction->get_personCRD()->get_name() == $oppositePerson->get_name())
				{
					echo "\t\t\t\t".'<div style="float:left;margin-left:20px;width:80px;">'.$singleTransaction->get_name().'</div>'."\n";
					echo "\t\t\t\t".'<div style="float:right;text-align:right;margin-right:10px;width:40px;">'.$singleTransaction->get_amount()."</div>\n";
				}
			}
		}
		echo "\t\t\t".'</td>'."\n";

		echo "\t\t".'</tr>'."\n";

		$prevYear = $eventYear;
		$shownEvents++;
?>