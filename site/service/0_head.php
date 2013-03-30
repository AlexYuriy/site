<? 
$host = $_SERVER[SCRIPT_NAME];
?>
		<tr height= "190px" id="topmenucss" >
				<td  background="images/logo_top.jpg" colspan = "3"  valign = "bottom" >
				<a href="main.php"><img src="images/transparent.png" height="150" width="450" border="0"></a>
				 &nbsp; 
				<div align="right">
					<a href="video.php">прямая трансляция </a>
					&nbsp; | &nbsp; 				
					<a href=" fghfghfg"> english </a>
					&nbsp; 
				</div>
			</td>
		</tr>

		<tr height="230px" >
			<td valign = "top" background="images/logo_center.jpg" colspan="3" class="mainmenucss" >
				<ul>
				<li <? if ( strrpos ($host , "main.php"  	)  === false) {} else { ?> id="active" <?} ?> ><a href="main.php">главная</a>&nbsp;
				<li <? if ( strrpos ($host , "about.php"  	)  === false) {} else { ?> id="active" <?} ?> ><a href="about.php">о церкви</a>&nbsp;
				<li <? if ( strrpos ($host , "department.php")  === false) {} else { ?> id="active" <?} ?>  ><a href="department.php">служения</a>&nbsp;
				<li <? if ( strrpos ($host , "pastor.php"  	)  === false) {} else { ?> id="active" <?} ?>  ><a href="pastor.php">пастор</a>&nbsp;
				<li <? if ( strrpos ($host , "media.php"  	)  === false) {} else { ?> id="active" <?} ?>  ><a href="media.php">медиа</a>&nbsp;
				<li <? if ( strrpos ($host , "contacts.php"  )  === false) {} else { ?> id="active" <?} ?>  ><a href="contacts.php">контакты</a>&nbsp;
				</ul>		
			</td>
		</tr>

		<tr>
			<td height="6" colspan="3"></td>
		</tr>
