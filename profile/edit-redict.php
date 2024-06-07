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
		if(($rowedit['access'] == 1 || $rowedit['access'] == 0) && ($rowedit['status'] == 1 || $rowedit['status'] == 3)) // Редактирование перед модерацией/обновлением без модерации
		{
			if($_POST['update'])
			{
				if($rowedit['status'] == 1 || $rowedit['status'] == 3) // переадреации
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
												if($rowedit['access'] == 1)
												{
													echo'
													<a href="https://lk.lnk-to.ru/list/edit?id='.$idpage.'" class="btn btn-info pull-left">Продолжить редактирование</a>';
													$sql = "UPDATE redict SET ArtistID='".mysqli_real_escape_string($db,$_POST['transfer'])."' WHERE id='".$idpage."' AND ownerid='".$SaveSession_UID."' AND access=1";
													$db->query($sql);
												}
												else
												{
													$sql = "INSERT INTO redict (`ownerid`, `status`, `sub`,`name`,`ArtistID`,`access`,`accessinfo`) VALUES ('".$SaveSession_UID."','11','".$rowedit['sub']."','".$rowedit['name']."','".mysqli_real_escape_string($db,$_POST['transfer'])."','".$rowedit['status']."','".$idpage."')";
													$db->query($sql);
													echo'
													<a href="https://lk.lnk-to.ru/list/edit?id='.$db->insert_id.'" class="btn btn-info pull-left">Отправка на модерацию</a>';
													
													$sql = "UPDATE redict SET access=11, accessinfo=".$db->insert_id." WHERE id='".$idpage."' AND ownerid='".$SaveSession_UID."' AND access=0";
													$db->query($sql);
											
												}
											}
											else { echo'<h5 class="card-title"><font color="red">Ошибка сохранения "Дополнительная информация": недопустимые символы. Вы ввели: '.$_POST['transfer'].'</font></h5>';} // Дополнительная информация
							
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
					<title>Редактирование страницы переадресации</title>
					  <h4 class="card-title">Редактирование страницы переадресации</h4>'; 
						if($rowedit['sub']) echo' <p class="card-category">'.$rowedit['sub'].'.lnk-to.ru/'.$rowedit['name'].'   --->   '.$rowedit['ArtistID'].'</p>';
						else echo '<p class="card-category">lnk-to.ru/'.$rowedit['name'].'   --->   '.$rowedit['ArtistID'].'</p>';
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
										if($rowedit['sub']) echo' <input class="form-control" disabled type="text" value="'.$rowedit['sub'].'.lnk-to.ru/'.$rowedit['name'].'"> ';
										else echo '<input class="form-control" disabled type="text" value="lnk-to.ru/'.$rowedit['name'].'"> ';
									echo'
									</div>
								</div>
									<div class="col-md-4">
										<div class="form-group">
										  <label class="bmd-label-floating" >Адрес переадресации</label>
										  <input type="text" class="form-control" name="transfer" value="'.$rowedit['ArtistID'].'">
										</div>
									</div>
							</div>';
							if($rowedit['access'] == 1) echo' <input class="btn btn-primary pull-right" type="submit" name="update" value="Обновить"/> ';
							else if($rowedit['access'] == 0) echo' <input class="btn btn-primary pull-right" type="submit" name="update" value="Отправить на модерацию"/> ';
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