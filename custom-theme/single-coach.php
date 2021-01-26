<?php
get_header();
$coachDetails = get_post_meta(get_the_ID(), 'page_settings', true);
?>

<div class="coaches-wrap details-wrap">
      <div class="container">
        <div class="details-Box">
          <div class="row">
           <div class="col-md-4 col-sm-4 col-xs-12 head-title same-height">
			 <?php if(isset($coachDetails['coach_name']) && ($coachDetails['coach_name'] != '')) { echo '<h2>'.$coachDetails['coach_name'].'</h2>'; } ?>
           </div>
           <div class="col-md-8 col-sm-8 col-xs-12 right-box same-height">
			 <?php if(isset($coachDetails['coach_title']) && ($coachDetails['coach_title'] != '')) { echo '<div class="cool-title">'.$coachDetails['coach_title'].'</div>'; } ?>
             <div class="free-box">
               <h4>FREE WEEK!</h4>
               <a href="<?php echo ((isset($coachDetails['coach_program_link_url']) && ($coachDetails['coach_program_link_url'] != ''))?$coachDetails['coach_program_link_url']:'#'); ?>" class="start-dbtn" target="_blank">START NOW</a>
             </div>
           </div>
          </div> <!--row-->
          
          <div class="biography-box">
          
           <h3>BIOGRAPHY</h3>
            <?php if(isset($coachDetails['listing_page_coach_description']) && ($coachDetails['listing_page_coach_description'] != '')) { echo wpautop($coachDetails['listing_page_coach_description']); } ?>
          
          </div> <!--biography-box-->
          
          <div class="row">
           <div class="col-md-4 col-sm-4 col-xs-12 head-title gallery-title">
            <h3>QUALIFICATIONS</h3>
			<?php
			if(isset($coachDetails['coach_qualification']) && ($coachDetails['coach_qualification'] != '')) {
				$qualifications = preg_split('/$\R?^/m', trim($coachDetails['coach_qualification']));						
				if(is_array($qualifications)) {
					echo '<ul>';
					//sort($qualifications, SORT_NATURAL | SORT_FLAG_CASE);	
					foreach($qualifications as $qualification) {
						if(trim($qualification) != '') {
							echo '<li>'.trim($qualification).'</li>';
						}
					}
					echo '</ul>';
				}
			}
			?>
           </div>
           <div class="col-md-8 col-sm-8 col-xs-12 right-box gallery-box">
             <h3>PHOTO GALLERY</h3>
             <div class="owl-carousel owl-theme gallery-slider">     
			   <?php
			   for($i = 1; $i <= 10; $i++) {
				   if(isset($coachDetails['coach_gallery_photo_'.$i]) && ($coachDetails['coach_gallery_photo_'.$i] != '')) {
					   echo '<div class="item">';
							echo '<img src="'.get_optimized_image($coachDetails['coach_gallery_photo_'.$i], array(187, 182)).'" alt=""/>';
					   echo '</div>';
				   }
			   }
			   ?>
            </div>
          
           </div>
          </div> <!--row--> 
         
         <div class="transformation-wrap">   
          <h3>transformations</h3>   
		  <?php
		  $transformations = $coachDetails['transformations'];
		  if(isset($transformations) && is_array($transformations)) {			  
			  $index = 1;
			  foreach($transformations as $transformation) {
				   if((($index - 1) % 3) == 0) {
					   echo '<div class="row">';
				   }
				   $transformationDetails = get_post_meta($transformation, 'page_settings', true);
				   echo '<div class="col-md-4 col-sm-4 col-xs-12 item-box item-box'.((($index - 1) % 3) + 1).'">';
					 echo '<div class="box">';
					   $beforeNafterImage = '';
					   if(isset($transformationDetails['listing_page_transformations_before_n_after_image']) && ($transformationDetails['listing_page_transformations_before_n_after_image'] != '')) {
							  $beforeNafterImage = ' style="background-image: url('.get_optimized_image($transformationDetails['listing_page_transformations_before_n_after_image'], array(386, 386)).');"';
					   }
					   echo '<div class="image-box"'.$beforeNafterImage.'></div>';
					   echo '<div class="text-box">';
							if(isset($transformationDetails['listing_page_transformations_name']) && ($transformationDetails['listing_page_transformations_name'] != '')) {
								echo '<h3>'.$transformationDetails['listing_page_transformations_name'].'</h3>';
							}
							if(isset($transformationDetails['listing_page_transformations_description']) && ($transformationDetails['listing_page_transformations_description'] != '')) {
								echo wpautop($transformationDetails['listing_page_transformations_description']);
							}
					   echo '</div>';
					 echo '</div>';
				   echo '</div>';
				   $index++;
				   if((($index - 1) % 3) == 0) {
					    echo '</div>';
						if((($index - 1) % 6) == 0) {
							echo '<div class="row">';
							 echo '<div class="details-free-wrap">';
								echo '<div class="free-wrap">';
								 echo '<h2>Ready for your free week?</h2>';
								 echo '<div class="start-btn"><a href="'.((isset($coachDetails['coach_program_link_url']) && ($coachDetails['coach_program_link_url'] != ''))?$coachDetails['coach_program_link_url']:'#').'" class="start-dbtn" target="_blank">START NOW ></a></div>';
								echo '</div>';
								echo '<div class="card-wrap">';
								 echo '<ul>';
									 echo '<li>';
										 echo '<div class="image"><img src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></div>No Credit Card';
									 echo '</li>';
									 echo '<li>';
										 echo '<div class="image"><img src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></div>No Commitment';
									 echo '</li>';
									 echo '<li>';
										 echo '<div class="image"><img src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></div>No Strings Attached!';
									 echo '</li>';
								 echo '</ul>';
							   echo '</div>';
							 echo '</div>';
							echo '</div> <!--details-Box-->';
						}
				   }
			  }
			  if((($index - 1) % 3) != 0) {
				echo '</div>';
				echo '<div class="row">';
				 echo '<div class="details-free-wrap">';
					echo '<div class="free-wrap">';
					 echo '<h2>Ready for your free week?</h2>';
					 echo '<div class="start-btn"><a href="'.((isset($coachDetails['coach_program_link_url']) && ($coachDetails['coach_program_link_url'] != ''))?$coachDetails['coach_program_link_url']:'#').'" class="start-dbtn" target="_blank">START NOW ></a></div>';
					echo '</div>';
					echo '<div class="card-wrap">';
					 echo '<ul>';
						 echo '<li>';
							 echo '<div class="image"><img src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></div>No Credit Card';
						 echo '</li>';
						 echo '<li>';
							 echo '<div class="image"><img src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></div>No Commitment';
						 echo '</li>';
						 echo '<li>';
							 echo '<div class="image"><img src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></div>No Strings Attached!';
						 echo '</li>';
					 echo '</ul>';
				   echo '</div>';
				 echo '</div>';
				echo '</div> <!--details-Box-->';
			  }
		  }
		  ?>          
         </div>  <!-- transformation-wrap -->
      </div> <!--container-->
    </div> <!--details-wrap-->
    
