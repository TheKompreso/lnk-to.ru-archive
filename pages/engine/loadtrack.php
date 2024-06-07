<?php
	$sql = "SELECT * FROM tracks WHERE id='".$row['id']."' LIMIT 1";
	$result = $db->query($sql);
	if(!($row = $result->fetch_assoc())) exit;
?>
	
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.95">
	<link rel="shortcut icon" href="https://lnk-to.ru/service_images/shortcut.png">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta property="og:url" content="https://lnk-to.ru">
	<meta property="og:type" content="article">
	<meta name="twitter:card" content="summary_large_image">

	<meta name="twitter:url" value="https://lnk-to.ru">
	
	<?php 
		echo '
			<title>'.$row['RelizTittle'].' - '.$row['RelizName'].'</title>
			<meta name="description" content="'.$row['RelizTittle'].' - '.$row['RelizName'].'">
			<meta property="og:title" content="'.$row['RelizTittle'].' - '.$row['RelizName'].'">
			<meta property="og:description" content="'.$row['RelizTittle'].' - '.$row['RelizName'].'">
			<meta property="og:image" content="https://lnk-to.ru/images/'.$actionsub.'_'.$action.'.jpg">
			<meta name="twitter:title" content="'.$row['RelizTittle'].' - '.$row['RelizName'].'">
			<meta name="twitter:description" content="'.$row['RelizTittle'].' - '.$row['RelizName'].'">
			<meta name="twitter:image" content="https://lnk-to.ru/images/'.$actionsub.'_'.$action.'.jpg">
		';
	?>
	
	<link rel="stylesheet" href="https://lnk-to.ru/css/32/styles/songpage.16.css">
	<style>#main, #main .imagecontainer img, #main #header {width: 321px;}</style>

</head>

