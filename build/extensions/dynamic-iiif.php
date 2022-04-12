<?php

// Last update 7 Sept 2021

$extensionList["dynamic-iiif"] = "extensionDynamicIIIF";

// Expecting GET Variables in the form of
/* Array
(
    [root] => /ss-iiif/
    [display] => home
    [viewer] => mirador (or seadragon)
    [extra] => 1234 (search term)
)
* converted into the following GLOBALS:

$rootDisplayURL = $_GET["root"].$_GET["display"];
$getExtra = explode("/", $_GET["extra"]);

Uses Mirador Version 3
Or OpenSeadragon version 2.4.2 

* a config json file can be used to set:

 	"search-uri": "REQUIRED: The full search URI which only requires a search term to be added to the end, such as https://example.com/api.php?search=",
	"limit": 50, // optional extra limit number that can be added to the search uri if needed

The search uri needs to be set up to return a json document including an array of results
* 
		"limit": "numerical value of any limit applied,
		"from": "and offset to apply to which limited results are returned",
		"limited": "true is the search results are limited,
		"total": "the total number of search matches",
		"search": "the search term that was used",
		###"what": "what has been returned: manifest or json.info files"
		"results": a simple list of manifests or info.json urls.
		"comment": "short comment that fits into the help text", // Results of "COMMENT TEXT" search for:"

NEED Notes on formatting of Manifest or Infor.josn list
*/

