<?php
	// Events
	global $eventsForPerson;
	
	echo "\t".'<table><tr><td width="350px">'."\n";
	echo "\t".'<span class="header">Events</span>'."\n";
	echo "\t".'<a href="#" onclick="toggle_visibility(&#039;formEvent&#039;);" onmouseover="roll_over(&#039;addImgE&#039;, &#039;img/add_mo.png&#039;)" onmouseout="roll_over(&#039;addImgE&#039;, &#039;img/add.png&#039;)">'."\n";
	echo "\t".'<img src="img/add.png" name="addImgE" height="25px" alt="Concert toevoegen" title="Concert toevoegen" border="0" /></a>'."\n";
	echo "\t".'</td><td>'."\n";
	echo "\t".'<span class="header">Give me my money back</span>'."\n";
	echo '<a href="#" onclick="toggle_visibility(&#039;formMoney&#039;);" onmouseover="roll_over(&#039;addImgM&#039;, &#039;img/add_mo.png&#039;)" onmouseout="roll_over(&#039;addImgM&#039;, &#039;img/add.png&#039;)">'."\n";
	echo '<img src="img/add.png" name="addImgM" height="25px" alt="Give me my money back" title="Give me my money back" border="0" /></a>'."\n";
	echo "\t".'</td></tr></table>'."\n";

	foreach($eventsForPerson as $event)
	{
		include('eventInfoTransaction.php');
	}
	echo "\t".'</table>'."\n";
	echo '</div>'."\n";

?>