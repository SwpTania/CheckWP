<?php
/*
Template Name: Coaches
*/
get_header();
?>

<div class="coaches-wrap">
	 <div class="container">
		<h1>OUR <b>COACHES</b></h1>
		<?php
		$coaches = get_posts(array(
			'numberposts' => -1,
			'post_type'   => 'coach',
		));
		if(isset($coaches) && is_array($coaches)) {
			foreach($coaches as $coach) {
				$coachDetails = get_post_meta($coach->ID, 'page_settings', true);
				echo '<div class="expertWrap">';
				  echo '<div class="row">';
						echo '<div class="col-md-3 col-sm-12 col-xs-12 box">';
							if(isset($coachDetails['listing_page_coach_before_n_after_image']) && ($coachDetails['listing_page_coach_before_n_after_image'] != '')) {
								echo '<a class="image-box" href="'.get_the_permalink($coach->ID).'" style="background-image: url('.get_optimized_image($coachDetails['listing_page_coach_before_n_after_image'], array(300, 300)).');"></a>';
							}
						echo '</div>';
						echo '<div class="col-md-9 col-sm-12 col-xs-12 box2">';
							echo '<div class="text-box">';
								echo '<div class="row">';
								  echo '<div class="col-md-5 col-sm-12 col-xs-12 head-title">';
									if(isset($coachDetails['listing_page_coach_name']) && ($coachDetails['listing_page_coach_name'] != '')) {
										echo '<h2><a href="'.get_the_permalink($coach->ID).'">'.$coachDetails['listing_page_coach_name'].'</a></h2>';
									}
								  echo '</div>';
								  echo '<div class="col-md-7 col-sm-12 col-xs-12 title-position">';
									if(isset($coachDetails['listing_page_coach_qualification']) && ($coachDetails['listing_page_coach_qualification'] != '')) {
										echo '<h3>'.$coachDetails['listing_page_coach_qualification'].'</h3>';
									}
								  echo '</div>';
								  
								echo '</div> <!-- row -->';	
								echo '<div class="text">';
									echo '<div class="row">';
									  echo '<div class="col-md-8 col-sm-12 col-xs-12 head-title">';
										if(isset($coachDetails['listing_page_coach_title']) && ($coachDetails['listing_page_coach_title'] != '')) {
											echo '<h4>'.$coachDetails['listing_page_coach_title'].'</h4>';
										}
										if(isset($coachDetails['listing_page_coach_description']) && ($coachDetails['listing_page_coach_description'] != '')) {
											echo wpautop(substr($coachDetails['listing_page_coach_description'], 0, 380).'...<label><a href="'.get_the_permalink($coach->ID).'">read more</a></label>');
										}
									  echo '</div>';
									  echo '<div class="col-md-4 col-sm-12 col-xs-12 btn-box">';
										 echo '<h5>FREE WEEK!</h5>';
										 echo '<a href="'.((isset($coachDetails['listing_page_coach_program_link_url']) && ($coachDetails['listing_page_coach_program_link_url'] != ''))?$coachDetails['listing_page_coach_program_link_url']:'#').'" class="start-dbtn" target="_blank">START NOW </a>';
										  echo '<a href="'.get_the_permalink($coach->ID).'" class="blank" target="_blank">Learn More > </a>';
									  echo '</div>';
									  
									echo '</div> <!-- row -->	'; 
								echo '</div>';
							echo '</div> <!-- text-box -->';
						echo '</div>';
					echo '</div>';
				echo '</div> <!-- row -->';
			}
		}
		?>
					
	 </div>	<!-- container -->
	 

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
		   </div>
		   


                    <div class="free-wrap">
		   	<h2>Ready for your free week?</h2>
		   	<div class="start-btn"><a href="#" class="start-dbtn" target="_blank">START NOW &gt;</a></div>
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

  	</div> <!-- coaches-wrap --> 


<?php get_footer(); ?>