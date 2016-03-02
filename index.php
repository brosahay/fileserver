<html>
<head>
	<title><?php echo (gethostname()); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/file-server.css">
</head>
<body>
	<nav class='navbar navbar-default'><a class='navbar-brand' href="#"><?php echo (gethostname()); ?> server</a></nav>
	<div class='container-fluid'>
		<div class='row'>

			<!-- SYSTEM STATUS -->
			<div class='col-md-2 hidden-xs sidebar'>
				<div class='system_status'>
				</div>
			</div>

			<!-- PATH NAVBAR -->
			<div class='col-md-offset-3 col-md-8'>
				<ol class='breadcrumb'>
					<li><a href='folder_1'>folder_1</a></li>
					<li><a href='folder_2'>folder_2</a></li>
					<li><a href='folder_3'>folder_3</a></li>
				</ol>
				<!-- TABLE OF CONTENTS -->
				<table class="table table-hover">
					<thead>
						<th>#</th>
						<th>FILENAME</th>
						<th>SIZE</th>
						<th>HITS</th>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<footer class='navbar-inverse'>Made with &hearts; <a href="#">htaccess</a></footer>
</body>
</html>