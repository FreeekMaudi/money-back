<?php
	$site = $rootUrl."Maudi";

	global $dirUp;

	$dir = "test/";
	if ($dirUp <> "")
	{
		$dir = "";
	}
	$read = $dir."testread.php";
	$write = $dir."testwrite.php";
	$add = $dir."testadd.php";
	$upd = $dir."testupd.php";
	$dlt = $dir."testdlt.php";
	$general = $dir."testgeneral.php";
?>
		<br /><br />
		<a href=<?php echo $site; ?>>site</a>
		&nbsp;*&nbsp;
		<a href=<?php echo $read; ?>>testread</a>
		&nbsp;*&nbsp;
		<a href=<?php echo $write; ?>>testwrite</a>
		&nbsp;*&nbsp;
		<a href=<?php echo $add; ?>>testadd</a>
		&nbsp;*&nbsp;
		<a href=<?php echo $upd; ?>>testupd</a>
		&nbsp;*&nbsp;
		<a href=<?php echo $dlt; ?>>testdlt</a>
		&nbsp;*&nbsp;
		<a href=<?php echo $general; ?>>testgeneral</a>
