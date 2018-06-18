<div class="article-area">

<?php //echo display_PageTitle('Search Results'); ?>

<div id="articleContent">
<div class="category-articles"><div class="section-title">

<?php echo display_PageTitle('Search Results'); ?>
</div></div><div>

<?php
//echo $_POST['searchtext'];
if (isset($_GET['searchtext']) and $_GET['searchtext'] <> "Search this site")
{
	$post  = array_map("filter_data", $_GET);
		
    if(trim($post['searchtext']) <> @$_SESSION['searchtext'] and strlen(trim($post['searchtext'])) >= 2)
	{
		$searchtext = $post['searchtext']; //htmlentities(addslashes(trim($_POST['searchtext'])));
		$_SESSION['searchtext'] = $searchtext;
	}
	else
	{ }
} else 
{ 
$searchtext = NULL;
}

if($_SESSION['searchtext']) { $searchtext = $_SESSION['searchtext']; } else { $searchtext = NULL; }
if($searchtext  and $searchtext <> "Search this site")
{	include("includes/inc.cont.search.results.php"); }
else
{	echo "<div class=\"wrap_alert\" id=\"box_alert\"><div class=\"wrap_alertb\">Enter text to search.</div></div>"; }
?>

</div>
</div></div>
    