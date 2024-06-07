<?php
	if(!empty($_GET ['code']))  
	{
		$id_app     =     '1' ;                      //Айди приложения
		$secret_app =    'key';         // Защищённый ключ. Можно узнать там же где и айди
		$url_script   =    'https://lk.lnk-to.ru/auth_vk'; //ссылка на этот скрипт
		$token = json_decode(file_get_contents('https://oauth.vk.com/access_token?client_id='.$id_app.'&client_secret='.$secret_app.'&code='.$_GET['code'].'&redirect_uri='.$url_script), true);
		$fields       = 'first_name,last_name,id';
		$uinf = json_decode(file_get_contents('https://api.vk.com/method/users.get?uids='.$token['user_id'].'&fields='.$fields.'&access_token='.$token['access_token'].'&v=5.80'), true); 
		$_SESSION['access_token'] = $token['access_token'];

		$sql = "SELECT * FROM users WHERE vkid='".$token['user_id']."' LIMIT 1";
		$result = $db->query($sql);
		if($row = $result->fetch_assoc())
		{ 
			require_once 'auth_token.php';
		}
		else
		{
			$sql = "INSERT INTO users (`id`, `vkid`, `name`, `name_family`) VALUES (NULL, '".$token['user_id']."','".$uinf['response'][0]['first_name']."','".$uinf['response'][0]['last_name']."')";
			$result = $db->query($sql);					
			$sql = "SELECT * FROM users WHERE vkid='".$token['user_id']."' LIMIT 1";
			$result = $db->query($sql);
			if($row = $result->fetch_assoc())
			{ 
				require_once 'auth_token.php';
			}
		}

		header("Location: https://lk.lnk-to.ru/stats");
    }
?>