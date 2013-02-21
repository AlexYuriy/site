<html>
<head>
<title>Скрипты</title>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<style type=text/css rel=stylesheet>
.menu {
	color: #2C3251;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: 295;
	text-decoration: none;
}
.menu:hover {
	color: #F5FFFA;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: 295;
	text-decoration: none;
}
.menusmall {
	FONT-WEIGHT: 300;
	FONT-SIZE: 11px;
	COLOR: #002244;
	LINE-HEIGHT: 14px;
	FONT-FAMILY: verdana, arial, helvetica, sans serif;
	TEXT-DECORATION: none
}
.menusmall:hover {
	FONT-WEIGHT: 300;
	FONT-SIZE: 11px;
	COLOR: #ffffff;
	LINE-HEIGHT: 14px;
	FONT-FAMILY: verdana, arial, helvetica, sans serif;
	TEXT-DECORATION: none
}
.menusmall2 {
	FONT-WEIGHT: 300;
	FONT-SIZE: 11px;
	COLOR: #002244;
	LINE-HEIGHT: 14px;
	FONT-FAMILY: verdana, arial, helvetica, sans serif;
	TEXT-DECORATION: none
}
.menusmall2:hover {
	FONT-WEIGHT: 300;
	FONT-SIZE: 11px;
	COLOR: #3300CC;
	LINE-HEIGHT: 14px;
	FONT-FAMILY: verdana, arial, helvetica, sans serif;
	TEXT-DECORATION: none
}
.menusmall3 {
	FONT-WEIGHT: 300;
	FONT-SIZE: 11px;
	COLOR: #9900CC;
	LINE-HEIGHT: 14px;
	FONT-FAMILY: verdana, arial, helvetica, sans serif;
	TEXT-DECORATION: underline;
}
.menusmall3:hover {
	FONT-WEIGHT: 300;
	FONT-SIZE: 11px;
	COLOR: #3300CC;
	LINE-HEIGHT: 14px;
	FONT-FAMILY: verdana, arial, helvetica, sans serif;
	TEXT-DECORATION: underline;
}
.smallnews {
	FONT-WEIGHT: 300;
	FONT-SIZE: 9px;
	COLOR: #002244;
	LINE-HEIGHT: 14px;
	FONT-FAMILY: verdana, arial, helvetica, sans serif;
	TEXT-DECORATION: none
}
.smallnews:hover {
	FONT-WEIGHT: 300;
	FONT-SIZE: 9px;
	COLOR: #3300CC;
	LINE-HEIGHT: 14px;
	FONT-FAMILY: verdana, arial, helvetica, sans serif;
	TEXT-DECORATION: none
}

#form    {BACKGROUND-COLOR: #003366;
	FONT-FAMILY: verdana;
	WIDTH: 75px;
	FONT-SIZE: 12pt;
	MARGIN-TOP: 0px;
	TEXT-ALIGN: center;
	border-color:black;}
</style>
</head>
<body>
<table width="100%" cellpadding="3" cellspacing="3">
  <tr bgcolor="#F5F8FA">
    <td width="138" height="64">&nbsp;</td>
    <td width="100%">&nbsp;</td>
    <td width="179">&nbsp;</td>
  </tr>
  <tr bgcolor="#F5F8FA">
    <td valign="top" class="menusmall2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MENU&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td valign="top" class="menusmall2">
	<table width="100%" align="">
    
	<tr>
	<td width="100%" align="center" bgcolor="#DDECEE" class="menu"><div align="center"><strong>Скрипт "Афоризмы"</strong></div></td>
    </tr><tr>
	<td class="menusmall2">
	Скрипт собственной разработки, использует MySql, высокая скорость работы даже при огромном количестве афоризмов.<BR>
	Включается-выключается возможность добавления афоризмов с главной страницы.<BR>
	В администраторком модуле есть конвертор из текстового(CVS) формата в MySQL.
	<BR><BR>
	</td>
	</tr>

	<tr>
	<td width="100%" align="center" bgcolor="#DDECEE" class="menu"><div align="center"><strong>Скрипт "Календарь новостей и событий"</strong></div></td>
    </tr><tr>
	<td class="menusmall2">
	Переработанный скрипт Козырева Олега - www.oleg.estetika.net ( Большое спасибо ему! )<BR>
	Новостная лента с календарем «DnP NEWS SQL 3.2 + Kalendar»<P>
 
	Теперь это не Новостная лента с календарем, а Календарь новостей и событий.<BR>
	Встраивается в главную страницу сайта.<BR><BR>
	<? include("news.php"); ?>
	</td>
	</tr>
    
	</table>
	</td>
    <td valign="top" class="menusmall2"><table width="178" align="">
      <tr><td width="178" align="center" bgcolor="#DDECEE" class="menu"><div align="center"><strong>Календарь новостей</strong></div></td>
    </tr><tr>
	<td>
	<? include("calend.php"); ?>
	</td>
	</tr>
    </table></td>
  </tr>
</table>
</body>
</html>
