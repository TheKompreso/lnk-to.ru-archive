<?php
	require_once 'check_token.php';
	if($user_lvl < 10)
	{
		header("Location: https://lk.lnk-to.ru/stats");
		exit;
	}
	if($_GET['id'])
	{
		$idpage = $_GET['id'];
		$_SESSION['edit_id'] = $idpage;
	}
	else
	{
		$idpage = $_SESSION['edit_id'];
	}

	$sql = "SELECT * FROM help WHERE id='".$idpage."' AND (access = 0 OR access = 1)";
	$result = $db->query($sql);
	if($row4 = $result->fetch_assoc())
	{
		if($_POST['text'])
		{
			$today = date("Y-m-d H:i");
			$posttext = str_replace(array("\"","<",">", "\\", "*", ";", "'"),"",$_POST['text']); // замена К на 000
			$sql = "INSERT INTO `help-messages` (`idhelp`, `text`, `iduser`,`date`) VALUES ('".$row4['id']."','".mysqli_real_escape_string($db,$posttext)."','".$SaveSession_UID."','".$today."')";
			$db->query($sql);
		}
	}
	else
	{
		header("Location: https://lk.lnk-to.ru/help/list");
		exit;
	}
	
	$topsize = 7;
	require_once 'topsize.php'; // верхняя часть страницы
	
	echo '
		<title>Список страниц</title>

	<div class="content">
			<div class="container-fluid">
			  <div class="row">
				<div class="col-md-8">
				  <div class="card">
					<div class="card-header card-header-primary">
					  <h4 class="card-title">Поддержка</h4>';
					  
						if($row4["typereason"] == 5)
						{
							$sql = "SELECT id,sub,name FROM redict WHERE id=".$row4['page']."";
							$result = $db->query($sql);
							$row6 = $result->fetch_assoc();
							
							if($row6["sub"]){ echo' <p class="card-category">Страница релиза '.$row6["sub"].'.lnk-to.ru/'.$row6["name"].'';}
							else{ echo' <p class="card-category">Страница релиза lnk-to.ru/'.$row6["name"].'';}
								
							if($row4["typeproblem"] == 1) echo' - ID музыканта 1</p>';
							else if($row4["typeproblem"] == 2) echo' - ID музыканта 2</p>';
							else if($row4["typeproblem"] == 3) echo' - Имена артистов</p>';
							else if($row4["typeproblem"] == 4) echo' - Название релиза</p>';
							else if($row4["typeproblem"] == 5) echo' - Дата релиза</p>';
							else if($row4["typeproblem"] == 6) echo' - Имя музыканта 1</p>';
							else if($row4["typeproblem"] == 7) echo' - Дополнительная информация</p>';
							else if($row4["typeproblem"] == 8) echo' - Информация о релизе в карточке музыканта</p>';
							else if($row4["typeproblem"] == 9) echo' - Apple Music</p>';
							else if($row4["typeproblem"] == 10) echo' - Boom</p>';
							else if($row4["typeproblem"] == 11) echo' - Yandex Music</p>';
							else if($row4["typeproblem"] == 12) echo' - VK Music</p>';
							else if($row4["typeproblem"] == 13) echo' - Google Play</p>';
							else if($row4["typeproblem"] == 14) echo' - Spotify</p>';
							else if($row4["typeproblem"] == 15) echo' - Deezer</p>';
							else if($row4["typeproblem"] == 16) echo' - Genius</p>';
							else if($row4["typeproblem"] == 17) echo' - Обложка</p>';
							else if($row4["typeproblem"] == 18) echo' - Другое</p>';
						}
					  echo'
					</div>
					<div class="card-body">
						<form action="" method="post">';
						
							require_once 'userinfo.php';
							$sql = "SELECT * FROM `help-messages` WHERE idhelp=".$idpage." ORDER BY id";
							$result = $db->query($sql);
							while($row9 = $result->fetch_assoc())		
							{
								if($row9['iduser'] == 0)
								{
									$sql = "SELECT typeacc,name FROM users WHERE id=".$row4['userid']."";
									$result2 = $db->query($sql);
									$row12 = $result2->fetch_assoc();
									
									echo'
									<div class="alert alert-SUCCESS alert-with-icon" data-notify="container">
										<i class="material-icons" data-notify="icon">perm_identity</i>
										<h6>'.$user_status["".$row12["typeacc"].""].' '.$row12["name"].'['.$row4['userid'].']: '.$row9['date'].'</h6>
										<span data-notify="message">'.$row9['text'].'</span>
									</div>
									';
								}
								else if($row9['iduser'] == $SaveSession_UID)
								{
									echo'
									<div class="alert alert-WARNING alert-with-icon" data-notify="container">
										<i class="material-icons" data-notify="icon">face</i>
										<h6>Вы: '.$row9['date'].'</h6>
										<span data-notify="message">'.$row9['text'].'</span>
									</div>';
								}
								else
								{
									$sql = "SELECT typeacc,name FROM users WHERE id=".$row9['iduser']."";
									$result2 = $db->query($sql);
									$row12 = $result2->fetch_assoc();
									
									echo'
									<div class="alert alert-WARNING alert-with-icon" data-notify="container">
										<i class="material-icons" data-notify="icon">face</i>
										<h6>'.$user_status["".$row12["typeacc"].""].' '.$row12["name"].'['.$row9['iduser'].']: '.$row9['date'].'</h6>
										<span data-notify="message">'.$row9['text'].'</span>
									</div>';
								}
							}
							
							echo'
							<div class="row">
							  <div class="col-md-12">
								<div class="form-group">
								  <label>Новое сообщение:</label>
								  <div class="form-group">
									<label class="bmd-label-floating">ваше сообщение</label>
									<textarea class="form-control" name="text" rows="5"></textarea>
								  </div>
								</div>
							  </div>
							</div>
							<button type="submit" class="btn btn-primary pull-right">Отправить запрос</button>
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