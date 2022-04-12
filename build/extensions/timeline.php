<?php

// Last update 07 June 2021

$extensionList["timeline"] = "extensionTimeline";
$start = false;
	
function extensionTimeline ($d, $pd)
  {
	global $start;
	
  if (isset($d["file"]) and file_exists($d["file"]))
		{
		$dets = getRemoteJsonDetails($d["file"], false, true);

		if (!isset($dets["start date"]))
			{die("ERROR: $d[file] format problems - 'start date' not found\n");}
		
		$start = $dets["start date"];
		$prefs = array_keys($dets["groups"]);
		$first = $prefs[0];

		if (!isset($dets["project"])) {$dets["project"] = "Please add a project title";}
		if (!isset($dets["margin"])) {$dets["margin"] = -3;}
		
		array_unshift($dets["groups"][$first]["stages"],
		array("Add as a margin", "", $dets["margin"], $dets["margin"]));
		
		$str = "";
		$jsstr = "var rectIDs = [];\n";

		foreach ($dets["groups"] as $pref => $ga)
			{
			$str .= "\tsection $ga[title]\n";
			$no = 0;
			foreach ($ga["stages"] as $k => $a)
				{
				if ($a[1]) {$a[1] = "$a[1], ";}
				$jsstr .= "rectIDs[\"".$pref.$no."\"] = \"".dA($a[2])." - ".dA($a[3])."\";\n";
				$str .= "\t\t".$a[0]." :$a[1]$pref$no, ".dA($a[2]).
					", ".dA($a[3])."\n";
				$no++;
				}
			}

		$pd["extra_js_scripts"][] =
			"https://cdn.jsdelivr.net/npm/mermaid@8.10.1/dist/mermaid.min.js\" integrity=\"sha256-aQCGsx3/OLAXwNyOUrAedielIQAjIrMFkcWdXMlIkGc=\" crossorigin=\"anonymous";
		$pd["extra_onload"] .= "
	
	mermaid.ganttConfig = {
    titleTopMargin:25,
    barHeight:20,
    barGap:4,
    topPadding:50,
    sidePadding:50
		}
  //console.log(mermaid.render);
  mermaid.initialize({startOnLoad:true, flowchart: { 
    curve: 'basis' 
  }});";
	//use to hide the label used for the first line which is just in place to provide a margin/padding on the left.

	ob_start();
		echo <<<END

$jsstr

var ttdiv = false;
	
function showTooltip(evt, cid) {

	if (!ttdiv)
		{let div = document.createElement('div');
		 div.id = "tooltip";
		 div.display = "none";
		 div.style = "position: absolute; display: none;";
		 document.body.append(div);
		 ttdiv = true;}	

	var daterange = "Date Range";
	if (cid in rectIDs)
		{daterange = rectIDs[cid];}
	
				
  let tooltip = document.getElementById("tooltip");
  tooltip.innerHTML = daterange;
  tooltip.style.display = "block";
  tooltip.style.left = evt.pageX + 10 + 'px';
  tooltip.style.top = evt.pageY + 10 + 'px';
	}

function hideTooltip() {
  var tooltip = document.getElementById("tooltip");
  tooltip.style.display = "none";
	}

// Select the node that will be observed for mutations
const targetNode = document.getElementById('gantt');

// Options for the observer (which mutations to observe)
const config = { attributes: true, childList: true, subtree: true };

// Callback function to execute when mutations are observed
const callback = function(mutationsList, observer) {
	// Use traditional 'for loops' for IE 11
  for(let mutation of mutationsList) {
		if (mutation.type === 'attributes' &&
				mutation.attributeName == 'id' &&
				mutation.target.tagName == 'rect') {			

			$( "#"+mutation.target.id ).mousemove(function( event ) {
				showTooltip(event, mutation.target.id);});
			$( "#"+mutation.target.id ).mouseout(function( event ) {
				hideTooltip();});
				
			$( "#"+mutation.target.id+"-text" ).mousemove(function( event ) {
				showTooltip(event, mutation.target.id);});
			$( "#"+mutation.target.id+"-text" ).mouseout(function( event ) {
				hideTooltip();});					
			}
    }
	};

// Create an observer instance linked to the callback function
const observer = new MutationObserver(callback);

// Start observing the target node for configured mutations
observer.observe(targetNode, config);
	
END;
    $pd["extra_js"] = ob_get_contents();
		ob_end_clean(); // Don't send output to client
		
    $pd["extra_css"] .= "
g a {
	color:inherit;}
	
#".$first."0-text {
	display:none;}

#tooltip {
  background: cornsilk;
  border: 1px solid black;
  border-radius: 5px;
  padding: 2px 5px 2px 5px;
  font-size: 0.75em;
  font-weight: bold;}

";

		ob_start();
		echo <<<END
	<div id="gantt" class="mermaid">
gantt
       dateFormat  YYYY-MM-DD
       title $dets[project]	
       $str
	</div>	 
END;
    $mcontent = ob_get_contents();
		ob_end_clean(); // Don't send output to client

		$d = positionExtraContent ($d, $mcontent);
    }

  return (array("d" => $d, "pd" => $pd));
  }


	
function dA ($v)
	{
	global $start;
	$a = explode(",", $v);
	$m = intval($a[0]);
	if(isset($a[1]))
		{$d = intval($a[1]-1);}
	else
		{$d = 0;}
	$date=new DateTime($start); // date object created.

	$invert = 0;
	if ($m < 0 or $d < 0)
		{$invert = 1;
		 $m = abs($m);
		 $d = abs($d);}
	$di = new DateInterval('P'.$m.'M'.$d.'D');
	$di->invert = $invert;
	$date->add($di); // inerval of 1 year 3 months added
	$new = $date->format('Y-m-d'); // Output is 2020-Aug-30
	return($new);
	}
	   
?>
