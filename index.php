<?php
function uptime(){
	if(PHP_OS=="Linux") {
		$uptime = shell_exec('cat /proc/uptime');
		if ($uptime !== false) {
			$uptime = explode(" ",$uptime);
			$uptime = $uptime[0];
			$days = explode(".",(($uptime % 31556926) / 86400));
			$hours = explode(".",((($uptime % 31556926) % 86400) / 3600));
			$minutes = explode(".",(((($uptime % 31556926) % 86400) % 3600) / 60));
			$time = ".";
			if ($minutes > 0)
				$time=$minutes[0]." mins".$time;
			if ($minutes > 0 && ($hours > 0 || $days > 0))
				$time = ", ".$time;
			if ($hours > 0)
				$time = $hours[0]." hours".$time;
			if ($hours > 0 && $days > 0)
				$time = ", ".$time;
			if ($days > 0)
				$time = $days[0]." days".$time;
		} else {
			$time = false;
		}
	} else {
		$time = false;
	}
	return $time;
}
function FileSizeConvert($bytes){
	$bytes = floatval($bytes);
	$arBytes = array(
		0 => array(
			"UNIT" => "TB",
			"VALUE" => pow(1024, 4)
			),
		1 => array(
			"UNIT" => "GB",
			"VALUE" => pow(1024, 3)
			),
		2 => array(
			"UNIT" => "MB",
			"VALUE" => pow(1024, 2)
			),
		3 => array(
			"UNIT" => "KB",
			"VALUE" => 1024
			),
		4 => array(
			"UNIT" => "B",
			"VALUE" => 1
			),
		);

	foreach($arBytes as $arItem)
	{
		if($bytes >= $arItem["VALUE"])
		{
			$result = $bytes / $arItem["VALUE"];
			$result = str_replace(".", "." , strval(round($result, 2)))." ".$arItem["UNIT"];
			break;
		}
	}
	return $result;
}
if(isset($_GET['current'])  && !empty($_GET['current'])){
	$current=$_GET['current'];
	if($current == '.')
		$current = "";
}
else{
	$current = '.';
}
	$files = scandir($current);
?>
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
			<div class='col-md-3 hidden-xs sidebar'>
				<div class="panel panel-primary">
					<div class="panel-heading">SYSTEM STATUS</div>
					<div class="panel-body">
						<span class="label label-info">SERVER</span>:<span><?php echo (gethostname()); ?></span><br>
						<span class="label label-info">UPTIME</span>:<span><?php echo uptime(); ?></span>
					</div>
				</div>
			</div>

			<!-- PATH NAVBAR -->
			<div class='col-md-offset-3 col-md-9 main'>
				<ol class='breadcrumb'>
					<?php
					$path_list = explode("/", $current);
					$print_path ="";
					foreach ($path_list as $key => $value) {
						if($print_path==''){
							echo "<li><a href='index.php?current=$print_path'>home</a></li>";
							$print_path =$value;
						}
						else{
							$print_path .='/'.$value;
							echo "<li><a href='index.php?current=$print_path'>$value</a></li>";
						}						
					}
					?>
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
						<?php
						foreach ($files as $key => $value) {
							if(!($value=='.' or $value=='..' or $value=='index.php' or $value=='css' or $value=='js' or $value=='fonts' or $value=='less' or $value=='scss' or $value=='img')){
								if(is_dir($current.'/'.$value)){
									echo "<tr>
												<th scope='row' style='width:50px'><span class='glyphicon glyphicon-folder-open'></span></th>";
									echo "<td><a href='index.php?current=$current/$value'>$value</a></td>";
									echo "<td>DIRECTORY</td>";
								}
								else
								{
									echo "<tr>
												<th scope='row' style='width:50px'><span class='glyphicon glyphicon-file'></span></th>";
									echo "<td><a href='$current/$value'>$value</a></td>";
									$file_size=filesize($value);
									$file_size=FileSizeConvert($file_size);
									echo "<td>$file_size</td>";
								}
								echo "<td>9999</td>
											</tr>";
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<footer class='navbar-inverse'>Made with &hearts; <a href="#">htaccess</a></footer>
</body>
</html>