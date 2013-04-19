<div id="writePersons" style="display:none;">
	PERSON
	<br /><br />
<?php

	global $allPersons;
	
	getPersons();

	echo "<br />".count($allPersons)." persons read.";
	savePersons();
	echo "<br />".count($allPersons)." persons written.";

	$count = count($allPersons);
	echo "<br />".$count." persons read and written.";
?>
</div>