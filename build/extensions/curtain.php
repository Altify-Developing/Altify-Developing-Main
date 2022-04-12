<?php

// Last update 21 Apr 2021

// A V&A viewer (https://github.com/vanda/curtain-viewer) based on OpenSeaDragon, using the curtain-sync plugin (https://github.com/cuberis/openseadragon-curtain-sync) for comparing naturally aligned image variants, such as those obtained by multi-spectral imaging, supplied as canvases in a IIIF manifest. 

$extensionList["curtain"] = "extensionCurtain";

function extensioncurtain ($d, $pd)
  {
	global $extraHTML;
	$workspace = false;
  $mans = '[]';
	$wo = '';
	$codecaption = "The complete curtain JSON file used to define the manifests and images presented in this example.";

	$pd["extra_css_scripts"][] = "https://jpadfield.github.io/curtain-viewer/bundle.css";
	$pd["extra_js_scripts"][] = "https://jpadfield.github.io/curtain-viewer/js/1.08958bb6.chunk.js";
	$pd["extra_js_scripts"][] = "https://jpadfield.github.io/curtain-viewer/js/app.a955ee34.js";

	$d = positionExtraContent ($d, '<div class="row" style="padding-left:16px;padding-right:16px;"><div class="col-12 col-lg-12"><div class="curtain-viewer" data-iiif-manifest="'.$d["file"].'"></div></div></div>');

  return (array("d" => $d, "pd" => $pd));
  }

?>
