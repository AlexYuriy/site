<?
//require("../db.inc.php");

$dates=date("Y-m-d");
$sql = mysql_query("SELECT * FROM users where login='$login' ");
$row = mysql_fetch_array($sql);
$dbstatus_us_l=$row["status_us"];
$db_username_l=$row["login"];

if ($dbstatus_us_l > "2" ){ err_msg("<CENTER class='menusmall2'><B>Доступ запрещен!<BR>Вы не можете редактировать пользователей!</B></CENTER>"); }?>
<script language="JavaScript">
<!--
function ckeck_uncheck_all() {
       var frm = document.editusers;
       for (var i=0;i<frm.elements.length;i++) {
               var elmnt = frm.elements[i];
               if (elmnt.type=="checkbox") {
                       if(frm.master_box.checked == true){ elmnt.checked=false; }
           else{ elmnt.checked=true; }
               }
       }
       if(frm.master_box.checked == true){ frm.master_box.checked = false; }
   else{ frm.master_box.checked = true; }
}

-->
</script>
<script language="javascript">
<!--
function confdelete(id){
var agree=confirm("Вы уверены, что хотите удалить этого пользователя?");
if (agree)
document.location=""+id;
}
-->
</script>
<?
//Удаление отмеченных пользователей
if (isset($delete_check)){ 
	if ($db_username_l != $login or $dbstatus_us_l > "1"){
		echo "<CENTER class='menusmall2'><B>Удалять запрещено!</B></CENTER>";
	}
	else {
	
	for ($i=0;$i<count($box);$i++)
	{mysql_query("delete from users where users_id='$box[$i]'");}
	echo "<CENTER class='menusmall2'><B>Пользователь удален</B></CENTER><br>";
	}}

//Добавление нового пользователя
if (isset($addnewuser)){
	$newpassword= md5($newpassword);
	mysql_query("insert into users values (null,'$newuserlogin','$newpassword','$newname_user','$newstatus','$newemail_user','$newphone_user','$newpicq_user', '$dates');"); 
echo "<CENTER class='menusmall2'><B>Пользователь добавлен</B></CENTER><BR>";
}
//Запись изменений пользователя
if (isset($editeduser)){
	if ($dbstatus_us_l > "1" and $newstatus == "1"){
	echo "<CENTER class='menusmall2'><B>Статус пользователя изменять запрещено!</B></CENTER>";
	//break;
	}else{
	if ($newpassword=="") {$newpassword=$dbmd5_pass;}
	else {$newpassword= md5($newpassword);}
	mysql_query("UPDATE users SET login='$newuserlogin', pass='$newpassword', name_user='$newname_user', status_us='$newstatus', email_us='$newemail_user', phone_user='$newphone_user', icq_user='$newpicq_user' WHERE users_id='$sid'");
echo "<CENTER class='menusmall2'><B>Изменения сохранены</B></CENTER>";
}}

