
<?php
$item_Content = '';
$forum_page = 'forums'; //'communities-of-practice';


$sql = "SELECT
    `mrfc_forum_categories`.`cat_id`
    , `mrfc_forum_categories`.`cat_name`
    , `mrfc_forum_categories`.`cat_current`
    , `mrfc_forum_categories`.`cat_published`
    , COUNT(`mrfc_forum_topics`.`topic_id`) AS `cat_topics`
    , `mrfc_forum_categories`.`cat_by`
    , `mrfc_forum_categories`.`cat_date_close`
FROM
    `mrfc_forum_categories`
    INNER JOIN `mrfc_forum_topics` 
        ON (`mrfc_forum_categories`.`cat_id` = `mrfc_forum_topics`.`topic_cat`)
WHERE (`mrfc_forum_categories`.`cat_published` =1
    AND `mrfc_forum_topics`.`topic_published` =1)
GROUP BY `mrfc_forum_categories`.`cat_id`
ORDER BY `mrfc_forum_categories`.`cat_current` DESC;";
	
$result = $cndb->dbQuery($sql);

if(!$result)
{
	$item_Content .= '<li>The categories could not be displayed, please try again later.</li>';
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		$item_Content .= '<li>No categories defined yet.</li>';
	}
	else
	{
		
		while($row = $cndb->fetchRow($result))
		{	
		
		$cat_name 	= trim(html_entity_decode(stripslashes($row['cat_name'])));	
		$cat_name 	= smartTruncateNew($cat_name, 50);
			
		$item_Content .= '<li> <div class="project_item" ><div class="project_wrap">
			<div class="project_name"><a href="'.$forum_page.'/?fc=category&id=' . $row['cat_id'] . '" class="txtbrown">' . $cat_name . '</a></div>
			<div style="position:relative;">
			<div class="project_padd"><span class="txt11">' . $row['cat_topics'] . ' topics,  ';
				
			//fetch posts
			$postssql = "SELECT  `mrfc_forum_topics`.`topic_cat` , COUNT(`mrfc_forum_posts`.`post_id`) AS `posts` , `mrfc_forum_posts`.`post_published` FROM
    `mrfc_forum_topics`
    INNER JOIN `mrfc_forum_posts`  ON (`mrfc_forum_topics`.`topic_id` = `mrfc_forum_posts`.`post_topic`)
WHERE (`mrfc_forum_topics`.`topic_cat` = " . $row['cat_id'] . " AND `mrfc_forum_posts`.`post_published` = 1)
GROUP BY `mrfc_forum_topics`.`topic_cat`, `mrfc_forum_posts`.`post_published`;";
						
			$postsresult = $cndb->dbQuery($postssql);
			if(mysqli_num_rows($postsresult))
				{ $postsrow    = $cndb->fetchRow($postsresult); $cat_posts = $postsrow['posts']; }
			else
				{ $cat_posts   = 0; }
			$item_Content .= $cat_posts . ' posts.</span>';					
			
				
			if($cat_posts > 0)
			{	
			
			$topicsql = "SELECT
    `mrfc_forum_categories`.`cat_id`
    , `mrfc_forum_topics`.`topic_id`
    , `mrfc_forum_posts`.`post_id`
    , `mrfc_forum_posts`.`post_content`
    , `mrfc_forum_posts`.`post_date`
    , `mrfc_forum_posts`.`post_by`
    , `mrfc_reg_account`.`namefirst` as `member`
FROM
    `mrfc_forum_topics`
    LEFT JOIN `mrfc_forum_categories` 
        ON (`mrfc_forum_topics`.`topic_cat` = `mrfc_forum_categories`.`cat_id`)
    INNER JOIN `mrfc_forum_posts` 
        ON (`mrfc_forum_posts`.`post_topic` = `mrfc_forum_topics`.`topic_id`)
    LEFT JOIN `mrfc_reg_account`
        ON (`mrfc_forum_posts`.`post_by` = `mrfc_reg_account`.`account_id`)
WHERE (`mrfc_forum_categories`.`cat_id` = '" . $row['cat_id'] . "' and `mrfc_forum_posts`.`post_published` = 1)
ORDER BY `mrfc_forum_topics`.`topic_date` DESC, `mrfc_forum_posts`.`post_date` DESC LIMIT 1;";
								
					$topicsresult = $cndb->dbQuery($topicsql);
				
					if(!$topicsresult)
					{
						$item_Content .= '<span class="txt11">Last post could not be displayed. </span>';
					}
					else
					{
						
						if(mysqli_num_rows($topicsresult) > 0)
						{
							while($topicrow = $cndb->fetchRow($topicsresult)) 
							{
							
							$topic_id		 = $topicrow['topic_id'];
							$post_content  	 = trim(html_entity_decode(stripslashes($topicrow['post_content'])));	
							$post_content     = smartTruncateNew(strip_tags($post_content),65);
							//$post_content = substr($topicrow['post_content'],0,40);
							
							$item_Content .= '<span class="txt11"> Last post &raquo; </span></span> <br><a href="'.$forum_page.'/?fc=topic&id=' . $topicrow['topic_id'] . '#' . $topicrow['post_id'] . '">' . $post_content . '</a> '  
							. ' <span class="txt11"><b>'. $topicrow['member'] . '</b> - ' . date('d-m-Y', strtotime($topicrow['post_date'])) . '</span>';
							}
						}
					}
			}
			
			
			$item_Content .= '</div>
				</div>
				</div> </div>&nbsp;
			</li>';
			
			
		}
	}
}

?>

<div class="panel panel-default">
    <div class="panel-heading clearfix txtleft bg-white">
       <h4 class="txt19"><i class="fa fa-comment-o txtmaroon "></i> &nbsp; Community Forums</h4>
    </div>

    <div class="panel-body">
	    <ul class="nav_side"><?php echo $item_Content; ?></ul>	
    </div>
</div>
	
	

<!--<div class="phpkb-tree">
<div class="padd5">
<div class="panel panel-default panel-alt">
	<div class="panel-headingX">
		<?php //echo display_PageTitle('Community Forums', 'h4', 'txtbrown box-cont-title'); ?>
	</div>
	<div class="panel-body">


	<div class="padd10"></div>
	</div>
</div>
</div>
</div>-->