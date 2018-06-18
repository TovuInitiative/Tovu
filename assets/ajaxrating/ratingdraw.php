<?php 
if(!isset($cndb)){
    require("../../classes/cls.config.php");
}
/*
Page:           _drawrating.php
Created:        Aug 2006
Last Mod:       Mar 18 2007
The function that draws the rating bar.
--------------------------------------------------------- 
ryan masuga, masugadesign.com
ryan@masugadesign.com 
Licensed under a Creative Commons Attribution 3.0 License.
http://creativecommons.org/licenses/by/3.0/
See readme.txt for full credit details.
--------------------------------------------------------- */
function rating_bar($id, $rcat='',$units='',$static='') { 
$cndb = new master();
require('ratingconfig.php'); // get the db connection info
	
//set some variables
$ip = ($_SERVER['REMOTE_ADDR'] == '::1') ? '127.0.1.1' : $_SERVER['REMOTE_ADDR'];
if (!$rcat) {$rcat = 'pub_resource';} 
if (!$units) {$units = 5;}
if (!$static) {$static = FALSE;}

// get votes, values, ips for the current rating bar
$query = $cndb->dbQuery("SELECT total_votes, total_value, used_ips FROM $rating_dbname.$rating_tableName WHERE rec_category='$rcat' AND rec_id='$id' ");


// insert the id in the DB if it doesn't exist already
// see: http://www.masugadesign.com/the-lab/scripts/unobtrusive-ajax-star-rating-bar/#comment-121
if ($cndb->recordCount($query) == 0) {
//$sql = "INSERT INTO $rating_dbname.$rating_tableName (`rec_category`, `rec_id`, `total_votes`, `total_value`, `used_ips`) VALUES ('$rcat', '$id', `total_votes`+1, `total_value`+$units, '$ip')";
$sql = "INSERT INTO $rating_dbname.$rating_tableName (`rec_category`, `rec_id`, `total_votes`, `total_value`, `used_ips`) VALUES ('$rcat', '$id', '0', '0', '')";
$result = $cndb->dbQuery($sql);
}

$numbers = $cndb->fetchRow($query);

//print_r($numbers); exit;

if ($numbers['total_votes'] == 0) {
	$count = 0;
} else {
	$count=$numbers['total_votes']; //how many votes total
}
$current_rating=$numbers['total_value']; //total number of rating added together and stored
$tense=($count==1) ? "vote" : "votes"; //plural form votes/vote

// determine whether the user has voted, so we know how to draw the ul/li
$voted=$cndb->recordCount($cndb->dbQuery("SELECT used_ips FROM $rating_dbname.$rating_tableName WHERE used_ips LIKE '%".$ip."%' AND rec_category='$rcat' AND rec_id='".$id."' ")); 

// now draw the rating bar
$curr_rate_count = ($count > 0) ? $current_rating/$count : 0;
$rating_width = 0; //number_format($curr_rate_count,2)*$rating_unitwidth;
$rating1 = number_format($curr_rate_count,1);
$rating2 = number_format($curr_rate_count,1);


if ($static == 'static') {

		$stat_width  = $rating_unitwidth * $units;
		$static_rater = array();
		$static_rater[] .= "\n".'<div class="ratingblock">';
		$static_rater[] .= '<div id="unit_long'.$id.'">';
		$static_rater[] .= '<ul id="unit_ul'.$id.'" class="unit-rating" style="width:'.$stat_width.'px;">';
		$static_rater[] .= '<li class="current-rating" style="width:'.$rating_width.'px;" title="Currently '.$rating2.'/'.$units.'"> </li>';
		$static_rater[] .= '</ul> <em class="txtgraylight txt11"> &nbsp;'.$count.' '.$tense.' </em>';
		//$static_rater[] .= '<p class="static">'.$id.'. Rating: <strong> '.$rating1.'</strong>/'.$units.' ('.$count.' '.$tense.' cast) <em>This is \'static\'.</em></p>';
		$static_rater[] .= '</div>';
		$static_rater[] .= '</div>'."\n\n";

		return join("\n", $static_rater);


} else {

      $rater ='';
      $rater.='<div class="ratingblock">';

      $rater.='<div id="unit_long'.$id.'">';
      $rater.='  <ul id="unit_ul'.$id.'" class="unit-rating" style="width:'.$rating_unitwidth*$units.'px;">';
      $rater.='     <li class="current-rating" style="width:'.$rating_width.'px;">Currently '.$rating2.'/'.$units.'</li>';

      for ($ncount = 1; $ncount <= $units; $ncount++) { // loop from 1 to the number of units
           if(!$voted) { // if the user hasn't yet voted, draw the voting stars
              $rater.='<li><a href="./assets/ajaxrating/ratingpost.php?j='.$ncount.'&amp;q='.$id.'&amp;t='.$ip.'&amp;c='.$units.'&amp;rc='.$rcat.'" title="'.$ncount.' out of '.$units.'" class="r'.$ncount.'-unit rater" rel="nofollow">'.$ncount.'</a></li>';
           }
      }
      $ncount=0; // resets the count
	
	  $rater.='  </ul>';
      $rater.='  <span style="display:inline-block;" ';
      if($voted){ $rater.=' class="voted"'; }
      //$rater.='>'.$id.' Rating: <strong> '.$rating1.'</strong>/'.$units.' ('.$count.' '.$tense.' cast)';
	  //$rater.='>Rating: <strong>'.$rating1.'</strong> ('.$count.' '.$tense.')';
	  $rater.='> &nbsp; '.$count.' &nbsp;<i class="fa fa-user"></i>';
      $rater.='</span>';
      $rater.='</div>';
      $rater.='</div>';
      return $rater;
 }
}
?>