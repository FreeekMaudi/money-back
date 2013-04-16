<?php

	// echo "getcwd()".getcwd()."\n";
	// echo "Upload testLocation\n";
	// var_dump($_FILES["testLocation"]);

//	uploadFile($_FILES["testLocation"], '/img/locations/');
		if ($_FILES["testLocation"]["name"] <> "")
		{
			$uploadDir = getcwd().'/img/locations/';
			$uploadFile = $uploadDir.basename($_FILES["testLocation"]["name"]);

			move_uploaded_file($_FILES["testLocation"]["tmp_name"], $uploadFile);
		}
	// echo "Upload testEvent\n";
	// var_dump($_FILES["testEvent"]);
	//uploadFile($_FILES["testEvent"], '/img/events/');

?>