<?php
	require_once 'check_token.php';
	$topsize = 8;
	
	if($_POST['url'])
	{
		if(preg_match('/^[a-zA-Zа-яА-Я0-9]+$/u',$_POST['url']) && preg_match('/^[a-zA-Z0-9]+$/',$_POST['music1']))
		{
			if(!$_POST['music2'] || preg_match('/^[a-zA-Z0-9]+$/',$_POST['music2']))
			{
				$sql = "SELECT name FROM artists WHERE (ownerid='".$SaveSession_UID."') AND name='".mysqli_real_escape_string($db,$_POST['music1'])."'";
				$result = $db->query($sql);
				if($row2 = $result->fetch_assoc())		
				{
					if($_POST['sub'])
					{
						if(preg_match('/^[a-zA-Z0-9]+$/',$_POST['sub']))
						{
							$sql = "SELECT sub FROM redict WHERE (ownerid='".$SaveSession_UID."') AND (name='') AND sub='".$_POST['sub']."'";
							$result = $db->query($sql);
							if($row2 = $result->fetch_assoc())		
							{
								$today = date("Ymd")+10000;
								$sql = "INSERT INTO redict (`ownerid`, `status`, `sub`,`name`,`ArtistID`,`ArtistID2`,`RelizDate`,`access`) VALUES ('".$SaveSession_UID."','0','".$_POST['sub']."','".$_POST['url']."','".$_POST['music1']."','".$_POST['music2']."','".$today."','1')";
								$db->query($sql);
								header("Location: https://lk.lnk-to.ru/list/edit?id=".$db->insert_id."");
								exit;
							}
						}
						else
						{
						}
					}
					else
					{
						$today = date("Ymd")+10000;
						$sql = "INSERT INTO redict (`ownerid`, `status`,`name`,`ArtistID`,`ArtistID2`,`RelizDate`,`access`) VALUES ('".$SaveSession_UID."','0','".$_POST['url']."','".$_POST['music1']."','".$_POST['music2']."','".$today."','1')";
						$db->query($sql);
						header("Location: https://lk.lnk-to.ru/list/edit?id=".$db->insert_id."");
						exit;
					}
				}
			}
		}
		else
		{
		}
	}

	require_once 'topsize.php'; // верхняя часть страницы
	echo '
	<title>Создание страницы релиза</title>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8">
					<div class="card">
						<div class="card-header card-header-primary">
						
							<h4 class="card-title">Создание страницы релиза</h4>
							<p class="card-category">Введите основные данные:</p>
						
						</div>
						<div class="card-body">
							<form action="" enctype="multipart/form-data" method="post">
								<div class="row">
									<div class="col-md-4">Субдомен:
										<div class="form-group">
											<select name="sub">
												<option value="0"></option>';
												$sql = "SELECT sub FROM redict WHERE (ownerid='".$SaveSession_UID."') AND (name='') AND status<10";
												$result = $db->query($sql);
												while($row2 = $result->fetch_assoc())		
												{
													echo'<option value="'.$row2['sub'].'"> '.$row2['sub'].' </option>';
												}
												echo'</select>
										</div>
									</div>
									<div class="col-md-4">ID музыканта 1:
										<div class="form-group">
											<select name="music1">';
												$sql = "SELECT name FROM artists WHERE (ownerid='".$SaveSession_UID."')";
												$result = $db->query($sql);
												while($row2 = $result->fetch_assoc())		
												{
													echo'<option value="'.$row2['name'].'"> '.$row2['name'].' </option>';
												}
												echo'</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="bmd-label-floating">Адрес страницы</label>
											<input class="form-control" type="text" name="url" value="">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="bmd-label-floating">ID музыканта 2</label>
											<input class="form-control" type="text" name="music2" value="">
										</div>
									</div>
								</div>
								<input class="btn btn-primary pull-right" type="submit" name="create" value="Создать"/>
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