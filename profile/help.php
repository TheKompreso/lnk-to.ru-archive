<?php
	require_once 'check_token.php';
	$topsize = 6;
	require_once 'topsize.php'; // верхняя часть страницы
	
	echo '
	<title>Поддержка</title>
	<div class="content">
		<div class="container-fluid">
		    <div class="row">
				<div class="col-md-8">
					<div class="card-header card-header-primary">
						<div class="places-buttons">
						
							<div class="row">
							  <div class="col-md-6 ml-auto mr-auto text-center">
								<h4 class="card-title">
								  <p class="category"><i class="material-icons">content_paste</i>Поддержка</p>
								</h4>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-6 ml-auto mr-auto text-center">
								<h4 class="card-title">
								<a href="https://lk.lnk-to.ru/help/list" class="btn btn-info btn-block">Ваши запросы</a>
								</h4>
							  </div>
							</div>
							
							<div class="row">
							  <div class="col-md-6 ml-auto mr-auto text-center">
								<h4 class="card-title">
								  <p class="category">Помощь со страницами:</p>
								</h4>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-4">
								<a href="https://lk.lnk-to.ru/help/redict" class="btn btn-danger btn-block">Переадресация</a>
							  </div>
							  <div class="col-md-4">
								<a href="https://lk.lnk-to.ru/help/reliz" class="btn btn-info btn-block">Страница релиза</a>
							  </div>
							  <div class="col-md-4">
								<a href="https://lk.lnk-to.ru/help/musician" class="btn btn-danger btn-block">Страница музыканта</a>
							  </div>
							</div>
						
							<div class="row">
							  <div class="col-md-6 ml-auto mr-auto text-center">
								<h4 class="card-title">
								  <p class="category">Другие запросы:</p>
								</h4>
							  </div>
							</div>
							<div class="row">
							  <div class="col-md-4">
								<a href="https://lk.lnk-to.ru/help/question" class="btn btn-danger btn-block">Отправить общий запрос</a>
							  </div>
							  <div class="col-md-4">
								<a href="https://lk.lnk-to.ru/help/account" class="btn btn-danger btn-block">Аккаунт</a>
							  </div>
							  <div class="col-md-4">
								<a href="https://lk.lnk-to.ru/help/error" class="btn btn-danger btn-block">Сообщить об ошибке</a>
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