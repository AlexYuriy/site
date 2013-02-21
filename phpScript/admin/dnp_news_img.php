<html>
<head>
<title>Загрузка картинки в новости</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="../css/main.css" type="text/css">
<link rel="stylesheet" href="../css/admin.css" type="text/css">
</head>
<body style="margin: 10px;">
<?
include("config.inf");

if(!isset($go))
{
?>
<b>Внимание, корректно работает в Internet Explorer</b>
<hr>
<form action="<?=$PHP_SELF?>?go" method=post enctype=multipart/form-data>
<table cellpading=3 cellspacing=0 border=0 width=100%>
  <tr>
    <td width=20%>
      Картинка
    </td>
    <td width=80%>
      <input type=file name=image style="width: 100%;">
    </td>
  </tr>
  <tr>
    <td>
      Название
    </td>
    <td>
      <input type=text name=alt style="width: 100%;">
    </td>
  </tr>
  <tr>
    <td>
      Выровнять
    </td>
    <td>
      <input type=radio name=align value=none checked> нет |
      <input type=radio name=align value=left>left |
      <input type=radio name=align value=right>right |
      <input type=radio name=align value=middle>middle |
      <input type=radio name=align value=top> top |
    </td>
  </tr>
  <tr>
    <td>

    </td>
    <td>
      <input type=submit value="Закачать">
      <input type=hidden name=go value=herach>
    </td>
  </tr>
</table>
</form>
<?
}
elseif(isset($go))
{
   //проверка клевости файла
   if(!file_exists($image)){echo "Ошибка загрузки!!!"; exit;}
   if(isset($image) && ereg(".gif$",$image_name) || ereg(".jpg$",$image_name) || ereg(".jpeg$",$image_name)) $is_img="ok";
   if(isset($image) && $image !="" && $image !=" " && $image_size > 0) $is_file="ok";
   if(isset($image) && $image_size <= 30000) $is_size="ok";
   if(isset($alt) && $alt!="") $is_alt="ok";

   if(isset($is_img) && $is_img=="ok" && isset($is_file) && $is_file=="ok"
      && isset($is_size) && $is_size=="ok" && isset($is_alt) && $is_alt=="ok")
   {

      $alt=str_replace ('"', '', $alt);
      $alt=str_replace ('\'', '', $alt);

      $new_image_name = strtolower($image_name);

      function ruslat ($string) // Функция перекодировки кириллицы в транслит.
      {
       $string = ereg_replace("а","a",$string);
       $string = ereg_replace("б","b",$string);
       $string = ereg_replace("в","v",$string);
       $string = ereg_replace("г","g",$string);
       $string = ereg_replace("д","d",$string);
       $string = ereg_replace("е","e",$string);
       $string = ereg_replace("ё","e",$string);
       $string = ereg_replace("ж","zh",$string);
       $string = ereg_replace("з","z",$string);
       $string = ereg_replace("и","i",$string);
       $string = ereg_replace("й","iy",$string);
       $string = ereg_replace("к","k",$string);
       $string = ereg_replace("л","l",$string);
       $string = ereg_replace("м","m",$string);
       $string = ereg_replace("н","n",$string);
       $string = ereg_replace("о","o",$string);
       $string = ereg_replace("п","p",$string);
       $string = ereg_replace("р","r",$string);
       $string = ereg_replace("с","s",$string);
       $string = ereg_replace("т","t",$string);
       $string = ereg_replace("у","u",$string);
       $string = ereg_replace("ф","f",$string);
       $string = ereg_replace("х","h",$string);
       $string = ereg_replace("ц","ts",$string);
       $string = ereg_replace("ч","ch",$string);
       $string = ereg_replace("щ","sh",$string);
       $string = ereg_replace("ь","",$string);
       $string = ereg_replace("ъ","",$string);
       $string = ereg_replace("э","e",$string);
       $string = ereg_replace("ю","yu",$string);
       $string = ereg_replace("я","ya",$string);
       return $string;
      }


      if(ereg("[а-яА-Я]",$new_image_name)) {
      $new_image_name = ruslat($new_image_name);
      }


      //приделываем к имени файла случайное число
      mt_srand((double)microtime()*1000000);
      $uid=mt_rand(1,1000000);
      $imghuy = $uid."_".$new_image_name;

      $imgdir = $news_dir;
      if(!file_exists($image)){echo "Ошибка копирования!!!"; exit;}
      Copy($image,$imgdir.$imghuy);


      echo "Файл загружен<br>можно закрыть это окно!!!<br>";
      ?>
      <script language="JavaScript">
        opener.document.formata.content.focus();
        sel = opener.document.selection.createRange();
        sel.text= "<img src='news/admin/<?=$imgdir.$imghuy?>'<?
        if(isset($align) && $align!="none")
        {
         echo " align=".$align;
        }
        ?> alt='<? echo $alt; ?>'>";
        window.close();
      </script>
      <?
      echo "<input type=button value=\"закрыть\" onClick=\"window.close();\">";
   }
   else
   {
    echo "<font color=red>Ошибка загрузки файла картинки!!!</font>";
     echo "<br><ul>";
      if(!isset($is_img)  || $is_img!="ok" ){echo "<li>Файл картинки может быть только <b>gif, jpg, jpeg</b>!</li>";}
      if(!isset($is_file) || $is_file!="ok"){echo "<li>Вы не выбрали файл для загрузки!</li>";}
      if(!isset($is_size) || $is_size!="ok"){echo "<li>Размер файла картинки не может быть больше <b>30 Килобайт</b>!</li>";}
      if(!isset($is_alt)  || $is_alt!="ok" ){echo "<li>Не заполнено поле \"Название\" для файла картинки!</li>";}
      echo "</ul><hr size=1 color=black noshade></a><a href=javascript:history.back(2) class=menu><< Попробуйте еще раз.</a>";

   }
}
?>
</body>
</html>