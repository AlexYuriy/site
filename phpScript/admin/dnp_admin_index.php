<?php

include("config.inf");
if ($HTTP_COOKIE_VARS)  {extract($HTTP_COOKIE_VARS, EXTR_SKIP);}
//if ($_FILES)  {extract($_FILES, EXTR_SKIP);}
if ($_COOKIE)           {extract($_COOKIE, EXTR_SKIP);}
if ($HTTP_POST_VARS)    {extract($HTTP_POST_VARS, EXTR_SKIP);}
if ($_POST)             {extract($_POST, EXTR_SKIP);}
if ($HTTP_GET_VARS)     {extract($HTTP_GET_VARS, EXTR_SKIP);}
if ($_GET)              {extract($_GET, EXTR_SKIP);}
if ($HTTP_ENV_VARS)     {extract($HTTP_ENV_VARS, EXTR_SKIP);}
if ($_ENV)              {extract($_ENV, EXTR_SKIP);}

if($PHP_SELF == ""){ $PHP_SELF = $HTTP_SERVER_VARS["PHP_SELF"]; }
global $error, $logined;

$sql = mysql_query("SELECT * FROM users where login = '$login'");
while ($row=mysql_fetch_array($sql)){
	$db_login=$row["login"];
	$db_pass=$row["pass"];
	$db_status_us=$row["status_us"];

}
if ($login!=$db_login or md5($password) != $db_pass){
		$logined = 0;
		$error = "Ошибка";
		setcookie("login","",0);
		setcookie("password","",0);		}
	else{
		$logined = 1;
		setcookie("login",$login);
		setcookie("password",$password);		}
	
if ($action=="exit") {
		setcookie("login","");
		setcookie("password","");
		$logined=0;

}