$bd = 32;
$buttons = array(
	"info" => '
	<button title="Further Information" type="button" style="margin-right:0px;padding:0px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#infoModal">
		<svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 161 161" width="'.$bd.'" height="'.$bd.'">
			<g fill="#eeeeee">
				<path d="m80 15c-35.88 0-65 29.12-65 65s29.12 65 65 65 65-29.12 65-65-29.12-65-65-65zm0 10c30.36 0 55 24.64 55 55s-24.64 55-55 55-55-24.64-55-55 24.64-55 55-55z"/>
				<path d="m57.373 18.231a9.3834 9.1153 0 1 1 -18.767 0 9.3834 9.1153 0 1 1 18.767 0z" transform="matrix(1.1989 0 0 1.2342 21.214 28.75)"/>
				<path d="m90.665 110.96c-0.069 2.73 1.211 3.5 4.327 3.82l5.008 0.1v5.12h-39.073v-5.12l5.503-0.1c3.291-0.1 4.082-1.38 4.327-3.82v-30.813c0.035-4.879-6.296-4.113-10.757-3.968v-5.074l30.665-1.105"/>
			</g>
		</svg>
	</button>
	',
	"list" => '
	<button title="List the included images" type="button" style="margin-right:0px;padding:0px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#listModal">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="'.$bd.'" height="'.$bd.'">
			<g fill="#eeeeee">
				<path d="M6 26h4v-4h-4v4zm0 8h4v-4h-4v4zm0-16h4v-4h-4v4zm8 8h28v-4h-28v4zm0 8h28v-4h-28v4zm0-20v4h28v-4h-28z"/>
				<path d="M0 0h48v48h-48z" fill="none"/>
			</g>
		</svg>
	</button>',
	"search" => '
	<button title="Open the simple search form" type="button" style="margin-right:0px;padding:0px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#searchModal">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 55 55" width="'.$bd.'" height="'.$bd.'">
			<g id="XMLID_13_" transform="translate(-25.461,-22.738)" fill="#eeeeee">
								<path d="M 69.902,72.704 58.967,61.769 c -2.997,1.961 -6.579,3.111 -10.444,3.111 -10.539,0 -19.062,-8.542 -19.062,-19.081 0,-10.519 8.522,-19.061 19.062,-19.061 10.521,0 19.06,8.542 19.06,19.061 0,3.679 -1.036,7.107 -2.828,10.011 l 11.013,11.011 c 0.583,0.567 0.094,1.981 -1.076,3.148 l -1.64,1.644 c -1.17,1.167 -2.584,1.656 -3.15,1.091 z M 61.249,45.799 c 0,-7.033 -5.695,-12.727 -12.727,-12.727 -7.033,0 -12.745,5.694 -12.745,12.727 0,7.033 5.712,12.745 12.745,12.745 7.032,0 12.727,-5.711 12.727,-12.745 z"
								id="path9"/></g></svg>
	</button>',
	"toggleM" => '
	<button title="Switch to the Mirador Viewer" id="toggleM" onclick="toggleViewer();" type="button" style="margin-right:0px;padding:0px;display:none;" class="btn btn-primary">
		<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="'.$bd.'" height="'.$bd.'" viewBox="0 0 64 64">
			<g transform="translate(0.000000,64.000000) scale(0.100000,-0.100000)"fill="#eeeeee" stroke="none">
				<path d="M20 325 l0 -275 90 0 90 0 0 275 0 275 -90 0 -90 0 0 -275z"/>
				<path d="M230 430 l0 -170 90 0 90 0 0 170 0 170 -90 0 -90 0 0 -170z"/>
				<path d="M440 325 l0 -275 90 0 90 0 0 275 0 275 -90 0 -90 0 0 -275z"/>
			</g>
		</svg>
	</button>',
	"toggleO" => '
	<button title="Switch to the OpenSeadragon Viewer" id="toggleO"  onclick="toggleViewer();" type="button" style="margin-right:0px;padding:0px;display:none;" class="btn btn-primary">
		<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="'.$bd.'" height="'.$bd.'" viewBox="0 0 103 103">
			<g transform="translate(0.000000,103.000000) scale(0.100000,-0.100000)" fill="#eeeeee" stroke="none">
				<path d="M440 884 c-81 -156 -79 -147 -43 -140 19 5 34 2 40 -6 6 -7 14 -58 17 -113 11 -170 0 -152 135 -223 65 -34 123 -62 128 -62 10 0 233 418 233 436 0 9 -421 234 -437 234 -4 0 -37 -57 -73 -126z"/>
				<path d="M238 716 c-75 -6 -138 -13 -141 -16 -3 -4 17 -295 23 -327 0 -2 18 -3 41 -3 31 0 51 8 79 30 46 36 55 37 83 7 19 -21 29 -23 76 -19 l54 4 -7 117 c-4 64 -9 140 -13 169 -5 48 -8 52 -32 51 -14 -1 -88 -7 -163 -13z"/>
				<path d="M200 345 c-41 -35 -74 -69 -72 -76 4 -16 121 -159 130 -159 16 1 50 36 54 55 2 13 12 21 29 23 14 2 40 15 58 30 l32 27 -66 80 c-36 44 -71 81 -78 82 -6 1 -46 -27 -87 -62z"/>
				<path d="M330 100 l0 -70 75 0 75 0 0 70 0 70 -75 0 -75 0 0 -70z"/>
			</g>
		</svg>
	</button>'

	);
	