//Редактирование пользователя
if ($action=="edituser" && $mod=="edituser"){
	$sql = mysql_query("SELECT * FROM users where users_id='$idus' ");
while ($row = mysql_fetch_array($sql))	{
	$id=$row["users_id"];
	$db_username=$row["login"];
	$dbmd5_pass=$row["pass"];
	$dbname_user=$row["name_user"];
	$dbstatus_us=$row["status_us"];
	$dbemail_us=$row["email_us"];
	$dbphone_user=$row["phone_user"];
	$dbpicq_user=$row["icq_user"];
	$dbdate_us=$row["date_us"];
?>	
<table border="0" cellpading="2" cellspacing="2" width="654" >
	<tr>
	<td width="654" colspan="6">
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="bottom" width="311" valign="top" height="1" class="menusmall2"><b>Изменить пользователя</b></td>
				<td width="5" valign="top" rowspan="3" height="81"></td>
			</tr>
			<tr>
				<td width="311" rowspan="2" valign="top" height="60">
<table cellspacing="0" cellpadding="0" width="100%" class="menusmall2">
<form method="post" id=form action="?mod=users&action=saveuser&subaction=editusers" >
				<tr>
					<td>&nbsp;Имя:</td>
					<td><input size=21 type=text name=newname_user value="<?=$dbname_user;?>" class="menusmall2"></td>
				</tr><tr>
					<td>&nbsp;Логин:</td>
					<td><input size=21 type=text name=newuserlogin value="<?=$db_username;?>" class="menusmall2"></td>
				</tr><tr>
					<td>&nbsp;Пароль:</td>
					<td><input size=21 type=password name=newpassword class="menusmall2"></td>
				</tr><tr>
					<td>&nbsp;Телефон:</td>
					<td><input size=21 type=text name=newphone_user value="<?=$dbphone_user;?>" class="menusmall2"></td>
				</tr><tr>
					<td>&nbsp;ICQ:</td>
					<td><input size=21 type=text name=newpicq_user value="<?=$dbpicq_user;?>" class="menusmall2"></td>
				</tr><tr>
					<td>&nbsp;E-mail:</td>
					<td><input size=21 type=text name=newemail_user value="<?=$dbemail_us;?>" class="menusmall2"></td>
				</tr><tr>
					<td>&nbsp;Статус:<?=$stat_us;?></td>
					<td>
					<select name=newstatus class="menusmall2"  value="<?=$dbstatus_us;?>" >
					<?if ($dbstatus_us == "1"){?>
							<option value="3">3 (Оператор)</option>
							<option  value="2">2 (Консультант)</option>
							<option selected value=1>1 (Администратор)</option>
							<?} else {?> <option selected value="3">3 (Оператор)</option>
										 <option value="2">2 (Консультант)</option>
										 <option value=1>1 (Администратор)</option>
							
						</select>
					<?}?>
									
					</td>
				</tr><tr>
					<td>&nbsp;</td>
					<td height="35"><input type=submit value=" Записать " id=button>
				<input type=hidden name=sid value=<?=$id;?>>
				<input type=hidden name=dbmd5_pass value=<?=$dbmd5_pass;?>>
				<input type=hidden name=editeduser>
					</td>
				</tr>
</form>
</table>
<?}}




