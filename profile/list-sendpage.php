<?php
	require_once 'check_token.php';
	
	if($_GET['id'])
	{
		$idpage = $_GET['id'];
		$_SESSION['edit_id'] = $idpage;
	}
	else
	{
		$idpage = $_SESSION['edit_id'];
	}
	
	$sql = "SELECT * FROM redict WHERE id='".$idpage."' AND ownerid='".$SaveSession_UID."' AND (status=11)";
	$result = $db->query($sql);
	if($row4 = $result->fetch_assoc())
	{
		if($_POST['update'] || $_POST['update_moderate'])
		{
			if($row4['access'] == 1 || $row4['access'] == 3)	
			{
				if($_POST['transfer'])
				{		
					$topsize = 5;
					require_once 'topsize.php'; // верхняя часть страницы
					echo'
					<div class="content">
						<div class="container-fluid">
						  <div class="row">
							<div class="col-md-8">
								<div class="card-header card-header-primary">
									<h4 class="card-title">Редактирование страницы переадресации</h4>';
									
										if(preg_match('/^[a-zA-Z0-9абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ $,().!?\-_\@\/]+$/',$_POST['transfer'])) 
										{ 
											
											$sql = "UPDATE redict SET ArtistID='".mysqli_real_escape_string($db,$_POST['transfer'])."'";
											if($_POST['update_moderate']) $sql = "".$sql.", status=12"; 
											$sql = "".$sql." WHERE id='".$idpage."' AND ownerid='".$SaveSession_UID."' AND status=11";
											$db->query($sql);
											
											if($_POST['update_moderate'])
											{
												$sql = "UPDATE redict SET access='12' WHERE id='".$row4['accessinfo']."' AND ownerid='".$SaveSession_UID."' AND access=11";
												$db->query($sql);
											}
										}
										else { echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Дополнительная информация": недопустимые символы. Вы ввели: '.$_POST['transfer'].'</font></h5>';} // Дополнительная информация
						
										echo'
										<a href="https://lk.lnk-to.ru/list/sendpage?id='.$idpage.'" class="btn btn-info pull-left">Продолжить редактирование</a>';
											if($row4['sub']) echo '<a href="https://'.$row4['sub'].'.lnk-to.ru/'.$row4['name'].'" class="btn btn-success pull-right" target="_blank">Перейти к странице</a>';
											else echo '<a href="https://lnk-to.ru/'.$row4['name'].'" class="btn btn-success pull-right" target="_blank">Перейти к странице</a>';
											echo'
										<div class="clearfix"></div>
								</div>
							  </div>
						  </div>
						</div>
					</div>
					';
					require_once 'footersize.php'; // нижняя часть страницы
					exit;
				}
			}
			else if($row4['access'] == 0) // Страница релиза
			{
				if($_POST['RelizTittle'])
				{
					$topsize = 5;
					require_once 'topsize.php'; // верхняя часть страницы
					echo'
					<div class="content">
						<div class="container-fluid">
						  <div class="row">
							<div class="col-md-8">
								<div class="card-header card-header-primary">
									<h4 class="card-title">Редактирование страницы переадресации</h4>';
					$sql = "UPDATE redict SET";
					
					$tempint = (int)$_POST['AppleID'];
					$sql = "".$sql." AppleID='".$tempint."'"; // Apple Music
					
					$tempint = (int)$_POST['BoomID'];
					$sql = "".$sql.", BoomID='".$tempint."'"; // Boom
					
					$tempint = (int)$_POST['YaID'];
					$sql = "".$sql.", YaID='".$tempint."'"; // Yandex Music
					
					$tempint = (int)$_POST['DeezerID'];
					$sql = "".$sql.", DeezerID='".$tempint."'"; // Deezer
					
					if(preg_match('/^[a-zA-Z0-9абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ $,.!?\-\_]+$/',$_POST['RelizTittle'])) { $sql = "".$sql.", RelizTittle='".$_POST['RelizTittle']."'"; }
					else { if($_POST['RelizTittle']) { echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Имена Артистов": недопустимые символы. Вы ввели: '.$_POST['RelizTittle'].'</font></h5>'; } }
					
					if(preg_match('/^[a-zA-Z0-9абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ $,.!?\-\_]+$/',$_POST['RelizName'])) { $sql = "".$sql.", RelizName='".$_POST['RelizName']."'"; }
					else { if($_POST['RelizName']) { echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Название релиза": недопустимые символы. Вы ввели: '.$_POST['RelizName'].'</font></h5>';}} // Название релиза
					
					$tempint = (int)$_POST['RelizDate'];
					if($tempint > 19700101 && $tempint < 99990101) { $sql = "".$sql.", RelizDate='".$_POST['RelizDate']."'"; }
					else { if($_POST['RelizDate']) { echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Дата релиза": недопустимые символы. Вы ввели: '.$_POST['RelizDate'].'</font></h5>';}} // Дата релиза
					
					if(preg_match('/^[a-zA-Z0-9абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ $,.!?\-\_]+$/',$_POST['ArtistName'])) { $sql = "".$sql.", ArtistName='".$_POST['ArtistName']."'"; }
					else { if($_POST['ArtistName']) { echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Имя музыканта 1": недопустимые символы. Вы ввели: '.$_POST['ArtistName'].'</font></h5>';}} // Имя музыканта 1
					
					if(preg_match('/(- |!enter)$/',$_POST['DopInfo']) && preg_match('/^[a-zA-Z0-9абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ $,().!?\-\_\@]+$/',$_POST['DopInfo'])) 
					{ 
						$sql = "".$sql.", ArtistPHP='".$_POST['DopInfo']."'";
					}
					else { if($_POST['DopInfo']) { echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Дополнительная информация": недопустимые символы. Вы ввели: '.$_POST['DopInfo'].'</font></h5>';}} // Дополнительная информация
					
					if(preg_match('/^[a-zA-Z0-9абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ $,.!?\-\_]+$/',$_POST['RelizInfo'])) { $sql = "".$sql.", RelizInfo='".$_POST['RelizInfo']."'"; }
					else { if($_POST['RelizInfo']) { echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Информация о релизе": недопустимые символы. Вы ввели: '.$_POST['RelizInfo'].'</font></h5>';}} // Информация о релизе
					
					if(preg_match('/^[a-zA-Z0-9!?\-\_\=\%\/]+$/',$_POST['VKID'])) { $sql = "".$sql.", VKID='".$_POST['VKID']."'"; }
					else { if($_POST['VKID']) { echo'<h5 class="card-title"><font color="red">Ошибка сохранения "VK Music": недопустимые символы. Вы ввели: '.$_POST['VKID'].'</font></h5>';}} // VK Music
					
					if(preg_match('/^[a-zA-Z0-9]+$/',$_POST['GoogleID'])) { $sql = "".$sql.", GoogleID='".$_POST['GoogleID']."'"; }
					else { if($_POST['GoogleID']) { echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Google Play": недопустимые символы. Вы ввели: '.$_POST['GoogleID'].'</font></h5>';}} // Google Play
					
					if(preg_match('/^[a-zA-Z0-9]+$/',$_POST['SpotyID'])) { $sql = "".$sql.", SpotyID='".$_POST['SpotyID']."'"; }
					else { if($_POST['SpotyID']) { echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Spotify": недопустимые символы. Вы ввели: '.$_POST['SpotyID'].'</font></h5>';}} // Spotify 
					
					if(preg_match('/^[a-zA-Z0-9\-]+$/',$_POST['GeniusID'])) { $sql = "".$sql.", GeniusID='".$_POST['GeniusID']."'"; }
					else { if($_POST['GeniusID']) { echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Genius": недопустимые символы. Вы ввели: '.$_POST['GeniusID'].'</font></h5>';}} // Genius
					
					if ($_SERVER['REQUEST_METHOD'] == 'POST')// Обработка запроса обновления фотографии
					{
						$newfileid = (int)$row4["jpgrelizid"]+1;
						$path = '/var/www/u0909374/data/www/lnk-to.ru/images/';// Пути загрузки файлов
						$oldnamejpg = ''.$row4["sub"].'_'.$row4["name"].'_'.$row4["jpgrelizid"].'.jpg';// Старый файл
						$namejpg = ''.$row4["sub"].'_'.$row4["name"].'_'.$newfileid.'.jpg';// Новый файл
						$WHht = 700;// Размер квадрата
						$types = array('image/jpeg'); // 'image/gif', 'image/png',  // Массив допустимых значений типа файла
						$size = 1024000; //256000 // Максимальный размер файла
						if (!in_array($_FILES['picture']['type'], $types))
						{
							echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Обложка": Запрещённый тип файла (разрешено: .jpg)</font></h5>';// Проверяем тип файла
						}
						else
						{
							if ($_FILES['picture']['size'] > $size)
							{
								echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Обложка": Слишком большой размер файла (разрешено: <1mB)</font></h5>';// Проверяем размер файла
							}
							else
							{
								if(file_exists($path . $oldnamejpg)) 
								{
									if ($_FILES['picture']['type'] == 'image/jpeg') $source = imagecreatefromjpeg($_FILES['picture']['tmp_name']);
									//else if ($_FILES['picture']['type'] == 'image/png') $source = imagecreatefrompng($_FILES['picture']['tmp_name']);
									//else if ($_FILES['picture']['type'] == 'image/gif') $source = imagecreatefromgif($_FILES['picture']['tmp_name']);
									$w_src = imagesx($source); 
									$h_src = imagesy($source);
									$new_image = imagecreatetruecolor($WHht, $WHht);
									imagecopyresampled($new_image, $source, 0, 0, 0, 0, $WHht, $WHht, $w_src, $h_src);
									imagejpeg($new_image, $path . $namejpg, 75);
									
									imagedestroy($new_image);
									imagedestroy($source);
									unlink($path . $oldnamejpg);
									if (file_exists($path . $namejpg)) 
									{
										$sql = "".$sql.", jpgrelizid='".$newfileid."'";
										echo'<h5 class="card-title">Обложка успешно загружена!</h5>';
									} 
									else 
									{
										echo'<h5 class="card-title"><font color="red">Неизвестная ошибка сохранения(1) "Обложка": обратитесь к администратору</font></h5>';
									}
								}
								else
								{
									echo'<h5 class="card-title"><font color="red">Неизвестная ошибка сохранения(2) "Обложка": обратитесь к администратору</font></h5>';
								}
							}
						}
					}
					
					
					$sql = "".$sql." WHERE id='".$idpage."' AND ownerid='".$SaveSession_UID."' AND access=0";
					$db->query($sql);
					// *************************************
					echo'
									<a href="https://lk.lnk-to.ru/list/edit?id='.$idpage.'" class="btn btn-info pull-left">Продолжить редактирование</a>';
										if($row4['sub']) echo '<a href="https://'.$row4['sub'].'.lnk-to.ru/'.$row4['name'].'" class="btn btn-success pull-right" target="_blank">Перейти к странице</a>';
										else echo '<a href="https://lnk-to.ru/'.$row4['name'].'" class="btn btn-success pull-right" target="_blank">Перейти к странице</a>';
										echo'
									<div class="clearfix"></div>
								</div>
							  </div>
						  </div>
						</div>
					</div>
					';
					require_once 'footersize.php'; // нижняя часть страницы
					//Переход на основную страницу
					//header("Location: https://lk.lnk-to.ru/list");
					exit;
				}
			}
			else if($row4['access'] == 2) // Страница музыканта
			{
				if($_POST['ArtistName'])
				{
					$topsize = 5;
					require_once 'topsize.php'; // верхняя часть страницы
					echo'
					<div class="content">
						<div class="container-fluid">
						  <div class="row">
							<div class="col-md-8">
								<div class="card-header card-header-primary">
									<h4 class="card-title">Редактирование страницы музыканта</h4>';
					
					if(preg_match('/^[a-zA-Z0-9абвгдеёжзийклмнопрстуфхцчшщъыьэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯ $,.!?\-\_]+$/',$_POST['ArtistName'])) 
					{
						$sql = "UPDATE redict SET ArtistName='".$_POST['ArtistName']."' WHERE id='".$idpage."' AND ownerid='".$SaveSession_UID."' AND access=0";
						$db->query($sql);
					}
					else 
					{ 
						if($_POST['ArtistName']) 
						{ 
							echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Имя музыканта 1": недопустимые символы. Вы ввели: '.$_POST['ArtistName'].'</font></h5>';
						}
						else 
						{
							echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Имя музыканта 1": вы не ввели имя</font></h5>';
						}
					} // Имя музыканта 1
					
					
					$updq = false;
					
					if(preg_match('/^[a-zA-Z0-9!?\-\_\=\%\/]+$/',$_POST['vk'])) 
					{ 
						if($updq)
						{ 
							$sql = "".$sql.", vk='".$_POST['vk']."'"; 
						}
						else 
						{
							$sql = "UPDATE artists SET vk='".$_POST['vk']."'";
							$updq = true;
						}
					}
					else
					{ 
						if($_POST['vk']) 
						{ 
							echo'<h5 class="card-title"><font color="red">Ошибка сохранения "VK": недопустимые символы. Вы ввели: '.$_POST['vk'].'</font></h5>';
						} // VK 
					}
					
					if(preg_match('/^[a-zA-Z0-9!?\-\_\=\%\/]+$/',$_POST['yt'])) 
					{ 
						if($updq)
						{ 
							$sql = "".$sql.", yt='".$_POST['yt']."'"; 
						}
						else 
						{
							$sql = "UPDATE artists SET yt='".$_POST['yt']."'";
							$updq = true;
						}
					}
					else
					{ 
						if($_POST['yt']) 
						{ 
							echo'<h5 class="card-title"><font color="red">Ошибка сохранения "YouTube": недопустимые символы. Вы ввели: '.$_POST['yt'].'</font></h5>';
						} // yt 
					}
					
					if(preg_match('/^[a-zA-Z0-9!?\-\_\=\%\/]+$/',$_POST['inst'])) 
					{ 
						if($updq)
						{ 
							$sql = "".$sql.", inst='".$_POST['inst']."'"; 
						}
						else 
						{
							$sql = "UPDATE artists SET inst='".$_POST['inst']."'";
							$updq = true;
						}
					}
					else
					{ 
						if($_POST['inst']) 
						{ 
							echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Instagram": недопустимые символы. Вы ввели: '.$_POST['inst'].'</font></h5>';
						} // inst 
					}
					
					if(preg_match('/^[a-zA-Z0-9!?\-\_\=\%\/]+$/',$_POST['twit'])) 
					{ 
						if($updq)
						{ 
							$sql = "".$sql.", twit='".$_POST['twit']."'"; 
						}
						else 
						{
							$sql = "UPDATE artists SET twit='".$_POST['twit']."'";
							$updq = true;
						}
					}
					else
					{ 
						if($_POST['twit']) 
						{ 
							echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Twitter": недопустимые символы. Вы ввели: '.$_POST['twit'].'</font></h5>';
						} // inst 
					}
					
					if(preg_match('/^[a-zA-Z0-9!?\-\_\.\=\%\/]+$/',$_POST['face'])) 
					{ 
						if($updq)
						{ 
							$sql = "".$sql.", face='".$_POST['face']."'"; 
						}
						else 
						{
							$sql = "UPDATE artists SET face='".$_POST['face']."'";
							$updq = true;
						}
					}
					else
					{ 
						if($_POST['face']) 
						{ 
							echo'<h5 class="card-title"><font color="red">Ошибка сохранения "FaceBook": недопустимые символы. Вы ввели: '.$_POST['face'].'</font></h5>';
						} // face 
					}
					
					if($updq)
					{
						$sql = "".$sql." WHERE name='".$row4['ArtistID']."' AND ownerid='".$SaveSession_UID."' AND access=0";
						$db->query($sql);
					}
					
					if ($_SERVER['REQUEST_METHOD'] == 'POST')// Обработка запроса обновления фотографии
					{
						$newfileid = (int)$row4["jpgrelizid"]+1;
						$path = '/var/www/u0909374/data/www/lnk-to.ru/images/';// Пути загрузки файлов
						$oldnamejpg = ''.$row4["sub"].'_'.$row4["name"].'_'.$row4["jpgrelizid"].'.jpg';// Старый файл
						$namejpg = ''.$row4["sub"].'_'.$row4["name"].'_'.$newfileid.'.jpg';// Новый файл
						$WHht = 700;// Размер квадрата
						$types = array('image/jpeg'); // 'image/gif', 'image/png',  // Массив допустимых значений типа файла
						$size = 1024000; //256000 // Максимальный размер файла
						if (!in_array($_FILES['picture']['type'], $types))
						{
							echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Обложка": Запрещённый тип файла (разрешено: .jpg)</font></h5>';// Проверяем тип файла
						}
						else
						{
							if ($_FILES['picture']['size'] > $size)
							{
								echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Обложка": Слишком большой размер файла (разрешено: <1mB)</font></h5>';// Проверяем размер файла
							}
							else
							{
								if(file_exists($path . $oldnamejpg)) 
								{
									if ($_FILES['picture']['type'] == 'image/jpeg') $source = imagecreatefromjpeg($_FILES['picture']['tmp_name']);
									//else if ($_FILES['picture']['type'] == 'image/png') $source = imagecreatefrompng($_FILES['picture']['tmp_name']);
									//else if ($_FILES['picture']['type'] == 'image/gif') $source = imagecreatefromgif($_FILES['picture']['tmp_name']);
									$w_src = imagesx($source); 
									$h_src = imagesy($source);
									$new_image = imagecreatetruecolor($WHht, $WHht);
									imagecopyresampled($new_image, $source, 0, 0, 0, 0, $WHht, $WHht, $w_src, $h_src);
									imagejpeg($new_image, $path . $namejpg, 75);
									
									imagedestroy($new_image);
									imagedestroy($source);
									unlink($path . $oldnamejpg);
									if (file_exists($path . $namejpg)) 
									{
										$sql = "UPDATE redict SET jpgrelizid='".$newfileid."' WHERE id='".$idpage."' AND ownerid='".$SaveSession_UID."' AND access=0";
										$db->query($sql);
										echo'<h5 class="card-title">Обложка успешно загружена!</h5>';
									} 
									else 
									{
										echo'<h5 class="card-title"><font color="red">Неизвестная ошибка сохранения(1) "Обложка": обратитесь к администратору</font></h5>';
									}
								}
								else
								{
									echo'<h5 class="card-title"><font color="red">Неизвестная ошибка сохранения(2) "Обложка": обратитесь к администратору</font></h5>';
								}
							}
						}
					}
					
					
					// *************************************
					echo'
									<a href="https://lk.lnk-to.ru/list/edit?id='.$idpage.'" class="btn btn-info pull-left">Продолжить редактирование</a>';
										if($row4['sub']) echo '<a href="https://'.$row4['sub'].'.lnk-to.ru/'.$row4['name'].'" class="btn btn-success pull-right" target="_blank">Перейти к странице</a>';
										else echo '<a href="https://lnk-to.ru/'.$row4['name'].'" class="btn btn-success pull-right" target="_blank">Перейти к странице</a>';
										echo'
									<div class="clearfix"></div>
								</div>
							  </div>
						  </div>
						</div>
					</div>
					';
					require_once 'footersize.php'; // нижняя часть страницы
					//Переход на основную страницу
					//header("Location: https://lk.lnk-to.ru/list");
					exit;
					
				}
			}
		}
	}
	else
	{
		header("Location: https://lk.lnk-to.ru/list");
		exit;
	}
	
	$topsize = 5;
	require_once 'topsize.php'; // верхняя часть страницы
	
	echo'
		<div class="content">
			<div class="container-fluid">
			  <div class="row">
				<div class="col-md-8">
				  <div class="card">
					<div class="card-header card-header-primary">';
					  if($row4['access'] == 1 || $row4['access'] == 3) 
					  {
						  echo'
					<title>Редактирование страницы переадресации</title>
					  <h4 class="card-title">Редактирование страницы переадресации</h4>'; 
						if($row4['sub']) echo' <p class="card-category">'.$row4['sub'].'.lnk-to.ru/'.$row4['name'].'   --->   '.$row4['ArtistID'].'</p>';
						else echo '<p class="card-category">lnk-to.ru/'.$row4['name'].'   --->   '.$row4['ArtistID'].'</p>';
						
					  }
					  else if($row4['access'] == 2)
					  {						  
						  echo'
					<title>Редактирование страницы музыканта</title>
					  <h4 class="card-title">Редактирование страницы музыканта</h4>
						  <p class="card-category">Страница музыканта </p>';
					  }
					  else if($row4['access'] == 0) 
					  {
						  echo'
					<title>Редактирование страницы релиза</title>
					  <h4 class="card-title">Редактирование страницы релиза</h4>
						  <p class="card-category">'.$row4['RelizTittle'].' - '.$row4['RelizName'].'</p>';
					  }
					  echo'
					</div>
					<div class="card-body">
						<form action="" enctype="multipart/form-data" method="post">
						
							<div class="row">
								<div class="col-md-2">
									<div class="form-group">
										<label class="bmd-label-floating">ID страницы</label>
										<input class="form-control" disabled type="text" name="id" value="'.$idpage.'">
									</div>
								</div>

								<div class="col-md-3">
									<div class="form-group">
										<label class="bmd-label-floating">Адрес страницы</label>';
										if($row4['sub']) echo' <input class="form-control" disabled type="text" value="'.$row4['sub'].'.lnk-to.ru/'.$row4['name'].'"> ';
										else echo '<input class="form-control" disabled type="text" value="lnk-to.ru/'.$row4['name'].'"> ';
									echo'
									</div>
								</div>
							';
							if($row4['access'] == 1 || $row4['access'] == 3) // Переадресация	
							{
								echo'
									<div class="col-md-4">
										<div class="form-group">
										  <label class="bmd-label-floating" >Адрес переадресации</label>
										  <input type="text" class="form-control" name="transfer" value="'.$row4['ArtistID'].'">
										</div>
									</div>
							</div>
								';
							}
							else if($row4['access'] == 0) // Страница релиза
							{
								echo'
									<div class="col-md-2">
										<div class="form-group">
											<label class="bmd-label-floating">ID музыканта 1</label>
											<input class="form-control" disabled type="text" value="'.$row4['ArtistID'].'">
										</div>
									</div>
									<div class="col-md-2">
										<div class="form-group">
											<label class="bmd-label-floating">ID музыканта 2</label>
											<input class="form-control" disabled type="text" value="'.$row4['ArtistID2'].'">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
										  <label class="bmd-label-floating" >Имена Артистов</label>
										  <input type="text" class="form-control" name="RelizTittle" value="'.$row4['RelizTittle'].'">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
										  <label class="bmd-label-floating" >Название релиза</label>
										  <input type="text" class="form-control" name="RelizName" value="'.$row4['RelizName'].'">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
										  <label class="bmd-label-floating" >Дата релиза</label>
										  <input type="text" class="form-control" name="RelizDate" value="'.$row4['RelizDate'].'">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
										  <label class="bmd-label-floating" >Имя музыканта 1</label>
										  <input type="text" class="form-control" name="ArtistName" value="'.$row4['ArtistName'].'">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
										  <label class="bmd-label-floating" >Дополнительная информация</label>
										  <input type="text" class="form-control" name="DopInfo" value="'.$row4['ArtistPHP'].'">
										</div>
									</div>
									<div class="col-md-5">
										<div class="form-group">
										  <label class="bmd-label-floating" >Информация о релизе в карточке музыканта</label>
										  <input type="text" class="form-control" name="RelizInfo" value="'.$row4['RelizInfo'].'">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
										  <label class="bmd-label-floating" >Apple Music (music.apple.com/ru/album/НОМЕР)</label>
										  <input type="text" class="form-control" name="AppleID" value="'.$row4['AppleID'].'">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										  <label class="bmd-label-floating" >Boom (boom.ru/redirect/album/НОМЕР)</label>
										  <input type="text" class="form-control" name="BoomID" value="'.$row4['BoomID'].'">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										  <label class="bmd-label-floating" >Yandex Music (music.yandex.ru/album/НОМЕР)</label>
										  <input type="text" class="form-control" name="YaID" value="'.$row4['YaID'].'">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										  <label class="bmd-label-floating" >VK Music (vk.com/ССЫЛКА)</label>
										  <input type="text" class="form-control" name="VKID" value="'.$row4['VKID'].'">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										  <label class="bmd-label-floating" >Google Play (play.google.com/store/music/album/?id=ССЫЛКА)</label>
										  <input type="text" class="form-control" name="GoogleID" value="'.$row4['GoogleID'].'">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										  <label class="bmd-label-floating" >Spotify (open.spotify.com/album/ССЫЛКА)</label>
										  <input type="text" class="form-control" name="SpotyID" value="'.$row4['SpotyID'].'">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										  <label class="bmd-label-floating" >Deezer (deezer.com/ru/album/НОМЕР)</label>
										  <input type="text" class="form-control" name="DeezerID" value="'.$row4['DeezerID'].'">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
										  <label class="bmd-label-floating" >Genius (genius.com/ССЫЛКА)</label>
										  <input type="text" class="form-control" name="GeniusID" value="'.$row4['GeniusID'].'">
										</div>
									</div>
								</div>
									
									<h4 class="card-title">Обновить обложку:
									<input name="picture" type="file" />
									</h4>
									
									<div class="alert alert-info alert-with-icon" data-notify="container">
										<i class="material-icons" data-notify="icon">error_outline</i>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											  <i class="material-icons">close</i>
											</button>
										<span data-notify="message">Дата релиза указывается в формате ГОД-МЕСЯЦ-ДЕНЬ. Пример: 2020-03-03</span>
									</div>
									
									<div class="alert alert-info alert-with-icon" data-notify="container">
										<i class="material-icons" data-notify="icon">error_outline</i>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											  <i class="material-icons">close</i>
											</button>
										<span data-notify="message">"Имена Артистов" отображаются в заголовке страницы</span>
										<img src="https://lnk-to.ru/profile/info_0.jpg" alt="Подсказка 1">
									</div>
									
									<div class="alert alert-info alert-with-icon" data-notify="container"><h4>Дополнительная информация</h4>
										<i class="material-icons" data-notify="icon">error_outline</i>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											  <i class="material-icons">close</i>
											</button>
										<span data-notify="message">1. В "Дополнительная информация" нужно указать то, что будет отображаются после Имени Музыканта 1.</span>
										<span data-notify="message">2. Для добавления ссылки используйте @ссылка[текст]</span>
										<span data-notify="message">3. Чтобы сделать перенос строки, напишите !enter</span>
										<span data-notify="message">4. Не забудьте написать " - " или "!enter" перед названием релиза</span>
										<span data-notify="message">5. При указании " - " не забудьте поставить пробелы, иначе оно сольётся с названием релиза</span>
									</div>
									
									<div class="alert alert-info alert-with-icon" data-notify="container"><h4>Порядок отображения информации о релизе:</h4>
										<i class="material-icons" data-notify="icon">error_outline</i>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											  <i class="material-icons">close</i>
											</button>
										<span data-notify="message">"Имя музыканта 1"  "Дополнительная информация"  "Название релиза"</span>
										<img src="https://lnk-to.ru/profile/info_1.jpg" alt="Подсказка 1">
									</div>
								';
								// RelizTittle - RelizName
								// ArtistName ArtistPHP RelizName
								
								// АРТИСТЫ_РЕЛИЗА - НАЗВАНИЕ_РЕЛИЗА
								// ИМЯ_МУЗЫКАНТА_1 ДОПОЛНИТЕЛЬНАЯ_ИНФОРМАЦИЯ НАЗВАНИЕ_РЕЛИЗА
							}
							else if($row4['access'] == 2) // Страница музыканта
							{
								echo'
									<div class="col-md-5">
										<div class="form-group">
										  <label class="bmd-label-floating" >ID Артиста</label>
										  <input type="text" class="form-control" disabled value="'.$row4['ArtistID'].'">
										</div>
									</div>
							</div>
							
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="bmd-label-floating" >Имя артиста</label>
											<input type="text" class="form-control" name="ArtistName" value="'.$row4['ArtistName'].'">
										</div>
									</div>
								</div>';
								
								
								$sql = "SELECT * FROM artists WHERE name='".$row4['ArtistID']."' AND ownerid='".$SaveSession_UID."' AND access=0";
								$result = $db->query($sql);
								if($row4 = $result->fetch_assoc())
								{
									echo'
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
											  <label class="bmd-label-floating" >Страница vk.com</label>
											  <input type="text" class="form-control" name="vk" value="'.$row4['vk'].'">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											  <label class="bmd-label-floating" >Канал на YouTube</label>
											  <input type="text" class="form-control" name="yt" value="'.$row4['yt'].'">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											  <label class="bmd-label-floating" >Страница в Instagram</label>
											  <input type="text" class="form-control" name="inst" value="'.$row4['inst'].'">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											  <label class="bmd-label-floating" >Страница на Twitter</label>
											  <input type="text" class="form-control" name="twit" value="'.$row4['twit'].'">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											  <label class="bmd-label-floating" >Страница на FaceBook</label>
											  <input type="text" class="form-control" name="face" value="'.$row4['face'].'">
											</div>
										</div>
									</div>
									<h4 class="card-title">Обновить обложку:
										<input name="picture" type="file" />
									</h4>
									';
								}
								else
								{
									echo'ОШИБКА. СООБЩИТЕ АДМИНИСТРАЦИИ
									';
								}
							}
							
							echo' <input class="btn btn-primary pull-right" type="submit" name="update" value="Обновить"/> ';
							echo' <input class="btn btn-primary pull-right" type="submit" name="update_moderate" value="Отправить на модерацию"/> ';
							echo'
							<div class="clearfix"></div>
						</form>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		</div>
	';
	
	require_once 'footersize.php'; // нижняя часть страницы
?>