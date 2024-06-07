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
	<title>Модерация</title>
	<div class="content">
		<div class="container-fluid">
		    <div class="row">
				<div class="col-md-8">
					<div class="card-header card-header-primary">
						<div class="places-buttons">
						
							<div class="row">
							  <div class="col-md-6 ml-auto mr-auto text-center">
								<h4 class="card-title">
								  <p class="category"><i class="material-icons">verified_user</i>Модерация</p>
								</h4>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-6 ml-auto mr-auto text-center">
								<h4 class="card-title">
								<a href="https://lk.lnk-to.ru/moderation/list/help" class="btn btn-info btn-block">Ответы на заявки</a>
								</h4>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-6 ml-auto mr-auto text-center">
								<h4 class="card-title">
								<a href="https://lk.lnk-to.ru/moderation/list/page" class="btn btn-info btn-block">Модерация изменений</a>
								</h4>
							  </div>
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