if ($action="listing" && $mod=="users"){
?>



<table border="0" cellpading="2" cellspacing="2" width="654" >
	<tr>
	<td width="654" colspan="6">
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<?if ($dbstatus_us_l == "1"){?>
				
				<td valign="bottom" width="311" valign="top" height="1" class="menusmall2"><b>Добавить нового пользователя</b></td>
				<td width="5" valign="top" rowspan="3" height="81"></td>
			</tr>
			<tr>
				<td width="311" rowspan="2" valign="top" height="60">

<table cellspacing="0" cellpadding="0" width="100%" class="menusmall2">
<form method="post" id=form action="?mod=users&action=adduser&subaction=editusers" >
				<tr>
					<td>&nbsp;Имя:</td>
					<td><input size=21 type=text name=newname_user class="menusmall2"></td>
				</tr><tr>
					<td>&nbsp;Логин:</td>
					<td><input size=21 type=text name=newuserlogin class="menusmall2"></td>
				</tr><tr>
					<td>&nbsp;Пароль:</td>
					<td><input size=21 type=password name=newpassword class="menusmall2"></td>
				</tr><tr>
					<td>&nbsp;Телефон:</td>
					<td><input size=21 type=text name=newphone_user class="menusmall2"></td>
				</tr><tr>
					<td>&nbsp;ICQ:</td>
					<td><input size=21 type=text name=newpicq_user class="menusmall2"></td>
				</tr><tr>
					<td>&nbsp;E-mail:</td>
					<td><input size=21 type=text name=newemail_user class="menusmall2"></td>
				</tr><tr>
					<td>&nbsp;Статус:</td>
					<td><select name=newstatus class="menusmall2">
							<option value=3>3 (Оператор)</option>
							<option selected value=2>2 (Консультант)</option>
							<option value=1>1 (Администратор)</option>
						</select>
					</td>
				</tr><tr>
					<td>&nbsp;</td>
					<td height="35"><input type=submit value=" Добавить " id=button>
<input type=hidden name=addnewuser>
					</td>
				</tr>
				<?} else {?>
				<tr>
				<td></td>
				<td></td>
				</tr>
				<?}?>
</form>
</table><BR>
<FORM METHOD=POST ACTION="">
<TABLE cellspacing="3" cellpadding="0" width="700" class="menusmall2" >
	<TR>
		<TD bgcolor="#F7F6F4" width=225 height=21 align=center><B>Логин</B></TD>
		<TD bgcolor="#F7F6F4" width=250 height=21 align=center><B>Дата регистрации</B></TD>
		<TD bgcolor="#F7F6F4" width=225 height=21 align=center><B>Имя</B></TD>
		<TD bgcolor="#F7F6F4" width=250 height=21 align=center><B>Эл. Почта</B></TD>
		<TD bgcolor="#F7F6F4" width=250 height=21 align=center><B>Статус</B></TD>
		<TD bgcolor="#F7F6F4" width=250 height=21 align=center><B>Телефон</B></TD>
		<TD bgcolor="#F7F6F4" width=250 height=21 align=center><B>ICQ</B></TD>
		<TD bgcolor="#F7F6F4" width=250 height=21 align=center><B>Изменить</B></TD>
		<TD bgcolor="#F7F6F4" width=250 height=21 align=center><INPUT TYPE="checkbox"  name=master_box title="Отметить всех" onclick="javascript:ckeck_uncheck_all()"></TD>
	</TR>
<?

if ($dbstatus_us_l == "1"){//$db_username_
$sql = mysql_query("SELECT * FROM users");
}else {$sql = mysql_query("SELECT * FROM users where login='$login' ");}
while ($row = mysql_fetch_array($sql))	{
	$id=$row["users_id"];
	$db_username=$row["login"];
	$dbmd5_pass=$row["pass"];
	$dbname_user=$row["name_user"];
	$dbstatus_us=$row["status_us"];
	$dbemail_us=$row["email_us"];
	$dbphone_user=$row["phone_user"];
	$dbpicq_user=$row["icq_user"];
	$dbdate_us=$row["date_us"];
?>	

	<TR>
		<TD bgcolor="#F7F6F4" align=center><?=$db_username;?></TD>
		<TD bgcolor="#F7F6F4" align=center><?=$dbdate_us;?></TD>
		<TD bgcolor="#F7F6F4" align=center><?=$dbname_user;?></TD>
		<TD bgcolor="#F7F6F4" align=center><?=$dbemail_us;?></TD>
		<TD bgcolor="#F7F6F4" align=center><?=stat_us();?></TD>
		<TD bgcolor="#F7F6F4" align=center><?=$dbphone_user;?></TD>
		<TD bgcolor="#F7F6F4" align=center><?=$dbpicq_user;?></TD>
		<TD bgcolor="#F7F6F4" align=center><A class="menusmall2" HREF="?mod=edituser&action=edituser&idus=<?=$id;?>&subaction=editusers">Правка</A></TD>
		<TD bgcolor="#F7F6F4" align=center><INPUT TYPE="checkbox" name="box[]" value="<?=$id;?>"></TD>
	</TR>
	

<?	} ?>
</TABLE>
<BR>
<p align="right"><INPUT TYPE="submit" name="delete_check" value="Удалить отмеченные" id=button ></p>
</FORM>
<?
}


##################################################################

	function stat_us(){
	global $dbstatus_us;
	$stat_array=array("Администратор", "Консультант", "Оператор");
	if ($dbstatus_us=="1"){ echo $stat_array[0];}
	if ($dbstatus_us=="2"){ echo $stat_array[1];}
	if ($dbstatus_us=="3"){ echo $stat_array[2];}
	}
##################################################################
function err_msg($error_text){
			echo"$error_text";
			exit();
	}
?>