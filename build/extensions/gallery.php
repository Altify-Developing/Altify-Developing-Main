<?php

// Last update 21 Apr 2021

$extensionList["gallery"] = "extensionGallery";

function extensionGallery ($d, $pd)
  {
  $gcontent = "";
		
	if (isset($d["file"]) and file_exists($d["file"]))
		{
		$dets = getRemoteJsonDetails($d["file"], false, true);
		if (isset($dets["ptitle"]))
			{$gcontent .= "<h3>$dets[ptitle]</h3>";}
		$gcontent .= '<div class="row text-center text-lg-left">';
		$last = "primary";
			
		foreach ($dets["images"] as $n => $a)
			{
			$a = array_merge(array("logo" => "", "link" => "#", "level" => "primary"), $a);

			if ($a["level"] != $last)
				{
				$gcontent .= '</div>';
				if (isset($dets["stitle"]))
					{$gcontent .= "<h3>$dets[stitle]</h3>";}
				$gcontent .= '<div class="row text-center text-lg-left">';
				}

			$last = $a["level"];
					
			ob_start();
      echo <<<END
    <div class="col-lg-3 col-md-4 col-6">
      <a href="$a[link]" class="d-block mb-4 h-100">
        <img class="img-fluid img-thumbnail $a[level] mx-auto d-block"
				  src="$a[logo]" alt="$n">
      </a>
    </div>
END;
			$gcontent .= ob_get_contents();
			ob_end_clean(); // Don't send output to client
			}

    $gcontent .= '</div>';
			
		//use to hide the label used for the first line which is just in place to provide a margin/padding on the left.
		$pd["extra_css"] .= "
img.primary, img.secondary {
  display: block;
  max-width:230px;
  max-height:128px;
  width: auto;
  height: auto;
	border: 0px solid black;
	}
	
img.secondary{
  max-width:192px;
  max-height:96px;
	}";

    $d = positionExtraContent ($d, $gcontent);
		}	

  return (array("d" => $d, "pd" => $pd));
  }
    
?>
