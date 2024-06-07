<?
	$sql = "SELECT * FROM onlinetoken WHERE name='".$_SESSION['token']."'";
	$result = $db->query($sql);
	if($rowsessia = $result->fetch_assoc())
	{
		if($rowsessia['time'] > time() && $_SESSION['uid'] == $rowsessia['userid'])
		{
			$sql = "DELETE FROM onlinetoken WHERE name='".$_SESSION['token']."'"; // 
			$db->query($sql);
			header("Location: https://lk.lnk-to.ru/auth");
			exit;
		}
	}
?>