<div class="container difference-wrap pack-wrap">
			<h3>6-Pack Macro</h3>
			<h2>COACH difference</h2>
			
		   <div class="row">
			 <div class="col-md-4 col-sm-4 col-xs-12">
			 	<div class="text-box" style="height: 209.45px;">
		  			<h4>custom workouts <br> tailored just for you</h4>
		  			<ul>
		  				<li>Gym Exercises</li>
		  				<li>Body Weight Workouts</li>
		  				<li>Custom Home Routines</li>
		  			</ul>
			 	</div>
		  	 </div>
		  
			 <div class="col-md-4 col-sm-4 col-xs-12">
			 	<div class="text-box" style="height: 209.45px;">
		  			<h4>macro-based <br> Nutrition plans</h4>
		  			<ul>
		  				<li>Choose foods you already enjoy</li>
		  				<li>Build in cheat meals</li>
		  				<li>Flexibility to eat out at restaurants</li>
		  			</ul>
			 	</div>
		  	 </div>
		  	 		   
			 <div class="col-md-4 col-sm-4 col-xs-12">
			 	<div class="text-box" style="height: 209.45px;">
		  			<h4>Structure <br> &amp; Accountability</h4>
		  			<ul>
		  				<li>Check Ins via text, Facetime, phone</li>
		  				<li>Structured weekly routines</li>
		  				<li>Adjustments if you fall off course</li>
		  			</ul>
			 	</div>
		  	 </div>		   
		   
		   </div> <!-- row -->
		   
		   <div class="row">
			 <div class="col-md-4 col-sm-4 col-xs-12">
			 	<div class="text-box" style="height: 209.45px;">
		  			<h4>100% accuracy <br> not required</h4>
		  			<ul>
		  				<li>Results can be obtained if plan<br> followed &gt; 80%</li>
		  				<li>Face obstacles adjusting to lifestyle</li> 
		  			</ul>
			 	</div>
		  	 </div>
		  
			 <div class="col-md-4 col-sm-4 col-xs-12">
			 	<div class="text-box" style="height: 209.45px;">
		  			<h4>Motivation <br> &amp; Inspiration</h4>
		  			<ul>
		  				<li>Coaches always there to motivate and inspire you</li>
		  				<li>Unlimited access to expertise &amp; advice</li> 
		  			</ul>
			 	</div>
		  	 </div>
		  	 		   
			 <div class="col-md-4 col-sm-4 col-xs-12">
			 	<div class="text-box" style="height: 209.45px;">
		  			<h4>Constant monitoring <br> &amp; adjustment</h4>
		  			<ul>
		  				<li>Workouts updated frequently</li>
		  				<li>Nutrition plans monitored &amp; updated</li>
		  				<li>Track &amp; accurately measure progress</li>
		  			</ul>
			 	</div>
		  	 </div>		   
		   
		   </div> <!-- row -->
		   
		   <div class="free-wrap weekWrap">
		   	<h2>Get a FREE WEEK!</h2>
            <ul>
		   		<li>
		   			<div class="image"><noscript><img src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></noscript><img class="lazyload" src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220%200%20210%20140%22%3E%3C/svg%3E" data-src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></div>No Credit Card 
		   		</li>
		   		<li>
		   			<div class="image"><noscript><img src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></noscript><img class="lazyload" src="data:image/svg+xml,%3Csvg%20xmlns=%22http://www.w3.org/2000/svg%22%20viewBox=%220%200%20210%20140%22%3E%3C/svg%3E" data-src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></div>No Commitment
		   		</li>
		   		<li class="attached-text">
		         	No Strings Attached!
		   		</li>
		   	</ul>
		   	<div class="start-btn"><a href="<?php echo ((isset($coachDetails['coach_program_link_url']) && ($coachDetails['coach_program_link_url'] != ''))?$coachDetails['coach_program_link_url']:'#'); ?>" class="start-dbtn" target="_blank">START NOW &gt;</a></div>
		   </div>
		   


                    <div class="free-wrap">
		   	<h2>Ready for your free week?</h2>
		   	<div class="start-btn"><a href="<?php echo ((isset($coachDetails['coach_program_link_url']) && ($coachDetails['coach_program_link_url'] != ''))?$coachDetails['coach_program_link_url']:'#'); ?>" class="start-dbtn" target="_blank">START NOW &gt;</a></div>
		   </div>
		   
		   <div class="card-wrap">
		   	<ul>
		   		<li>
		   			<div class="image"><noscript><img src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></noscript><img class=" lazyloaded" src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg" data-src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></div>No Credit Card
		   		</li>
		   		<li>
		   			<div class="image"><noscript><img src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></noscript><img class=" lazyloaded" src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg" data-src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></div>No Commitment
		   		</li>
		   		<li>
		   			<div class="image"><noscript><img src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></noscript><img class=" lazyloaded" src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg" data-src="https://6packmacros.com/wp-content/themes/monawar/images/checked.svg"></div>No Strings Attached!
		   		</li>
		   	</ul>
		   </div>
		   
		</div>
    
	
</div> 


<?php get_footer(); ?>