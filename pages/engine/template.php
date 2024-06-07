<?php
	class Template 
	{
		function ErrorFoundPage($action,$actionsub)
		{	
			echo'
			<style> body{background-color: #95c2de;} .mainbox{background-color: #95c2de;margin: auto;height: 600px;width: 600px;position: relative;} .err{color: #ffffff;font-family: "Nunito Sans", sans-serif;font-size: 11rem;position:absolute;left: 20%;top: 8%;} .far {position: absolute;font-size: 8.5rem;left: 42%;top: 15%;color: #ffffff;} .err2 {color: #ffffff;font-family: "Nunito Sans", sans-serif;font-size: 11rem;position:absolute;left: 68%;top: 8%;} .msg {text-align: center;font-family: "Nunito Sans", sans-serif;font-size: 1.6rem;position:absolute;left: 16%;top: 45%;width: 75%;} a {text-decoration: none;color: white;} a:hover {text-decoration: underline;} </style>
				<head> <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600;900&display=swap" rel="stylesheet"> <script src="https://kit.fontawesome.com/4b9ba14b0f.js" crossorigin="anonymous"></script> </head>
				<body> <div class="mainbox"> <div class="err">4</div> <i class="far fa-question-circle fa-spin"></i> <div class="err2">4</div>';	
			if($actionsub) // Если есть субдомен
			{
				if($action) echo'<div class="msg">Страница '.$actionsub.'.lnk-to.ru/'.$action.' не найдена. Если это ошибка, сообщите <a href="https://vk.com/im?sel=1">Администратору</a><p> <a href="https://lnk-to.ru">Home</a></p></div></div></body>';
				else echo'<div class="msg">Страница '.$actionsub.'.lnk-to.ru не найдена. Если это ошибка, сообщите <a href="https://vk.com/im?sel=1">Администратору</a><p> <a href="https://lnk-to.ru">Home</a></p></div></div></body>';
			}
			else
			{
				echo'<div class="msg">Страница lnk-to.ru/'.$action.' не найдена. Если это ошибка, сообщите <a href="https://vk.com/im?sel=1">Администратору</a><p> <a href="https://lnk-to.ru">Home</a></p></div></div></body>';
			}
			return 0;
		}
		function RecViewSQL($id,$ownerid)
		{
			global $rows, $db;
			//АнтиБот
			if(!preg_match('/(bot|Bot|2ip|WebDataStats|Go-http-client|Python|python|BackupLand|curl|vk.com\/dev\/Share)/', $_SERVER['HTTP_USER_AGENT']))
			{
				if(!isset($_COOKIE["spamid".$id.""])) // антинакрутка просмотров
				{
					$today = (int)(time()/86400);
					$sql = "SELECT id FROM visits WHERE date='".$today."' AND idpage='".$id."' LIMIT 1";
					$result = $db->query($sql);
					if($vizets = $result->fetch_assoc())
					{
						if(isset($_COOKIE["id".$id.""]))
						{
							$sql = "UPDATE visits SET total=total+1 WHERE date='".$today."' AND idpage='".$id."'";
							$db->query($sql);
						}
						else
						{
							$sql = "UPDATE visits SET total=total+1,uni=uni+1 WHERE date='".$today."' AND idpage='".$id."'";
							$db->query($sql);
						}
					}
					else 
					{
						$sql = "INSERT INTO visits (`idpage`,`date`,`uni`,`total`,`ownerid`) VALUES ('".$id."','".$today."','1','1','".$ownerid."')";
						$db->query($sql);
					}
					setcookie("id".$id."",1, time()+84400);  // срок действия 1 час(3600) 1 день (84400)
					setcookie("spamid".$id."",1, time()+3600);  // срок действия 1 час(3600) 1 день (84400)
				}
				$sql = "INSERT INTO visitors (`PageID`, `time`, `OwnerID`, `IP`, `Browser`, `REDIRECT`) VALUES ('".$id."', '".time()."', '".$ownerid."', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['HTTP_USER_AGENT']."','[".$_SERVER['REQUEST_TIME_FLOAT']."] ".$_SERVER['SERVER_NAME']."".$_SERVER['REQUEST_URI']."')"; // [".$_SERVER['REQUEST_TIME_FLOAT']."] ".$_SERVER['SERVER_NAME']."".$_SERVER['REQUEST_URI']."
				$db->query($sql); 
			}
			else
			{
				$sql = "INSERT INTO visitorsbot (`PageID`, `time`, `OwnerID`, `IP`, `Browser`, `REDIRECT`) VALUES ('".$id."', '".time()."', '".$ownerid."', '".$_SERVER['REMOTE_ADDR']."', '".$_SERVER['HTTP_USER_AGENT']."','[".$_SERVER['REQUEST_TIME_FLOAT']."] ".$_SERVER['SERVER_NAME']."".$_SERVER['REQUEST_URI']."')"; //,'из ".$_SERVER['REDIRECT_QUERY_STRING']." в ".$_SERVER['QUERY_STRING']." (".$_SERVER['REQUEST_URI'].")')";
				$db->query($sql); 
			}
			return 0;
		}
		
		function views($action,$actionsub) 
		{
			global $rows, $db;
			$sql = "SELECT sub FROM redict WHERE sub='$actionsub' LIMIT 1";
			$result = $db->query($sql);
			if($row = $result->fetch_assoc())
			{
				$sql = "SELECT * FROM redict WHERE name='$action' AND sub='$actionsub' AND status < 5 LIMIT 1"; 
				$result = $db->query($sql);
				$current_year = date ( 'Y' );
				if($row = $result->fetch_assoc())
				{
					$this->RecViewSQL($row['id'],$row['ownerid']); // Записываем просмотр в базу данных для анализа
					
					if($row['status'] == 0) require_once(ENGINE_DIR . 'loadtrack.php');
					else if($row['status'] == 1)
					{
						header('Refresh: 2; url=https://'.$row['ArtistID'].'');
						echo '
							<title>Переадресация на '.$row['ArtistID'].'</title>
							<link rel="shortcut icon" href="https://lnk-to.ru/service_images/shortcut.png">
							<h1 style="color: #5e9ca0; text-align: center;">Вы покидаете сайт lnk-to.ru</h1>
							<p style="text-align: center;">
							<span style="background-color: #FFD700; color: #fff; display: inline-block; padding: 3px 10px; font-weight: bold; border-radius: 5px;">
							<a title="Перейти на '.$row['ArtistID'].' сейчас!" href="https://'.$row['ArtistID'].'" style="color: #ffffff">Переадресация произойдёт через 3 секунды</a></span>&nbsp;</p>
							
						';
					}
					else if($row['status'] == 2) require_once(ENGINE_DIR . 'loadartist.php');
					else if($row['status'] == 3)
					{
						header('Location: https://'.$row['ArtistID'].'');
						echo '
							<title>Переадресация на '.$row['ArtistID'].'</title>
							<link rel="shortcut icon" href="https://lnk-to.ru/service_images/shortcut.png">
							<h1 style="color: #5e9ca0; text-align: center;">Вы покидаете сайт lnk-to.ru</h1>
							<p style="text-align: center;">
							<span style="background-color: #FFD700; color: #fff; display: inline-block; padding: 3px 10px; font-weight: bold; border-radius: 5px;">
							<a title="Перейти на '.$row['ArtistID'].' сейчас!" href="https://'.$row['ArtistID'].'" style="color: #ffffff">Переадресация произойдёт через 0 секунд</a></span>&nbsp;</p>';
					}
					else if($row['status'] == 4)
					{
						if(is_readable('/var/www/u0909374/data/www/lnk-to.ru/'.$row['ArtistID'].'')) require_once('/var/www/u0909374/data/www/lnk-to.ru/'.$row['ArtistID'].'');
						else $this->ErrorFoundPage($action,$actionsub);
					}
					else 
					{
						if($actionsub) header('Location: https://'.$actionsub.'.lnk-to.ru');
						else $this->ErrorFoundPage($action,$actionsub);
					}
				}
				else
				{	
					if($actionsub && !$action) // если есть субдомен, но нет ссылки
					{
						$this->ErrorFoundPage($action,$actionsub);
					}
					else if($actionsub)
					{
						//$this->ErrorFoundPage($action,$actionsub);
						header('Location: https://'.$actionsub.'.lnk-to.ru'); // ОШИБКА ЛИШНЕЙ ПЕРЕАДРЕСАЦИИ
					}
					else
					{
						$this->ErrorFoundPage($action,$actionsub);
					}
				}
				return 0;
			}
			$this->ErrorFoundPage($action,$actionsub);
			return 0;
		}
	}
?>