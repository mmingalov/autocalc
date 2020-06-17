<!DOCTYPE html>
<!--AUTO-CALCULATOR!-->
<html lang="ru-RU">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">	
	<link type="text/css" rel="stylesheet" href="css/style.css"/>
	<script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
	<title>Покупка авто в Японии</title>
	<meta name="description" content="Калькулятор полной стоимости привоза автомобиля из Японии: стоимость лота на аукционе, включая доставку по морю, а также таможенное оформление и все прочие платежи. Расчет основан на текущих курсах валют с возможностью задания своих значений." />
	<meta name="keywords" content="авто, машина, аукцион, япония, лот, стоимость, таможенное оформление, пошлина, модель">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		<!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>!-->
		<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css">
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-42053037-2', 'какдорого.рф');
	  ga('send', 'pageview');

	</script>
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- TEST01_140627 -->
	<ins class="adsbygoogle"
		 style="display:inline-block;width:728px;height:90px"
		 data-ad-client="ca-pub-2354984817497268"
		 data-ad-slot="5659353631"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
</head>
<body>
	
	<div id="header">
		<p>Расчет стоимости покупки авто с аукциона в Японии</p>
	</div>
				
	<div id="wrapper">
		<div id="ads_left">

		</div>
		<div id="inputs">
			<!--<ul>
				<a href="index.php"><li class="menuitem">ГЛАВНАЯ</li></a>
				<a href="index.html"><li class="menuitem">ПОМОЩЬ</li></a>
			</ul>!-->
			<p>На этой странице вы можете рассчитать общие затраты на покупку автомобиля с Японии. Курсы валют актуальны на текущую дату, но вы также можете задать в поля свои собственные значения
			и увидеть как изменится расчет. <br>В зависимости от объема двигателя и возраста авто, будут рассчитаны затраты на таможенное оформление. <br>Сумма в поле "Прочие расходы" соответствует 
			действующим тарифам.<br>
			Калькулятор позволяет выполнить неограниченное количество расчетов, с разными параметрами, на одной странице.</p>
			<form name="input" action="#" method="post">
				<b>Параметры автомобиля</b><br/>
				Год и месяц выпуска авто (в формате ГГГГММ): 
				<input type='text' id='tbYYYYMM' value='000000'>
				<br>
				<a href = "http://www.drom.ru/frameno/" target="_blank">Как определить возраст авто</a>:
				<br><br>
				Объем двигателя, куб. см:
				<input type='text' id='tbEngine' value='1500'>
				<br><br>
				<!--Мощность двигателя, л.с.:
				<input type='text' id='tbPower' value=''>
				<br><br>!-->
				<b>Денежные затраты</b>
				<br>
				Комиссия брокеру, руб:
				<input type='text' id='tbSumBroker' value='0'>
				<br><br>
				Прочие расходы, руб (Выгрузка-СВХ, таможенное оформление, экспертизы на дату выпуска и мощность, справка ЕВРО-5, утилизационный сбор):
				<input type='text' id='tbSumOther' value='0'>
				<br><br>
				Цена автомобиля в Японии (стоимость лота), йен:
				<input type='text' id='tbSumLot' placeholder= 'sdfsdfsdf' value='1000000'>
				<div id="sliderSumLot"></div>
				<a href = "http://www.pravto.ru/auto_stat.html" target="_blank">Цены на аукционах: статистика продаж</a>
				<br>					
				<a href = "http://www.drom.ru/customs/cartable.php" target="_blank">Таможенные ставки</a>
				<br><br/>
				Доставка из Японии во Владивосток, йен:
				<input type='text' id='tbSumShip' value='99000'>
				<br/><br/>
				<b>Курсы валют к рублю на <?php echo date("d.m.Y"); ?></b> (можете ввести свои значения)
				<br/>
				Йена: <input type='text' id='tbJPY' value='<?php 
								// Получаем текущие курсы валют в rss-формате с сайта www.cbr.ru 
								  $content = get_content(); 
								  // Разбираем содержимое, при помощи регулярных выражений 
								  $pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i"; 
								  preg_match_all($pattern, $content, $out, PREG_SET_ORDER); 
								  $dollar = ""; 
								  $euro = ""; 
								  $yena = "";
								  foreach($out as $cur) 
								  { 
									if($cur[2] == 840) $dollar = str_replace(",",".",$cur[4]); 
									if($cur[2] == 978) $euro   = str_replace(",",".",$cur[4]); 
									if($cur[2] == 392) $yena   = str_replace(",",".",$cur[4]); 
								  } 
								  echo $yena / 100;
								  function get_content() 
								  { 
									// Формируем сегодняшнюю дату 
									$date = date("d/m/Y"); 
									// Формируем ссылку 
									$link = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=".$date; 
									// Загружаем HTML-страницу 
									$fd = fopen($link, "r"); 
									$text=""; 
									if (!$fd) echo "Запрашиваемая страница не найдена"; 
									else 
									{ 
									  // Чтение содержимого файла в переменную $text 
									  while (!feof ($fd)) $text .= fgets($fd, 4096); 
									} 
									// Закрыть открытый файловый дескриптор 
									fclose ($fd); 
									return $text; 
								  } 
							?>'>
				<br>
				Евро: <input type='text' id='tbEUR' value='<?php 
								// Получаем текущие курсы валют в rss-формате с сайта www.cbr.ru 
								  $content = get_content(); 
								  // Разбираем содержимое, при помощи регулярных выражений 
								  $pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i"; 
								  preg_match_all($pattern, $content, $out, PREG_SET_ORDER); 
								  $dollar = ""; 
								  $euro = ""; 
								  $yena = "";
								  foreach($out as $cur) 
								  { 
									if($cur[2] == 840) $dollar = str_replace(",",".",$cur[4]); 
									if($cur[2] == 978) $euro   = str_replace(",",".",$cur[4]); 
									if($cur[2] == 392) $yena   = str_replace(",",".",$cur[4]); 
								  } 
								  //echo "Йена - ".$yena."<br>";
								  //echo "Евро - ".$euro."<br>"; 
								  echo $euro;
								  
							?>'>
							
			</form>
		</div>
		<div id="ads_right">
			<img src="img/6_flip.jpg" alt="Lexus">
		</div>
		<div id="buttons">
			<input id='button1' type='submit' value='Добавить расчет'>
			<input id='button2' type='submit' value='Стереть расчеты'>
			<a href = "help.html">Подробнее о расчете</a>
		</div>
		<div id="outputs">
		
		</div>
	</div>
	
	<div id="block3">
		<p id="footer"><a href = "http://www.macrosolution.ru" target="_blank">© 2014 macro solution</a></p>
		
	</div>
		
	<div class="share42init"></div>
	<script type="text/javascript" src="http://www.какдорого.рф/share42/share42.js"></script>
	
</body>


</html>