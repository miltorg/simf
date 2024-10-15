<?php
?><!DOCTYPE html>
<html>
<head>
  
  <title>Заказы</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<style>
  

  
</style>

</head>

<body>
<?php



// Это рабочий поиск

$reg2 = '/is now ready/ui'; // Полное регулярное выражение вместе с ограничителями для поиска внутри файла
$reg = '/.*/'; // Полное регулярное выражение вместе с ограничителями для файлов и папок
$path = '.';

$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

foreach ($rii as $k=>$f) {
      
  if($f->getFilename()!='..') {
        
    if($f->getFilename()=='.' and preg_match($reg, $f)) ;//print $f."\n"; // Если папка
    elseif(preg_match($reg, $f->getFilename())) {
      //print $f."\n";
      
      if ($fp = @fopen($f, "r")) {

        $i=0;
        while (($b = fgets($fp, 10000)) !== false) {
          ++$i;
          if(preg_match($reg2, $b)) echo "$reg2 найдено в $i строке файла $f <br>\n";
        }
            
        if (!feof($fp)) echo "Ошибка: fgets() неожиданно потерпел неудачу\n";
        fclose($fp);
      }   
    }
  }
}
print '</body></html>';
