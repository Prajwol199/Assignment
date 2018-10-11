<?php
	global $server_root;
	require_once __dir__.'/../model/database.php';
	$conn = new database(); 

	$sql = 'SELECT server_root FROM setting';

	$result = mysqli_query($conn->connection(),$sql);

	$rows=array();
	while($row=mysqli_fetch_assoc($result)){
		$rows[]=$row;
	}
	foreach ($rows as $key => $value) {
		$server_root = $value['server_root'];
	}