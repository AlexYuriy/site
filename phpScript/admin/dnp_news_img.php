<html>
<head>
<title>�������� �������� � �������</title>
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
<b>��������, ��������� �������� � Internet Explorer</b>
<hr>
<form action="<?=$PHP_SELF?>?go" method=post enctype=multipart/form-data>
<table cellpading=3 cellspacing=0 border=0 width=100%>
  <tr>
    <td width=20%>
      ��������
    </td>
    <td width=80%>
      <input type=file name=image style="width: 100%;">
    </td>
  </tr>
  <tr>
    <td>
      ��������
    </td>
    <td>
      <input type=text name=alt style="width: 100%;">
    </td>
  </tr>
  <tr>
    <td>
      ���������
    </td>
    <td>
      <input type=radio name=align value=none checked> ��� |
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
      <input type=submit value="��������">
      <input type=hidden name=go value=herach>
    </td>
  </tr>
</table>
</form>
<?
}
elseif(isset($go))
{
   //�������� �������� �����
   if(!file_exists($image)){echo "������ ��������!!!"; exit;}
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

      function ruslat ($string) // ������� ������������� ��������� � ��������.
      {
       $string = ereg_replace("�","a",$string);
       $string = ereg_replace("�","b",$string);
       $string = ereg_replace("�","v",$string);
       $string = ereg_replace("�","g",$string);
       $string = ereg_replace("�","d",$string);
       $string = ereg_replace("�","e",$string);
       $string = ereg_replace("�","e",$string);
       $string = ereg_replace("�","zh",$string);
       $string = ereg_replace("�","z",$string);
       $string = ereg_replace("�","i",$string);
       $string = ereg_replace("�","iy",$string);
       $string = ereg_replace("�","k",$string);
       $string = ereg_replace("�","l",$string);
       $string = ereg_replace("�","m",$string);
       $string = ereg_replace("�","n",$string);
       $string = ereg_replace("�","o",$string);
       $string = ereg_replace("�","p",$string);
       $string = ereg_replace("�","r",$string);
       $string = ereg_replace("�","s",$string);
       $string = ereg_replace("�","t",$string);
       $string = ereg_replace("�","u",$string);
       $string = ereg_replace("�","f",$string);
       $string = ereg_replace("�","h",$string);
       $string = ereg_replace("�","ts",$string);
       $string = ereg_replace("�","ch",$string);
       $string = ereg_replace("�","sh",$string);
       $string = ereg_replace("�","",$string);
       $string = ereg_replace("�","",$string);
       $string = ereg_replace("�","e",$string);
       $string = ereg_replace("�","yu",$string);
       $string = ereg_replace("�","ya",$string);
       return $string;
      }


      if(ereg("[�-��-�]",$new_image_name)) {
      $new_image_name = ruslat($new_image_name);
      }


      //����������� � ����� ����� ��������� �����
      mt_srand((double)microtime()*1000000);
      $uid=mt_rand(1,1000000);
      $imghuy = $uid."_".$new_image_name;

      $imgdir = $news_dir;
      if(!file_exists($image)){echo "������ �����������!!!"; exit;}
      Copy($image,$imgdir.$imghuy);


      echo "���� ��������<br>����� ������� ��� ����!!!<br>";
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
      echo "<input type=button value=\"�������\" onClick=\"window.close();\">";
   }
   else
   {
    echo "<font color=red>������ �������� ����� ��������!!!</font>";
     echo "<br><ul>";
      if(!isset($is_img)  || $is_img!="ok" ){echo "<li>���� �������� ����� ���� ������ <b>gif, jpg, jpeg</b>!</li>";}
      if(!isset($is_file) || $is_file!="ok"){echo "<li>�� �� ������� ���� ��� ��������!</li>";}
      if(!isset($is_size) || $is_size!="ok"){echo "<li>������ ����� �������� �� ����� ���� ������ <b>30 ��������</b>!</li>";}
      if(!isset($is_alt)  || $is_alt!="ok" ){echo "<li>�� ��������� ���� \"��������\" ��� ����� ��������!</li>";}
      echo "</ul><hr size=1 color=black noshade></a><a href=javascript:history.back(2) class=menu><< ���������� ��� ���.</a>";

   }
}
?>
</body>
</html>