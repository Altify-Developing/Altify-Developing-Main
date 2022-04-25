<?php
$file = fopen("./ip/ip.txt","a");
$ip_address1 = $_SERVER['HTTP_CLIENT_IP'];
$ip_address2 = $_SERVER['HTTP_X_FORWARDED_FOR'];
$ip_address3 = $_SERVER['REMOTE_ADDR'];
echo $ip_address1;
echo $ip_address2;
echo $ip_address3;
echo fwrite($file,$ip_address1);
echo fwrite($file,$ip_address2);
echo fwrite($file,$ip_address3);
fclose($file);
?>
