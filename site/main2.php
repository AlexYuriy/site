
<html >
<head>
<? include ("meta.html") ?>
 <title>Главная </title>
 </head>
 
 <body font= "Arial">
 	<table  align="center" border="0" width="950" cellspacing="0"  height="100%">
	<? include ("head.html") ?>
		<tr  nin-height="180px" >
			<td background= "images/left.jpg" "repeat" id="contentcss" width="80%" >
				<h1>&nbsp;НОВОСТИ	</h1>
			</td>
			<? include ("baner.html") ?>
		</tr>
		<tr valign="top">
			<td><? include("./phpScript/news.php"); ?></td>
			<? include ("calend.php") ?>
		</tr>
	</table>
</body></html>	