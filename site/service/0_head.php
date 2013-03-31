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

		<tr height="230px" id="mainmenucss" >
			<td valign = "top" background="images/logo_center.jpg" colspan="3">
				<ul>
				<li><a href="main.php" 		<? if ( strrpos ($host , "main.php"  ) 		) {echo 'class="active" ';}?> >главная	</a>&nbsp; </li>
				<li><a href="about.php" 	<? if ( strrpos ($host , "about.php" )  	) {echo 'class="active" ';}?> >о церкви	</a>&nbsp; </li>
				<li><a href="department.php"<? if ( strrpos ($host , "department.php")  ) {echo 'class="active" ';}?> >служения	</a>&nbsp; </li>
				<li><a href="pastor.php" 	<? if ( strrpos ($host , "pastor.php" )		) {echo 'class="active" ';}?> >пастор	</a>&nbsp; </li>
				<li><a href="media.php" 	<? if ( strrpos ($host , "media.php" ) 		) {echo 'class="active" ';}?> >медиа	</a>&nbsp; </li>
				<li><a href="contacts.php" 	<? if ( strrpos ($host , "contacts.php" )	) {echo 'class="active" ';}?> >контакты	</a>&nbsp; </li>
				</ul>		
			</td>
		</tr>

		<tr>
			<td height="6" colspan="3"></td>
		</tr>
