<html>
<head>
<title>Предварительный просмотр</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?
 $dura1=$SERVER_NAME.$REQUEST_URI; 
 $base_dir = str_replace("admin/hot_view.php", "", $dura1);
 //phpinfo();
 echo "<base href=\"".$base_dir."\">\n";
?>
<link rel="stylesheet" href="../css/main.css" type="text/css">
</head>
<body bgcolor="#FFFFFF" style="margin: 10px;">
<hr style="height: 3px;">

<center><input type=button value="Закрыть окно" onclick="window.close();"></center>

<hr style="height: 3px;">
<p class=jcontent>

 <script language="JavaScript">
    var sel;
    sel = opener.document.formata.content.value;
    document.write(sel);
 </script>

</p>
</body>
</html>