<?php

// Last update 07 June 2021

$extensionList["list"] = "extensionCards";
$blank = array("groups" => array(), "ptitle" => "",
    "stitle" => "",  "comment" => "", "image" => "", "link" => "");
$defaultcard = "list";
$displaychecked = true;
$maxcols = false;
    
// Still to do an optional table of contents for groups - model on https://github.com/IIIF/awesome-iiif

function buildContents ($groups)
  {
  $html = "<h3>Contents</h3><ul>";

  foreach ($groups as $gnm => $ga)
    {$tag = urlencode(strtolower($gnm));
      $html .= "<li>".
      "<a id=\"$tag-TBC\" class=\"offsetanchor\"></a>".
      "<a href=\"#$tag\">$gnm</a></li>";}
  
  $html .= "</ul>";

  return ($html);
  }

function extensionCards ($d, $pd)
  {
  global $blank, $defaultcard, $displaychecked, $maxcols;
  $gcontent = "";
    
  if (isset($d["file"]) and file_exists($d["file"]))
    {
    $dets = getRemoteJsonDetails($d["file"], false, true);

    if (isset($dets["defaultcard"]))
      {$defaultcard = $dets["defaultcard"];}
      
    if (isset($dets["displaychecked"]))
      {$displaychecked = $dets["displaychecked"];}

    if (!isset($dets["list"]))
      {$dets["list"] = array();}

    // If a path to json files is provided they need to be loaded into an array
    if (!is_array($dets["list"] ))
      {
      $lfs = glob($dets["list"]);
      $dets["list"] = array();
      foreach($lfs as $file){
        $ja = getRemoteJsonDetails($file, false, true);
        if ($ja) {$dets["list"][] = $ja;}}
      }

    
    foreach ($dets["list"] as $lno => $la)
      {
      //ensure each of the currently required fields are present.
      $la = array_merge($blank, $la);
      
      $dga = array("comment" => "", "card" => $defaultcard, 
        "config" => array(), "maxcols" => 3);
      
      foreach ($la["groups"] as $k => $gnm)
          {                                
          if (!isset($dets["groups"][$gnm] ))
            {$dets["groups"][$gnm]  = $dga;}
          else
						{$dets["groups"][$gnm] = array_merge($dga, $dets["groups"][$gnm]);}
                            
          if (!isset($dets["groups"][$gnm]["card"]))
            {$dets["groups"][$gnm]["card"] = "list";}

          if (!function_exists("build".ucfirst($dets["groups"][$gnm]["card"])."Card"))
            {$cfn = "buildSimpleCard";}
          else
            {$cfn = "build".ucfirst($dets["groups"][$gnm]["card"])."Card";}
          
          if (!isset($dets["groups"][$gnm]["html"]))
            {$dets["groups"][$gnm]["html"] = startGroupHtml (
             $gnm, $dets["groups"][$gnm]["comment"],
             $dets["groups"][$gnm]["card"], $dets["tableofcontents"]);}
          
          $maxcols = $dets["groups"][$gnm]["maxcols"];
          $dets["groups"][$gnm]["html"] .= call_user_func_array($cfn, array($la));          
          }
      }

    // organise children
    foreach ($dets["groups"] as $gnm => $ga)
        {
        $pc = explode ("|", $gnm);

        if (count($pc) > 1)
          {
          if (in_array($dets["groups"][$gnm]["card"], array("list")))
            {$dets["groups"][trim($pc[0])]["html"] .=
                "</ul><br/>".$dets["groups"][$gnm]["html"] ;}
          else
            {$dets["groups"][trim($pc[0])]["html"] .=
                "</div><br/>".$dets["groups"][$gnm]["html"] ;}

          unset($dets["groups"][$gnm]);
          }
        }
        
    foreach ($dets["groups"] as $gnm => $ga)
        {
        if (!isset($ga["html"])) {/*ERROR*/}
        if (in_array($dets["groups"][$gnm]["card"], array("list")))
          {$gcontent .= $ga ["html"]."</ul><br/>";}
        else
          {$gcontent .= $ga ["html"]."</div><br/>";}
        }
      
    $pd["extra_css"] .= "
.card-img {
  width: auto;
  max-width: 100%;
  max-height:200px;
  display: block;
  margin-left: auto;
  margin-right: auto;
  padding: 10px;
}

.card-img-top {
  width: auto;
  max-width: 100%;    
  max-height:128px;
  display: block;
  margin-left: auto;
  margin-right: auto;
  padding: 10px;
}

.nodec:link, .nodec:visited, .nodec:hover, .nodec:active {
  text-decoration: none;
  color: inherit;
  }

.card-hov:hover {
  opacity: 0.7;
}

.offsetanchor {
  position: relative;
  top: -75px;
}

.pcontainer {
   position: relative;
   width: 100%;
   padding-top: 56.25%; /* 16:9 Aspect Ratio */
	}
	
.preview {
   position: absolute;
   top: 0;
   left: 0;
   bottom: 0;
   right: 0;
   width: 100%;
   height: 100%;
	}

";

    // Check if a table of contents should be added.
    if (!isset($dets["tableofcontents"])) {$dets["tableofcontents"] = false;}
    if ($dets["tableofcontents"])
      {$tb = buildContents ($dets["groups"]);}
    else
      {$tb = "";}
      
    $d = positionExtraContent ($d, $tb.$gcontent);
    }

  return (array("d" => $d, "pd" => $pd));
  }

