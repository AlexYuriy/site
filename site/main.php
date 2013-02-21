<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru-ru" lang="ru-ru" dir="ltr" slick-uniqueid="1"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!--<base href="http://istochnik-spb.ru.host1245282.serv18.hostland.ru/">--><base href=".">
  
 <meta name="robots" content="index, follow">

 <title>главная</title>

<link rel="stylesheet" href="./css/main.css" type="text/css">
<link rel="shortcut icon" href="http://istochnik-spb.ru.host1245282.serv18.hostland.ru/templates/main/images/favicon.ico">
</head>

<body>

<div align="center">

	<table border="0" width="950" cellspacing="0" cellpadding="0" id="table1" height="100%">
		<tbody><tr>
			<td height="160" colspan="3" background="./images/logo_top1.jpg"></td>
		</tr>
		<tr>
			<td height="50" colspan="3" background="./images/logo_top2.jpg" align="right" id="topmenucss">
				<ul class="menu">
					<li class=""><a href=" "> english </a></li>
					<li class=""> | </li>
					<li class="item-470"><a href="http://www.ustream.tv/channel/istochnik">Прямая трансляция </a></li>
					</ul>
			</td>
		</tr>
		<tr>
			<td height="13" colspan="3" background="./images/logo_center1.jpg">
				<div id="mainmenucss">
					<ul class="menu">
						<li class="item-101 current active"><a href="./main.php">главная</a></li></ul>
				</div>
			</td>
		</tr>
		<tr>
			<td height="35" colspan="3" background="./images/logo_center2.jpg"></td>
		</tr>
		<tr>
			<td height="189" colspan="3" background="./images/logo_center3.jpg"></td>
		</tr>
		<tr>
			<td height="6" colspan="3"></td>
		</tr>
		<tr>
			<td id="contentcss">
				<div class="item-page">
				<h1>НОВОСТИ	</h1>
					<? include("./phpScript/news.php"); ?>
				</div>
			</td>
			<td width="6"> </td>
			<td id="contentcss">
				Календарь <? include("./phpScript/calend.php"); ?> 
			</td>
		</tr>
	</tbody></table>
</div>
</body></html>	