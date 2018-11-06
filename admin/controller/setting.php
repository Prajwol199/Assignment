<?php
	global $server_root;
	global $site_name;
	global $footer;
	global $limit;
	require_once __dir__.'/../model/database.php';
	$conn = new database(); 

	$sql = 'SELECT * FROM setting';

	$result = mysqli_query($conn->connection(),$sql);

	$rows=array();
	while($row=mysqli_fetch_assoc($result)){
		$rows[]=$row;
	}
	foreach ($rows as $key => $value) {
		$server_root = $value['server_root'];
		$site_name = $value['site_name'];
		$footer = $value['footer'];
		$limit = $value['page_limit'];
	}