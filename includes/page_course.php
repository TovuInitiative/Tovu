

<div>
<?php include("includes/nav_crumbs.php"); ?>
</div>

<!-- style="background-color: #3c3836; background-repeat: no-repeat; background-image: url(assets/image/gallery/bann3.jpg); background-attachment: scroll; background-position: top left; "-->
<div class="page_width nopadd single-course">


	<div style="background-color: #3c3836; background-repeat: no-repeat; background-image: url(assets/image/gallery/bann3.jpg); background-attachment: scroll; background-position: top left; ">
	
	<div class="" style="opacity: 0.8; background-color: #000000;">
	
		<div class="padd15 padd0_b">
		<div class="subcolumns clearfix" style="overflow:visible;">


			<div class="col-md-9 nopadd" >


				<div class="padd15_r padd15_l" style="min-height:300px;">

					<div id="wrapper" class="">
					<?php 
						/*echobr($item);
						displayArray($currCont);*/
					?>
						<div class="col-md-12 " id="course-header">
							<h1 class="txt35"><?php echo $currCont['title']; ?></h1>
							<h5 class="txt24"><?php echo $currCont['article']; ?></h5>
							<hr>

							<div class="col-md-7 nopadd">
								<div class="course-price">
									<div class="col-md-6 padd0_l">
									<p>Cost per delegate</p>
									<p><?php echo $currCont['extras']['cost']; ?></p>
									</div>
									<div class="col-md-6 txtcenter">
									<p>Duration</p>
									<p><?php echo $currCont['extras']['duration'].' '.$currCont['extras']['duration_type']; ?></p>
									</div>
								</div>
							</div>

							<div class="col-md-5">
								<div class="course_download_wrapper">
								<a class="btn btn-danger"><i class="fa fa-file-pdf-o txt16"></i> Download the full course schedule</a>
								</div>
							</div>

						</div>
						
						<div class="col-md-12">&nbsp;</div>

						<div class="col-md-9 nopadd">
							<!-- Nav tabs -->
								<ul class="nav nav-tabs nav-justified" id="myTab">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" data-href="#panel1" role="tab">Description</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" data-href="#panel2" role="tab">Locations and Dates</a>
									</li>
								</ul>
						</div>
					</div>

				</div>
			</div>

			

		</div>
		</div>

	</div>
	
	</div>
	
	<div class="clearfix padd20_l padd20_r">
		
		<div class="col-md-9">
		
				<!-- Tab panels -->
				<div class="tab-content card padd0_20">
					<!--Panel 1-->
					<div class="tab-pane fade in show active" id="panel1" role="tabpanel">
						<br>						
							<div class="tab_inner_content invers-color" itemprop="text">
							
							<h3>Who is it for?</h3>
								<?php echo $currCont['extras']['target']; ?>

							<h3>What does it cover?</h3>
								<?php echo $currCont['extras']['coverage']; ?>		

							<h3>Benefits of attending this course</h3>
								<?php echo $currCont['extras']['benefits']; ?>		
								<p></p>		
								<!--<p class="txtcenter"><?php //echo getContGalleryPic($currCont['id'], $currCont['title'], '_cont', 'width="60%" height="473"'); ?></p>-->
								<p></p>

							<h3>Registering for this course</h3>
								<?php echo $currCont['extras']['joining']; ?>		




							</div>
					</div>
					<!--/.Panel 1-->
					
					
					
					
					
					
					
					
					<!--Panel 2-->
					<div class="tab-pane fade" id="panel2" role="tabpanel">
						<br>
						<div class="padd15">
							
							<h3 class="bold">This Course runs consecutively over <?php echo $currCont['extras']['duration']; ?> Days</h3>
							<p></p>
							<?php

							$sqList = "SELECT `date`, `location`, `venue`, `status` FROM `mrfc_dt_content_dates` WHERE `id_content` = ".q_si($currCont['id'])."
							ORDER BY `date` ASC;";

							//getData($disp_query, $redirect, $disp_front = 0, $title_trunc = 80, $id_label = "id", $blank=0) 
							echo $m2_data->getData($sqList,"#", 1);
							//&id=".$id."

							?>
					
						</div>
					</div>
					<!--/.Panel 2-->
					
					
					
				</div>
                
			<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('#myTab a').click(function (e) {
					  //e.preventDefault();
					$('#myTab a').removeClass("active");
					var tab_id = $(this).attr('data-href'); /*alert(tab_id);*/
					$('.tab-pane').removeClass("in").removeClass("active").removeClass("show").hide();		   
					$(tab_id).show().addClass("in").addClass("active").addClass("show");
					$(this).addClass('active');
				
				});
			});
			</script>
			
			<p>&nbsp;</p>
			<?php include("includes/nav_social_share.php");  ?>
		</div>		
		
		
		
		
		<div class="col-md-3">
			
			<?php
			/*echo '<div class="padd20_t">';
			include("includes/nav_downloads-latest.php");
			echo '</div>'*/;
			?>
			
			<div class="padd15"></div>
			<?php include("includes/form.enquiry.course.php");  ?>
			
		</div>
	</div>



</div>









