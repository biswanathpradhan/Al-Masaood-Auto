<?php
 // echo $_SERVER['DOCUMENT_ROOT'];
// 
  // $url = $_SERVER['DOCUMENT_ROOT'];
// $url2 = substr($_SERVER['DOCUMENT_ROOT'], 0, strrpos( $_SERVER['DOCUMENT_ROOT'], '/public'));
// echo $_SERVER['DOCUMENT_ROOT']."hii".$url2;

// $pieces = explode('/', $_SERVER['DOCUMENT_ROOT']);

// Glue the pieces back together, excluding the last item
 // $str = implode('/', array_slice($pieces, 0, -1));
// var_dump($str);

//echo $str; // '/me/you/them'


// var_dump(parse_url($url));



// exit();
// $targetFolder = $_SERVER['DOCUMENT_ROOT'].'/storage/app/public/images/interior';
// $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage/images/interior';
// $symlync = symlink($targetFolder,$linkFolder);
// echo 'Symlink process successfully completed'.'----'.$symlync;

$targetFolder = 'C:/Inetpub/vhosts/markacommunications.com/amaauto.markacommunications.com/storage/app/public/images/interior';
$linkFolder = 'C:/Inetpub/vhosts/markacommunications.com/amaauto.markacommunications.com/public/storage/images/interior';
$symlync = symlink($targetFolder,$linkFolder);
echo 'Symlink process successfully completed'.'----'.$symlync;
?>