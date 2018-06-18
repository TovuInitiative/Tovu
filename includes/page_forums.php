

<div class="head_widthX">
<?php include("includes/nav_crumbs.php"); ?>
</div>

<style type="text/css">
/*-------------------------------------------------------------------------------------------------------
@ FORUM
-------------------------------------------------------------------------------------------------------*/
.topic { background: none; }
.topic-post { overflow: auto; }

.table>thead>tr>th,.table>tbody>tr>th,
.table>tfoot>tr>th,.table>thead>tr>td,
.table>tbody>tr>td,.table>tfoot>tr>td,
.table td,
 table td {padding:6px 8px;line-height:1.428571429;vertical-align:top !important;border-top:1px solid #ddd; /*font-size:12px;*/}
.table, table { border:1px solid #ddd; border-width: 1px 1px; width: 100%; }
.table>thead>tr>th, table th { background: #F5F5F5; padding:6px 8px;}
	
</style>

<!-- community
================================================== -->
<section>
<div class="page_width">
  	<div class="row">
  		<div class="col-md-3">
  			<div class="padd20_tX">
  				<?php include("includes/forum/inc.forum.box.php"); ?>
  			</div>
  		</div>
  		
  		<div class="col-md-9">
  			<!--<h3>&nbsp;</h3>-->
			<div class="panel panel-default panel-alt" style="padding: 20px;">
				
				<div>
					<?php 
					//displayArray($request);
					$fc= (isset($request['fc'])) ? $request['fc'] : 'home';

					switch ($fc){
						case 'home':
							include("includes/forum/inc.forum.home.php");
							break;

						case 'category':
							include("includes/forum/inc.forum.category.php");
							break;

						case 'topic':
							include("includes/forum/inc.forum.topic.php");
							break;

						case 'reply':
							include("includes/forum/inc.forum.reply.php");
							break;
					}
					 ?>
				</div>
			</div>
  		</div>
  	</div>  	
</div>
</section>
  



