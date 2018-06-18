<style>
section#news .article{padding-left:3.226%;margin-top:34px;margin-bottom:0;width:25%;}
section#news .article.interview img{position:static}
section#news .article.x2{width:50%}
section#news .article.full time{display:none}
	
	.short{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:relative;/* width:270px;*/ height:360px;}
.short .wrapper{height:100%;position:relative;-webkit-box-shadow:0 1px 1px #ddd;box-shadow:0 1px 1px #ddd;color:#333}
.short .content{padding:13px 25px;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:absolute;bottom:0;min-height:45%;background:#fff;width:100%}
.short .being_processed{position:absolute;width:100%;height:100%}
.short time{font-size:14px;color:#ababab;margin-bottom:3px;display:block}
.short h2{font-size:18px;text-align:left;z-index:2;position:relative;line-height:1.2;font-weight:normal;}
.short h2 a{color:#333}
.short .more{font-size:16px;margin-top:10px;display:inline-block}
.short img{max-width:100%;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}

.short .event-flag .day{display:block;font-family:'aw-conqueror-carved-one',sans-serif;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;font-weight:normal;font-size:36px}
.short .bg{height:55%;}
/*.short .bg img{display:none}*/
.short p{padding:0;/*display:none;*/}
.short p a{color:#333}
.short footer{display:none}
.short.full.loading .wrapper{background:transparent}
.short.full .wrapper{background:#000;}
.short.full .wrapper p{color:#fff}
.short.full a:hover h2{color:#04cdae}
.short.full .content{background:-webkit-gradient(linear, left top, left bottom, color-stop(0.4, rgba(0,0,0,0)), color-stop(0.8, rgba(0,0,0,0.5)));background:-webkit-linear-gradient(top, rgba(0,0,0,0) 40%, rgba(0,0,0,0.5) 80%);background:-moz-linear-gradient(top, rgba(0,0,0,0) 40%, rgba(0,0,0,0.5) 80%);background:-o-linear-gradient(top, rgba(0,0,0,0) 40%, rgba(0,0,0,0.5) 80%);background:-ms-linear-gradient(top, rgba(0,0,0,0) 40%, rgba(0,0,0,0.5) 80%);background:linear-gradient(top, rgba(0,0,0,0) 40%, rgba(0,0,0,0.5) 80%);top:0;padding-left:4px;padding-right:4px;text-shadow:0 2px 3px rgba(0,0,0,0.4);}
.short.full .content .more{display:none}
.short.full .content time{display:none}
.short.full .bg{height:100%;width:100%;position:absolute;top:0;left:0;opacity:1;-ms-filter:none;filter:none}
.short.full img{height:100%;width:100%;position:absolute;z-index:0}
.short.full h2{font-size:18px;z-index:2;position:absolute;bottom:25px;padding:0 25px;width:100%;text-align:center;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;font-family:'aw-conqueror-carved-one',sans-serif;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;font-weight:normal;color:#fff}
.short.full footer{background:#fff;height:60px;position:absolute;display:none;bottom:0;width:100%;padding:20px 0 0 0;-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;font-size:16px;}
.short.full footer a{display:block;text-align:center;color:#fe3f00}

</style>


<?php

$item_Content = '';

$section_items 	= master::$contMain['front']; //master::$menuToContents[11]; //master::$contMain['section'][2];
$section_pages 	= array_chunk($section_items, 4, true);

if(count($section_pages)) 
{
	$boxes_home = '';
	$boxes_home_long = '';
	$truncFilter 	 = ""; //<a>,<br>,,<strong>,<b><img>
	$truncChars 	  = 90;
	if($this_page == 'index.php') { $truncChars = 100; }
	
	$contPages 		= $section_pages[0];
	//array_sort_by_column($newsItems, 1);
	
	$loopNum 		= 1;
	
	
	foreach ($contPages  as $contVal) 						
	{
		$itemArr	        = master::$contMain['full'][$contVal]; //displayArray($itemArr);
		$cont_id			= $itemArr['id'];
		$cont_parent_id	 = $itemArr['id_menu'];
		$cont_title		 = smartTruncateNew($itemArr['title'],200); 
		
		$cont_title_sub	 = $itemArr['title_sub'];
		$cont_date		  = $itemArr['modified'];
		
		$cont_article		= $itemArr['article'];
		$cont_brief_plain 	= smartTruncateNew(strip_tags($cont_article),$truncChars);
		
		$item_link	   	 = display_linkArticle($cont_id, $itemArr['link_seo']);	
		$other_link		= @$itemArr['extras']['other_link'];
		if($other_link <> '') {
			$item_link = 'href="'.$other_link.'"';
		}
		$sector			= '';
		/*$sector_id		 = $itemArr['sector_id'];
		$sector			= ($sector_id <> '') ? $ddSelect->getProjectParents('sectors', $sector_id) : 'News';
		if($sector <> '') { $sector = '<span class="highbtn hcont">'.$sector.'</span>';}*/
		
/*-------------------------------------------------------------------------------------------------------
@CONTENT IMAGE
-------------------------------------------------------------------------------------------------------*/
		
$image_disp = ''; $image_link = '';

if(preg_match('/<img[^>]+\>/i',$cont_article,$regs)) { 
	$image_item = $regs[0];  $pic_small  = autoThumbnail($image_item); 	
	if($pic_small <> '') { $image_link  = '<img src="'.$pic_small.'" alt="'.$cont_title.'" style="width:100%;height:100%;max-height:200px;" />'; } 
} 
else { $image_link  = getContGalleryPic($cont_id, $cont_title, '', ' class="story listing " data-behavior="bgfill" '); }

if($image_link == '') { $image_link = '<img src="image/logo_cont.jpg" alt="'.$cont_title.'" />'; }
if($image_link <> '') {  } 
$image_disp		= '<span class="bitChopa" style="display:none">'.$image_link.'</span>';

/*-------------------------------------------------------------------------------------------------------
@@ END: CONTENT IMAGE
-------------------------------------------------------------------------------------------------------*/ 
	
	
		$title_sub		= '';
		$title_date		= '<span class="scrollDate txtgreen txt10">'.$cont_date.' - </span>';
	
		
		if($loopNum <= 4)	
		{
			/*<time datetime="2017-06-21" pubdate="">'.$title_date.'</time>*/
			$item_Content .=  '<div class="col-md-4"><div class="article short">
					<a '.$item_link.'>
						<div class="wrapper"><span class="bg added" style="background-image: url(assets/image/strategy.jpg);">'.$image_link.'</span>
							<div class="content">
								<h2><span>'.$cont_title.'</span></h2>
								<p class="article__intro">'. $cont_brief_plain .'</p>
							</div>
							<footer></footer>
						</div>
					</a>
				</div></div>'; 
		}
			
		$loopNum += 1;
	
	}
	


$boxEqualize = '';
$boxTitleClass = 'box_title box_pink';

}
?>


<?php echo display_PageTitle('What we do', 'h3', 'txtgray txtcenter linegray '); ?>

<div class="news">
	<div class="group">
		<?php echo $item_Content; ?>
		
	</div>
</div>