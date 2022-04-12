<?php

// Last update 7 Sept 2021

$extensionList["discovery-example"] = "extensionDiscoveryExample";
$defaultEP = "https://research.ng-london.org.uk/discovery/";
	
function autoChildViewerText ($name, $which=false)
	{
	$w1 = false;
	
	if (in_array(strtolower($which), array("osd", "openseadragon")))
		{$w1 = "specific images (IIIF info.json files)";
		 $w2 = "OpenSeaDragon";}
	else if (in_array(strtolower($which), array("mirador")))
		{$w1 = "IIIF manifests";
		 $w2 = "Mirador";}
	
	if ($w1)
		{$out = array("$name Example ($w2)", "<p>This system has been designed to demonstrate a working implementation of a simple IIIF discovery system, displaying images in relation to paintings within the $name Collection. This page allows users to pull select $w1 based on a simple text search and add them into $w2.</p>");}
	else
		{$out = array("$name IIIF Viewer", "<p>This system has been designed to demonstrate a working implementation of a simple IIIF discovery system, displaying images in relation to paintings within the $name Collection. This page allows users to pull select IIIF resources based on a simple text search and add them into either OpenSeaDragon or Mirador V3.</p>");}
		
	return($out);	
	}
	
function createViewerData($name, $parent, $uri, $viewer=false)
	{
	$m = autoChildViewerText ($name, $viewer);
	$npage = array(
			"title" => "",
			"class" => "dynamic-iiif",
			"parent" => $parent,
			"file" => array (
				"search-uri" => $uri,
				"limit" => 25, 
				"viewer" => $viewer,
				"layout" => "grid"),
			"displayName" => $m[0],
			"content" => $m[1],
			"content right" => "",
			"fluid" => 1,
			"displaycode" => false		
			);	
			
	return ($npage);
	}
	
	
function createExampleData($parent, $path, $config)
	{
	// Allow config details to be sent as an array
	if (!is_array($path))
		{$path = $path.$config["tag"].".json";}
		
	$npage = array(
			"title" => "",
			"class" => "discovery-example",
			"parent" => $parent,
			"file" => array (
				"example" => true,
				"path" => $path),
			"displayName" => $config["name"],
			"content" => $config["comment"],
			"content right" => "",
			"displaycode" => false
			);	
			
	return ($npage);
	}
	
function getConfigs ($path)
	{		
	$de = glob($path."*.json");
	$configs = array();

	foreach($de as $file){
		$dets = getsslJSONfile ($file, true);
		if (!isset($dets["skip"]) and !$dets["skip"])
			{$configs[$dets["tag"]] = $dets;}
		} 
	
	return ($configs);
	}
	