if ($logined==0){ 


?>
<META http-equiv=Content-Type content="text/html; charset=windows-1251">
<META http-equiv=Content-Language content=ru>
<LINK href="style.css" type=text/css rel=stylesheet>
</head>
	<BR><BR>
	<table border=0 cellspacing=0 cellpadding=1>
     <form  name=login action="?mod=in" method=post>
      <tr>
       <td width=80 class=menusmall>Имя: </td>
       <td><input id=inp type=text name=login ></td>
      </tr>
      <tr>
       <td class=menusmall>Пароль: </td>
       <td><input id=inp type=password name=password ></td>
      </tr>
      <tr>
       <td></td>
       <td ><input id=button type=submit style="width:134" value='      Вход...      '></td>
      </tr>
      <input type=hidden name=in_login>
     </form>
    </table>
	<?} elseif ($logined==1) { 

$login=$db_login;
mysql_connect ($dbhostname , $dbusername , $dbpassword);
mysql_select_db($database);

//header
?>

<html>
<head>
<title>Новости :: пользователь <?=$login;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="../css/main.css" type="text/css">
<link rel="stylesheet" href="../css/admin.css" type="text/css">
</head>
<body style="margin: 10px;">
.: Новости :.  пользователь <?=$login;?>
<hr size=1 color=black noshade>
<table border=0><tr><td>
<a class=menu href="<?=$_SERVER['PHP_SELF']?>?action=add">Добавить новость</a> |
<? if ($db_status_us > 1) { } else {?>
<a class=menu href="<?=$_SERVER['PHP_SELF']?>?action=view">Просмотр / удаление новостей</a> | <?}?>

<? if ($db_status_us > 2) { } else {?>
<a class=menu href="<?=$_SERVER['PHP_SELF']?>?mod=users&subaction=editusers" >Пользователи</a> | <?}?>
<a class=menu href=../../>Выход &raquo;</a>
<hr size=1 color=black noshade>
</td>
</tr>
</table>
<?
if ($subaction=="editusers") {include("editusers.php");}
else 
{

if(isset($action)=="" || !$action)
 {
//wellcome
?>
<table border=0>
<tr>
<td align=center>
<br><br>
</td></tr></table>
<?
 }
//############################################ ADD ######################
elseif($action=="add")
 {
   $year=date('Y');
   $month=date('m');
   $day=date('d');
   $now_date = $year."-".$month."-".$day;
   $time=date('H:i');
?>
<script language="JavaScript">
 <!--

function voidPutATag(Tag,Tag2)
{
document.formata.content.focus();
sel = document.selection.createRange();
sel.text = Tag+sel.text+Tag2;
document.formata.content.focus();
}

 //-->
</script>

<form action=<?=$_SERVER['PHP_SELF']?> method=post enctype=multipart/form-data name=formata>

..:: Добавление новости ::.. <hr>
<table cellpadding=5 cellspacing=0 border=0 width=100%>
  <tr>
    <td width=13%>Дата:</td>
    <td><?
echo '<select name="c_day">';
$days = array("00", "01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31",);
	$months = array("None", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",);
	$months_num = array("None", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12",);
foreach($days as $key => $value) {
	if ($key != "0") {
   		echo "<option value=\"$value\" ";
   		if($value == date(d)) { echo "selected"; };
   		echo ">".$key."</option>";
   		}
	}
	echo '</select><select id="c_month" name="c_month">';
foreach($months_num as $key => $value) {
	if ($key != "0") {
   		echo "<option value=\"$value\" ";
   		if($value == date(m)) { echo "selected"; };
   			echo ">".$value."</option>";}
			
   		
	}
	echo '</select><input type="text" id="c_year" name="c_year" size="4" maxlength="4" value="'.date(Y).'"/></p>';?>
	

</td>
</tr>
  <tr>
    <td>Новость актуальна:</td><td><input type=text name="actuals" value="0" size="2" maxlength="3"> дней <INPUT TYPE="checkbox" NAME="act_on"> Включить&nbsp;|&nbsp;будет отображаться в самом верху новостей</td> 
</tr>
</td>
  </tr>
  <tr>
    <td>Заголовок:</td>
    <td><input type=text name=title style="width: 80%;"></td>
  </tr>
  <tr>
    <td></td>
    <td><? if ($db_status_us == 1) {?>
       
      <a href="javascript: voidPutATag('<b>','</b>')" title="полужирный текст" class=buten>b</a>
      <a href="javascript: voidPutATag('<i>','</i>')" title="курсив" class=buten>i</a>
      <a href="javascript: voidPutATag('<u>','</u>')" title="подчеркивание" class=buten>u</u>
      <a href="javascript: voidPutATag('<center>','</center>')" title="" class=buten>center</a>
      <a href="javascript: voidPutATag('<ul>','</ul>')" title="список" class=buten>ul</a>
      <a href="javascript: voidPutATag('<li>','</li>')" title="элемент списка" class=buten>li</a>
      <a href="javascript: voidPutATag('&laquo;','&raquo;')" title="кавычки" class=buten>&laquo; &raquo;</a>
      <a href="javascript: voidPutATag('\n<br>','\n ')" title="перенос строки" class=buten>br</a>
      <a href="javascript: voidPutATag('\n<p>','\n ')" title="абзац" class=buten>Абзац</a>
      <a href="javascript: voidPutATag('<a href=>','</a>')" title="ссылка" class=buten>ссылка</a><? } else {} ?>
      <a href=dnp_news_img.php onclick="window.open(this.href,this.target,'width=500,height=350,'+'location=no,toolbar=no,menubar=no,status=yes,scroll=yes');return false;" title='закачать картинку'  class=buten>закачать картинку</a>
    </td>
  </tr>
  <tr>
    <td></td>
    <td>
      
    </td>
  </tr>
  <tr>
    <td valign=top>Содержание:</td>
    <td><textarea name="content" style="height: 250px; width: 100%; padding: 5px;"></textarea></td>
  </tr>
  <tr>
    <td valign=top></td>
    <td><INPUT TYPE="reset" class=btn value="Очистить">
<input type=button OnClick="window.open('hot_view.php',this.target,'width=700,height=350,'+'location=no,toolbar=no,menubar=no,status=yes,resizeable=yes,scrollbars=yes');return false;"  value="Предпросмотр текста">
<input type=submit class=btn value="Сохранить"></td>
  </tr>
</table>
    <input type=hidden name=do value="save">
    <input type=hidden name=action value="add_on">
    <input type=hidden name=time value="<?=$time?>">
</form>
<?
}
//############## add on
elseif(isset($action) && $action=="add_on")
{ $datum=$c_year."-".$c_month."-".$c_day;
   if(isset($title)   && $title!=""   &&
      isset($content) && $content!="" &&
      isset($datum)
      )
   {
     $visible='on';
     $ip=getenv("REMOTE_ADDR")."::".getenv("HTTP_X_FORWARDED_FOR");
     $brouser=getenv("HTTP_USER_AGENT");

     
	 $datum=$c_year."-".$c_month."-".$c_day;	
	//HTML с переносом строк
	if ($db_status_us == 1) {} else {
	 $content = str_replace("\n",'<br />', $content);
	 $content = preg_replace("#\[php\](.+?)\[/php\]#ies","php_highlight('\\1')",$content);
	}
     $title   = str_replace("\"","&quot;", $title);
     
	 $n_actuals=$actuals*3600*24;
	 $nd_mk_date=mktime(0, 0, 0, $c_month, $c_day, $c_year);
	$and_mk_date=$nd_mk_date+$n_actuals;

	 mysql_query("insert into ".$table_dnp_news."
            values(null,
                  \"$time\",
                  \"$datum\",
                  \"$nd_mk_date\",
                  \"$title\",
                  \"$content\",
                  \"$visible\",
                  \"$ip\",
                  \"$and_mk_date\",
                  \"$act_on\",
                  \"$brouser\")")or die(mysql_error());
     echo "<font color=green>Запись внесена!!!</font><hr>";
     $raz=explode("-",$datum);
     echo "<nobr><a href='".$_SERVER['PHP_SELF']."?action=view&year=".$raz[0]."&today=".$raz[2]."&month=".$raz[1]."' ";
     echo "class=buten>В просмотр &raquo;</a></nobr>";
   }
   else
   {
      echo "Информация не может быть добавлена, вы ввели неверные данные<br><ul>";
      if(!isset($title)   || $title==""){echo "<li>Поле \"Заголовок\" должно быть заполнено обязательно!</li>";}
      if(!isset($content) || $content==""){echo "<li>\"Содержание\" должно быть заполнено обязательно!</li>";}
      //if(!isset($datum)   || $datum==""){echo "<li>Поле \"Дата\" $datum $c_year должно быть заполнено обязательно!</li>";}
      echo "</ul><hr size=1 color=black noshade></a><a href=javascript:history.back(2) class=menu><< Попробуйте еще раз.</a>";
   }
}
//########### add stop

//###################### VIEW #########################################
elseif(isset($action) && $action=="view")
{

   // удаление ссылки
  if(@$delete == "on")
   {
    if (isset($id))
     {
      mysql_query("delete from ".$table_dnp_news." where idnum = ".$id."");
      echo "<font color=red>Запись удачно удалена!!!</font><hr size=1><br>";
     }
   }

   echo "..:: Просмотр новостей ::..<hr>";


   echo "<table border=1 width=100% bordercolor=#BDD7D6 cellpadding=10><tr><td valign=top width=170>";



   //очистка от гамна
if (isset($_GET['month'])) {
   $month = $_GET['month'];
   $month = ereg_replace ("[[:space:]]", "", $month);
   $month = ereg_replace ("[[:punct:]]", "", $month);
   $month = ereg_replace ("[[:alpha:]]", "", $month);
   if ($month < 1) { $month = 12; }
   if ($month > 12) { $month = 1; }
   }

if (isset($_GET['year'])) {
   $year = $_GET['year'];
   $year = ereg_replace ("[[:space:]]", "", $year);
   $year = ereg_replace ("[[:punct:]]", "", $year);
   $year = ereg_replace ("[[:alpha:]]", "", $year);
   if ($year < 1990) { $year = 1990; }
   if ($year > 2035) { $year = 2035; }
   }

if (isset($_GET['today'])) {
   $today = $_GET['today'];
   $today = ereg_replace ("[[:space:]]", "", $today);
   $today = ereg_replace ("[[:punct:]]", "", $today);
   $today = ereg_replace ("[[:alpha:]]", "", $today);
   }


$month = (isset($month)) ? $month : date("n",time());
$year  = (isset($year)) ? $year : date("Y",time());
$today = (isset($today))? $today : date("j", time());
$daylong   = date("l",mktime(1,1,1,$month,$today,$year)); //день недели текст англ.
$monthlong = date("F",mktime(1,1,1,$month,$today,$year)); //название месяца англ.
$dayone    = date("w",mktime(1,1,1,$month,1,$year)); //день недели цифрой
$numdays   = date("t",mktime(1,1,1,$month,1,$year)); //количество дней в месяце
$alldays   = array('Пн','Вт','Ср','Чт','Пт','<font color=red>Сб</font>','<font color=red>Вс</font>');
$next_year = $year + 1;
$last_year = $year - 1;
$next_month = $month + 1;
$last_month = $month - 1;
if ($today > $numdays) { $today--; }
        if($month == "1" ){$month_ru="январь";}
    elseif($month == "2" ){$month_ru="февраль";}
    elseif($month == "3" ){$month_ru="март";}
    elseif($month == "4" ){$month_ru="апрель";}
    elseif($month == "5" ){$month_ru="май";}
    elseif($month == "6" ){$month_ru="июнь";}
    elseif($month == "7" ){$month_ru="июль";}
    elseif($month == "8" ){$month_ru="август";}
    elseif($month == "9" ){$month_ru="сентябрь";}
    elseif($month == "10"){$month_ru="октябрь";}
    elseif($month == "11"){$month_ru="ноябрь";}
    elseif($month == "12"){$month_ru="декабрь";}


echo "<table border=0 cellpadding=4 cellspacing=1 width=170>";

//выводим название года
echo "<tr bgcolor=#E7EBEF>
      <td align=center><a href=".$_SERVER['PHP_SELF']."?year=".$last_year."&today=".$today."&month=".$month."&action=view>&laquo;</a></td>";
echo "<td width=100% class=\"cellbg\" colspan=\"5\" valign=\"middle\" align=\"center\">
      <b>".$year." г.</b></td>\n";
echo "<td align=center><a href=".$_SERVER['PHP_SELF']."?year=".$next_year."&today=".$today."&month=".$month."&action=view>&raquo;</a></td>";
echo "</tr>\n<tr>\n</table>";

//выводим название месяца
echo "<table border=0 cellpadding=4 cellspacing=1 width=170>";
echo "<tr bgcolor=#E7EBEF>
      <td align=center><a href=".$_SERVER['PHP_SELF']."?year=".$year."&today=".$today."&month=".$last_month."&action=view>&laquo;</a></td>";
echo "<td width=100% class=\"cellbg\" colspan=\"5\" valign=\"middle\" align=\"center\">
      <b>".$month_ru."</b></td>\n";
echo "<td align=center><a href=".$_SERVER['PHP_SELF']."?year=".$year."&today=".$today."&month=".$next_month."&action=view>&raquo;</a></td>";
echo "</tr>\n<tr>\n</table>";

echo "<table border=0 cellpadding=2 cellspacing=1 width=170><tr>";
//выводим дни недели
foreach($alldays as $value) {
  echo "<td valign=\"middle\" align=\"center\" width=\"10%\">
        <b>".$value."</b></td>\n";
}
echo "</tr>\n<tr>\n";


//выводим пустые дни месяца как пробелы
if ($dayone == 0) {$dayone=7;}
for ($i = 0; $i < ($dayone-1); $i++) {
  echo "<td valign=\"middle\" align=\"center\">&nbsp;</td>\n";
}


//выводим дни месяца
for ($zz = 1; $zz <= $numdays; $zz++) {
 $stat_date = $year."-".$month."-".$zz;
  $stat_result = mysql_query("select * from ".$table_dnp_news." where datum = '".$stat_date."' ");
  $stat_rows=mysql_fetch_array($stat_result);
  $act_status = $stat_rows["act_status"];
  //echo "act_status=$act_status";
  if ($i >= 7) {  print("</tr>\n<tr>\n"); $i=0; }

  if ($zz == $today) {
    echo "<td valign=\"middle\" align=\"center\" bgcolor=#B9D7D5>";
          $news_date = $year."-".$month."-".$zz;
          $news_result = mysql_query("select * from ".$table_dnp_news." where datum = '".$news_date."'");
          $news_rows = mysql_num_rows($news_result);
           if($news_rows >0 and $act_status=="on") {
           echo "<a class=linkz href=\"".$_SERVER['PHP_SELF']."?year=$year&today=$zz&month=$month&action=view\"><FONT COLOR=red>".$zz."</FONT></a>";
           }
		  elseif($news_rows >0) {
           echo "<a class=linkz href=\"".$_SERVER['PHP_SELF']."?year=$year&today=$zz&month=$month&action=view\" >".$zz."</a>";
           }
          else {
           echo $zz;
           }
          echo "</td>\n";
  }
  else {
    
			
	echo "<td valign=\"middle\" align=\"center\">";
          $news_date = $year."-".$month."-".$zz;
          $news_result = mysql_query("select * from ".$table_dnp_news." where datum = '".$news_date."'");
          $news_rows = mysql_num_rows($news_result);
          
		  
		  if($news_rows >0) {
		     if ($act_status!="on") {
           echo "<a class=linkz href=\"".$_SERVER['PHP_SELF']."?year=".$year."&today=".$zz."&month=".$month."&action=view\">".$zz."</a>";
		   } else {
		   echo "<a class=linkz href=\"".$_SERVER['PHP_SELF']."?year=".$year."&today=".$zz."&month=".$month."&action=view\"><FONT COLOR=red>".$zz."</FONT></a>";
		   }
          }
          else {
           echo $zz;
           }
          echo "</td>\n";
  }

  $i++;
}

$create_emptys = 7 - ((($dayone-1) + $numdays) % 7);
if ($create_emptys == 7) { $create_emptys = 0; }

//выводим пустые ячейки
if ($create_emptys != 0) {
  echo "<td valign=\"middle\" align=\"center\" colspan=\"$create_emptys\"></td>\n";
}

echo "</tr>";
echo "</table>";




   echo "</td><td valign=top>";
   $sql_date = $year."-".$month."-".$today;

   $result = mysql_query("select * from ".$table_dnp_news." where datum='".$sql_date."' order by datum desc");
   $rows = mysql_num_rows($result);


   if($rows > 0 && !isset($long))
   {
      ?>
      <table width=100% cellpadding=4 border=0 cellspacing=2>
      <?
      for($k=0;$k < $rows;$k++)
      {
        $time=mysql_result($result, $k , "time");
        $datum=mysql_result($result, $k , "datum");
        $title=mysql_result($result, $k , "title");
        $idnum=mysql_result($result, $k , "idnum");

        $datun=explode("-",$datum);
            if($datun[1] == "1" || $datun[1] == "01"){$month="января";}
        elseif($datun[1] == "2" || $datun[1] == "02"){$month="февраля";}
        elseif($datun[1] == "3" || $datun[1] == "03"){$month="марта";}
        elseif($datun[1] == "4" || $datun[1] == "04"){$month="апреля";}
        elseif($datun[1] == "5" || $datun[1] == "05"){$month="мая";}
        elseif($datun[1] == "6" || $datun[1] == "06"){$month="июня";}
        elseif($datun[1] == "7" || $datun[1] == "07"){$month="июля";}
        elseif($datun[1] == "8" || $datun[1] == "08"){$month="августа";}
        elseif($datun[1] == "9" || $datun[1] == "09"){$month="сентября";}
        elseif($datun[1] == "10"){$month="октября";}
        elseif($datun[1] == "11"){$month="ноября";}
        elseif($datun[1] == "12"){$month="декабря";}

        if(($k % 2) == 0){$bgcol="#F7F8FC";}
        else{$bgcol="#EBEBEC";}
        $kp=$k+1;
        ?>
         <tr bgcolor=<?=$bgcol?>>
           <td><?=$kp?></td>
           <td><?=$time?></td>
           <td><nobr><?=$datun[2]?> <?=$month?> <?=$datun[0]?> </nobr></td>
           <td><a href="<? echo $_SERVER['PHP_SELF']."?idnum=".$idnum; ?>&action=view&long=ok&year=<?=$year?>&today=<?=$today?>&month=<?=$month?>"><?=$title?></a></td>
         <?
           echo "<form method=post action=".$_SERVER['PHP_SELF']."?action=izm name=izm".$k." style=\"margin: 0px; padding: 0px;\">
                 <td width=50 valign=top>";
           echo "<input style=\"width: 55px; background-color: green; color: white;\"
                  type=submit value=\"Править\">";
           echo "<input type=hidden name=action value=izm>";
           echo "<input type=hidden name=idnum value=".$idnum.">";
           echo "</td></form>";
          ?>
           <td width=50>
           <form method=post action="<?=$_SERVER['PHP_SELF'];?>?year=<?=$year;?>&today=<?=date("j");?>&month=<?=date("n");?>&action=view"
             name=dela<?=$k?> style="margin: 0px;">
             <input style="width: 55px; background: red; color: white;"
              type=button value="Удалить" OnClick="dela<?=$k?>.submit();">
             <input type=hidden name=delete value=on>
             <input type=hidden name=action value=view>
             <input type=hidden name=id value=<?=$idnum?>>
           </form>
           </td>
         </tr>
         <?
        }
        echo "</table>";
      }
      elseif(isset($long))
      {
         $result = mysql_query("select * from ".$table_dnp_news." where idnum='".$idnum."'  limit 1");
         $rows = mysql_num_rows($result);

         $datum=mysql_result($result, 0 , "datum");
         $title=mysql_result($result, 0 , "title");
         $idnum=mysql_result($result, 0 , "idnum");
         $ip=mysql_result($result, 0 , "ip");
         $time=mysql_result($result, 0 , "time");
         $brouser=mysql_result($result, 0 , "brouser");
         $content=mysql_result($result, 0 , "content");
         $content=str_replace("admin/","../admin/",$content);
         ?>

         <hr>
         <table width=100% cellpadding=2 border=0 cellspacing=0 style="border: solid 1 px gray;">
           <tr>
             <td class=header bgcolor="#F0F0F0">Дата: <b><?=$datum?></b> | Время: <b><?=$time?></b></td>
           </tr>
           <tr>
             <td class=header bgcolor="#F0F0F0">Заголовок: <b><?=$title?></b></td>
           </tr>
           <tr>
             <td class=header bgcolor="#F0F0F0">IP адрес автора: <b><?=$ip?></b></td>
           </tr>
           <tr>
             <td class=header bgcolor="#F0F0F0">Система: <b><?=$brouser?></b></td>
           </tr>
           <tr>
             <td>
              <table style="text-align: justify; border: solid 1 px black; padding: 10px; width: 100%">
              <tr><td>
              <?=$content?>
              </td></tr>
              </table>
             </td>
           </tr>
         </table>
         <hr>
         <a href="javascript: history.back(2)">&laquo; назад</a>
         <?
      }

  echo "</td></tr></table>";

}
//############################################ IZM ######################
elseif($action=="izm" && isset($idnum))
 {

 $result = mysql_query("select * from ".$table_dnp_news." where idnum='".$idnum."'");
 $rows = mysql_num_rows($result);

         $datum=mysql_result($result, 0 , "datum");
         $time=mysql_result($result, 0 , "time");
         $title=mysql_result($result, 0 , "title");
         $content=mysql_result($result, 0 , "content");
         $idnum=mysql_result($result, 0 , "idnum");
         $actuals=mysql_result($result, 0 , "actuals");
         $act_status=mysql_result($result, 0 , "act_status");
		$dati=explode("-",$datum);
?>
<script language="JavaScript">
 <!--

function voidPutATag(Tag,Tag2)
{
document.formata.content.focus();
sel = document.selection.createRange();
sel.text = Tag+sel.text+Tag2;
document.formata.content.focus();
}

 //-->
</script>

<form action="<?=$_SERVER['PHP_SELF']?>?year=<?=$dati[0];?>&today=<?=$dati[2];?>&month=<?=$dati[1];?>" method=post enctype=multipart/form-data name=formata>

..:: Изменение новости ::.. <hr>
<table cellpadding=5 cellspacing=0 border=0 width=100%>
  <tr>
    <td width=10%>Время:</td>
    <td><input type=text name=time style="width: 100px;" value="<?=$time?>"></td>
  </tr>
  <tr>
    <td width=13%>Дата:</td>
    <td><?$dati=explode("-",$datum);
echo '<select name="c_day">';
$days = array("00", "01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31",);
	$months = array("None", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",);
	$months_num = array("None", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12",);

foreach($days as $key => $value) {
	if ($key != "0") {
   		echo "<option value=\"$value\" ";
   		if($value == $dati[2]) { echo "selected"; };
   		echo ">".$key."</option>";
   		}
	}
	echo '</select><select id="c_month" name="c_month">';
foreach($months_num as $key => $value) {
	if ($key != "0") {
   		echo "<option value=\"$value\" ";
   		if($value == $dati[1]) { echo "selected"; };
   			echo ">".$value."</option>";}
			
   		
	}
	echo '</select><input type="text" id="c_year" name="c_year" size="4" maxlength="4" value="'.$dati[0].'"/></p>';?>
	
<?
		$loc_day=date("d");
		$loc_mont=date("m");
		$loc_year=date("Y");
		$loc_date=mktime(0, 0, 0, $loc_mont, $loc_day, $loc_year);
	
		$dati=explode("-",$datum);
		$and_mk_date=mktime(0, 0, 0, $dati[1], $dati[2], $dati[0]);	
		$date_stop=($actuals-$loc_date)/24/3600; 
		if ($date_stop<0) {$date_stop=0; if ($date_stop==0) {$act_status="";} } 
		 
?>
</td>
</tr>
  <tr>
    <td>Новость актуальна:</td><td><input type=text name="actuals" value="<?=$date_stop;?>" size="2" maxlength="3"> дней <INPUT TYPE="checkbox" NAME="act_on" <? if ($act_status=="on") {?>checked> Выключить&nbsp;|&nbsp;не будет отображаться в самом верху новостей<?}else {?>>Включить&nbsp;|&nbsp;будет отображаться в самом верху новостей<?}?></td>
</tr>
</td>
  </tr>
  <tr>
    <td>Заголовок:</td>
    <td><input type=text name=title style="width: 80%;" value="<?=$title?>"></td>
  </tr>
  <tr>
    <td></td>
    <td><? if ($db_status_us == 1) {?>
      
      <a href="javascript: voidPutATag('<b>','</b>')" title="полужирный текст" class=buten>b</a>
      <a href="javascript: voidPutATag('<i>','</i>')" title="курсив" class=buten>i</a>
      <a href="javascript: voidPutATag('<u>','</u>')" title="подчеркивание" class=buten>u</u>
      <a href="javascript: voidPutATag('<center>','</center>')" title="" class=buten>center</a>
      <a href="javascript: voidPutATag('<ul>','</ul>')" title="список" class=buten>ul</a>
      <a href="javascript: voidPutATag('<li>','</li>')" title="элемент списка" class=buten>li</a>
      <a href="javascript: voidPutATag('&laquo;','&raquo;')" title="кавычки" class=buten>&laquo; &raquo;</a>
      <a href="javascript: voidPutATag('\n<br>','\n ')" title="перенос строки" class=buten>br</a>
      <a href="javascript: voidPutATag('\n<p>','\n ')" title="абзац" class=buten>Абзац</a>
      <a href="javascript: voidPutATag('<a href=>','</a>')" title="ссылка" class=buten>ссылка</a><? } else {} ?>
      <a href=dnp_news_img.php onclick="window.open(this.href,this.target,'width=500,height=350,'+'location=no,toolbar=no,menubar=no,status=yes,scroll=yes');return false;" title='закачать картинку'  class=buten>закачать картинку</a>
    </td>
  </tr>
  <tr>
    <td valign=top>Содержание: <?=$db_status_us;?></td>
    <td><textarea name=content style="height: 250px; width: 100%; padding: 5px;"><?//=$content;
		 if ($db_status_us == 1) {echo $content; } else {echo strip_tags($content);} ?></textarea></td>
  </tr>
  <tr>
    <td valign=top></td>
    <td>
<input type=button OnClick="window.open('hot_view.php',this.target,'width=700,height=350,'+'location=no,toolbar=no,menubar=no,status=yes,resizeable=yes,scrollbars=yes');return false;"  value="Предпросмотр текста">
<input type=submit class=btn value="Сохранить"></td>
  </tr>
</table>
    <input type=hidden name=do value="save">
    <input type=hidden name=idnum value="<?=$idnum?>">
    <input type=hidden name=action value="izm_on">
</form>
<?
}
//############## izm  on
elseif(isset($action) && $action=="izm_on")
{
	$dates=$c_year."-".$c_month."-".$c_day;
   if(isset($title)   && $title!=""   &&
      isset($content) && $content!="" &&
      isset($time)    && $time!=""    &&
      isset($dates)   && $dates!=""
      )
   {
	
	 $n_actuals=$actuals*3600*24;
	 $nd_mk_date=mktime(0, 0, 0, $c_month, $c_day, $c_year);
		$and_mk_date=$nd_mk_date+$n_actuals;
   if ($db_status_us == 1){} else {
	 $content = str_replace("\n",'<br />', $content);
	 $content = preg_replace("#\[php\](.+?)\[/php\]#ies","php_highlight('\\1')",$content);
	}

	 mysql_query("update ".$table_dnp_news." set
                  datum = \"".$dates."\",
                  x_datum = \"".$nd_mk_date."\",
                  time  = \"".$time."\",
                  title = \"".$title."\",
                  actuals = \"".$and_mk_date."\",
                  act_status = \"".$act_on."\",
                  content =\"".$content."\" where idnum = \"".$idnum."\" ") or die(mysql_error());
     echo "<font color=green>Запись внесена!!!</font><hr>";
     $raz=explode("-",$datum);
     echo "<nobr><a href='".$_SERVER['PHP_SELF']."?action=view&year=".$year."&today=".$today."&month=".$month."' ";
     echo "class=buten>В просмотр &raquo;</a></nobr>";
   }
   else
   {
      echo "Информация не может быть добавлена, вы ввели неверные данные <br><ul>";
      if(!isset($title)   || $title==""){echo "<li>Поле \"Заголовок\" должно быть заполнено обязательно!</li>";}
      if(!isset($content) || $content==""){echo "<li>\"Содержание\" должно быть заполнено обязательно!</li>";}
      //if(!isset($time)    || $time==""){echo "<li>Поле \"Время\" должно быть заполнено обязательно!</li>";}
      //if(!isset($dates)   || $dates==""){echo "<li>Поле \"Дата\" должно быть заполнено обязательно!</li>";}
      echo "</ul><hr size=1 color=black noshade></a><a href=javascript:history.back(2) class=menu><< Попробуйте еще раз.</a>";
   }
}
//########### izm add stop
}
?>
</body>
</html>
<?}?>