<?php

// Last update 20 July 2021

$extensionList["dynamic-mirador"] = "extensionDynamicMirador";

// Expecting GET Variables in the form of
/* Array
(
    [root] => /md-dev/
    [display] => home
    [extra] => 1234 (search term)
)
* converted into the following GLOBALS:

$rootDisplayURL = $_GET["root"].$_GET["display"];
$getExtra = explode("/", $_GET["extra"]);

Uses Mirador Version 3

* a config json file can be sued to set:

 	"search-uri": "REQUIRED: The full search URI which only requires a search term to be added to the end, such as https://example.com/api.php?search=",
	"limit": 50, // optional extra limit number that can be added to the search uri if needed
	"forceFullSearch": false //extra optional value to force or select different search options.

The search uri needs to be set up to return a json document including an array of terms
* 
		"limit": "numerical value of any liimit applied,
		"limited": "true is the search results are limited,
		"comment": "short comment that fits into the help text", // Results of "COMMENT TEXT" search for:"
		"total": "total number of matches,
		"manifests": a simple list of manifest and or collections to be added to Mirador.
		);
*/

function extensionDynamicMirador ($d, $pd)
  {
	global $extraHTML, $navExtra, $rootDisplayURL, $getExtra;

	$workspace = false;
  $mans = '[]';
	$wo = '';
	$codeHTML = "";
	$codecaption = "";
	$cats = "";
	$note = "		<div class=\"container-fluid\"><div class=\"row\"><div class=\"col-12\">";
	
	$pd["navExtra"] = '
	<ul class="navbar-nav justify-content-end w-100" style="padding-right:10px;"><li>
		'.buildSearchForm ("submit").'</li></ul>';
	
	$limit = 25;
	$force = false;
		
	if (isset($d["file"]) and file_exists($d["file"]))
		{$config = getRemoteJsonDetails($d["file"], false, true);
		 if (isset($config["limit"]) and $config["limit"])
			{$limit = intval($config["limit"]);}
		 if (isset($config["forceFullSearch"]) and $config["forceFullSearch"])
			{$force = true;}
		 }
	else
		{$config = array("search-uri" => "");}
  	 
  if ($getExtra[0] and $config["search-uri"])
		{
		if (isset($getExtra[1]) and intval($getExtra[1]) > 0)
			{$limit = intval($getExtra[1]);}
			
		if (isset($getExtra[2]) and $getExtra[2]) //Skip Accession number only search
			{$force = true;}
	
		$extraTerms = "&limit=$limit&forceFullSearch=$force";		
		$dets = getExternalDetails($getExtra[0], $config["search-uri"], $extraTerms);

		$cats = buildCatalog ($dets["manifests"]);
				
		$note .= "Results of ".$dets["comment"]." search for: <b>".$getExtra[0]."</b>";
		if ($dets["limited"])
			{$note .= " - Please note your search has been limited, displaying <b>$dets[limit]</b> of <b>$dets[total]</b> paintings.</div></div>";}
		else if (!$dets["total"])
			{$note .= "</div></div>".buildSearchForm ("submit-extra", "Sorry, no results have been found for your search, please try again.");}
		else
			{$note .= "</div></div>";}
		}
	else
		{$note .= "</div></div>".buildSearchForm ("submit-extra", "Below is an empty instance of <a href=\"https://projectmirador.org/\">Mirdaor V3</a> - you can add <a href=\"https://iiif.io\">IIIF</a> Manifest or Collections in directly using the <b>Add Resource</b> option or new images can be loaded in automatically by running a simple search.");
		 $cats = '"catalog": []';}

	$pd["extra_css"] .= ".fixed-top {z-index:1111;}";
	
	$pd["extra_js_scripts"][] = "https://cdn.jsdelivr.net/npm/mirador@3.2.0/dist/mirador.min.js\" integrity=\"sha256-e11UQD1U7ifc8OK9X0rVMshTXSKl7MafRxi3PTwXDHs=\" crossorigin=\"anonymous";

	ob_start();			
	echo <<<END
	
	var submits = document.getElementsByClassName('searchsubmit');
	for (var i=0, len=submits.length|0; i<len; i=i+1|0) {
	  submits[i].addEventListener("click", formatSearchGet);}
	
	function formatSearchGet(e) {
		e.preventDefault();
		const svalue = document.getElementById(e.target.id+"-search");
		var vars = [];
		var pname = window.location.pathname
		var parts = pname.replace(/([\/])([^\/]+)/gi, function(m,key,value) {
			vars.push(value);});
		var new_url = "$rootDisplayURL" + "/" + svalue.value;
		window.location.href = new_url;
		}

	$(function() {
var myMiradorInstance = Mirador.viewer({
       id: "mirador",
       "workspace": {
				"isWorkspaceAddVisible": true},     
       $cats
       });     
     });
END;
	$pd["extra_js"] .= ob_get_contents();
	ob_end_clean(); // Don't send output to client
	
	if ($note)
		{$note = '<div class="alert alert-warning" role="alert">'.$note.'</div>';}
	
	$d = positionExtraContent ($d, '	
		'.$note.'</div>
		<div class="row justify-content-center flex-grow-1">
			<div class="h-100" style="position:relative;min-height:400px;" id="mirador">
			</div>
		</div>'.$codeHTML);

  return (array("d" => $d, "pd" => $pd));
  }

function buildCatalog ($mans)
			{
			$cats = array();
			
			foreach ($mans as $k => $m)
				{$cats[] = '{"manifestId": "'.$m.'"}';}
			
			$catalog = '
			"catalog": [
				'.implode(',
				', $cats).'
				]';
				
			return($catalog);
			}
			
function buildSearchForm ($id="submit", $comment=false)
	{
	if ($comment)
		{$comment = "<div class=\"col-lg-8 col-md-6 col-sm-12  col-xs-12\">".
			"$comment</div>";
		 $dclass = "col-lg-4 col-md-6 col-sm-12  col-xs-12";}
	else
		{$dclass = "col-12";}
			
	ob_start();
	echo <<<END
			<div class="row">
				$comment
				<div class="$dclass">
					<form class="d-flex float-end">
						<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="'.$id.'-search" name="'.$id.'-search">
						<button class="btn btn-outline-success searchsubmit" id="'.$id.'">Search</button>
					</form>
				</div>
			</div>

		
END;
	$searchform = ob_get_contents();
	ob_end_clean(); // Don't send output to client
			
	return ($searchform);
	}

function getsslJSONfile ($uri, $decode=true)
	{
	$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,),);  

	$response = file_get_contents($uri, false, stream_context_create($arrContextOptions));
	
	if ($decode)
		{return (json_decode($response, true));}
	else
		{return ($response);}
	}
	
function getExternalDetails($searchterm, $uri="https://scientific.ng-london.org.uk/tools/md/api.php?search=", $extra="")
	{$uri = $uri.$searchterm.$extra;
	 $arr = getsslJSONfile($uri);
	 return($arr);}

?>