function extensionDiscoveryExample ($d, $pd, $addPages=false)
  {
	global $extraHTML, $navExtra, $rootDisplayURL, $getExtra, $rootURL, $defaultEP;
	
	if (isset($d["file"]) and is_array($d["file"]))
		{$configs = $d["file"];}
	else if (isset($d["file"]) and is_dir($d["file"]))
		{$configs = getConfigs ($d["file"]);}
	else
		{$configs = array();}
		
	if (isset($d["displayName"]) and $d["displayName"] == "End-Points")
		{		
		$d["content"] .= "<h4>End-Point results format</h4><p>Simple IIIF Discovery end-points are required to return results in the form of a JSON document as shown below. Further description of the various variables can be found in the <a href=\"./diagram\">model diagram</a>.</p><figure class=\"figure\"><pre class=\"json-renderer\" style=\"overflow-y: auto;overflow-x: auto; border: 2px solid black;padding: 10px;max-height:400px;\">${defaultEP}ng/</pre><figcaption class=\"figure-caption\">Default response from the National Gallery Simple IIIF Discovery end-point.</figcaption>\r\n</figure>";
		
		$eplist = "<h4>Example Simple IIIF Discovery End-Points</h4><p>The following six example endpoints have been setup to demonstrate the required functionality.</p>";
		
		foreach ($configs as $tag => $a)
			{$eplist .= "<a class=\"btn btn-outline-secondary nav-button\" style=\"margin-bottom: 10px;\" id=\"$tag-endpoint-link\" role=\"button\" href=\"${defaultEP}$tag/\">${defaultEP}$tag/</a>";}
		
		$eplist .= "<br/>";
		
		$d["content right"] = $eplist.$d["content right"];
		
		return (array("d" => $d, "pd" => $pd));
		exit;
		}				
	else if (isset($d["displayName"]) and $d["displayName"] == "Home")
		{		
		$collections = array();
		$examples = array();
		foreach ($configs as $tag => $a)
			{$collections[] = "[".$a["name"]."|./".$tag."-example]";
			 $examples = array_merge($examples, $a["examples"]);}
		
		$last = array_pop($collections);
		$colList = implode(", ", $collections)." and $last.";
		
		$d["content"] = preg_replace('/\[INSERT COLLECTIONS LIST HERE\]/', $colList, $d["content"]);
		$d["content right"] = "<figure class=\"figure\">
			[##]
			<figcaption class=\"figure-caption\" style=\"text-align:center;padding-top:5px;\">
				Example images from the collections included in this Simple IIIF Discovery demonstrator.
			</figcaption>
		</figure>";
		$d["vheight"] = 800;
		shuffle($examples);
		$d["file"] = $examples;
		
		$out = extensionopenseadragon ($d, $pd);
				
		return ($out);
		exit;
		}		
	
	if ($addPages)
		{
		//$pd equals parent name here		
		$configCombined = array(
			"tag" => "combined",
			"name" => "Cross-Collection Search",
			"logo" => array(),
			"link" => array(),
			"docURL" => array(),
			"termsURL" => array(),
			"ep" => array(),
			"comment" => "Multiple Simple IIIF Discovery end-points can be connected ".
				"to a single page to allow users to search across multiple collections ".
				"at the same time<br/><br/>These particular examples allow users to search ".
				"across the collections of ",
			"examples" => array()
			);
		$collections = array();
				
				
		foreach ($configs as $tag => $config)
			{
			$example = $tag."-example";			
			$xpages[$example] = createExampleData($pd, $d["file"], $config);
			
			if (!isset($config["ep"]))
				{$config["ep"] = $defaultEP.$tag."/";}
				
			$configCombined["ep"][] = $config["ep"];
			$configCombined["logo"][] = $config["logo"];
			$configCombined["link"][] = $config["link"];
			$configCombined["examples"] = array_merge($configCombined["examples"], $config["examples"]);
			$collections[] = $config["name"];	
			
			$xpages["viewer-$tag"] = createViewerData(
				$config["name"], $example, $config["ep"]);
				
			// Not required just adding the original viewer specific pages for persistence 
			$xpages["viewer-$tag-m"] = createViewerData(
				$config["name"], $example."-m", $config["ep"], "mirador");
			$xpages["viewer-$tag-osd"] = createViewerData(
				$config["name"], $example."-osd", $config["ep"], "openseadragon");
					
			// Just to add the original aliases for the ng viewers
			if ($tag == "ng")
				{$xpages["viewer-m"] = $xpages["viewer-$config[tag]-m"];
				 $xpages["viewer-m"]["copy"] = true;
				 $xpages["viewer-osd"] = $xpages["viewer-$config[tag]-osd"];
				 $xpages["viewer-osd"]["copy"] = true;}
			}
	
		$last = array_pop($collections);
		$configCombined["comment"] .= implode(", ", $collections)." and $last.";
		 
		$xpages[$configCombined["tag"]."-example"] = createExampleData($pd, $configCombined, $configCombined);
		$xpages["viewer-".$configCombined["tag"]] = createViewerData($configCombined["name"], $configCombined["tag"]."-example", $configCombined["ep"]);
		
		// Not required just adding the original viewer specific pages for persistence 
		$xpages["viewer-$configCombined[tag]-m"] = createViewerData($configCombined["name"], 
			$configCombined["tag"]."-example-m", $configCombined["ep"], "mirador");
		$xpages["viewer-$configCombined[tag]-osd"] = createViewerData($configCombined["name"], 
			$configCombined["tag"]."-example-osd", $configCombined["ep"]);
				
		return ($xpages);
		exit();	
		}	
	else if (isset($configs["example"]) and $configs["example"])
		{
		if (is_array($configs["path"]))
			{$config = $configs["path"];}
		else
			{$config = getsslJSONfile ($configs["path"], true);}
		
		if (!isset($config["ep"]))
				{$config["ep"] = $defaultEP.$config["tag"]."/";}
				
		if (is_array($config["logo"]))
			{
			$p = "(s)";
			$x1 = "style=\"text-align:center;\"";
			$x2 = "</div><br/>";
			$x3 = "";
			$ims = "";
			foreach ($config["logo"] as $lk => $lim)
				{$ims .= "[<img class=\"float-sm\" src=\"$lim\" style=\"".
				 "margin:2px 10px 0px 0px !important; width: 128px;\" alt=\"".
				 $config["link"][$lk]."\">|".$config["link"][$lk]."]";}
			$epbuttons = "";
			foreach ($config["ep"] as $ek => $url)
				{$epbuttons .= "<a class=\"btn btn-outline-secondary nav-button\" ".
					" style=\"margin-bottom: 10px;\" id=\"endpoint-link-$ek\" role=\"button\" ".
					"href=\"$url\">$url</a>";}				
			$epexample = "";
			}
		else
			{
			$p = "";
			$x1 = "";
			$x2 = "";
			$x3 = "</div>";
			$ims = "[<img class=\"float-start\" src=\"$config[logo]\" style=\"".
				"margin:2px 10px 0px 0px !important; width: 150px;\" alt=\"".
				"The $d[displayName]\">|$config[link]]";
			$epbuttons = "<a class=\"btn btn-outline-secondary nav-button\" ".
				"id=\"endpoint-link\" role=\"button\" ".
				"href=\"$config[ep]\">$config[ep]</a>";
			$epexample = "<br/>
		<figure class=\"figure\">
			<pre class=\"json-renderer\" style=\"overflow-y: auto;overflow-x: auto; border: 2px solid black;padding: 10px;max-height:400px;\">
				$config[ep]
			</pre>
			<figcaption class=\"figure-caption\">
				Default response from the $d[displayName] Simple IIIF Discovery end-point.
			</figcaption>
		</figure>	";
			}
	
		$sf = buildSearchForm ("", 25, 1, false);
	
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
		var new_url = "$rootURL" + "viewer-$config[tag]" + "/" + svalue.value + lstr + pstr + vstr;

		window.location.href = new_url;
		}
END;
	$pd["extra_js"] .= ob_get_contents();
	ob_end_clean(); // Don't send output to client
		
	ob_start();			
		echo <<<END
		<div class="clearfix" $x1>
			$ims
			$x2
			<p>$d[content]</p>
		$x3
		
		<h5>Search and display the Collection$p:</h5>
		<!--- <div class="clearfix w-100">
			<a style="color: #3b5998;" href="./viewer-$config[tag]-osd" role="button" title="OpenSeaDragon">
				<img class="float-start" src="./graphics/osd_logo.png" style="margin:0px 10px 0px 10px !important; width: 64px;" alt="OpenSeadragon Example">
			</a>
			<a style="color: #3b5998;" href="./viewer-$config[tag]-m" role="button"  title="Mirdaor">
				<img class="float-start" src="./graphics/Mirador%20Logo%20Black.png" style="margin:0px 10px 0px 10px !important; width: 64px;" alt="Project Mirador Example">
			</a>
		</div> --->
		
		
		<div class="alert alert-warning" role="alert" style="padding:0px 0.5rem 0px 0.5rem;">
			$sf
		</div>
			
			
		
		
END;
		$d["content"] = ob_get_contents();
		ob_end_clean(); // Don't send output to client			 
		
			ob_start();			
		echo <<<END
		<figure class="figure">
			[##]
			<figcaption class="figure-caption" style="text-align:center;padding-top:5px;">
				Example images from the $d[displayName] Simple IIIF Discovery end-point.
			</figcaption>
		</figure>
		<h5>Simple IIIF Discovery End-Point$p</h5>
		$epbuttons
		$epexample
END;
		$d["content right"] = ob_get_contents();
		ob_end_clean(); // Don't send output to client			 
	
	$d["hideIncluded"] = true;
	$d["file"] = $config["examples"];
	$d["osd-viewer"] = "grid";
	$d["osd-background"] = "white";
		
	$osd = extensionopenseadragon ($d, $pd);
	$d = $osd["d"];
	$pd = $osd["pd"];
		}
		
  return (array("d" => $d, "pd" => $pd));
  }
  
?>
