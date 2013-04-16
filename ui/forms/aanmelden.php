<?php
	global $subDir;
	$actionUrl = '/'.$subDir.'/';
	
	echo '<div class="aanmelden">'."\n";
	echo "\t".'<span class="header">Aanmelden</span>'."\n";
?>
	<form class="aanmelden" method="post" name="login" action="<?php echo $actionUrl; ?>">
		<label>Naam</label>
		<br />
		<input type="input" name="currentPersonName" value="">
		<br />
		<label>Wachtwoord</label>
		<br />
		<input type="password" name="pass" class="pass" />
		<br /><br />
		<input type="submit" value="&nbsp;&nbsp;aanmelden&nbsp;&nbsp;" class="button" />
	</form>
<?php
	echo "</div>\n";
?>