function buildFullCard ($la)
  {   
  if ($la["link"])
    {$ltop= "<a href=\"$la[link]\" class=\"stretched-link nodec\">";
      $lbottom = "</a>";
      $hclass =  "card-hov";}
  else
    {$ltop= "";
     $lbottom = "";
     $hclass =  "";}
        
  ob_start();      
  echo <<<END

<div class="card mb-3 $hclass">
  $ltop<div class="row no-gutters">
    <div class="col-md-4  my-auto" >
      <img src="$la[image]" class="card-img" alt="$la[ptitle]">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h4 class="card-title">$la[ptitle]</h4>
        <h5 class="card-title">$la[stitle]</h5>
        <p class="card-text">$la[comment]</p>
      </div>
    </div>
  </div>$lbottom
</div>

END;
    $html = ob_get_contents();
    ob_end_clean(); // Don't send output to client

    return ($html);
    }

function buildPresentationCard ($la)
  {  
  if ($la["link"])
    {$ltop= "<a href=\"$la[link]\">";
      $lbottom = "</a>";}
  else
    {$ltop= "";
     $lbottom = "";}
     
  $extra = "";
  
  //https://www.youtube.com/embed/
  
     
  if (isset($la["video"]))
		{
		if (preg_match("/^http[s]*[:][\/]+www[.]youtube[.]com[\/].+$/", $la["video"], $m))
			{$prev = '<div class="pcontainer"><iframe class="preview" src="'.$la["video"].
				'" title="YouTube video player" allow='.
				'"accelerometer; autoplay; clipboard-write; encrypted-media; '.
				'gyroscope; picture-in-picture" allowfullscreen></iframe></div>';}
		else
			{$vtype = pathinfo($la["video"], PATHINFO_EXTENSION);	
			 $prev = '<div class="pcontainer">
					<video class="preview" controls>
					<source src="'.$la["video"].'" type="video/'.$vtype.'">
					Your browser does not support the video tag.
					</video></div>';}
			
		if (isset($la["slides"])) 
			{$extra .= "<p>The slides for this presentation can be downloaded <a href=\"$la[slides]\">here</a></p>";}
		if (isset($la["transcript"])) 
			{$extra .= "<p>The transcript for this presentation can be downloaded <a href=\"$la[transcript]\">here</a></p>";}
		}
	else if (isset($la["slides"]))
		{$prev = '<div class="pcontainer"><iframe class="preview-iframe preview" id="preview-iframe" '.
			'src="'.$la["slides"].'"></iframe></div>';
		 if (isset($la["transcript"])) 
			{$extra .= "<p>The transcript for this presentation can be downloaded <a href=\"$la[slides]\">here</a></p>";}}
	else if (isset($la["image"]))
		{$prev = "<img src=\"$la[image]\" class=\"card-img\" alt=\"$la[ptitle]\">";}
	else
		{$prev = "";}        
         
  ob_start();      
  echo <<<END
<div class="card mb-3" style="width: 100%;">
  <div class="row no-gutters">
    <div class="col-md-4  my-auto" >
      $prev
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h4 class="card-title">$la[ptitle]</h4>
        $ltop<h5 class="card-title">$la[stitle]</h5>$lbottom
        <p class="card-text">$la[comment]</p>        
        $extra
      </div>      
    </div>
  </div>
</div>

END;
    $html = ob_get_contents();
    ob_end_clean(); // Don't send output to client

    return ($html);
    }

function BS_ColClass ($max=3)
  {
  $cno = intval($max);
  if ($cno > 12) {$cno = 12;}
  if ($cno < 1) {$cno = 1;}
  $cno = intval(12/$cno);
  $class = "col-lg-".$cno;
  return ($class);
  }

function buildSimpleCard ($la) { 
	global $maxcols;
	     
  if ($la["link"])
    {$ltop= "<a href=\"$la[link]\" class=\"stretched-link nodec\">";
     $lbottom = "</a>";
     $hclass =  "card-hov";}
  else
    {$ltop= "";
     $lbottom = "";
     $hclass =  "";}
  
  $cc = BS_ColClass ($maxcols);
  
  ob_start();      
  echo <<<END
      
  <div class="$cc col-md-6 col-sm-12  col-xs-12 mb-4 $hclass">
    <div class="card" title="$la[ptitle]">
      $ltop
      <img class="card-img-top" src="$la[image]" alt="$la[ptitle]">
      $lbottom
      <div class="card-body">
        <h5 class="card-title">$la[ptitle]</h5>
        <p class="card-text">$la[comment]</p>
      </div>
    </div>
  </div>

END;
    $html = ob_get_contents();
    ob_end_clean(); // Don't send output to client

    return ($html);
    }
    
function buildImageCard ($la) { 
	global $maxcols;
	     
  if ($la["link"])
    {$ltop= "<a href=\"$la[link]\" class=\"stretched-link nodec\">";
     $lbottom = "</a>"  ;
     $hclass =  "card-hov";}
  else
    {$ltop= "";
     $lbottom = "";
     $hclass =  "";}
  
  $cc = BS_ColClass ($maxcols);        
  
  ob_start();      
  echo <<<END
    
  <div class="$cc  col-md-6 col-sm-12  col-xs-12 mb-4 $hclass">
    <div class="card" title="$la[ptitle]">
      $ltop
      <img class="card-img-top" src="$la[image]" alt="$la[ptitle]">
      $lbottom
    </div>
  </div>

END;
    $html = ob_get_contents();
    ob_end_clean(); // Don't send output to client

    return ($html);
    }

 function buildListCard ($la) {
     global $displaychecked ;
    
     if ($la["link"])
        {$ltop= "<a href=\"$la[link]\" class=\"\">";
          $lbottom = "</a>"  ;}
    else
        {$ltop= "";
          $lbottom = "";}

    if ($la["comment"])
      {$la["comment"] = " - ".$la["comment"];}

    if ($displaychecked )
      {
      if (isset($la["checked"]) and $la["checked"])
        {$checked = "<span style=\"font-size:0.75em\">  ( last checked ".$la["checked"]." )</span>";}
      else
        {$checked = "<span style=\"font-size:0.75em\">  ( no checked date )</span>";}
      }
    else
      {$checked = "";}
        
    ob_start();      
    echo <<<END
<li>$ltop$la[ptitle]$lbottom$la[comment]$checked</li>
END;
    $html = ob_get_contents();
    ob_end_clean(); // Don't send output to client

    return ($html);
    }

function startGroupHtml ($gnm, $comment, $card, $tbc)
  {
  $html = "";
  $tag = urlencode(strtolower($gnm));
  $hno = 3;
  
  $pc = explode ("|", $gnm);
  
  if (count($pc) > 1)
    {$tbc = false;
     $gnm = $pc[1];
     $hno = 4;}  

  if ($tbc)
    {$anchor = "<a id=\"$tag\" class=\"anchor offsetanchor\" ".
        "aria-hidden=\"true\" href=\"#${tag}-TBC\"></a>";
     $alink = "<a class=\"anchor nodec\" aria-hidden=\"true\" ".
        "href=\"#${tag}-TBC\">$gnm</a>";}
  else
    {$anchor = "";
     $alink = "$gnm";}

  $gtop = "<h${hno}>$anchor$alink</h${hno}><p>".$comment."</p>";

	// this was removed to allow the maxcol value to control the number of
	// max cols for the image cards as well as the simple cards.
  /*if (in_array($card, array("image")))
    {$html  = "$gtop<div class=\"row row-cols-1 ".
      "row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5\">";}            
  else*/ if (in_array($card, array("list")))
    {$html = "$gtop<ul>";}              
  /*else if (in_array($card, array("full", "presentation")))
    {$html = "$gtop<div class=\"card-column\">";}
  else //if (in_array($card, array("simple"))) or anything else
    {$html = "$gtop<div class=\"card-deck\">";}*/
  else //if (in_array($card, array("simple"))) or anything else
    {$html = "$gtop<div class=\"row\">";}

  return ($html);
  }
    
?>
