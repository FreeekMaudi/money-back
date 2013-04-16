<?php
?>
<form action="<?php echo $PHP_SELF;?>" method="post" enctype="multi-part/form-data">
<input type='hidden' name='testUpload' value='testUpload'/>
<fieldset>
<input type="hidden" name="MAX_FILE_SIZE" value="50000" />
<!-- images naar img/locations -->
<label>Plaatje location</label><br /><input class="button" type="file" name="testLocation" accept="image/gif, image/jpeg, image/png" />
<!-- images naar img/events -->
<label>Plaatje event</label><br /><input class="button" type="file" name="testEvent" accept="image/gif, image/jpeg, image/png" />
<p class="submit"><input class="button" type="submit" value="Toevoegen" /></p>
</fieldset>
</form>

<br /><br />
<?php $dir = getcwd(); 
	echo "<img src='/img/locations/ahoy.png' height='80px' />";
	echo "<br />";
	echo "<img src='img/events/3fm_awards_2010.jpg' height='80px' />";
	echo "<br />";
?>
