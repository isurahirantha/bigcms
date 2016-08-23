 <!DOCTYPE html>
 <html>
<head>
 <title>BigIMF</title>
 <meta charset="utf-8">
 <meta lang="si">
     
    <link rel="stylesheet" href="cssheets/admincss.css"/>
	<link rel="stylesheet" href="cssheets/dash.css"/>
	<link rel="stylesheet" href="cssheets/club.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>
	
</head>
 
 <body>

 		<div class="bg_header">
 			<div class="header_wrapper">
	 			<div class="header">
			 		<a href="index.php">BIGimF</a>
				</div>
					<?php
					if(allow()){include("includes/dashboard/dash_header_disabled.php");
					}else{
						include("includes/dashboard/dash_header.php");
					}
					?>
			</div>
	    </div>