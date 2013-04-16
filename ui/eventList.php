<?php
	// Events
	global $allEvents;
	
	echo '<div class="eventList">'."\n";
	echo "\t".'<table><tr><td width="350px">'."\n";
	echo "\t".'<span class="header">Events</span>'."\n";
	//echo "\t".'<a href="#" onclick="toggle_visibility(&#039;formEvent&#039;);" onmouseover="roll_over(&#039;addImgE&#039;, &#039;img/add_mo.png&#039;)" onmouseout="roll_over(&#039;addImgE&#039;, &#039;img/add.png&#039;)">'."\n";
	//echo "\t".'<img src="img/add.png" name="addImgE" height="25px" alt="Concert toevoegen" title="Concert toevoegen" border="0" /></a>'."\n";
	echo "\t".'</td><td>'."\n";
	echo "\t".'</td></tr></table>'."\n";

	foreach($allEvents as $event)
	{
		include('eventInfo.php');
	}
	echo "\t".'</table>'."\n";
	echo '</div>'."\n";

	echo '</div>'."\n";
?>