<?php
	if(!empty($_GET['token']))
	{
		$uinf = json_decode(file_get_contents('https://api.exemple.ru/u/checktoken?token='.$_GET['token'].'&uid='.$_GET['uid'].''), true);
		if($uinf['response'] == "success")
		{
			$sql = "SELECT * FROM users WHERE ttlid='".$_GET['uid']."' LIMIT 1";
			$result = $db->query($sql);
			if($row = $result->fetch_assoc())
			{ 
				require_once 'auth_token.php';
			}
			else
			{
				$sql = "INSERT INTO users (`id`, `ttlid`) VALUES (NULL, '".$_GET['uid']."')";
				$result = $db->query($sql);					
				$sql = "SELECT * FROM users WHERE ttlid='".$_GET['uid']."' LIMIT 1";
				$result = $db->query($sql);
				if($row = $result->fetch_assoc())
				{ 
					require_once 'auth_token.php';
				}
			}

			header("Location: https://lk.lnk-to.ru/stats");
		}
    }
?>