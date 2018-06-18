
<style type="text/css">
.cloud {display: inline;list-style-type: none;width: 100%;}
.cloud li {list-style: none;display: inline; padding-left: 0px; margin-right: 5px; margin-left: 0px;}
.cloud.cloud-category li:nth-of-type(3n + 1) {font-size: 1.25em;}
.cloud li:nth-of-type(3n + 1)  a {	color: #666; }
.cloud.cloud-category li:nth-of-type(4n+3) { font-size: 1.5em; }
.cloud.cloud-category li:nth-of-type(5n - 3) { font-size: 1em; }
	
.cloud.cloud-county li:nth-of-type(4n+3) a { color: #B0BC2A; }	
.cloud.cloud-county li:nth-of-type(3n + 2)  a {	color: #930808; }	
.cloud.cloud-county li a { font-size: 1.2em; }	
</style>


<div class="page_width">
<div class="padd15_t">
<div class="subcolumns clearfix">
	<div class="col-md-8">
		<div class="padd10_r">
			<div class="box-cont-title">Resources By County</div>
			<div>
				<ul class="cloud cloud-county">
				
				<?php
				$res_county 	= $dispDt->get_resCounties(); 
				$county_links	= array();
				foreach ($res_county as $rc => $rc_arr) { 	
					$ct_name 	= $rc_arr['county'];
					$ct_seo 	= $rc_arr['county_seo'];
					$ct_docs 	= $rc_arr['num_resources']; /*county.php*/
					$link 		= '<li><a href="counties/?county='.$ct_seo.'" title="Resources: '.$ct_docs.'">'.$ct_name.' </a> </li> ';
					$county_links[] = $link;
				}
					echo implode('',$county_links);
				?>
				
		<!--<li><a href="county.php?com=5&formname=tag&county=Baringo" >Baringo</a> </li> <li><a href="county.php?com=5&formname=tag&county=Bomet" >Bomet</a> </li> <li><a href="county.php?com=5&formname=tag&county=Bungoma" >Bungoma</a> </li> <li><a href="county.php?com=5&formname=tag&county=Busia" >Busia</a> </li> <li><a href="county.php?com=5&formname=tag&county=Elgeyo-Marakwet" >Elgeyo-Marakwet</a> </li> <li><a href="county.php?com=5&formname=tag&county=Embu" >Embu</a> </li> <li><a href="county.php?com=5&formname=tag&county=Garissa" >Garissa</a> </li> <li><a href="county.php?com=5&formname=tag&county=Homa Bay" >Homa Bay</a> </li> <li><a href="county.php?com=5&formname=tag&county=Isiolo" >Isiolo</a> </li> <li><a href="county.php?com=5&formname=tag&county=Kajiado" >Kajiado</a> </li> <li><a href="county.php?com=5&formname=tag&county=Kakamega" >Kakamega</a> </li> <li><a href="county.php?com=5&formname=tag&county=Kericho" >Kericho</a> </li> <li><a href="county.php?com=5&formname=tag&county=Kiambu" >Kiambu</a> </li> <li><a href="county.php?com=5&formname=tag&county=Kilifi" >Kilifi</a> </li> <li><a href="county.php?com=5&formname=tag&county=Kirinyaga" >Kirinyaga</a> </li> <li><a href="county.php?com=5&formname=tag&county=Kisii" >Kisii</a> </li> <li><a href="county.php?com=5&formname=tag&county=Kisumu" >Kisumu</a> </li> <li><a href="county.php?com=5&formname=tag&county=Kitui" >Kitui</a> </li> <li><a href="county.php?com=5&formname=tag&county=Kwale" >Kwale</a> </li> <li><a href="county.php?com=5&formname=tag&county=Laikipia" >Laikipia</a> </li> <li><a href="county.php?com=5&formname=tag&county=Lamu" >Lamu</a> </li> <li><a href="county.php?com=5&formname=tag&county=Machakos" >Machakos</a> </li> <li><a href="county.php?com=5&formname=tag&county=Makueni" >Makueni</a> </li> <li><a href="county.php?com=5&formname=tag&county=Mandera" >Mandera</a> </li> <li><a href="county.php?com=5&formname=tag&county=Marsabit" >Marsabit</a> </li> <li><a href="county.php?com=5&formname=tag&county=Meru" >Meru</a> </li> <li><a href="county.php?com=5&formname=tag&county=Migori" >Migori</a> </li> <li><a href="county.php?com=5&formname=tag&county=Mombasa" >Mombasa</a> </li> <li><a href="county.php?com=5&formname=tag&county=Muranga" >Muranga</a> </li> <li><a href="county.php?com=5&formname=tag&county=Nairobi" >Nairobi</a> </li> <li><a href="county.php?com=5&formname=tag&county=Nakuru" >Nakuru</a> </li> <li><a href="county.php?com=5&formname=tag&county=Nandi" >Nandi</a> </li> <li><a href="county.php?com=5&formname=tag&county=Narok" >Narok</a> </li> <li><a href="county.php?com=5&formname=tag&county=Nyamira" >Nyamira</a> </li> <li><a href="county.php?com=5&formname=tag&county=Nyandarua" >Nyandarua</a> </li> <li><a href="county.php?com=5&formname=tag&county=Nyeri" >Nyeri</a> </li> <li><a href="county.php?com=5&formname=tag&county=Samburu" >Samburu</a> </li> <li><a href="county.php?com=5&formname=tag&county=Siaya" >Siaya</a> </li> <li><a href="county.php?com=5&formname=tag&county=Taita Taveta" >Taita-Taveta</a> </li> <li><a href="county.php?com=5&formname=tag&county=Tana River" >Tana River</a> </li> <li><a href="county.php?com=5&formname=tag&county=Tharaka Nithi" >Tharaka-Nithi</a> </li> <li><a href="county.php?com=5&formname=tag&county=Trans Nzoia" >Trans-Nzoia</a> </li> <li><a href="county.php?com=5&formname=tag&county=Turkana" >Turkana</a> </li> <li><a href="county.php?com=5&formname=tag&county=Uasin Gishu" >Uasin Gishu</a> </li> <li><a href="county.php?com=5&formname=tag&county=Vihiga" >Vihiga</a> </li> <li><a href="county.php?com=5&formname=tag&county=Wajir" >Wajir</a> </li> <li><a href="county.php?com=5&formname=tag&county=West Pokot" >West Pokot</a> </li> --> 
				</ul>
			</div>
		</div>
	</div>
	
	<div class="col-md-4">
		<div class="padd10_r">
			<div class="box-cont-title">Resources By Category</div>
			<div class="nano"><div class="nano-content">
				<ul class="cloud  cloud-category">
				<?php
				$res_cats 	= $dispDt->get_resTypes(); //displayArray($res_cats);
				$type_links	= array();
				foreach ($res_cats as $rc => $rc_arr) { 	
					$type_name 	= $rc_arr['download_type'];
					$type_seo 	= $rc_arr['res_type_seo'];
					$type_nums	= $rc_arr['num_resources'];
					$type_docs 	= ($rc_arr['perc_resources'] * 1.9) + 100;
					$link = '<li><a href="rescat.php?rsc='.$type_seo.'" title="Resources: '.$type_nums.'" style="font-size:'.$type_docs.'%">'.$type_name.' </a> </li> ';
					$type_links[] = $link;
				}
					echo implode('',$type_links);
				?>
				</ul>				
			</div></div>		
		</div>
	</div>
	
</div>
<div class="clearfix padd10"></div>
</div>
</div>
