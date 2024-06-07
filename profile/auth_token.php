<?php
	$time = 3600+time();
	if($_POST['remember'])
	{
		$time = $time+72000;
	}
	$idhash = hash('md5',hash('sha256',$row['id']));
	$timehash = hash('md5',hash('sha256',$time));
	$tokenn = "".$idhash{3}."".$timehash{1}."".$timehash{12}."".$timehash{2}."".$timehash{15}."".$timehash{4}."".$timehash{3}."".$timehash{22}."".$idhash{6}."".$timehash{14}."_".$idhash{8}."".$timehash{5}."".$timehash{10}."".$timehash{9}."".$idhash{12}."".$timehash{13}."".$timehash{11}."".$timehash{6}."".$timehash{7}."".$timehash{8}."";
	
	$sql = "INSERT INTO onlinetoken (`name`,`userid`,`time`,`ctime`) VALUES ('".$tokenn."','".$row['id']."','".$time."','".time()."')";
	$db->query($sql);
	
	$_SESSION['uid'] = $row['id'];
	$_SESSION['token'] = $tokenn;
?>