<?php

// Last update 21 Apr 2021

$extensionList["paneltruck"] = "extensionPanelTruck";

function extensionPanelTruck ($d, $pd)
  {
	global $extraHTML;
	$workspace = false;
  $mans = '[]';
	$wo = '';
	$codeHTML = "";
	$codecaption = "The complete panel truck JSON file used to define the images, positions and captions presented in this example.";
	
	$pd["extra_js_scripts"][] = "https://cdn.jsdelivr.net/npm/@webcomponents/webcomponentsjs/webcomponents-loader.js";
	$pd["extra_js_scripts"][] = "https://cdn.jsdelivr.net/npm/vue@2.6.12";
	$pd["extra_js_scripts"][] = "https://geoservices.leventhalmap.org/panel-truck/webcomponent-0.1/panel-truck.min.js";

	ob_start();
	echo <<<END
END;
	$pd["extra_js"] .= ob_get_contents();
	ob_end_clean(); // Don't send output to client

	$d = positionExtraContent ($d, '<div style="width:100%;height:800px;"><!-- the panel-truck component will take the size of its parent element -->
<panel-truck screenplay-src="'.$d["file"].'"></panel-truck>
</div>'.$codeHTML);

  return (array("d" => $d, "pd" => $pd));
  }
     
?>
