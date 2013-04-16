<?php
?>
<form action="<?php echo $PHP_SELF;?>" method="post" enctype="multipart/form-data">
<input type='hidden' name='newLocation' value='newLocation'/>
<fieldset>
<legend>Nieuwe locatie</legend>
<p><label>Naam</label><br /><input class="text" type="text" name="venue" />
<label>Site locatie</label><br /><input class="text" type="text" name="venue_url" />
<input type="hidden" name="MAX_FILE_SIZE" value="500000" />
<label>Plaatje</label><br /><input class="button" type="file" name="image" accept="image/gif, image/jpeg, image/png" />
<label>Straat</label><br /><input class="text" type="text" name="street" />
<label>Nummer</label><br /><input class="text" type="text" name="number" />
<label>Plaats</label><br /><input class="text" type="text" name="city" />
<label>P naam</label><br /><input class="text" type="text" name="p_name" />
<label>P straat</label><br /><input class="text" type="text" name="p_street" />
<label>P nummer</label><br /><input class="text" type="text" name="p_number" /></p>
<p class="submit"><input class="button" type="submit" value="Toevoegen" /></p>
</fieldset>
</form>
