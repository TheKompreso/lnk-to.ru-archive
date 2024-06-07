<?php
	require_once 'check_token.php';
	$topsize = 6;
	require_once 'topsize.php'; // верхняя часть страницы
	

	echo '
		<title>Список страниц</title>
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header card-header-primary">
								<h4 class="card-title ">Поддержка</h4>
								<p class="card-category">список ваших запросов</p>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table">
									<thead class=" text-primary">
									<th>ID</th>
									<th>Запрос</th>
									<th>Дата</th>
									<th>Статус</th>
									</thead>
									<tbody>';

									$sql = "SELECT id,date,page,typereason,access FROM help WHERE (userid='".$SaveSession_UID."') ORDER BY id DESC";
									$result = $db->query($sql);
									while($row2 = $result->fetch_assoc())		
									{
										echo '
										<tr>
										<td>'.$row2['id'].'</td>';

										if($row2['typereason'] == 5) echo ' <td>Страница релиза(ID: '.$row2['page'].')</td>';

										echo ' <td>'.$row2['date'].'</td>';
										

										if($row2['access'] == 0) echo ' <td><a href="https://lk.lnk-to.ru/help/page?id='.$row2['id'].'" target="newframe">Ожидание</a></td>';
										else if($row2['access'] == 1) echo ' <td><a href="https://lk.lnk-to.ru/help/page?id='.$row2['id'].'" target="newframe">Требует ваш ответ</a></td>';
										else if($row2['access'] == 2) echo ' <td><a href="https://lk.lnk-to.ru/help/page?id='.$row2['id'].'" target="newframe">Решено</a></td>';

										echo '
										</tr>
										';
									}

									echo '
									</tbody>
									</table>
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