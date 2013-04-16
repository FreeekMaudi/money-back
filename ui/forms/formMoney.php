<?php
?>
<form action="<?php echo $PHP_SELF;?>" method="post">
<input type='hidden' name='newMoney' value='newMoney'/>
<fieldset>
<legend>Money Back</legend>
<p><label>Wie krijgt?</label><br />
<select name="who">
	<option value=<?php echo $name; ?>><?php echo $name; ?></option>
	<option value="Maudi">Maudi</option>
</select>
<label>Waarvoor?</label><br />
<select name="what">
	<option value="Kaarten">Kaarten</option>
	<option value="Eten">Eten</option>
	<option value="Drinken">Drinken</option>
	<option value="P kosten">P kosten</option>
	<option value="Overig">Overig</option>
</select>
<label>Hoeveel?</label><br /><input class="text" type="text" name="amount" />
<label>Datum (YYYYMMDD)</label><br /><input class="text" type="text" name="date" />
<label>Concert</label><br />
<select name="event_id">
<?php
	$eventsSorted = array_sort($events, 'date', SORT_DESC);
	foreach ($eventsSorted as $event)
	{
		echo '<option value="'.$event["id"].'">'.$event["artist"].' ('.$event["date"].')</option>'."\n";
	}
?>
</select>
</p>
<p class="submit"><input class="button" type="submit" value="Shake shake shake" /></p>
</fieldset>
</form>
