<?php
	require_once 'check_token.php';
	
	
	$topsize = 6;
	if($_POST['text'])
	{
		$posttext = str_replace(array("\"","<",">", "\\", "*", ";", "'"),"",$_POST['text']); // замена К на 000
		$today = date("Y-m-d H:i");
		$sql = "INSERT INTO help (`userid`, `typereason`, `page`, `typeproblem`, `date`) VALUES ('".$SaveSession_UID."', '5', '".(int)$_POST['page_id']."', '".(int)$_POST['problem_id']."', '".$today."')";
		$db->query($sql);
		$createid = $db->insert_id;
		$sql = "INSERT INTO `help-messages` (`idhelp`, `text`, `iduser`,`date`) VALUES ('".$createid."','".mysqli_real_escape_string($db,$posttext)."','0','".$today."')";
		$db->query($sql);
		
		require_once 'topsize.php'; // верхняя часть страницы
		echo'
		<div class="content">
			<div class="container-fluid">
			  <div class="row">
				<div class="col-md-8">
					<div class="card-header card-header-primary">
						<h4 class="card-title">Запрос успешно создан</h4>
							<a href="https://lk.lnk-to.ru/help" class="btn btn-info pull-left">Поддержка</a>
							<a href="https://lk.lnk-to.ru/help/list" class="btn btn-success pull-right" target="_blank">Перейти к списку запросов</a>
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
	
	require_once 'topsize.php'; // верхняя часть страницы
	
	echo '
	<title>Поддержка</title>

	<div class="content">
			<div class="container-fluid">
			  <div class="row">
				<div class="col-md-8">
				  <div class="card">
					<div class="card-header card-header-primary">
					  <h4 class="card-title">Поддержка</h4>
					  <p class="card-category">Страница релиза</p>
					</div>
					<div class="card-body">
						<form action="" method="post">
							<div class="row">
								<div class="col-md-4">Выберете страницу, связанную с проблемой: 
									<div class="form-group">
										<select name="page_id">
											<option value="0" selected></option>';
												$sql = "SELECT id,sub,name FROM redict WHERE (ownerid='".$SaveSession_UID."') AND (status=0) ORDER BY RelizDate DESC";
												$result = $db->query($sql);
												while($row5 = $result->fetch_assoc())		
												{
													if($row5["sub"]){ echo' <option value="'.$row5["id"].'">'.$row5["sub"].'.lnk-to.ru/'.$row5["name"].'</option> ';}
													else { echo' <option value="'.$row5["id"].'">lnk-to.ru/'.$row5["name"].'</option> ';}
												}
											echo'
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">Выберете пункт, связанный с проблемой:
									<div class="form-group">
										<select name="problem_id">
										  <option value="0"></option>
										  <option value="1" selected>ID музыканта 1</option>
										  <option value="2">ID музыканта 2</option>
										  <option value="3">Имена артистов</option>
										  <option value="4">Название релиза</option>
										  <option value="5">Дата релиза</option>
										  <option value="6">Имя музыканта 1</option>
										  <option value="7">Дополнительная информация</option>
										  <option value="8">Информация о релизе в карточке музыканта</option>
										  <option value="9">Apple Music</option>
										  <option value="10">Boom</option>
										  <option value="11">Yandex Music</option>
										  <option value="12">VK Music</option>
										  <option value="13">Google Play</option>
										  <option value="14">Spotify</option>
										  <option value="15">Deezer</option>
										  <option value="16">Genius</option>
										  <option value="17">Обложка</option>
										  <option value="18">Другое</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
							  <div class="col-md-12">
								<div class="form-group">
								  <label>Описание:</label>
								  <div class="form-group">
									<label class="bmd-label-floating">Опишите ваш запрос</label>
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