function extensionDynamicIIIF ($d, $pd)
  {
	global $extraHTML, $navExtra, $rootDisplayURL, $getExtra;
	
	if (isset($pd["licence"])) {$pd["licence"] = "<a href='http://rightsstatements.org/vocab/InC/1.0/'><img style='background-color:#318ac7;padding:2px;' height='24' alt='In Copyright - Please check the terms and conditions with the image providers' title='Assumed in Copyright - Please check the terms and conditions with the image providers' src='https://rightsstatements.org/files/buttons/InC.white.svg'/></a>";}
	if (isset($pd["footer"])) {$pd["footer"] = "";}
	
	// This is done to maximise the space for the viewer
	$d = convertContenttoInfo ($d);
	
	$pd["extra_css"] .= '
		.modal {z-index: 1112;}
		.fixed-top {z-index:1111;}
	';
	
	$note = "<div class=\"container-fluid\" style=\"padding-top:0px;\">";
	$maxlimit = 100;
	$limit = 25;
	$from = "";
	$page = 1;
	$morejs = false;
	$imagelist = false;
	$returnsBlocked = false;
	$sterm = false;
	$stermForm = false;
	
	if (is_array($d["file"]))
		{$config = $d["file"];}
	else if (isset($d["file"]) and file_exists($d["file"]))
		{$config = getRemoteJsonDetails($d["file"], false, true);
		 if (isset($config["limit"]) and $config["limit"])
			{$limit = intval($config["limit"]);}}
	else
		{$config = array("search-uri" => "");}
	
	$mans = '[]';
	$cats = "";
	$tileSources = "[]";
	$defaultStr = "Please click on the <b>search</b> icon to find IIIF resources. You can be view results in either <a href=\"https://openseadragon.github.io/\">OpenSeadragon</a> or <a href=\"https://projectmirador.org/\">Mirdaor V3</a>, toggling between the two using the <b>viewer switch</b> button next tot he search button.";
	
	if (isset($config["viewer"]) and $config["viewer"] == "mirador")
		{$displayviewer = "m";}
	else
		{$displayviewer = "osd";}
			   
  if ($getExtra[0] and $config["search-uri"])
		{
		if (isset($getExtra[1]) and intval($getExtra[1]) > 0)
			{$limit = intval($getExtra[1]);
			 if ($limit > $maxlimit) {$limit = $maxlimit;}}
			
		if (isset($getExtra[2]) and intval($getExtra[2]) > 0)
			{
			// Some APIs are limited to returning 10000 resources
			 if ((intval($getExtra[2]) * $limit) > 10000)
				{$getExtra[2] = floor(10000/$limit);
				 $returnsBlocked = true;}
				
			 $from = (intval($getExtra[2]) - 1) * $limit;			 			
			 if ($from > 0) {$from = "&from=".$from;
				 $page=intval($getExtra[2]);}
			 else {$from = "";$page=1;}}
		
		if (isset($getExtra[3]) and $getExtra[3] == "m")
			{$displayviewer = "m";}
		else if (isset($getExtra[3]))
			{$displayviewer = "osd";}		
		
		$extraTerms = "&limit=$limit".$from;
		$pageURI = "$rootDisplayURL/$getExtra[0]/$limit/";
		$sterm =	"?search=".rawurlencode($getExtra[0]);
		$stermForm =	htmlspecialchars($getExtra[0]);
		$epts = 1;
		
		if (!is_array($config["search-uri"])) {
			$config["search-uri"] = array($config["search-uri"]);}
		
		}
	else
		{$config["search-uri"] = array();
		$extraTerms = "";
		$pageURI = "$rootDisplayURL";
		$sterm =	"?search=";
		$stermForm =	false;}
		
	$epts = count($config["search-uri"]);
		
	$dets = array(		
		"limit" => $limit * $epts,
		"from" => 0, 
		"limited" => false,
		"total" => false,
		"search" => $sterm,
		"results" => array("info"=>array(),"manifests"=>array()),
		"comment" => array(),
		"missed" => 0, // used for debugging, when end-points return objects with no IIIF resources
		"objects" => 0, // things searched for, limited by the $limit value
		"resources" => 0, // IIIF resources related to the things returned
		"altIDs" => array() // Used for individual searches if image id fails
		);
			
	if ($epts > 1)
		{$dets["comment"][] = "Images drawn from a combination of sites.";}
		
	$maxPages = 1;
	$maxTotal = 0;
		
	$debug = "";
		
	$range = array(0,0);
			
	foreach ($config["search-uri"] as $k => $uri)
		{
		$trange = array(0,0);
		// need a temp $dets and combine the results
		$tdets = getExternalDetails($sterm, $uri, $extraTerms);
		if (!isset($tdets["altIDs"])) {$tdets["altIDs"] = array();}

		if ($tdets["limited"]) {$dets["limited"] = true;}
			
		$dets["resources"] +=	count($tdets["results"]["info"]);
		if ($tdets["total"] > $maxTotal) {$maxTotal = $tdets["total"];}
		$dets["total"] += $tdets["total"];
		$dets["results"]["info"] = array_merge($dets["results"]["info"], $tdets["results"]["info"]);
		$dets["results"]["manifests"] = array_merge($dets["results"]["manifests"], $tdets["results"]["manifests"]);
		
		$dets["altIDs"] = array_merge($dets["altIDs"], $tdets["altIDs"]);
				
		if (($tdets["total"] - $tdets["from"]) > $tdets["limit"])
			{
			// Full return
			$trange[0] = $tdets["from"];
			$trange[1] = $tdets["from"] + $tdets["limit"];
			$tnote = " <span style=\"color: #0d6efd;\"> Displaying resources from ". implode(" - ", $trange) ." of ".$tdets["total"]. " objects.</span>";
			$range[0] += $trange[0];
			$range[1] += $trange[1];
			$dets["objects"] += $tdets["limit"];				
			}
		else if (($tdets["total"] - $tdets["from"]) > 0)
			{
			// A few left
			$trange[0] = $tdets["from"];
			$trange[1] = $tdets["total"];
			$tnote = " <span style=\"color: #0d6efd;\"> Displaying resources from ". implode(" - ", $trange) ." of ".$tdets["total"]. " objects.</span>";
			$range[0] += $trange[0];
			$range[1] += $trange[1];
			$dets["objects"] += $tdets["total"] - $tdets["from"];}
		else
			{
			// All finished - can occur in combination presentations
			$range[0] += $tdets["total"];
			$range[1] += $tdets["total"];
			if ($tdets["total"] > 0)
				{$tnote = " <span style=\"color: red;\"> Displaying no resources from ".$tdets["total"]. " objects, all objects already returned.</span>";}
			else
				{$tnote = " <span style=\"color: red;\"> No objects returned for this search.</span>";}
			}
			
		$dets["comment"][] = $tdets["comment"] .$tnote;
		}

	$maxPages = ceil($maxTotal/$limit);

	$pd["extra_js_scripts"][] = "https://cdn.jsdelivr.net/npm/mirador@3.2.0/dist/mirador.min.js\" integrity=\"sha256-e11UQD1U7ifc8OK9X0rVMshTXSKl7MafRxi3PTwXDHs=\" crossorigin=\"anonymous";
	$pd["extra_js_scripts"][] = "https://cdn.jsdelivr.net/npm/openseadragon@2.4.2/build/openseadragon/openseadragon.min.js\" integrity=\"sha256-NMxPj6Qf1CWCzNQfKoFU8Jx18ToY4OWgnUO1cJWTWuw=\" crossorigin=\"anonymous";		
	
	$extramorejs = "";
		 
	if ($displayviewer == "m")
		{$displayOSD = "display:none;";
		 $displayM = "display:block;";
		 $extramorejs .= "var defaultViewer=\"m\";";}
	else
		{$displayOSD = "display:block;";
		 $displayM = "display:none;";
		 $extramorejs .= "var defaultViewer=\"osd\";";}
	
	// Mirador resources
	if ($dets["results"]["manifests"]) {
		$cats = MD_buildCatalog ($dets["results"]["manifests"]);}
	else
		{$displayM = "display:none;";}
	
	$list = false;
	// OpenSeaDragon related resources
	if ($dets["results"]["info"]) {		
		$list = true;
		$imagelist = OSD_formatImageList($dets["results"]["info"], $dets["altIDs"]);
		$lbtB = '$(listButton).css("display", "block");';
		$lbtN = '$(listButton).css("display", "none");';
		$tileSources = "[ 
\t\t\t\"".implode("\",\n\t\t\t\"", $dets["results"]["info"])."\"
]";
		}
	else
		{$lbtB = '';
		 $lbtN = '';		 
		 $displayOSD =  "display:none;";}	
				
	if (isset($config["layout"]) and $config["layout"] == "simplegrid")
		{
		$rows = floor(sqrt($dets["resources"]));
		if ($rows > 4) {$rows = $rows - 1;}		
		$osdMode = "	
			collectionMode:       true,
			collectionRows:       $rows, 
			collectionTileSize:   1024,
			collectionTileMargin: 256,
			";
		}
	else if (isset($config["layout"]) and $config["layout"] == "grid")
		{
		$pd["extra_js_scripts"][] = "https://cdn.rawgit.com/Pin0/openseadragon-justified-collection/1.0.2/dist/openseadragon-justified-collection.min.js";
		$osdMode = "	
			collectionMode:       true,
			collectionRows:       1, 
			";
		$extramorejs = '
	var total = '.intval($dets["resources"]).';
				';
		}
	else
		{$osdMode = "
		 sequenceMode: true,
		 showReferenceStrip: true,";}
	
	ob_start();			
	echo <<<END
		
	var loadedViewer;
	var myMViewer;
	var myOSDViewer;
	
	function setViewer (viewer)
		{
		if (viewer == "m")
			{
			$(toggleO).css("display", "block");
			$(listButton).css("display", "none");					 
			loadedViewer = "m";		
			}
		else
			{
			$(toggleM).css("display", "block");			 
			loadedViewer = "osd";		
			}
		}
		
	function toggleViewer ()
		{		
		if (loadedViewer == "m")
			{
			$lbtB
			$(iiifviewerO).css("display", "block");
			$(toggleM).css("display", "block");
			 
			$(iiifviewerM).css("display", "none");
			$(toggleO).css("display", "none");			 
			loadedViewer = "osd";
			}
		else
			{
			$lbtN
			$(iiifviewerO).css("display", "none");
			$(toggleM).css("display", "none");
			 
			$(iiifviewerM).css("display", "block");
			$(toggleO).css("display", "block");			 
			loadedViewer = "m";
			}
		}
		
	function displayMirador() {
		myMViewer = Mirador.viewer({
			id: "iiifviewerM",
			"workspace": {
				"isWorkspaceAddVisible": true},     
				$cats
				});  
			}
				
	function displayOpenSeadragon() {
		var w = $(iiifviewerO).width();
		var h = $(iiifviewerO).height();
		myOSDViewer = OpenSeadragon({
			id: "iiifviewerO",
			prefixUrl: "https://openseadragon.github.io/openseadragon/images/",
			imageLoaderLimit: 100,
			$osdMode
			tileSources:   $tileSources 
			});
			
		var cls = Math.round(Math.sqrt((w/h) * total));
			
		if (w > h)
			{myOSDViewer.collectionColumns = cls;}
		else
			{myOSDViewer.collectionColumns = cls - 1;}
		
		myOSDViewer.addHandler('open', function() {
			myOSDViewer.world.arrange();
			myOSDViewer.viewport.goHome(true);
			});
		}
				 
		$extramorejs 
END;
		$morejs .= ob_get_contents();
		ob_end_clean(); // Don't send output to client			 
		
	$pd["extra_onload"] .= "
	 setViewer (\"$displayviewer\");
	 displayOpenSeadragon();
	 displayMirador();	 
	 ";
			
	if ($dets["resources"] > 50)
		{$exnote = "<span style=\"color: #0d6efd;\"> Also it can take some time for larger sets of images to appear in the viewer.</span>";}
	else
		{$exnote = "";}
		
	if ($returnsBlocked) 
		{$blockStr = "<span style=\"color: red;\"> (Access limited)</span>";
		 $exnote .= "<span style=\"color: red;\"> Additionally access has been limited to first 10000 records per end-point.</span>";}
	else {$blockStr = "";}

	$exnote .= "<br/><br/><b>These results include:</b><br/><ul><li>".implode("</li><li>", $dets["comment"])."</li></ul>";
	$opts = buildPagination ($pageURI, $page, $maxPages, $returnsBlocked);

	$sstr = "<span style=\"color: green;\"> Search for: <b>".$getExtra[0]."</b></span>";
	$dstr = "Displaying resources from objects <b>". implode(" - ", $range) ."</b> of <b>".$dets["total"]."</b>";

	if (!$epts)
		{$note .= "".buildModalButton ($defaultStr, true, false);}
	else if ($dets["limited"])
		{$note .= "".buildModalButton("$sstr. $dstr.$blockStr", true, $list, $opts);
		 $d["info"] .= "Please note your search has been limited, attempting to display <b>$dets[resources]</b> resources relating to <b>$dets[objects]</b> objects (<b>". implode(" - ", $range) ."</b> of <b>$dets[total]</b> results).$exnote";
			}
	else if (!$dets["total"])
		{$note .= "".buildModalButton (" Sorry, no results have been found for your search for <b>".$getExtra[0]."</b>, please try again.", true, false);}
	else
		{$note .= "".buildModalButton("$sstr. $dstr.", true, $list);}

	ob_start();			
	echo <<<END
	
	var submits = document.getElementsByClassName('searchsubmit');
	for (var i=0, len=submits.length|0; i<len; i=i+1|0) {
	  submits[i].addEventListener("click", formatSearchGet);}
	
	function formatSearchGet(e) {
		e.preventDefault();
		const svalue = document.getElementById(e.target.id+"-search");		
		const lvalue = document.getElementById(e.target.id+"-limit");
		
		if (lvalue.value != "...") {var lstr = "/" + lvalue.value;}
		else {var lstr = "";}
		
		const pvalue = document.getElementById(e.target.id+"-page");
		const pno = parseInt(pvalue.value)		
		if (pno) {var pstr = "/" + pno;}
		else {var pstr = "";}
		
		const vvalue = $('#viewer input:radio:checked').val();
		var vstr = "/" + vvalue;
		
		var vars = [];
		var pname = window.location.pathname
		var parts = pname.replace(/([\/])([^\/]+)/gi, function(m,key,value) {
		vars.push(value);});
		var new_url = "$rootDisplayURL" + "/" + svalue.value + lstr + pstr + vstr;

		window.location.href = new_url;
		}
		
	function formatPageGet(e) {
		e.preventDefault();
		
		if (e.target.href === undefined) 
			{var ca = $(e.target).parent();
			 var link = ca[0].href + '/' + loadedViewer;}
		else
			{var link = e.target.href + '/' + loadedViewer;}
		
		window.location.href = link;
		}

	var myModal = document.getElementById('searchModal')
	var myInput = document.getElementById('submit-modal-search')

	myModal.addEventListener('shown.bs.modal', function () {
		if (loadedViewer == "m")
			{document.querySelector("input[value='m']").checked = true;}
		else
			{document.querySelector("input[value='osd']").checked = true;}
		myInput.focus()
	})
	$morejs
END;
	$pd["extra_js"] .= ob_get_contents();
	ob_end_clean(); // Don't send output to client
	
	if ($note)
		{$note = '<div class="alert alert-warning" role="alert" style="padding:0px 0.5rem 0px 0.5rem;">'.$note.'</div>';}
	
	$sform = buildSearchForm ($stermForm, $limit, $page, true);
	
	ob_start();			
	echo <<<END
		$note</div>
		<div class="row justify-content-center flex-grow-1">
			<div class="h-100" style="position:relative;min-height:400px;$displayOSD" id="iiifviewerO">
			</div>
			<div class="h-100" style="position:relative;min-height:400px;$displayM" id="iiifviewerM">
			</div>
		</div>
	
<div class="modal fade" id="listModal" tabindex="-1" aria-labelledby="listModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="listModalLabel">Identified Details for Displayed Images</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        $imagelist
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="infoModalLabel">Further Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        $d[info]
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="searchModalLabel">Run New Search</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				$sform
			</div>
			<div class="modal-footer">
				<!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button> -->
			</div>
		</div>
	</div>
</div>
END;
	$extra_content = ob_get_contents();
	ob_end_clean(); // Don't send output to client
	
	$d = positionExtraContent ($d, $extra_content);

  return (array("d" => $d, "pd" => $pd));
  }

function MD_buildCatalog ($mans)
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
			
	
function buildModalButton ($comment=false, $info=false, $list=false, $nav=false)
	{
	global $buttons;
	
	if($info)
		{$infoButton = $buttons["info"];}
	else
		{$infoButton = '';}
		
	if($list)
		{$listButton = "<td id=\"listButton\">".$buttons["list"]."</td>";}
	else
		{$listButton = '';}
		
	if ($nav) {
		$nav = "<div class=\"row\"><div class=\"col d-flex justify-content-center\">".
			"$nav</div></div>";
		}
		
	$toggleButton = $buttons["toggleM"].$buttons["toggleO"];
	$searchButton = $buttons["search"];
				
	ob_start();
	echo <<<END
			<div class="row" style="padding:0.5rem;">				
				<div class="col-xl-11 col-lg-10 col-md-9  col-sm-7 col-6" style="padding-right:6px;padding-left:0px;display:table;" >
					<span style="display:table-cell;vertical-align: middle;">$comment</span>
				</div>
				<div class="col-xl-1 col-lg-2 col-md-3 col-sm-5 col-6" style="padding:0px;" >
					<div><div class="container"  style="padding:0px;">
						<div class="row">
							<div class="col d-flex justify-content-center">
								<table>
									<tr>
										<td>$infoButton</td>
										$listButton
										<td>$toggleButton</td>										
										<td>$searchButton</td>										
									</tr>
								</table>
							</div>
						</div>
						$nav
					</div></div>
				</div>
			</div>
END;
	$html = ob_get_contents();
	ob_end_clean(); // Don't send output to client
			
	return ($html);
	}

function OSD_formatImageList($list, $altIDs)			
	{
	global $rootDisplayURL;

	$html = "<div class=\"container\">";
	$pstyle = "class=\"text-uppercase\" style=\"cursor:default;font-weight:bold;display:table-cell;vertical-align:bottom;";
	$pstyle2 = $pstyle."text-align:center;";
	
	echo <<<END
	<ul class="list-group list-group-flush">
	<li class="list-group-item">
	<div class="row">		
		<div class="col-lg-8 col-6" style="display:table;">
			<p $pstyle">Filename or ID</p>
		</div>
		<div class="col-lg-2 col-3" style="display:table;">
			<p $pstyle2" title="Links to open specific image in a new tab">View</p>
		</div>
		<div class="col-lg-2 col-3" style="display:table;">
			<p $pstyle2"  title="Links to open an image IIIF info.json file in a new tab">Info</p>
		</div>
	</div>
	</li>
END;
		$html .= ob_get_contents();
		ob_end_clean(); // Don't send output to client		

	foreach ($list as $k => $url)
		{		
		if (preg_match ("/^(.+[\/])([^\/]+)[\/]info.json$/", $url, $m))
			{$file = $m[2];
			 if (isset($altIDs[$m[2]]))
				{$sterm = $altIDs[$m[2]];
				 $file .= " ($sterm)";}
			 else
				{$sterm = $m[2];}
			 //changed native.jpg to the older default.jpg as newer systems will work with both but older systems fail for native.jpg
			 $search = "<a target=”_blank” href=\"$rootDisplayURL/$sterm\" title=\"Open specific image in a new tab\">
				<img alt=\"$m[2]\" src=\"".trim($m[1], "/")."/$m[2]/full/64,/0/default.jpg\" style=\"margin-left:auto;margin-right:auto;display:block;\">
			 </a>";}
		else
			{$file = "Name not Found";
			 $search = "Link not Found";}

		ob_start();
	echo <<<END
	<li class="list-group-item">
	<div class="row">
		<div class="col-lg-8 col-6" style="display:table;overflow:hidden;">
			<p class="text-break">$file</p>
		</div>
		<div class="col-lg-2 col-3" style="display:table;">
			$search
		</div>
		<div class="col-lg-2 col-3" style="display:table;">
			<a target=”_blank” href="$url" title="Open image IIIF info.json file in a new tab">
				<img style="margin-left:auto;margin-right:auto;display:block;" alt="image icon" width="32" src="https://avatars.githubusercontent.com/u/5812589?s=32&v=4"></a>
		</div>
	</div>
			</li>
END;
		$html .= ob_get_contents();
		ob_end_clean(); // Don't send output to client		
		}
	
	$html .= "</ul></div>";	
	return($html);
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
	 
function buildSearchForm ($search, $limit=25, $page=1, $modal=true)
	{		
	$limits = array(25,50,75,100);
	$selStr = "";
	
	foreach ($limits as $k => $v)
		{if ($v == $limit) {$selected = "selected";}
		 else {$selected = "";}
		 $selStr .= "<option value=\"$v\" $selected>$v</option>";}
		
	if ($modal) {$var = "modal";}
	else {$var = "inline";}
			
	ob_start();
	echo <<<END
		<form class="d-flex  justify-content-center" style="padding:0.5rem 0px 0.5rem 0px;">
					<div class="bd-example">
						<label for="submit-$var-search" class="form-label">Free text search term ("AND" operator used for multiple words)</label>
						<div class="input-group mb-3">
							<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="submit-$var-search" name="submit-$var-search" value="$search">
							<button class="btn btn-outline-success searchsubmit" id="submit-$var">Search</button>
						</div>
						<label for="submit-$var-limit" class="form-label">Object limit and page number <b>per end-point</b></label>
						<div class="input-group mb-3">        
							<label class="input-group-text" for="submit-$var-limit">Limit</label>
							<select class="form-select" id="submit-$var-limit">
								$selStr
							</select>
							<label class="input-group-text" for="submit-$var-page">Page No.</label>
							<input type="text" aria-label="Page Number" class="form-control" id="submit-$var-page" placeholder="1" value="$page">
						</div>
						<label for="submit-$var-viewer" class="form-label">Select the <b>default</b> IIIF viewer</b></label>
						<div class="input-group mb-3" id="viewer">  
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="submit-$var-viewer" id="submit-$var-viewer1" value="osd" checked>
								<label class="form-check-label" for="submit-$var-viewer1">
									OpenSeadragon (Image Grid)
								</label>
							</div>							
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio" name="submit-$var-viewer" id="submit-$var-viewer2" value="m">
								<label class="form-check-label" for="submit-$var-viewer2">
									Mirador (Images with Metadata)
								</label>
							</div>
						</div>
					</div>
				</form>
END;
	$searchform = ob_get_contents();
	ob_end_clean(); // Don't send output to client
			
	return ($searchform);
	}

function buildPagination ($link, $current, $max, $block=false)
	{	
	if ($current <= 1)
		{$current = 1;
		 $db = "disabled";
		 $db2 = " aria-disabled=\"true\"";
		 $previous = "";}
	else
		{$db = "";
		 $db2 = "";
		 $previous = "href=\"$link".($current - 1)."\"";}
		
	if ($block)
		{$dn = "disabled";
		 $dn2 = " aria-disabled=\"true\"";
		 $next = "";}
	else if ($current >= $max)
		{$current = $max;
		 $dn = "disabled";
		 $dn2 = " aria-disabled=\"true\"";
		 $next = "";}
	else
		{$dn = "";
		 $dn2 = "";
		 $next = "href=\"$link".($current + 1)."\"";}	
	
	ob_start();			
	echo <<<END
<nav aria-label="Navigate search pages">
  <ul class="pagination pagination-sm" style="margin:5px 0px 0px 0px;">
    <li class="page-item $db">
      <a class="page-link" $previous tabindex="-1" onclick="formatPageGet(event)" $db2><i class="fas fa-angle-left"></i></a>
    </li>
    <li class="page-item disabled"><a class="page-link" aria-disabled="true"> $current/$max </a></li>
    <li class="page-item $dn">
      <a class="page-link" $next  onclick="formatPageGet(event)" $dn2><i class="fas fa-angle-right"></i></a>
    </li>
  </ul>
</nav>
END;
	$html = ob_get_contents();
	ob_end_clean(); // Don't send output to client
	
	return($html);
	}
?>
