
<?php
//echobr(REF_ACTIVE_URL);

$active_url = ( substr(REF_ACTIVE_URL, 0, 2) == 'aj' ) ? 'forums/' : REF_ACTIVE_URL;
    
    
//$crit_list 	  = " WHERE `cat_current` = 1 and `cat_published` = 1 limit 0, 1 ";
$crit_list 	  = " WHERE `cat_published` = 1 ";

if($id) 
{
	$crit_list = " WHERE (cat_id = ".q_si($id).") and `cat_published` = 1 limit 0, 1  "; 
}

if(isset($request['fsec']) )
{
	$crit_list = " WHERE (committee_id IN (".$request['fsec'].") ) and `cat_published` = 1 "; 
}


$sql = "SELECT
			cat_id,
			cat_name,
			cat_description
		FROM
			mrfc_forum_categories
		". $crit_list ." ; ";
//echobr($sql);			

$result = $cndb->dbQuery($sql);

if(!$result)
{
	echo 'No discussion to display'; 
	//echo 'The category could not be displayed, please try again later.' . mysql_error();
}
else
{
	if(mysqli_num_rows($result) == 0)
	{
		echo 'No discussion to display'; //'This category does not exist.';
	}
	else
	{
		
		//display category data
		while($row = $cndb->fetchRow($result))
		{
			$cat_id 	= $row['cat_id'];
			$cat_title 	= trim(html_entity_decode(stripslashes($row['cat_name'])));
			$cat_desc 	= trim(html_entity_decode(stripslashes($row['cat_description'])));
			
			//echo display_PageTitle($cat_title, 'h1', 'txtgraylight txt24');
            echo '<h1><a class="txtgraylightX txt24" href="'.$active_url.'?fc=category&id='.$cat_id.'">'.$cat_title.'</a></h1>';
			
			if($cat_desc <> ''){
			echo '<div class="jtrunc trunc1200">' . $cat_desc . '</div><br>';
			}
			echo '<h4>Questions / Topics in &prime;' . trim(html_entity_decode(stripslashes($row['cat_name']))) . '&prime; </h4>';
		
	
            //do a query for the topics
            $sq_topics = "SELECT	
                        topic_id,
                        topic_subject,
                        topic_date,
                        topic_cat
                    FROM
                        mrfc_forum_topics
                    WHERE
                        topic_cat = " . q_si($cat_id)." AND `topic_published` =1 ORDER BY topic_date DESC limit 0,3";


            $rs_topics = $cndb->dbQuery($sq_topics);

            if(!$rs_topics)
            {
                echo 'The topics could not be displayed, please try again later.';
            }
            else
            {
                if(mysqli_num_rows($rs_topics) == 0)
                {
                    echo 'There are no topics in this category yet.';
                    
                }
                else
                {
                    //prepare the table
                    echo '<table border="1">
                          <!--<tr>
                            <th>Topic</th>
                            <th>Created at</th>
                          </tr>-->';	

                    while($row = $cndb->fetchRow($rs_topics))
                    {
                        $topic_posts = 0;
                        $posts_sql = "SELECT COUNT(`post_id`) AS `post_num`, `post_topic`, `post_published` FROM `mrfc_forum_posts` WHERE (`post_topic` = ". $row['topic_id'] ." AND `post_published` =1) GROUP BY `post_topic`, `post_published`;";

                        $posts_result = $cndb->dbQuery($posts_sql);
                        if(mysqli_num_rows($posts_result) == 1) 
                        {
                            $cn_posts_result = $cndb->fetchRow($posts_result);
                            $topic_posts = $cn_posts_result[0];
                        }				
                        echo '<tr>';
                            echo '<td class="leftpartX txt14">';
                            // echo '<div class=""><a href="'.$active_url.'' . $com_base . 'fc=topic&id=' . $row['topic_id'] . '">' . 
                                echo '<div class=""><a href="'.$active_url.'?fc=topic&id=' . $row['topic_id'] . '">' . trim(html_entity_decode(stripslashes($row['topic_subject']))) . '</a><div>' . $topic_posts . ' contributions ';
                            echo '</td>';
                            //echo '<td class="rightpart">';
                            //	echo ''; //date('d-m-Y, H:i', strtotime($row['topic_date']));
                            //echo '</td>';
                        echo '</tr>';
                    }

                    echo '</table>';
                }
            }
            echo '<hr>';
        }    
	}
}

?>
