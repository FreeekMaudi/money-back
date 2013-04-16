<head>
        <meta http-equiv="Content-Type" content="text/html;
        charset=iso-8859-1" />
        <title><?php echo $title; ?></title>
		<script type="text/javascript">
			function toggle_visibility(id) {
			   var e = document.getElementById(id);
			   if(e.style.display == 'block')
				  e.style.display = 'none';
			   else
				  e.style.display = 'block';
			}
			
			function roll_over(img_name, img_src)
			{
				document[img_name].src = img_src;
			}
			
		</script>
		<?php
			$reqURI = explode('/', $_SERVER['REQUEST_URI']);
			$style = "style.css";

			if (count($reqURI) == 4 && $reqURI[2] == "test")
				$style = "../".$style;
		?>
		<link rel="stylesheet" type="text/css" href=<?php echo '"'.$style.'"'; ?>"> 
		
</head>
