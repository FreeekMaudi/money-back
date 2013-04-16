<?php
	global $subDir;
	$actionUrl = '/'.$subDir.'/';

	echo '<div class="afmelden">'."\n";
?>
	<form method="post" name="login" action="<?php echo $actionUrl; ?>">
		<input type="hidden" name="currentPersonName" value="">
		<input type="submit" value="&nbsp;&nbsp;afmelden&nbsp;&nbsp;" class="button" />
	</form>
<?php
	echo "</div>\n";
?>