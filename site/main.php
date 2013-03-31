<!DOCTYPE html>
<html >
<head>
<? include ("service/0_meta.php") ?>
 <title>Главная </title>
 </head>
 
 <body>
 	<table  align="center" border="0" width="950" cellspacing="0" >
	<? include ("service/0_head.php") ?>
		<tr>
			<td background= "images/left.jpg" id="contentcss" >
				<h1>&nbsp;НОВОСТИ	</h1>
			</td>
			<? include ("service/0_baner.php") ?>
		</tr>
		<tr valign="top">
			<td><? include("./phpScript/news.php"); ?></td>
			<? include ("service/0_calend.php") ?>
		</tr>
	</table>
	<? include ("service/0_down.php") ?>
</body></html>	