      <?

$now_month = date("n",time());
$now_year  = date("Y",time());
$now_today = date("j", time());


include("admin/config.inf");
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
mysql_connect ($dbhostname , $dbusername , $dbpassword);
mysql_select_db($database);





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
$monthlong = date("F",mktime(1,1,1,$month,$today,$year)); //название мес€ца англ.
$dayone    = date("w",mktime(1,1,1,$month,1,$year)); //день недели цифрой
$numdays   = date("t",mktime(1,1,1,$month,1,$year)); //количество дней в мес€це
$alldays   = array('ѕн','¬т','—р','„т','ѕт','<font color=#C05643>—б</font>','<font color=#C05643>¬с</font>');
$next_year = $year + 1;
$last_year = $year - 1;
$next_month = $month + 1;
$last_month = $month - 1;
if ($today > $numdays) { $today--; }
        if($month == "1" ){$month_ru="€нварь";}
    elseif($month == "2" ){$month_ru="февраль";}
    elseif($month == "3" ){$month_ru="март";}
    elseif($month == "4" ){$month_ru="апрель";}
    elseif($month == "5" ){$month_ru="май";}
    elseif($month == "6" ){$month_ru="июнь";}
    elseif($month == "7" ){$month_ru="июль";}
    elseif($month == "8" ){$month_ru="август";}
    elseif($month == "9" ){$month_ru="сент€брь";}
    elseif($month == "10"){$month_ru="окт€брь";}
    elseif($month == "11"){$month_ru="но€брь";}
    elseif($month == "12"){$month_ru="декабрь";}
//echo $month;
//echo $dayone;



if(checkdate($month,29,$year) && $month==2) {
   //echo "это 29 мес!!! ";
   $dayone=7;
   }
?>
<table border=0 cellpadding=4 cellspacing=1 width=170>

<!-- выводим название года -->
<tr bgcolor=#E7EBEF class=menusmall>
      <td align=center class=menusmall><a class=menusmall2 href="<?=$PHP_SELF;?>?year=<?=$last_year;?>&today=<?=$today;?>&month=<?=$month;?>">&laquo;&laquo;</a></td>
<td class="menusmall" colspan="5" valign="middle" align="center">
      <b ><?=$year;?> г.</b></td>
<td align=center class=menusmall><a class=menusmall2 href="<?=$PHP_SELF;?>?year=<?=$next_year;?>&today=<?=$today;?>&month=<?=$month;?>">&raquo;&raquo;</a></td>
</tr></table>

<!-- //выводим название мес€ца -->
<table border=0 cellpadding=4 cellspacing=1 width=170>
<tr bgcolor=#E7EBEF class=menusmall >
     <td align=center class=menusmall><a class=menusmall2 href="<?=$PHP_SELF;?>?year=<?=$year?>&today=<?=$today;?>&month=<?=$last_month;?>">&laquo;&laquo;</a></td>
<td class="cellbg" colspan="5" valign="middle" align="center">
      <b><?=$month_ru;?></b></td>
<td align=center class=menusmall><a class=menusmall2 href="<?=$PHP_SELF;?>?year=<?=$year;?>&today=<?=$today;?>&month=<?=$next_month;?>">&raquo;&raquo;</a></td>
</tr></table>

<table border=0 cellpadding=2 cellspacing=1 width=170><tr>

<!-- //выводим дни недели -->
<?
foreach($alldays as $value) { ?>
  <td valign="middle" align="center" class=menusmall>
        <b><?=$value;?></b></td>
<?}?>
</tr><tr>


<!-- //выводим пустые дни мес€ца как пробелы -->
<?
if ($dayone == 0) {$dayone=7;}
for ($i = 0; $i < ($dayone-1); $i++) {?>
  <td valign="middle" align="center" class=menusmall >&nbsp;</td>
<?}?>


<!-- //выводим дни мес€ца -->
<?
for ($zz = 1; $zz <= $numdays; $zz++) {
  if ($i >= 7) { ?>
  </tr><tr><? $i=0; }

  if ($zz == $today) {?>
  <td valign="middle" align="center" bgcolor=#BECCDE class=menusmall>
  <?
          $news_date = $year."-".$month."-".$zz;
          $news_result = mysql_query("select * from ".$table_dnp_news." where datum = '".$news_date."' and act_status!='on'");
          $news_rows = mysql_num_rows($news_result);
          if($news_rows >0) {?>
		  <a class=menusmall3 href="<?=$_SERVER['PHP_SELF'];?>?year=<?=$year;?>&today=<?=$zz;?>&month=<?=$month;?>"><?=$zz;?></a>
           <?}
          else {
           echo $zz;
           }?>
       </td>
  <?}
  else {?>
    <td valign="middle" align="center" class=menusmall bgcolor=#EBF2F5>
	<?
          $news_date = $year."-".$month."-".$zz;
          
		  
		  
		  $news_result = mysql_query("select * from ".$table_dnp_news." where datum = '".$news_date."' and act_status!='on'");
          $news_rows = mysql_num_rows($news_result);
          if($news_rows >0) {?>
		  <a class=menusmall3 href="<?=$_SERVER['PHP_SELF'];?>?year=<?=$year;?>&today=<?=$zz;?>&month=<?=$month;?>"><?=$zz;?></a>
          <?}
          else {
           echo $zz;
           }?>
		   </td>
<?
  }

  $i++;
}

$create_emptys = 7 - ((($dayone-1) + $numdays) % 7);
if ($create_emptys == 7) { $create_emptys = 0; }

//выводим пустые €чейки
if ($create_emptys != 0) {?>
  <td valign="middle" align="center" colspan="<?=$create_emptys;?>"></td>
<?}

if($now_month == "1" ){$now_month_ru="январ€";}
    elseif($now_month == "2" ){$now_month_ru="‘еврал€";}
    elseif($now_month == "3" ){$now_month_ru="ћарта";}
    elseif($now_month == "4" ){$now_month_ru="јпрел€";}
    elseif($now_month == "5" ){$now_month_ru="ћа€";}
    elseif($now_month == "6" ){$now_month_ru="»юн€";}
    elseif($now_month == "7" ){$now_month_ru="»юл€";}
    elseif($now_month == "8" ){$now_month_ru="јвгуста";}
    elseif($now_month == "9" ){$now_month_ru="—ент€бр€";}
    elseif($now_month == "10"){$now_month_ru="ќкт€бр€";}
    elseif($now_month == "11"){$now_month_ru="Ќо€бр€";}
    elseif($now_month == "12"){$now_month_ru="ƒекабр€";}


?>

</tr>
</table>

<!-- //выводим сегодн€шнюю дату с ссылкой -->
<table border=0 cellpadding=4 cellspacing=1 width=170>
<tr bgcolor=#E7EBEF class=menusmall3>
      <td  align=center class=menusmall3><a href="<?=$PHP_SELF;?>?year=<?=$now_year;?>&today=<?=$now_today;?>&month=<?=$now_month;?>" class=menusmall3>
       <div >—егодн€: <?=$now_today;?> <?=$now_month_ru;?> <?=$now_year;?> </div></a>
	   <? if ($news_comon=="on") {?>	   
	   <BR>
	   <A class="smallnews" HREF="<?=$pach_name;?>/admin" target="_blank">ƒобавить новость</A><?} else {} ?> 
	   </td>
</tr></table>



