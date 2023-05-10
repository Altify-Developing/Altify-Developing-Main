<?php

// mysql settings
$mysql_host = "localhost";
$mysql_user = "root";
$mysql_pass = "";
$mysql_database = "pony";

$global_directory_slash = DIRECTORY_SEPARATOR;
$global_temporary_directory = "temp";

// debug settings
$global_verbose_log = false; // improved verbose log, use for debugging only!
$global_allow_all_ftp = false; // disable filtering, set 'true' for testing purposes only!

$global_filter_list = array(
    "127.0.0.1",
    "192.168.",
    "localhost",
    "nonymous",
    "bitshare.com",
    "depositfiles.com",
    "filesonic.com",
    "gigapeta.com",
    "hotfile.com",
    "ifolder.ru",
    "letitbit.net",
    "sms4file.com",
    "turbobit.ru",
    "uploadbox.com",
    "vip-file.com",
    "wupload.com",
);

// accept connections from white-list IPs only
$white_list = array(
	// add at least one IP to enable white-list mode
	//"127.0.0.1",
);

date_default_timezone_set('Europe/Moscow');
$enable_http_mode = true;
$show_help_to_users = true;
$show_http_to_users = true;
$show_logons_to_users = true;
$disable_ip_logger = false;
$enable_email_mode = true;
$show_email_to_users = true;
$show_other_to_users = true;
