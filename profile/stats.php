<?php
	ob_start(); // Initiate the output buffer
	require_once 'check_token.php';
	$topsize = 1;
	require_once 'topsize.php'; // верхняя часть страницы
echo '
<title>Статистика</title>
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">insert_link</i>
                  </div>
                  <p class="card-category">Переадресация</p>
                  <h3 class="card-title">';
				  $sql = "SELECT count(*) FROM redict WHERE (ownerid='".$SaveSession_UID."') AND (status=1 OR status=3)";
				  $result = $db->query($sql);
				  $row2 = $result->fetch_assoc();	
				  echo''.$row2['count(*)'].'';
				  if($user_lvl >= 90) echo '<small>/∞</small>';
				  else if($user_lvl%10 == 3) echo '<small>/240</small>';
				  else if($user_lvl%10 == 2) echo '<small>/100</small>';
				  else if($user_lvl%10 == 1) echo '<small>/40</small>';
				  else if($user_lvl%10 == 0) echo '<small>/15</small>';
                  echo '</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">add_box</i> Добавить 10 страниц переадресаций
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">album</i>
                  </div>
                  <p class="card-category">Страница релиза</p>
                  <h3 class="card-title">';
				  $sql = "SELECT count(*) FROM redict WHERE (ownerid='".$SaveSession_UID."') AND (status=0)";
				  $result = $db->query($sql);
				  $row2 = $result->fetch_assoc();	
				  echo''.$row2['count(*)'].'';
				  if($user_lvl >= 90) echo '<small>/∞</small>';
				  else if($user_lvl%10 == 3) echo '<small>/60</small>';
				  else if($user_lvl%10 == 2) echo '<small>/25</small>';
				  else if($user_lvl%10 == 1) echo '<small>/10</small>';
				  else if($user_lvl%10 == 0) echo '<small>/4</small>';
                  echo '</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">add_box</i> Добавить 4 страницы релиза
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">library_music</i>
                  </div>
                  <p class="card-category">Страница музыканта</p>
                  <h3 class="card-title">';
				  $sql = "SELECT count(*) FROM redict WHERE (ownerid='".$SaveSession_UID."') AND (status=2)";
				  $result = $db->query($sql);
				  $row2 = $result->fetch_assoc();	
				  echo''.$row2['count(*)'].'';
				  if($user_lvl >= 90) echo '<small>/∞</small>';
				  else if($user_lvl%10 == 3) echo '<small>/20</small>';
				  else if($user_lvl%10 == 2) echo '<small>/8</small>';
				  else if($user_lvl%10 == 1) echo '<small>/3</small>';
				  else if($user_lvl%10 == 0) echo '<small>/1</small>';
                  echo '</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">add_box</i> Добавить 1 страницу музыканта
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">monetization_on</i>
                  </div>
                  <p class="card-category">Баланс</p>
                  <h3 class="card-title">'.$user_money.'
                    <small>рублей</small>
                  </h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">payments</i> Пополнить баланс
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Самые популярные страницы по уникальным посетителям</h4>
                  <p class="card-category">Статистика за последние 7 дней</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Ссылка на страницу</th>
                      <th>Уникальные посетители</th>
                      <th>Просмотров за неделю</th>
                    </thead>
                    <tbody>';
					
					$today = (int)(time()/86400);
					$i = 1;
					
					$sql = "SELECT idpage,uni,total FROM visits WHERE date>='".($today-6)."' AND ownerid='".$SaveSession_UID."'";

					$result2 = $db->query($sql);
					while($row2 = $result2->fetch_assoc())		
					{
						$pageidtotal[$row2['idpage']] += $row2['total'];
						$pageiduni[$row2['idpage']] += $row2['uni'];
					}
					
					arsort($pageiduni);
					
						
						
					foreach ($pageiduni as $key => $val) 
					{
						if($i <= 20)
						{
							echo'
							<tr>
							<td>'.$i++.'</td>';
							$sql = "SELECT sub,name FROM redict WHERE id=".$key."";
							$result = $db->query($sql);
							
							if($row3 = $result->fetch_assoc())		
							{
								if($row3['sub'])
								{
									echo'<td><a href="https://'.$row3['sub'].'.lnk-to.ru/'.$row3['name'].'" target="_blank">'.$row3['sub'].'.lnk-to.ru/'.$row3['name'].'</a></td>';
								}
								else
								{
									echo'<td><a href="https://lnk-to.ru/'.$row3['name'].'" target="_blank">lnk-to.ru/'.$row3['name'].'</a></td>';
								}
							}	
							
							
							if($val == $_COOKIE["stats".$key.""] || $_COOKIE["stats".$key.""] == 0) 
							{
								echo'
								<td><b>'.$val.'</b></td>
								';
							}
							else if($val > $_COOKIE["stats".$key.""]) 
							{
								echo'
								<td><b>'.$val.'</b> <font color="green">(+'.($val-$_COOKIE["stats".$key.""]).')</font></td>
								';
							}
							else if($val < $_COOKIE["stats".$key.""]) 
							{
								echo'
								<td><b>'.$val.'</b> <font color="red">('.($val-$_COOKIE["stats".$key.""]).')</font></td>
								';
							}
							
							
							if($pageidtotal[$key] == $_COOKIE["statsB".$key.""] || $_COOKIE["statsB".$key.""] == 0) 
							{
								echo'
								<td>'.$pageidtotal[$key].'</td>
								</tr>
								';
							}
							else if($pageidtotal[$key] > $_COOKIE["statsB".$key.""]) 
							{
								echo'
								<td>'.$pageidtotal[$key].' <font color="green">(+'.($pageidtotal[$key]-$_COOKIE["statsB".$key.""]).')</font></td>
								</tr>
								';
							}
							else if($pageidtotal[$key] < $_COOKIE["statsB".$key.""]) 
							{
								echo'
								<td>'.$pageidtotal[$key].' <font color="red">('.($pageidtotal[$key]-$_COOKIE["statsB".$key.""]).')</font></td>
								</tr>
								';
							}
							
						}
						setcookie("stats".$key."", $val, time()+604800);
					}
					unset($pageidtotal);
					unset($pageiduni);
					
					echo'
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Самые популярные страницы по просмотрам</h4>
                  <p class="card-category">Статистика за последние 7 дней</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-warning">
                      <th>ID</th>
                      <th>Ссылка на страницу</th>
                      <th>Уникальные посетители</th>
                      <th>Просмотров за неделю</th>
                    </thead>
                    <tbody>';
					
					$i = 1;
					
					$sql = "SELECT idpage,uni,total FROM visits WHERE date>='".($today-6)."' AND ownerid='".$SaveSession_UID."'";
					$result2 = $db->query($sql);
					while($row2 = $result2->fetch_assoc())		
					{
						$pageidtotal[$row2['idpage']] += $row2['total'];
						$pageiduni[$row2['idpage']] += $row2['uni'];
					}
					
					arsort($pageidtotal);
					
					foreach ($pageidtotal as $key => $val) 
					{
						if($i <= 20)
						{
							echo'
							<tr>
							<td>'.$i++.'</td>';
							$sql = "SELECT sub,name FROM redict WHERE id=".$key."";
							$result = $db->query($sql);
							
							if($row3 = $result->fetch_assoc())		
							{
								if($row3['sub'])
								{
									echo'<td><a href="https://'.$row3['sub'].'.lnk-to.ru/'.$row3['name'].'" target="_blank">'.$row3['sub'].'.lnk-to.ru/'.$row3['name'].'</a></td>';
								}
								else
								{
									echo'<td><a href="https://lnk-to.ru/'.$row3['name'].'" target="_blank">lnk-to.ru/'.$row3['name'].'</a></td>';
								}
							}	
							
							
							

							if($pageiduni[$key] == $_COOKIE["stats".$key.""] || $_COOKIE["stats".$key.""] == 0) 
							{
								echo'
								<td><b>'.$pageiduni[$key].'</b></td>
								';
							}
							else if($pageiduni[$key] > $_COOKIE["stats".$key.""]) 
							{
								echo'
								<td><b>'.$pageiduni[$key].'</b> <font color="green">(+'.($pageiduni[$key]-$_COOKIE["stats".$key.""]).')</font></td>
								';
							}
							else if($pageiduni[$key] < $_COOKIE["stats".$key.""]) 
							{
								echo'
								<td><b>'.$pageiduni[$key].'</b> <font color="red">('.($pageiduni[$key]-$_COOKIE["stats".$key.""]).')</font></td>
								';
							}
							
							
							if($val == $_COOKIE["statsB".$key.""] || $_COOKIE["statsB".$key.""] == 0) 
							{
								echo'
								<td>'.$val.'</td>
								</tr>
								';
							}
							else if($val > $_COOKIE["statsB".$key.""]) 
							{
								echo'
								<td>'.$val.' <font color="green">(+'.($val-$_COOKIE["statsB".$key.""]).')</font></td>
								</tr>
								';
							}
							else if($val < $_COOKIE["statsB".$key.""]) 
							{
								echo'
								<td>'.$val.' <font color="red">('.($val-$_COOKIE["statsB".$key.""]).')</font></td>
								</tr>
								';
							}
							
							
							
						}
						setcookie("statsB".$key."",$val, time()+604800);
					}
					
					echo'
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
';

	require_once 'footersize.php'; // нижняя часть страницы
?>