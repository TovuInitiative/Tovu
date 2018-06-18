<!-- @begin: sitemap --> 		
<div>
<?php echo display_PageTitle('Site Map'); ?>

<div id="sidetree" class="sitemap">
<div id="sidetreecontrol">
<a title="Collapse the entire tree below" href="#" class="txt16"><img src="assets/scripts/sitemap/image/minus.gif" /> Collapse All</a> &nbsp;&nbsp; 
<a title="Expand the entire tree below" href="#" class="txt16"><img src="assets/scripts/sitemap/image/plus.gif" /> Expand All</a>
</div>

<!--<ul class="treeview" id="tree">-->
<?php
//echo $dispData->build_generalMenu(master::$menusFull, $com, $com_active, "treeview");
$nav_Sitemap = $dispData->buildMenu_Main($com_active, 6, 0, 'treeview');
echo $nav_Sitemap;
?>
<!--</ul>-->

<div class="clearfix padd10"></div>
</div>

</div>
<!-- @end: sitemap -->	