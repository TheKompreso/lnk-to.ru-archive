<?php
	require_once 'check_token.php';
	$topsize = 7;
	if($user_lvl < 10)
	{
		header("Location: https://lk.lnk-to.ru/stats");
		exit;
	}
	require_once 'topsize.php'; // верхняя часть страницы
	echo'
		<title>Список запросов</title>
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header card-header-primary">
								<h4 class="card-title ">Поддержка</h4>
								<p class="card-category">список запросов</p>
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

									$sql = "SELECT id,date,page,typereason,access FROM help WHERE (access = 0 OR access = 1) ORDER BY id"; // DESC
									$result = $db->query($sql);
									while($row2 = $result->fetch_assoc())		
									{
										echo '
										<tr>
										<td>'.$row2['id'].'</td>';

										if($row2['typereason'] == 5) echo ' <td>Страница релиза(ID: '.$row2['page'].')</td>';

										echo ' <td>'.$row2['date'].'</td>';
										

										if($row2['access'] == 0) echo ' <td><a href="https://lk.lnk-to.ru/moderation/help?id='.$row2['id'].'" target="newframe">Требует решения</a></td>';
										else if($row2['access'] == 1) echo ' <td><a href="https://lk.lnk-to.ru/moderation/help?id='.$row2['id'].'" target="newframe">Ожидания ответа пользователя</a></td>';
										
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