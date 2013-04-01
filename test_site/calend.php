
<?

if($PHP_SELF == ""){ $PHP_SELF = $HTTP_SERVER_VARS["PHP_SELF"]; }

include("admin/config.inf");
$link = mysql_connect ($dbhostname , $dbusername , $dbpassword);
if ( (!$link) || (!mysql_select_db($database) ) ) 
{
    die('Ошибка соединения: ' . mysql_error());
}
///Саша написал ->>
	$res = mysql_query("select datum from ".$table_dnp_news."");
	$num_rows = mysql_num_rows($res);

	$value = mysql_result($res,0);
	$good_Year = substr($value, 0, 4) ;
	$good_Month= substr($value, 5, 2) ;
	$good_Date = substr($value, 8, 2) ;	
	
	for($i=1; $i < $num_rows; ++$i)
	{
		$value = mysql_result($res,$i);
		$good_Year .= ", " . substr($value, 0, 4) ;
		$good_Month.= ", " . substr($value, 5, 2) ;
		$good_Date .= ", " . substr($value, 8, 2) ;
	}

/// <<- Саша написал 
mysql_close($link);

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

 
$month = (isset($month)) ? $month : date("n",time());
$year  = (isset($year)) ? $year : date("Y",time());
$dayone    = date("w",mktime(1,1,1,$month,1,$year)); //день недели цифрой
	if ($dayone ==0) {$dayone = 7;} 
$numdays   = date("t",mktime(1,1,1,$month,1,$year)); //количество дней в месяце
$alldays   = array('Пн','Вт','Ср','Чт','Пт','<font color=#C05643>Сб</font>','<font color=#C05643>Вс</font>');
$next_year = $year + 1;
$last_year = $year - 1;
$next_month = $month + 1;
$last_month = $month - 1;

$month_ru = array ('','Январ','Феврал','Март','Апрел','Ма','Июн','Июл','Август','Сентябр','Октябр','Ноябр','Декабр');
$im_p = array ('','ь','ь','','ь','й','ь','ь','','ь','ь','ь','ь');
$r_p = array ('','я','я','а','я','я','я','я','а','я','я','я','я');
$space = "&nbsp;";

$today_day	= date("j",time()) ;
$today_month= date("n",time()) ;
$today_year	= date("Y",time()) ;

function is_tomonth()
{
	global $today_month, $month, $today_year, $year;
	if ( ($today_month == $month) && ($today_year == $year) ) return true; else return false; 
}


function is_today($str)
{
	global $today_day;
	if (( $today_day == $str) && is_tomonth() ) return true; else return false; 
}

function busy_day($str)
{
	global $good_Year, $good_Month, $good_Date, $num_rows, $year, $month;
	$month_str = str_pad($month, 2, '0', STR_PAD_LEFT);
	$day_str = str_pad($str, 2, '0', STR_PAD_LEFT);
	$year_str = str_pad($year, 4, '0', STR_PAD_LEFT);
	
	for($i=0; $i < $num_rows; ++$i)
	{
		$Years[$i] = substr($good_Year, $i*6,4) ;
		$Months[$i]= substr($good_Month,$i*4,2) ;
		$Dates[$i] = substr($good_Date, $i*4,2) ;	

	}
	for($i=0; $i < $num_rows; ++$i)
		{
			if (( strcmp( $Years[$i], $year_str) ==0 ) && ( strcmp( $Months[$i], $month_str) ==0 ) && ( strcmp( $Dates[$i], $day_str) ==0 )) 
				return true;
		}
	return false; 
}

?>

<link rel="stylesheet" href="css/calend.css" type="text/css">
<script type="text/javascript" src="js/calend.js"></script>

<table class="calend" align="center" cellpadding="4" cellspacing="1" >
	<tr>
		<td id="back"><a href="<?=$PHP_SELF;?>?year=<?=$year?>&month=<?=$last_month;?>" onclick="month(-1); return false;">&laquo;&laquo;</a></td>
		<td colspan="5"><center><b id="month"><? echo $month_ru[$month], $im_p[$month];?></b></center></td>
		<td id="forward"><a href="<?=$PHP_SELF;?>?year=<?=$year;?>&month=<?=$next_month;?>" onclick="month(1); return false;">&raquo;&raquo;</a></td>
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
	<tr class=days>	<?
		$j = 1-$dayone;
		$invis_flag = false;
		for ($i = 1; $i < 43; ++$i) 
		{
				++$j;
				echo "\n",'		<td id="', $i, '"';  
				if (($j <= $numdays)&&( $j > 0 )) 
				{ 
					$context = " $j ";
					if (busy_day($j) ) $context =" bgcolor=#055A81><a href=$news_page?year=$year&today=$j&month=$month > $context </a>" ;
						else $context = ">$context";
					if (is_today($j)) echo ' bgcolor=#05CA81'; 
	
					echo $context, '</td>' ;
					$invis_flag = false;
				} 
				elseif($invis_flag) echo ' bgcolor=#E7EBEF></td>';
				else echo ' bgcolor=#929493></td>';  
				
				if (($i<42)&&( $i % 7 == 0) )
				{
					$invis_flag = true;
					if ($i>34) 			{ echo "\n	</tr>\n", '	<tr class=days id="last_week"> ';} 
						elseif ($i>27)	{ echo "\n	</tr>\n", '	<tr class=days id="pre_last_week">';}  
							else  		{ echo "\n	</tr>\n", '	<tr class=days>';}
				}
		}
	?>
	
	</tr>
	<tr class=today_link>
		<td colspan="7">
			<a href="<?=$PHP_SELF;?>" onclick="today(); return false;">Сегодня:  <? echo $today_day ,' ' ,$month_ru[ $today_month ], $r_p[ $today_month ],' ' , $today_year ;?> </a>
		</td>
	</tr>
</table>


<script type="text/javascript">
<!--
var good_Date =  [<?=$good_Date?>] ;
var good_Month = [<?=$good_Month?>] ;
var good_Year =  [<?=$good_Year?>] ;

var now = new Date(<?echo "$year, ", $month-1?>, 15);

function today()
{
	now.setYear(<?=$today_year?>);
	now.setMonth(<?=$today_month-1?>);
	redraw();
}

redraw();
-->
</script>

