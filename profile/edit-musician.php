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
	
	$sql = "SELECT * FROM redict WHERE id='".$idpage."' AND ownerid='".$SaveSession_UID."'";
	$result = $db->query($sql);
	if($rowedit = $result->fetch_assoc())
	{
		if($rowedit['access'] == 1 && $rowedit['status'] == 2)
		{
			if($_POST['update'])
			{
				if($rowedit['access'] == 1)
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
							$sql = "UPDATE redict SET ArtistName='".$_POST['ArtistName']."' WHERE id='".$idpage."' AND ownerid='".$SaveSession_UID."' AND access=1";
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
							$sql = "".$sql." WHERE name='".$rowedit['ArtistID']."' AND ownerid='".$SaveSession_UID."' AND access=0";
							$db->query($sql);
						}
						
						if ($_SERVER['REQUEST_METHOD'] == 'POST')// Обработка запроса обновления фотографии
						{
							$newfileid = (int)$rowedit["jpgrelizid"]+1;
							$path = '/var/www/u0909374/data/www/lnk-to.ru/images/';// Пути загрузки файлов
							$oldnamejpg = ''.$rowedit["sub"].'_'.$rowedit["name"].'_'.$rowedit["jpgrelizid"].'.jpg';// Старый файл
							$namejpg = ''.$rowedit["sub"].'_'.$rowedit["name"].'_'.$newfileid.'.jpg';// Новый файл
							$WHht = 700;// Размер квадрата
							$types = array('image/jpeg'); // 'image/gif', 'image/png',  // Массив допустимых значений типа файла
							$size = 1024000; //256000 // Максимальный размер файла
							if (!in_array($_FILES['picture']['type'], $types))
							{
								if(is_uploaded_file($_FILES['picture']['tmp_name']))
								{
									echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Обложка": Запрещённый тип файла (разрешено: .jpg)</font></h5>';// Проверяем тип файла
								}
							}
							else
							{
								if ($_FILES['picture']['size'] > $size)
								{
									echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Обложка": Слишком большой размер файла (разрешено: <1mB)</font></h5>';// Проверяем размер файла
								}
								else
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
									
									if(file_exists($path . $oldnamejpg)) unlink($path . $oldnamejpg);
									
									if(file_exists($path . $namejpg)) 
									{
										$sql = "UPDATE redict SET jpgrelizid='".$newfileid."' WHERE id='".$idpage."' AND ownerid='".$SaveSession_UID."' AND access=1";
										$db->query($sql);
										echo'<h5 class="card-title">Обложка успешно загружена!</h5>';
									} 
									else 
									{
										echo'<h5 class="card-title"><font color="red">Неизвестная ошибка сохранения(1) "Обложка": обратитесь к администратору</font></h5>';
									}
								}
							}
						}
						
						
						// *************************************
						echo'
										<a href="https://lk.lnk-to.ru/list/edit/musician?id='.$idpage.'" class="btn btn-info pull-left">Продолжить редактирование</a>';
											if($rowedit['sub']) echo '<a href="https://'.$rowedit['sub'].'.lnk-to.ru/'.$rowedit['name'].'" class="btn btn-success pull-right" target="_blank">Перейти к странице</a>';
											else echo '<a href="https://lnk-to.ru/'.$rowedit['name'].'" class="btn btn-success pull-right" target="_blank">Перейти к странице</a>';
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
				else
				{
					header("Location: https://lk.lnk-to.ru/list");
					exit;
				}
			}
		}
		else
		{
			header("Location: https://lk.lnk-to.ru/list");
			exit;
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
					<div class="card-header card-header-primary">
					<title>Редактирование страницы музыканта</title>
					  <h4 class="card-title">Редактирование страницы музыканта</h4>
						  <p class="card-category">Страница музыканта </p>
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
										if($rowedit['sub']) echo' <input class="form-control" disabled type="text" value="'.$rowedit['sub'].'.lnk-to.ru/'.$rowedit['name'].'"> ';
										else echo '<input class="form-control" disabled type="text" value="lnk-to.ru/'.$rowedit['name'].'"> ';
									echo'
									</div>
								</div>
									<div class="col-md-5">
										<div class="form-group">
										  <label class="bmd-label-floating" >ID Артиста</label>
										  <input type="text" class="form-control" disabled value="'.$rowedit['ArtistID'].'">
										</div>
									</div>
							</div>
							
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="bmd-label-floating" >Имя артиста</label>
											<input type="text" class="form-control" name="ArtistName" value="'.$rowedit['ArtistName'].'">
										</div>
									</div>
								</div>';
								
								$sql = "SELECT * FROM artists WHERE name='".$rowedit['ArtistID']."' AND ownerid='".$SaveSession_UID."' AND access=0";
								$result = $db->query($sql);
								if($rowedit = $result->fetch_assoc())
								{
									echo'
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
											  <label class="bmd-label-floating" >Страница vk.com</label>
											  <input type="text" class="form-control" name="vk" value="'.$rowedit['vk'].'">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											  <label class="bmd-label-floating" >Канал на YouTube</label>
											  <input type="text" class="form-control" name="yt" value="'.$rowedit['yt'].'">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											  <label class="bmd-label-floating" >Страница в Instagram</label>
											  <input type="text" class="form-control" name="inst" value="'.$rowedit['inst'].'">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											  <label class="bmd-label-floating" >Страница на Twitter</label>
											  <input type="text" class="form-control" name="twit" value="'.$rowedit['twit'].'">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
											  <label class="bmd-label-floating" >Страница на FaceBook</label>
											  <input type="text" class="form-control" name="face" value="'.$rowedit['face'].'">
											</div>
										</div>
									</div>
									<h4 class="card-title">Обновить обложку:
										<input name="picture" type="file" />
									</h4>
									';
								}
							echo' 
							<input class="btn btn-primary pull-right" type="submit" name="update" value="Обновить"/>
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