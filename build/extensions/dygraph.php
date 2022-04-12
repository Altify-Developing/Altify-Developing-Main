<?php

// Last update 21 Apr 2021

$extensionList["dygraph"] = "extensionDygraph";
      
function extensionDygraph ($d, $pd)
  {
  if (isset($d["file"]) and file_exists($d["file"]))
		{$dets = getRemoteJsonDetails($d["file"], false, true);}
  else
    {$dets = array();}
  
  $pd["extra_js_scripts"][] =
			"https://cdnjs.cloudflare.com/ajax/libs/dygraph/2.1.0/dygraph.min.js";
  $pd["extra_js_scripts"][] =
			"https://cdnjs.cloudflare.com/ajax/libs/dygraph/2.1.0/dygraph.min.js.map";
  $pd["extra_js_scripts"][] =
			"js/dygraph_Ext.js";
  //$pd["extra_js_scripts"][] =
  //"https://unpkg.com/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js";
  
  $pd["extra_css_scripts"][] =
    "https://cdnjs.cloudflare.com/ajax/libs/dygraph/2.1.0/dygraph.min.css";
  $pd["extra_css_scripts"][] =
    "https://cdnjs.cloudflare.com/ajax/libs/dygraph/2.1.0/dygraph.min.css.map";
  //$pd["extra_css_scripts"][] =
  //  "https://unpkg.com/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css";
      
  $pd["extra_js"] .= "
    ";

  /*$pd["extra_onload"] .= "

  $(function () { // INITIALIZE DATEPICKER PLUGIN
    $('.datepicker').datepicker({
      clearBtn: true,
      format: \"yyyy-mm-dd\"});});

  $(function () {
    $('[data-toggle=\"tooltip\"]').tooltip()})

  ";*/
   
  $titles = array(
    );

  $inputs = array(
    );
    
		//do we need tooltips?			
		//<div class="input-group col-md-6" data-toggle="tooltip" data-placement="top" title="Standard operating lux Level.">

  $alerts = array(
    );
    
	if (isset($d["file"]) and file_exists($d["file"]))
		{
		ob_start();
		echo <<<END

END;
    $mcontent = ob_get_contents();
		ob_end_clean(); // Don't send output to client

		//$d["content"] = positionExtraContent ($d["content"], $mcontent);
		$d = positionExtraContent ($d, $mcontent);

		}	

  return (array("d" => $d, "pd" => $pd));
  }
    
?>
