<?
	$SaveSession_Token = $_SESSION['token'];
	$SaveSession_UID = $_SESSION['uid'];
	$sql = "SELECT * FROM onlinetoken WHERE name='".$SaveSession_Token."'";
	$result = $db->query($sql);
	if($row = $result->fetch_assoc())
	{
		if($row['time'] < time() || $SaveSession_UID != $row['userid'])
		{
			$sql = "DELETE FROM onlinetoken WHERE name='".$SaveSession_Token."'"; // 
			$db->query($sql);
			header("Location: https://lk.lnk-to.ru/auth");
			exit;
		}
		else
		{
			$sql = "UPDATE onlinetoken SET time = time-ctime+".time()." WHERE id=".$row['id']."";
			$db->query($sql);
		}
	}
	else
	{
		header("Location: https://lk.lnk-to.ru/auth");
		exit;
	}
	$sql = "SELECT typeacc,name,balance FROM users WHERE id=".$SaveSession_UID."";
	$result = $db->query($sql);
	if($row = $result->fetch_assoc())
	{
		$user_money = $row['balance']; // уровень аккаунта
		$user_lvl = $row['typeacc']; // уровень аккаунта
		//      Базовый - x0
		//  Расширенный - x1
		//  Премиальный - x2
		// Максимальный - x3
		//	  Создатель - 93
		//	  	 Хелпер - 13
	}
?>