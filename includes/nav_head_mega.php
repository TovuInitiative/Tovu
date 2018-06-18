
<div>
<ul class="sf-menu sf-menu-main sf-menu-right sf-arrows">
<?php
$nav_head_main = $dispData->buildMenu_Main($com_active, 1, 0, 'nav_top') . '<li class="button-search"><a id="slide-search" title="Search"><i class="fa fa-search txt17"></i></a></li>';
//echo $nav_head_main;
?>

<!--<li class="button-search"><a id="slide-search" title="Search"><i class="fa fa-search txt17"></i></a></li>-->

</ul>
</div>
<script type="text/javascript">
var menu_main = '<?php echo str_replace("'","",$nav_head_main) ; ?>';
</script>