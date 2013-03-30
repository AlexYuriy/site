
<?

if($PHP_SELF == ""){ $PHP_SELF = $HTTP_SERVER_VARS["PHP_SELF"]; }

include("admin/config.inf");
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
$dayone    = date("w",mktime(1,1,1,$month,1,$year)); //день недели цифрой
	if ($dayone ==0) {$dayone = 7;} 
$numdays   = date("t",mktime(1,1,1,$month,1,$year)); //количество дней в месяце
$alldays   = array('Пн','Вт','Ср','Чт','Пт','<font color=#C05643>Сб</font>','<font color=#C05643>Вс</font>');
$next_year = $year + 1;
$last_year = $year - 1;
$next_month = $month + 1;
$last_month = $month - 1;

if ($today > $numdays) { $today = $numdays; }
$month_ru = array ('','Январ','Феврал','Март','Апрел','Ма','Июн','Июл','Август','Сентябр','Октябр','Ноябр','Декабр');
$im_p = array ('','ь','ь','','ь','й','ь','ь','','ь','ь','ь','ь');
$r_p = array ('','я','я','а','я','я','я','я','а','я','я','я','я');
$space = "&nbsp;";


?>

<link rel="stylesheet" href="calend.css" type="text/css">
<script type="text/javascript" src="calend.js"></script>

<table class="calend" align="center" cellpadding="4" cellspacing="1" >
	<tr>
		<td><a id="back" href="<?=$PHP_SELF;?>?year=<?=$year?>&today=<?=0;?>&month=<?=$last_month;?>" onclick="month(-1); return false;">&laquo;&laquo;</a></td>
		<td colspan="5"><center><b id="month"><? echo $month_ru[$month], $im_p[$month];?></b></center></td>
		<td><a id="forward" href="<?=$PHP_SELF;?>?year=<?=$year;?>&today=<?=0;?>&month=<?=$next_month;?>" onclick="month(1); return false;">&raquo;&raquo;</a></td>
	</tr>
	<tr>	<!-- //выводим дни недели -->
		<td><b>Пн</b></td>
		<td><b>Вт</b></td>
		<td><b>Ср</b></td>
		<td><b>Чт</b></td>
		<td><b>Пт</b></td>
		<td><b><font color=#C05643>Сб</font></b></td>
		<td><b><font color=#C05643>Вс</font></b></td>
	</tr>
	<tr class=days>	 
	
	<?
		$j = 1-$dayone;
		for ($i = 1; $i < 43; ++$i) 
			{
				++$j;
				echo '<td id="', $i;  
				if (($j <= $numdays)&&( $j > 0 )) { echo '">', $j, '</td>' ;} else { echo '" class=free_day></td>'; }  
				if (($i<42)&&( $i % 7 == 0) )
				{
					if ($i>34) 		{?></tr><tr class=days id="last_week"><?} 
					elseif ($i>27) 	{?></tr><tr class=days id="pre_last_week"><?}  
						else  		{?></tr><tr class=days><?}
				}
			}
	?>
	</tr>
	<tr class=today_link>
		<td colspan="7">
			<a href="<?=$PHP_SELF;?>" onclick="today(); return false;">Сегодня: <? echo date("j",time()),' ' ,$month_ru[date("n",time())], $r_p[date("n",time())],' ' ,date("Y",time()) ;?> </a>
		</td>
	</tr>
</table>


<script type="text/javascript">
var good_Date =  [ 23, 	25, 	13, 	3] ;
var good_Month = [ 2, 	2, 		1, 		3];
var good_Year =  [ 2013, 	2013, 	2012, 	2013];

var color_no = "028AC8" ;
var color_yes = "055A81" ;
var color_free = "929493" ;

var now = new Date();

function today()
{
	now.setYear(<?=date("Y",time());?>);
	now.setMonth(<?=date("F",mktime(1,1,1,$month,$today,$year));?>);
	redraw();
}

redraw();

</script>

