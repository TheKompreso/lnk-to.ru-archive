<?php
	require_once 'check_token.php';
	if($user_lvl < 10)
	{
		header("Location: https://lk.lnk-to.ru/stats");
		exit;
	}
	$topsize = 7;
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
									<th>Статус</th>
									</thead>
									<tbody>';

									$sql = "SELECT id,access,accessinfo FROM redict WHERE status=12 ORDER BY id"; // DESC
									$result = $db->query($sql);
									while($row2 = $result->fetch_assoc())		
									{
										echo '
										<tr>
										<td>'.$row2['id'].'</td>';

										if($row2['access'] == 1 || $row2['access'] == 3) echo ' <td>Страница релиза(ID: '.$row2['accessinfo'].')</td>';
										else if($row2['access'] == 2) echo ' <td>Страница музыканта(ID: '.$row2['accessinfo'].')</td>';
										else if($row2['access'] == 0) echo ' <td>Страница релиза(ID: '.$row2['accessinfo'].')</td>';
										echo ' <td><a href="https://lk.lnk-to.ru/moderation/page?id='.$row2['id'].'" target="newframe">Требует решения</a></td>';
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