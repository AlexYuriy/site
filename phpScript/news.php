<?php 
$now_month = date("n",time());
$now_year  = date("Y",time());
$now_today = date("j", time());


require_once("admin/config.inf");
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
function translit($trnsl)

{
        $rus = array('а','б','в','г', 'д', 'е', 'Є', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', '€');
    $eng = array('a', 'b', 'v', 'g', 'd', 'e', 'e', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sz', '', 'y', '', 'e', 'yu', 'ya');
        $trnsl = preg_replace('/\W/', '-', strtolower(strip_tags($trnsl)));
    $trnsl = preg_replace('/[-]+/', '-', $trnsl);
    $trnsl = preg_replace('/(-$)/', '', $trnsl);
    $trnslr = preg_replace('/(^-)/', '', $trnsl);
    $trnsl = str_replace($rus,$eng,$trnsl);
return $trnsl;
}

function rewr_url(){
global $output, $rew_datum, $idn, $title, $title_actual;


	//if ($loc_date){$url = date('/Y/m/d/', $loc_date);}
	//else {
		$url = date('/Y/m/d/', $rew_datum).$idn.'/'.translit($title_actual);
	//}

    $output = "$url.htm";
    
echo "$output";
}
function page_url(){
global $msg, $rew_datum, $title, $id, $title_actual, $year, $month, $cont, $PHP_SELF, $url, $cont;

   // if ($year and !$month){$link = date('Y', $rew_datum);}
    //else {
		//$link = date('Y/m', $rew_datum);
		//}

    
    $msg = str_replace('&amp;cont=', '', $msg);
    $msg = str_replace('&amp;id=', '', $msg);
    $msg = str_replace('&amp;year='.$year, '', $msg);
    $msg = str_replace('&amp;month='.$month, '', $msg);
    $msg = str_replace('&amp;today='.$today, '', $msg);
    //$msg = preg_replace('[start_from=([0-9]+)&amp;]', '\\1', $msg);
    //$msg = preg_replace('[start_from=([0-9]+)]', '\\1', $msg);
    //$msg = str_replace($PHP_SELF.'?', '/'.$link.'/page/', $msg);
    //$msg = str_replace(htmlspecialchars(preg_replace('[cstart=([0-9]+)]', '', $_SERVER['QUERY_STRING'])), '', $msg);

    if (!$today){$msg = '';}

//echo "msg= $msg $id $year $month $today $cont";
//return $msg;
}

if(!isset($cont))
{
$local_date=date("Y-m-d");
$loc_day=date("d");
$loc_mont=date("m");
$loc_year=date("Y");
$loc_date=mktime(0, 0, 0, $loc_mont, $loc_day, $loc_year);
$sql_date = $year."-".$month."-".$today;


$results = mysql_query("select * from $table_dnp_news where actuals!=''");
while ($rowss = mysql_fetch_array($results)){
$content_actual=$rowss["content"];
$title_actual=$rowss["title"];
$datum_actual=$rowss["datum"];
$x_datum_actual=$rowss["x_datum"];
$num_actual=$rowss["actuals"];
$act_status=$rowss["act_status"];
$datix=explode("-",$datum_actual);

$end_date=($loc_date-$num_actual)/24/3600;
if ($loc_date < $num_actual and $act_status=="on"){ ?>
<TABLE width="100%" cellpadding="0" cellspacing="0"">
	<TR>
	 <TD bgcolor="#DEDFEC" height="20"  <? if (strlen($title)>70) {?> class="menusmall" <?} else {?>class="menu"<?}?> align="center"><b><?=$title_actual;?></b></TD>
							   </TR>
								 <TR>
						 			<TD  cellpadding="5" class="menusmall">&nbsp;&nbsp;<?=$content_actual;?></TD>
						 </TR>
						 </TABLE><BR>
 
 
					<?}
}

if($now_today==$today && $now_month==$month && $now_year==$year && $start_news == "on")
{ 
 //echo "1 act_status=$act_status loc_date=$loc_date num_actual=$num_ start_news=$start_news local_date=$local_date<BR>";
 $result = mysql_query("select * from ".$table_dnp_news." where x_datum <= '$loc_date' and  act_status!='on' order by datum desc, time desc limit ".$news_num." ");
 $rows = mysql_num_rows($result);
}
else
{//echo "2 act_status=$act_status loc_date=$loc_date num_actual=$num_ start_news=$start_news local_date=$local_date<BR>";
$result = mysql_query("select * from ".$table_dnp_news." where datum = '".$sql_date."' and act_status!='on' order by time desc");
$rows = mysql_num_rows($result);
}

   if($rows==0 && $sql_date==$local_date) {//echo "3 act_status=$act_status loc_date=$loc_date num_actual=$num_ start_news=$start_news local_date=$local_date sql_date=$sql_date<BR>";
       $result = mysql_query("select * from ".$table_dnp_news." where x_datum <= '$loc_date' and act_status!='on' order by datum desc, time desc limit ".$news_num." ");
       $rows = mysql_num_rows($result);
       }
	elseif ($rows==0 && $sql_date!=$local_date) {//echo "4 act_status=$act_status loc_date=$loc_date num_actual=$num_ start_news=$start_news local_date=$local_date sql_date=$sql_date<BR>";
       $result = mysql_query("select * from ".$table_dnp_news." where x_datum <= '$loc_date' and act_status!='on' order by datum desc, time desc limit ".$news_num." ");
       $rows = mysql_num_rows($result);
	}
	   
 

for($k=0;$k < $rows;$k++)
   {
    $idn=mysql_result($result, $k , "idnum");
    $content=mysql_result($result, $k , "content");
    $title=mysql_result($result, $k , "title");
    $idnum=mysql_result($result, $k , "idnum");
    $datum=mysql_result($result, $k , "datum");
    

    $dati=explode("-",$datum);
    $rew_datum=$loc_date=mktime(0, 0, 0, $dati[1], $dati[2], $dati[0]);
	$shot_content=explode("[cut]",$content);

if($dati[1] == "1" || $dati[1] == "01"){$months="€нвар€";}
    elseif($dati[1] == "2" || $dati[1] == "02"){$months="феврал€";}
    elseif($dati[1] == "3" || $dati[1] == "03"){$months="марта";}
    elseif($dati[1] == "4" || $dati[1] == "04"){$months="апрел€";}
    elseif($dati[1] == "5" || $dati[1] == "05"){$months="ма€";}
    elseif($dati[1] == "6" || $dati[1] == "06"){$months="июн€";}
    elseif($dati[1] == "7" || $dati[1] == "07"){$months="июл€";}
    elseif($dati[1] == "8" || $dati[1] == "08"){$months="августа";}
    elseif($dati[1] == "9" || $dati[1] == "09"){$months="сент€бр€";}
    elseif($dati[1] == "10"){$months="окт€бр€";}
    elseif($dati[1] == "11"){$months="но€бр€";}
    elseif($dati[1] == "12"){$months="декабр€";}
	



?>        
		 <!-- блок новости -->
              
                <?
					$Lengthtext=strlen($content);
					$MessLengthtext=280;
				$name = substr($content, 0, $MessLengthtext)." >>>>";
				$name = str_replace(">>>", ".....", $name);
                  if($Lengthtext>$MessLengthtext){?>
                         
						 
						 <TABLE width="100%" cellpadding="0" cellspacing="0">
						 <TR>
						 	<TD bgcolor="#DEDFEC" width="25%" height="20" class="menu"><font color=#336600>&nbsp;<?=$dati[2];?> <?=$months;?> <?=$dati[0];?></font></TD>
						 	<TD bgcolor="#DEDFEC" <? if (strlen($title)>65) {?> class="menusmall" <?} else {?>class="menu"<?}?>><b><?=$title;?></b></TD>
						 </TR>
							<TR><!-- <a class="menusmall2" href="<? rewr_url();?>"><FONT COLOR="#330099">ѕодробнее&nbsp;&raquo</a> -->
						 		<TD  colspan="2" class="menusmall">&nbsp;&nbsp;<?=$name;?><BR>
								<a class="menusmall2" href="?cont=long&id=<?=$idnum;?>&year=<?=$dati[0];?>&today=<?=$dati[2];?>&month=<?=$dati[1];?>"><FONT COLOR="#330099">ѕодробнее&nbsp;&raquo</a></FONT></TD>
							</TR>
						 </TABLE>
					
						    						   
                        
                        <? }
                   else { $nd=date('Y' ); ?>
                        
						<TABLE width="100%" cellpadding="0" cellspacing="0" >
						 <TR>
						 	<TD bgcolor="#DEDFEC" width="25%" height="20" class="menu"><font color=#336600>&nbsp;<?=$dati[2];?> <?=$months;?> <?=$dati[0];?></font></TD>
                               <TD bgcolor="#DEDFEC" <? if (strlen($title)>65) {?> class="menusmall" <?} else {?>class="menu"<?}?>><b><?=$title;?></b></TD>
							   </TR>
								 <TR>
						 			<TD  colspan="2" valign="top" class="menusmall">&nbsp;&nbsp;<?=$content;?></TD>
						 </TR>
						 </TABLE>
                       <? }
                ?>
 <!-- <hr color=#BECCDE> -->               
<BR>


<?
 } if ($content=="") {echo "<CENTER><B>Ќовостей нет!</B></CENTER><BR>";}

}
elseif(isset($cont) && $cont=="long" && isset($id))
{

   echo "<!-- содержание новости -->";
              
//page_url();

   $result = mysql_query("select * from ".$table_dnp_news." where idnum='".$id."'  limit 1");
   $rows = mysql_num_rows($result);

   if($rows > 0)
   {
    $datum   = mysql_result($result, 0 , "datum"  );
    $title   = mysql_result($result, 0 , "title"  );
    $idnum   = mysql_result($result, 0 , "idnum"  );
    $content = mysql_result($result, 0 , "content");
    $content = str_replace("[cut]"," ",$content);

    $dati=explode("-",$datum);

    $datun=explode("-",$datum);
        if($datun[1] == "1" || $datun[1] == "01"){$month="€нвар€";}
    elseif($datun[1] == "2" || $datun[1] == "02"){$month="феврал€";}
    elseif($datun[1] == "3" || $datun[1] == "03"){$month="марта";}
    elseif($datun[1] == "4" || $datun[1] == "04"){$month="апрел€";}
    elseif($datun[1] == "5" || $datun[1] == "05"){$month="ма€";}
    elseif($datun[1] == "6" || $datun[1] == "06"){$month="июн€";}
    elseif($datun[1] == "7" || $datun[1] == "07"){$month="июл€";}
    elseif($datun[1] == "8" || $datun[1] == "08"){$month="августа";}
    elseif($datun[1] == "9" || $datun[1] == "09"){$month="сент€бр€";}
    elseif($datun[1] == "10"){$month="окт€бр€";}
    elseif($datun[1] == "11"){$month="но€бр€";}
    elseif($datun[1] == "12"){$month="декабр€";}
    ?>
      <TABLE width="100%" cellpadding="0" cellspacing="0">
						 <TR>
						 	<TD bgcolor="#DEDFEC" width="25%" height="20" class="menu"><font color=#336600>&nbsp;<?=$datun[2]?> <?=$month?> <?=$datun[0]?></font></TD>
						 	<TD bgcolor="#DEDFEC" <? if (strlen($title)>70) {?> class="menusmall" <?} else {?>class="menu"<?}?>><b><?=$title;?></b></TD>
						 </TR>
							<TR>
						 		<TD  colspan="2" class="menusmall" >&nbsp;&nbsp;<?=$content?></TD>
							</TR>
						 </TABLE>
         
         
    
     <BR><P>
     <?
    /*
      //links creator
     $rid_back = mysql_query("select * from ".$table_dnp_news." where idnum < '".$id."' order by idnum desc limit 1 ");
     $id_back_rows=mysql_num_rows($rid_back);
     if($id_back_rows > 0)
     {
       $id_back=mysql_result($rid_back, 0 ,"idnum");
       echo "<td width=50%><a href=\"".$PHP_SELF."?cont=long&id=".$id_back."&year=".$dati[0]."&today=".$dati[2]."&month=".$dati[1]."\">&laquo; предыдуща€ новость</a></td>";
     }
      else
     {
       echo "<td width=50% style=\"color: gray;\">&laquo; предыдуща€ новость</td>";
     }

     $rid_next = mysql_query("select * from ".$table_dnp_news." where idnum > '".$id."' order by idnum limit 1 ");
     $id_back_rows=mysql_num_rows($rid_next);
     if($id_back_rows > 0)
     {
       $id_next=mysql_result($rid_next,0,"idnum");
       echo "<td width=50% align=right><a href=\"".$PHP_SELF."?cont=long&id=".$id_next."&year=".$dati[0]."&today=".$dati[2]."&month=".$dati[1]."\">следующа€ новость &raquo;</a></td>";
     }
     else
     {
       echo "<td width=50% align=right style=\"color: gray;\">следующа€ новость &raquo;</td>";
     }*/
     
     echo "<a class=menusmall2 href=\"javascript:history.back(2);\">&laquo; назад</a><BR>";
     
	 ?>
        
     


    <?
   }





}
?>


    

