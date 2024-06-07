<?php
	//  <title>
   // Material Dashboard by Creative Tim
  //</title>
echo '
<html lang="ru">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="https://lnk-to.ru/profile/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="https://lnk-to.ru/profile/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="https://lnk-to.ru/profile/assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link href="https://lnk-to.ru/profile/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="">
		<div class="logo"><a href="http://www.lnk-to.ru" class="simple-text logo-normal">
		  LNK-TO.RU
		</a></div>
		<div class="sidebar-wrapper">
			<ul class="nav">';
			
				if($topsize == 1) echo '<li class="nav-item active  ">';
				else echo '<li class="nav-item   ">';
				echo '  
					<a class="nav-link" href="https://lk.lnk-to.ru/stats">
						<i class="material-icons">dashboard</i>
						<p>Статистика</p>
					</a>
				</li>
				';
				/*
				if($topsize == 2) echo '<li class="nav-item active  ">';
				else echo '<li class="nav-item ">';
				echo '
					<a class="nav-link" href="https://lk.lnk-to.ru/person">
						<i class="material-icons">person</i>
						<p>Профиль</p>
					</a>
				</li>
				';*/
				if($topsize == 3) echo '<li class="nav-item active  ">';
				else echo '<li class="nav-item ">';
				echo '
					<a class="nav-link" href="https://lk.lnk-to.ru/list">
						<i class="material-icons">content_paste</i>
						<p>Список страниц</p>
					</a>
				</li>
				';
				if($topsize == 6) echo '<li class="nav-item active  ">';
				else echo '<li class="nav-item ">';
				echo '
					<a class="nav-link" href="https://lk.lnk-to.ru/help">
						<i class="material-icons">help</i>
						<p>Поддержка</p>
					</a>
				</li>
				';
				
				if($user_lvl > 10)
				{
					if($topsize == 7) echo '<li class="nav-item active  ">';
					else echo '<li class="nav-item   ">';
						
							echo '
								<a class="nav-link" href="https://lk.lnk-to.ru/moderation">
									<i class="material-icons">verified_user</i>
									<p>Модерация</p>
								</a>
							</li>
						';
				}
				if($topsize == 5)
				{ 
					echo '
						<li class="nav-item active  ">
							<a class="nav-link">
								<i class="material-icons">edit</i>
								<p>Редактирование</p>
							</a>
						</li>
					';
				}
				if($topsize == 8)
				{ 
					echo '
						<li class="nav-item active  ">
							<a class="nav-link">
								<i class="material-icons">edit</i>
								<p>Создание</p>
							</a>
						</li>
					';
				}
				
				if($topsize == 4) echo '<li class="nav-item active-pro active  ">';
				else echo '<li class="nav-item active-pro  ">';
				echo '
					<a class="nav-link" href="https://lk.lnk-to.ru/upgrade">
						<i class="material-icons">unarchive</i>
						<p>Cтатус аккаунта</p>
					</a>
				</li>
			</ul>
		</div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">8</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">Youre now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                  <a class="dropdown-item" href="#">Another One</a>
                  <a class="dropdown-item" href="#">Another One</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#">Профиль</a>
                  <a class="dropdown-item" href="#">Настройки</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="https://lk.lnk-to.ru/auth/exit">Выйти</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
';
?>