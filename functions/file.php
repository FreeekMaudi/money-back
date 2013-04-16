<?php
	function uploadFile($file, $remoteDir)
	{
		if ($file["name"] <> "" && $file["error"] == "UPLOAD_ERR_OK")
		{
			$uploadDir = getcwd().$remoteDir;
			$uploadFile = $uploadDir.basename($file["name"]);

			if(!(move_uploaded_file($file["tmp_name"], $uploadFile)))
			{
				return false;
			}
		}

		return true;
	}
?>