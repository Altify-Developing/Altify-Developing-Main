<?php

@system("clear");
$blue="\033[1;34m";
$cyan="\033[1;36m";
$okegreen="\033[92m";
$lightgreen="\033[1;32m";
$white="\033[1;37m";
$purple="\033[1;35m";
$red="\033[1;31m";
$yellow="\033[1;33m";

print "\n";
print "$red //$white Don't be$yellow Capitalism\n";
print "$white    We listen$okegreen Musics$white without$red Ads\n";
print "\n";
print "$yellow ->$white Let's generate some$okegreen Spotify Premium$white Account\n";
print "\n";
print "$okegreen ??$white Total : ";
$jumlah = trim(fgets(STDIN));
print "\n";
print "$red //$white Generating $jumlah Account\n";
print "\n";
$result = file_get_contents('http://n1ghthax0r.000webhostapp.com/api/spotify/?jumlah='.$jumlah);
$json = json_decode($result, true);
foreach ((array) $json as $row){
    $country = $row['Country'];
    $type = $row['Account Type'];
    $email = $row['Email'];
    $pass = $row['Password'];
    $exp = $row['Expired'];
    print "$okegreen **$white Type    : $type\n";
    print "$okegreen **$white Email   : $email\n";
    print "$okegreen **$white Pass    : $pass\n";
    print "$okegreen **$white Country : $country \n";
    if ($exp == ''){
        print "\n";
    }
    else{
        print "$okegreen **$white Expired : $exp\n";
        print "\n";
    }
}
