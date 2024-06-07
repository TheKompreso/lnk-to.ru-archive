<?php
	require_once 'check_token.php';
	$topsize = 3;
	require_once 'topsize.php'; // верхняя часть страницы
	
	echo '
	<title>Список страниц</title>
	<div class="content">
			<div class="container-fluid">
			  <div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header card-header-primary">
						  <h4 class="card-title ">Переадресация</h4>
						  <p class="card-category">список ваших адресов переадресации</p>
						</div>
						<div class="card-body">
						  <div class="table-responsive">
							<table class="table">
							  <thead class=" text-primary">
								<th>ID</th>
								<th>Адрес страницы</th>
								<th>Адрес переадресации</th>
								<th>Редактирование</th>
							  </thead>
							  <tbody>';
							  
								$sql = "SELECT * FROM redict WHERE (ownerid='".$SaveSession_UID."') AND (status=1 OR status=3) ORDER BY RelizDate DESC";
								$result = $db->query($sql);
								while($row2 = $result->fetch_assoc())		
								{
									echo '
									<tr>
									    <td>'.$row2['id'].'</td>';
									    
										if($row2['sub']) echo '<td>'.$row2['sub'].'.lnk-to.ru/'.$row2['name'].'</td>';
										else echo '<td>lnk-to.ru/'.$row2['name'].'</td>';
										
										
										if(strlen($row2['ArtistID']) > 75) echo ' <td><a href="https://'.$row2['ArtistID'].'" target="newframe">'.substr($row2['ArtistID'], 0, 70).'...</a></td> ';
										else echo ' <td><a href="https://'.$row2['ArtistID'].'" target="newframe">'.$row2['ArtistID'].'</a></td> '; 
										
										if($row2['access'] == 0) echo ' <td><a href="https://lk.lnk-to.ru/list/edit/redirection?id='.$row2['id'].'">Редактировать</a></td>';
										else if($row2['access'] == 1) echo ' <td><a href="https://lk.lnk-to.ru/list/edit/redirection?id='.$row2['id'].'">Редактировать(без модерации)</a></td>';
										else if($row2['access'] == 2) echo ' <td>Отключено администрацией</td>';
										else if($row2['access'] == 11) echo ' <td>На модерации</td>';
										else echo ' <td>Ошибка. Обратитесь к администратору</td>';
									echo '
									</tr>
									';
								}
								
							  echo '
							  </tbody>
							</table>
							<a href="https://lk.lnk-to.ru/list/create/redict" class="btn btn-danger pull-right">Создать</a>
						  </div>
						</div>
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="card">
						<div class="card-header card-header-primary">
						  <h4 class="card-title ">Страницы релизов</h4>
						  <p class="card-category">список ваших релизов</p>
						</div>
						<div class="card-body">
						  <div class="table-responsive">
							<table class="table">
							  
							  <thead class=" text-primary">
								<th>ID</th>
								<th>Адрес страницы</th>
								<th>Имя релиза</th>
								<th>Apple music</th>
								<th>Boom</th>
								<th>Yandex music</th>
								<th>VK music</th>
								<th>Google Play</th>
								<th>Spotify</th>
								<th>Deezer</th>
								<th>Genius</th>
								<th>Статус</th>
							  </thead>
							  
							  <tbody>';
							  
								$sql = "SELECT * FROM redict WHERE (ownerid='".$SaveSession_UID."') AND (status=0) ORDER BY RelizDate DESC";
								$result = $db->query($sql);
								while($row2 = $result->fetch_assoc())		
								{
									echo '
									<tr>
									    <td>'.$row2['id'].'</td>';
										
										if($row2['sub']) echo '<td><a href="https://'.$row2['sub'].'.lnk-to.ru/'.$row2['name'].'" target="newframe">'.$row2['sub'].'.lnk-to.ru/'.$row2['name'].'</a></td>';
										else echo '<td><a href="https://lnk-to.ru/'.$row2['name'].'" target="newframe">lnk-to.ru/'.$row2['name'].'</a></td>';
										
										echo' <td>'.$row2['RelizTittle'].' - '.$row2['RelizName'].'</a></td> ';		
										
										if($row2['AppleID']) echo ' <th><font color="#FFD700"><a href="https://music.apple.com/ru/album/'.$row2['AppleID'].'?app=music&l=ru" title="music.apple.com/ru/album/'.$row2['AppleID'].'?app=music&l=ru" target="newframe">Apple</a></font></th> ';
										else echo ' <th>null</th> ';
										if($row2['BoomID']) echo ' <th><font color="#FFD700"><a href="https://boom.ru/redirect/album/'.$row2['BoomID'].'" title="boom.ru/redirect/album/'.$row2['BoomID'].'" target="newframe">Boom</a></font></th> ';
										else echo ' <th>null</th> ';
										if($row2['YaID']) echo ' <th><font color="#FFD700"><a href="https://music.yandex.ru/album/'.$row2['YaID'].'" title="music.yandex.ru/album/'.$row2['YaID'].'" target="newframe">Yandex</a></font></th> ';
										else echo ' <th>null</th> ';
										if($row2['VKID']) echo ' <th><font color="#FFD700"><a href="https://vk.com/'.$row2['VKID'].'" title="vk.com/'.$row2['VKID'].'" target="newframe">VK</a></font></th> ';
										else echo ' <th>null</th> ';
										if($row2['GoogleID']) echo ' <th><font color="#FFD700"><a href="https://play.google.com/store/music/album/?id='.$row2['GoogleID'].'" title="play.google.com/store/music/album/?id='.$row2['GoogleID'].'" target="newframe">Google</a></font></th> ';
										else echo ' <th>null</th> ';
										if($row2['SpotyID']) echo ' <th><font color="#FFD700"><a href="https://open.spotify.com/album/'.$row2['SpotyID'].'" title="open.spotify.com/album/'.$row2['SpotyID'].'" target="newframe">Spotify</a></font></th> ';
										else echo ' <th>null</th> ';
										if($row2['DeezerID']) echo ' <th><font color="#FFD700"><a href="https://www.deezer.com/ru/album/'.$row2['DeezerID'].'" title="deezer.com/ru/album/'.$row2['DeezerID'].'" target="newframe">Deezer</a></font></th> ';
										else echo ' <th>null</th> ';
										if($row2['GeniusID']) echo ' <th><font color="#FFD700"><a href="https://genius.com/'.$row2['GeniusID'].'" title="genius.com/'.$row2['GeniusID'].'" target="newframe">Genius</a></font></th> ';
										else echo ' <th>null</th> ';
										
										
										if($row2['access'] == 0) echo ' <td>Отключено (сообщите администрации)</a></td>';
										else if($row2['access'] == 1) echo ' <td><a href="https://lk.lnk-to.ru/list/edit/reliz?id='.$row2['id'].'">Редактировать</a></td>';
										else if($row2['access'] == 2) echo ' <td>Отключено администрацией</td>';
										else echo ' <td>Ошибка. Обратитесь к администратору</td>';
									
									echo '
									</tr>
									';
								}
								
							  echo '
							  </tbody>
							</table>
							<a href="https://lk.lnk-to.ru/list/create/reliz" class="btn btn-primary pull-right">Создать</a>
						  </div>
						</div>
					</div>
				</div>
				
				<div class="col-md-12">
					<div class="card">
						<div class="card-header card-header-primary">
						  <h4 class="card-title ">Страницы музыкантов</h4>
						  <p class="card-category">список страниц музыкантов</p>
						</div>
						<div class="card-body">
						  <div class="table-responsive">
							<table class="table">
							  
							  <thead class=" text-primary">
								<th>ID</th>
								<th>Адрес страницы</th>
								<th>Имя артиста</th>
								<th>vk.com</th>
								<th>YouTube</th>
								<th>Instagram</th>
								<th>Twitter</th>
								<th>FaceBook</th>
								<th>Статус</th>
							  </thead>
							  
							  <tbody>';
							  
								$sql = "SELECT * FROM redict WHERE (ownerid='".$SaveSession_UID."') AND (status=2) ORDER BY RelizDate DESC";
								$result = $db->query($sql);
								while($row2 = $result->fetch_assoc())		
								{
									echo '
									<tr>
									    <td>'.$row2['id'].'</td>';
									    
										if($row2['sub']) echo '<td><a href="https://'.$row2['sub'].'.lnk-to.ru/'.$row2['name'].'" target="newframe">'.$row2['sub'].'.lnk-to.ru/'.$row2['name'].'</a></td>';
										else echo '<td><a href="https://lnk-to.ru/'.$row2['name'].'" target="newframe">lnk-to.ru/'.$row2['name'].'</a></td>';
										
										echo '<td>'.$row2['ArtistName'].'</td>';
										
										$sql = "SELECT * FROM artists WHERE name='".$row2['ArtistID']."' LIMIT 1";
										$result3 = $db->query($sql);
										if($row3 = $result3->fetch_assoc())
										{
											if($row3['vk']) echo ' <th><font color="#FFD700"><a href="https://vk.com/'.$row3['vk'].'" title="vk.com/'.$row3['vk'].'" target="newframe">vk.com</a></font></th> ';
											else echo ' <th>null</th> ';
											if($row3['yt']) echo ' <th><font color="#FFD700"><a href="https://www.youtube.com/'.$row3['yt'].'" title="youtube.com/'.$row3['yt'].'" target="newframe">YouTube</a></font></th> ';
											else echo ' <th>null</th> ';
											if($row3['inst']) echo ' <th><font color="#FFD700"><a href="https://www.instagram.com/'.$row3['inst'].'" title="instagram.com/'.$row3['inst'].'" target="newframe">Instagram</a></font></th> ';
											else echo ' <th>null</th> ';
											if($row3['twit']) echo ' <th><font color="#FFD700"><a href="https://twitter.com/'.$row3['twit'].'" title="twitter.com/'.$row3['twit'].'" target="newframe">Twitter</a></font></th> ';
											else echo ' <th>null</th> ';
											if($row3['face']) echo ' <th><font color="#FFD700"><a href="https://www.facebook.com/'.$row3['face'].'" title="facebook.com/'.$row3['face'].'" target="newframe">FaceBook</a></font></th> ';
											else echo ' <th>null</th> ';
					
										}
										
										if($row2['access'] == 0) echo ' <td>Отключено (сообщите администрации)</a></td>';
										else if($row2['access'] == 1) echo ' <td><a href="https://lk.lnk-to.ru/list/edit/musician?id='.$row2['id'].'">Редактировать</a></td>';
										else if($row2['access'] == 2) echo ' <td>Отключено администрацией</td>';
										else echo ' <td>Ошибка. Обратитесь к администратору</td>';
									
									echo '
									</tr>
									';
								}
								
								echo'
							  </tbody>
							</table>
							<a href="https://lk.lnk-to.ru/list/create/musician" class="btn btn-danger pull-right">Создать</a>
						  </div>
						</div>
					</div>
				</div>
			 
			  </div>
			</div>
		  </div>
	';
	require_once 'footersize.php'; // нижняя часть страницы
?>