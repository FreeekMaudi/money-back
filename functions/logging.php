<?php

	function log_info($message) {
	    //error_log(date("Y-m-d H:i:s")." -- INFO: ".$message, 3, $rootUrl."logs/log.txt\n");
	    error_log(date("Y-m-d H:i:s")." -- INFO: ".$message, 3, $rootUrl."logging.txt\n");
	}

	function log_warning($message) {
	    error_log(date("Y-m-d H:i:s")." -- WARN: ".$message, 3, $rootUrl."logs/log.txt\n");
	}

	function log_error($message) {
	    error_log(date("Y-m-d H:i:s")." -- ERROR: ".$message, 3, $rootUrl."logs/log.txt\n");
	}
?>