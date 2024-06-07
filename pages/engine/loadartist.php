<?php
	$ArtistID = (int)$row['ArtistID'];
	$sql = "SELECT * FROM artists WHERE id='$ArtistID' LIMIT 1";
	$result = $db->query($sql);
	if(!($ArtistInfo = $result->fetch_assoc())) exit;
?>

<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.80">
	<link rel="shortcut icon" href="https://lnk-to.ru/service_images/shortcut.png">
	<title><?php print($ArtistInfo['nickname']);?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="description" content="<?php print($ArtistInfo['nickname']);?>">
	<meta property="og:title" content="<?php print($ArtistInfo['nickname']);?>">
	<meta property="og:description" content="<?php print($ArtistInfo['nickname']);?>">
	<meta property="og:url" content="https://lnk-to.ru">
	<meta property="og:type" content="article">
	<meta property="og:image" content="<?php echo'https://lnk-to.ru/images/'.$actionsub.'_'.$row['name'].'.jpg';?>">
	<meta name="twitter:url" value="https://lnk-to.ru">
	<meta name="twitter:title" content="<?php print($ArtistInfo['nickname']);?>">
	<meta name="twitter:description" content="<?php print($ArtistInfo['nickname']);?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:image" content="<?php echo'https://lnk-to.ru/images/'.$actionsub.'_'.$row['name'].'.jpg';?>">
	
	<?php if($row['size'] < 300) $row['RelizDate'] = 341; ?>
	<link rel="stylesheet" href="https://lnk-to.ru/css/32/styles/songpage.15.css">
	<style>#main, #main .imagecontainer img, #main #header {width: <?php print($ArtistInfo['size']);?>px;}</style>
	<link rel="stylesheet" href="https://lnk-to.ru/css/social.css">

</head>

<body>
	<div id="main">
		<div id="bg">
			<img src="<?php echo'https://lnk-to.ru/images/'.$actionsub.'_'.$row['name'].'.jpg';?>" alt="">
		</div>

		<div id="img" class="imagecontainer" style="position:relative">
			<img src="<?php echo'https://lnk-to.ru/images/'.$actionsub.'_'.$row['name'].'.jpg';?>" alt="">
		</div>

		<div id="header" class="service-container sticky" style="z-index:9000; ">
			<div class="header">
				<h1 class="artist"><?php print($ArtistInfo['nickname']); ?></h1>
				<p class="where">Выбрать трек/альбом</p>
			</div>
			<div class="arrow"></div>
		</div>
		<div class="hideme" style="display:none;z-index:1"></div>
		<div id="service" class="service-container">
			<?php
				$today = date("Ymd")+1;
				$sql = "SELECT idtrack,relizdate FROM trackartists WHERE idartist=".$ArtistID." ORDER BY relizdate DESC";
				$result = $db->query($sql);
				while($idstracks = $result->fetch_assoc())		
				{
					if($idstracks['relizdate']>$today) continue;
					$sql = "SELECT * FROM tracks WHERE id=".$idstracks['idtrack'].""; // RelizDate<'$today' 
					$result2 = $db->query($sql);
					if($row2 = $result2->fetch_assoc())
					{
						if($row2['sub'])
						{
							echo '
								<div class="service">
								<a class="img-btn redirect" href="https://'.$row2['sub'].'.lnk-to.ru/'.$row2['name'].'" data-player="vk" data-servicetype="play" data-apptype="manual">
								<span><img class="" width="45px" height="45px" style="display:inline-block;" src="https://lnk-to.ru/images/'.$row2['sub'].'_'.$row2['name'].'.jpg" alt="vk"></span>
								<strong> '.$row2['RelizName'].'</strong> '.$row2['RelizInfo'].'
								<span class="play">Перейти</span>
								</a>
								</div>
							';
						}
						else
						{
							echo '
								<div class="service">
								<a class="img-btn redirect" href="https://lnk-to.ru/'.$row2['name'].'" data-player="vk" data-servicetype="play" data-apptype="manual">
								<span><img class="" width="45px" height="45px" style="display:inline-block;" src="https://lnk-to.ru/images/'.$row2['sub'].'_'.$row2['name'].'.jpg" alt="vk"></span>
								<strong> '.$row2['RelizName'].'</strong> '.$row2['RelizInfo'].'
								<span class="play">Перейти</span>
								</a>
								</div>
							';
						}
					}
				}

					echo '
					<div class="service">
					<font size="1px" color="white" face="Arial">'.$ArtistInfo['nickname'].'</font>';
					if($ArtistInfo['vk'])
					{
						echo '
						<div class="social vk">
						<a href="https://vk.com/'.$ArtistInfo['vk'].'" target="_blank"><i class="fa fa-vk fa-2x"></i></a>    
						</div>  
						';
					}
					if($ArtistInfo['yt'])
					{
						echo '
						<div class="social youtube">
						<a href="https://www.youtube.com/'.$ArtistInfo['yt'].'" target="_blank"><i class="fa fa-youtube fa-2x"></i></a>
						</div>
						';
					}
					if($ArtistInfo['twit'])
					{
						echo '
						<div class="social twitter">
						<a href="https://twitter.com/'.$ArtistInfo['twit'].'" target="_blank"><i class="fa fa-twitter fa-2x"></i></a>
						</div>
						';
					}
					if($ArtistInfo['inst'])
					{
						echo '
						<div class="social instagram">
						<a href="https://www.instagram.com/'.$ArtistInfo['inst'].'" target="_blank"><i class="fa fa-instagram fa-2x"></i></a>
						</div>
						';
					}
					if($ArtistInfo['face'])
					{
						echo '
						<div class="social facebook">
						<a href="https://www.facebook.com/'.$ArtistInfo['face'].'" target="_blank"><i class="fa fa-facebook fa-2x"></i></a>    
						</div>
						';
					}
			?>
			<font size="1px" color="white" face="Arial"><?php print($ArtistInfo['nickname']); ?></font>      
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