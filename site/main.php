
<html><head>
<? include ("meta.html") ?>
 <title>Главная </title>
 </head>
 
 <body>
 	<table  align="center" border="0" width="950" cellspacing="0" >
	<? include ("head.html") ?>
		<tr>
			<td background= "images/left.jpg" id="contentcss" width="80%" >
				<h1>&nbsp; НОВОСТИ	</h1>
			</td>
			<? include ("baner.html") ?>
		</tr>
		<tr valign="top">
			<td><? include("./phpScript/news.php"); ?></td>
			<? include ("calend.php") ?>
		</tr>
	</table>
	<? include ("down.php") ?>
</body></html>	