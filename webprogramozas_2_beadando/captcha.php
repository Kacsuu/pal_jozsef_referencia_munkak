<?php
session_start();

header("Content-type: image/jpeg");
$im=imagecreatetruecolor(150,40);
$feher=imagecolorallocate($im,255,255,255);
$fekete=imagecolorallocate($im,0,0,0);
$szurke=imagecolorallocate($im,125,125,125);
$chars="abcdefghijklmnopqrstuxyz123456789";
$str="";
for ($i=0;$i<6;$i++){
    $rand=rand(0,strlen($chars)-1);
    $str.=$chars[$rand];
}
$_SESSION["mycaptcha"]=$str;
imagefill($im,0,0,$feher);
imagettftext($im,20,0,12,32,$szurke,"c:/windows/fonts/arial.ttf",$str);
imagettftext($im,20,0,9,30,$fekete,"c:/windows/fonts/arial.ttf",$str);
imagejpeg($im);
?>