<body>
	<div id="main">
		<div id="bg">
			<img src="https://lnk-to.ru/images/<?php echo''.$actionsub.'_'.$action.'';?>.jpg" alt="">
		</div>

		<div id="img" class="imagecontainer" style="position:relative">
			<img src="https://lnk-to.ru/images/<?php echo''.$actionsub.'_'.$action.'';?>.jpg" alt="">
		</div>

		<div id="header" class="service-container sticky" style="z-index:9000; ">
			<div class="header">
				<?php
					$row['ArtistPHP'] = preg_replace("~!enter$~","</h1><p class=\"where\">",$row['ArtistPHP']);
					$row['ArtistPHP'] = str_replace("!enter","</h1><h6 class=\"artist\">",$row['ArtistPHP']);
					$row['ArtistPHP'] = preg_replace("~@(.+)[(](.+)[)]~","<a title=\"\" href=\"http://\\1\" style=\"color: #B0E0E6\">\\2</a>",$row['ArtistPHP']);
					if($row['ArtistID']) 
					{
						if($row['ArtistName'])
						{
							echo '<h1 class="artist"><a title="'.$row['ArtistName'].' в соц.сетях" href="/'.$row['ArtistID'].'" style="color: #B0E0E6">'.$row['ArtistName'].'</a>'.$row['ArtistPHP'].''.$row['RelizName'].'</h1>';
						}
						else
						{
							echo '<h1 class="artist">'.$row['ArtistPHP'].''.$row['RelizName'].'</h1>';
						}
					}
					else
					{
						echo '<h1 class="artist">'.$row['ArtistName'].''.$row['ArtistPHP'].''.$row['RelizName'].'</h1>';
					}
					if(preg_match('/(- )$/',$row['ArtistPHP']))
					{
						echo '<p class="where">Выбрать музыкальный сервис</p>';
					}
				?>
			</div>
			<div class="arrow"></div>
		</div>
		<div class="hideme" style="display:none;z-index:1">

		</div>
		
		<div id="service" class="service-container">
			<?php	 
				if($row['AppleID']) 
				{
					echo '
						<div class="service">				  
						<a class="img-btn redirect" href="https://music.apple.com/ru/album/'.$row['AppleID'].'?app=music&l=ru" data-player="applemusic" data-servicetype="play" data-apptype="manual">
						<span><img class="" width="125px" height="40px" style="display:inline-block;" src="https://lnk-to.ru/service_images/music-service_applemusic.svg" alt="applemusic"></span>
						<span class="play">Слушай</span>
						</a>
						</div>
					';
				}
				if($row['AppleID']) 
				{
					echo '
						<div class="service">
						<a class="img-btn redirect" href="https://music.apple.com/ru/album/'.$row['AppleID'].'?app=itunes&l=ru" data-player="itunes" data-servicetype="download" data-apptype="manual">
						<span><img class="" width="125px" height="40px" style="display:inline-block;" src="https://lnk-to.ru/service_images/music-service_itunes.svg" alt="itunes"></span>
						<span class="play">Загружай</span>
						</a>
						</div>
					';
				}
				if($row['BoomID']) 
				{
					echo '
						<div class="service">';
						
					if($row['id'] > 127) echo' <a class="img-btn redirect" href="https://share.boom.ru/album/'.$row['BoomID'].'" data-player="boom" data-servicetype="play" data-apptype="manual">';
					else echo' <a class="img-btn redirect" href="https://boom.ru/redirect/album/'.$row['BoomID'].'" data-player="boom" data-servicetype="play" data-apptype="manual">';
						echo'	
						<span><img class="" width="125px" height="40px" style="display:inline-block;" src="https://lnk-to.ru/service_images/music-service_boom.svg" alt="boom"></span>
						<span class="play">Слушай</span>
						</a>
						</div>
					';
				}
				if($row['YaID']) 
				{
					echo '
						<div class="service">
						<a class="img-btn redirect" href="https://music.yandex.ru/album/'.$row['YaID'].'" data-player="yandexmusic" data-servicetype="play" data-apptype="manual">
						<span><img class="" width="125px" height="40px" style="display:inline-block;" src="https://lnk-to.ru/service_images/music-service_yandexmusic.svg" alt="yandexmusic"></span>
						<span class="play">Слушай</span>
						</a>
						</div>
					';
				}
				if($row['VKID']) 
				{
					echo '
						<div class="service">
						<a class="img-btn redirect" href="https://vk.com/'.$row['VKID'].'" data-player="vk" data-servicetype="play" data-apptype="manual">
						<span><img class="" width="125px" height="40px" style="display:inline-block;" src="https://lnk-to.ru/service_images/music-service_vk.svg" alt="vk"></span>
						<span class="play">Слушай</span> 
						</a>
						</div>
					';
				}
				if($row['GoogleID']) 
				{
					echo '
						<div class="service">
						<a class="img-btn redirect" href="https://play.google.com/store/music/album/?id='.$row['GoogleID'].'" data-player="google" data-servicetype="download" data-apptype="manual">
						<span><img class="" width="125px" height="40px" style="display:inline-block;" src="https://lnk-to.ru/service_images/music-service_google.svg" alt="google"></span>
						<span class="play">Загружай</span>
						</a>
						</div>
					';
				}
				if($row['SpotyID']) 
				{
					echo '
						<div class="service">
						<a class="img-btn redirect" href="https://open.spotify.com/album/'.$row['SpotyID'].'" data-player="google" data-servicetype="download" data-apptype="manual">
						<span><img class="" width="125px" height="40px" style="display:inline-block;" src="https://lnk-to.ru/service_images/music-service_spotify.svg" alt="google"></span>
						<span class="play">Загружай</span>
						</a>
						</div>
					';
				}
				if($row['DeezerID']) 
				{
					echo '
						<div class="service">
						<a class="img-btn redirect" href="https://www.deezer.com/ru/album/'.$row['DeezerID'].'" data-player="deezer" data-servicetype="download" data-apptype="manual">
						<span><img class="" width="125px" height="40px" style="display:inline-block;" src="https://lnk-to.ru/service_images/music-service_deezer.svg" alt="deezer"></span>
						<span class="play">Слушай</span>
						</a>
						</div>
					';
				}
				if($row['GeniusID']) 
				{
					echo '
						<div class="service">
						<a class="img-btn redirect" href="https://genius.com/'.$row['GeniusID'].'" data-player="genius" data-servicetype="download" data-apptype="manual">
						<span><img class="" width="125px" height="40px" style="display:inline-block;" src="https://lnk-to.ru/service_images/music-service_genius.svg" alt="genius"></span>
						<span class="play">Текст</span>
						</a>
						</div>
					';
				}
			?>
		</div>
		<div id="header" class="service-container sticky" style="z-index:9000; ">
			<div style="line-height: 2.445em" class="header">	 
				<?php
					$today = date("Ymd");
					if($today > $row['paytime'])
					{
						echo '
							<h1 class="artist">Поддержать проект lnk-to.ru</h1>
							<a class="btn btn-warning" href="https://qiwi.com/n/MICKRIZE" role="button" > <input type="image" width="15px" height="15px" src="https://lnk-to.ru/service_images/qiwi.png"> Qiwi</a>
							<a class="btn btn-warning" href="https://yoomoney.ru/to/410012146703255" role="button" > <input type="image" width="15px" height="15px" src="https://lnk-to.ru/service_images/yandexmoney.png"> Яндекс деньги</a> 
						';
					}
				?>
				<font style="display: block;" size="0" color="white" face="Arial"><a href="https://lnk-to.ru">lnk-to.ru</a> © 2019-<?php print($current_year);?></font> 
			</div>
		</div>
	</div>
</body>