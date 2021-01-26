<?php
/*
 * Template Name: Macro Calculator Page
 *
 */
get_header('macro-calculator');

if ( is_user_logged_in() ) {
  $blur = "";
  $user_id= get_current_user_id();
  $bmr_rate=get_user_meta($user_id,'bmr_rate',true);     
  $tdee=get_user_meta($user_id,'tdee',true);     
  $average_daily_calories = get_user_meta($user_id,'average_daily_calories',true);     
  $protein_grams =get_user_meta($user_id,'protein_grams',true);     
  $remaining_calories = get_user_meta($user_id,'remaining_calories',true);     
  $carb_grams = get_user_meta($user_id,'carb_grams',true);     
  $fat_grams = get_user_meta($user_id,'fat_grams',true);     
  $gender = get_user_meta($user_id,'gender',true);     
  $height = get_user_meta($user_id,'height',true);     
  $weight = get_user_meta($user_id,'weight',true);     
  $age = get_user_meta($user_id,'age',true);     
  $job_activity = get_user_meta($user_id,'job_activity',true);     
  $days_per_week_workout = get_user_meta($user_id,'days_per_week_workout',true);     
  $duration_of_workout = get_user_meta($user_id,'duration_of_workout',true);     
  $workout_type = get_user_meta($user_id,'workout_type',true);     
  $intensity = get_user_meta($user_id,'intensity',true);     
  $days_per_week_cardio = get_user_meta($user_id,'days_per_week_cardio',true);     
  $cardio_intensity = get_user_meta($user_id,'cardio_intensity',true);     
  $duration_of_cardio = get_user_meta($user_id,'duration_of_cardio',true);     
  $goal = get_user_meta($user_id,'goal',true);     
  $natural_calories = get_user_meta($user_id,'natural_calories',true);     
  $cardio_calories=get_user_meta($user_id,'cardio_calories',true);     
  $workout_calories=get_user_meta($user_id,'workout_calories',true);     
  if($gender == "F"){
    $bg_img = 'female_bimg';
  }else{
    $bg_img = 'male_bimg';
  }
  $show_hide = '';
  $mo_show_hide = 'hide';
}else {
  $bg_img = 'male_bimg';
  $blur = "blur";
  $show_hide = 'hide';
  $mo_show_hide = '';
}

//$macro_membership_amount = get_field('macro_membership_amount', 'option');
//echo '<pre>'; print_r($macro_membership_amount);die('macro_membership_amount');

$template_directory = get_template_directory_uri() . '/assets/img/';
$site_url = get_site_url();

?> 
<div id="loading">
    <center>
      <p> Calculating...</p>
        <!-- <img id="loading-image" src="<?php echo $template_directory;?>BigCircleBall.gif" alt="Loading..." /> -->
    </center>
</div>
<section class="sec sec-macro-calculator <?php echo $bg_img; ?>">

  <div class="marco-cal-steps">
    <div class="container">
      <ul class="list-inline">
        <li class="active personal_li" data-label="personal">
          <h4>Personal</h4>
        </li>
        <li class="exercise_li" data-label="exercise">
          <h4>Exercise</h4>
        </li>
        <li class="results" data-label="results">
          <h4>Results</h4>
        </li>
      </ul>
    </div>
  </div>

  <div class="marco-content active" id="personal">
    <div class="container">
      <div class="step-form">
        <form action="" method="POST" class="personal_form" id="personal_form" >
          <div class="form-list">
            <p>Gender</p>
            <div class="custom-input">
              <div class="check-radio">
                <input type="radio" id="mail" name="gender" value="M" checked>
                <label for="mail">Male</label>
              </div>
              <div class="check-radio">
                <input type="radio" id="female" name="gender" value="F" >
                <label for="female">Female</label>
              </div>
            </div>
          </div>
          <div class="form-list">
            <p>Height</p>
            <div class="custom-input">
              <div class="check-number">
                <input type="number" name="height_ft" min="1" max="10">
                <label>ft</label>
              </div>
              <div class="check-number">
                <input type="number" name="height_in" min="0" max="12">
                <label>in</label>
              </div>
            </div>
          </div>
          <div class="form-list">
            <p>Weight</p>
            <div class="custom-input">
              <div class="check-number">
                <input type="number" name="weight" min="1">
                <label>lbs</label>
              </div>
            </div>
          </div>
          <div class="form-list">
            <p>Age</p>
            <div class="custom-input">
              <div class="check-number">
                <input type="number" name="age" min="1" max="100">
                <label>Years</label>
              </div>
            </div>
          </div>
          
          <div class="form-list">
            <p>Job Activity Level</p>
            <div class="custom-input">
              <div class="select-dropdown">
                <select name="job_activity" class="job_activity custom-select sources" id="job_activity" placeholder="Choose Job Activity">
                  <option value="" class="select-dropdown__list-item empty">Choose Job Activity</option>
                  <option value="0" class="select-dropdown__list-item">Not Working</option>
                  <option value="1" class="select-dropdown__list-item">Mostly Seated</option>
                  <option value="2" class="select-dropdown__list-item">Standing/Walking</option>
                  <option value="3" class="select-dropdown__list-item">Very Active</option>
                </select>
              </div>

            </div>
          </div>

          <div class="form-list">
            <p>Basal Metabolic Rate (BMR)
              <span class="in-info">?</span>
              <label class="in-info-show">
                <span>The amount of calories your body burns for energy to maintain vital life functions when
                  completely at rest.</span>
              </label>
            </p>
            <div class="custom-input">
              <div class="check-number max-100">
                <input type="number" name="bmr_rate" class="">
              </div>
              <div class="check-checkbox">
                <input type="hidden" name="bmr_rate_know" value="yes" class="">
                <input type="checkbox" id="check-01" name="bmr_rate_no" class="ignore">
                <label for="check-01">I don't know</label>
              </div>
            </div>
          </div>
          <div class="form-list total-cal">
            <p>Your natural calories burned is
              <span class="in-info">?</span>
              <label class="in-info-show">
                <span>The amount of calories your body burns to maintain vital life functions and perform your daily activities excluding exercise.</span>
              </label>
            </p>
            <div class="custom-input">
                <input type="hidden" class="" value="" name="natural_calories">
              <div class="total-calories">
                <span class="natural_calories">0000</span><small> kcal</small>
              </div>

            </div>
          </div>
          <div class="form-list">
            <input type="submit" class="btn btn-main personal_check hidden" value="Check">
            <a href="javascript:void(0);" class="btn btn-main personal_next disabled">Next</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Workout form -->
  <div class="marco-content" id="exercise">
    <div class="container">
      <div class="step-form">
        <form action="" method="POST" class="exercise_form_workout" id="exercise_form_workout">

          <div class="form-list">
            <p>Workouts Per Week</p>
            <div class="custom-input">
              <div class="custom-number">
                <span class="minus">-</span>
                <input class="count" type="number" min="0" max="7" value="0" name="days_per_week_workout" exercise_type="workout" />
                <span class="plus">+</span>
              </div>
            </div>
          </div>

          <div class="form-list">
            <p>Workout Type</p>
            <div class="custom-input">
              <div class="select-dropdown">
                <select name="workout_type" id="workout_type" class="workout_type custom-select sources" placeholder="Choose Workout Type">
                  <option value="" class="select-dropdown__list-item empty">Choose Workout Type</option>
                  <option value="0" class="select-dropdown__list-item">Calisthenics/Body Weight</option>
                  <option value="1" class="select-dropdown__list-item">Group Fitness</option>
                  <option value="2" class="select-dropdown__list-item">Weight Lifting</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-list">
            <p>Duration</p>
            <div class="custom-input">
              <input class="slider" value="15" min="0" max="180" name="duration_of_workout" type="range" />
            </div>
          </div>

          <div class="form-list">
            <p>Intensity Level</p>
            <div class="custom-input">
              <div class="select-dropdown">
                <select name="intensity" id="intensity" class="intensity custom-select sources" placeholder="Choose Intensity">
                  <option value="" class="select-dropdown__list-item empty">Choose Intensity</option>
                  <option value="moderate" class="select-dropdown__list-item">Moderate</option>
                  <option value="intense" class="select-dropdown__list-item">Intense</option>
                  <option value="vigorous" class="select-dropdown__list-item">Vigorous</option>
                  <option value="max_extreme" class="select-dropdown__list-item">Max Extreme</option>
                </select>
              </div>
            </div>
          </div>
          
          <div class="form-list" style="margin-bottom: 50px;">
            <p>Calories Burned from Workout
              <!-- <span class="in-info">?</span>
              <label class="in-info-show">
                <span>The amount of calories your body burns for energy to maintain vital life functions when
                  completely at rest.</span>
              </label> -->
            </p>
            <div class="custom-input">
              <input type="hidden" name="workout_calories">
              <div class="total-calories">
                <span class="workout_calories">000</span><small> kcal</small>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-main workout_check hidden" value="Check">
        </form>

        <!-- Cardio Form -->
        <form action="" method="POST" class="exercise_form_cardio" id="exercise_form_cardio">
          <div class="form-list">
            <p>Cardio Sessions per Week</p>
            <div class="custom-input">
              <div class="custom-number">
                <span class="minus">-</span>
                <input class="count" type="number" min="0" max="7" value="0" name="days_per_week_cardio" exercise_type="cardio" />
                <span class="plus">+</span>
              </div>
            </div>
          </div>

          <div class="form-list">
            <p>Duration</p>
            <div class="custom-input">
              <input class="slider" value="15" min="0" max="180" name="duration_of_cardio" type="range" />
            </div>
          </div>

          <div class="form-list">
            <p>Intensity Level</p>
            <div class="custom-input">
              <div class="select-dropdown">
                <select name="cardio_intensity" id="cardio_intensity" class="cardio_intensity custom-select sources" placeholder="Choose Intensity">
                  <option value="" class="select-dropdown__list-item empty">Choose Intensity</option>
                  <option value="slow" class="select-dropdown__list-item">Slow</option>
                  <option value="moderate" class="select-dropdown__list-item">Moderate</option>
                  <option value="intense" class="select-dropdown__list-item">Intense</option>
                  <option value="vigorous" class="select-dropdown__list-item">Vigorous</option>
                </select>
              </div>
            </div>
          </div>
          
          <div class="form-list" style="margin-bottom: 50px;">
            <p>Calories Burned from Cardio
              <!-- <span class="in-info">?</span>
              <label class="in-info-show">
                <span>The amount of calories your body burns for energy to maintain vital life functions when
                  completely at rest.</span>
              </label> -->
            </p>
            <div class="custom-input">
              <input type="hidden" name="cardio_calories">
              <div class="total-calories">
                <span class="cardio_calories">000</span><small> kcal</small>
              </div>
            </div>
          </div>
          <input type="submit" class="btn btn-main cardio_check hidden" value="Check">
        </form>

        <form action="" method="POST" class="exercise_form_adc" id="exercise_form_adc">
          <div class="form-list">
            <p>Goal
              <span class="in-info">?</span>
              <label class="in-info-show">
                <span>Faster fat loss goals can decrease muscle mass.  Faster muscle gains can increase body fat. Slower goals are recommended for sustainable results.</span>
              </label>
            </p>
            <div class="custom-input">
              <div class="select-dropdown">
                <select name="goal" id="goal" class="goal custom-select sources" placeholder="Choose Goal">
                  <option value="" class="select-dropdown__list-item empty">Choose Goal</option>
                  <option value="aggressive_fat_loss" class="select-dropdown__list-item">Aggressive Fat Loss</option>
                  <option value="standard_fat_loss" class="select-dropdown__list-item">Standard Fat Loss</option>
                  <option value="slow_fat_loss" class="select-dropdown__list-item">Slow Fat Loss</option>
                  <option value="maintenance" class="select-dropdown__list-item">Maintenance</option>
                  <option value="slow_muscle_gain" class="select-dropdown__list-item">Slow Muscle Gain</option>
                  <option value="standard_gain_muscle" class="select-dropdown__list-item">Standard Muscle Gain</option>
                  <option value="aggressive_muscle_gain" class="select-dropdown__list-item">Aggressive Muscle Gain</option>
                </select>
              </div>
            </div>
          </div>

          <div class="form-list total-cal">
            <p>Your Total Daily Energy Expenditure
              <span class="in-info">?</span>
              <label class="in-info-show">
                <span>The total amount of calories your body burns to maintain vital life functions, perform daily tasks and exercise activities.</span>
              </label>
            </p>
            <div class="custom-input">
              <input type="hidden" name="tdee_calories">
              <div class="total-calories">
                <span class="tdee_calories">0000</span> <small>kcal</small>
              </div>

            </div>
          </div>
          <div class="form-list">
            <input type="submit" class="btn btn-main adc_check hidden" value="Check">
            <a href="javascript:void(0);" class="btn btn-main exercise_next disabled">Next</a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="marco-content" id="results">
    <div class="container">
      <div class="step-form">
        <div class="form-list">
          <p>Your Targets</p>
          <div class="target-list d-flex">
            <div class="target-list-in">
              <div class="target-img">
                <img src="<?php echo $template_directory;?>pro.png" alt="Protein" />
              </div>
              <div class="target-text">
                <div class="member-only <?php echo $mo_show_hide;?>">
                  <small>Members</small> Only
                </div>
                <input type="hidden" name="protein_grams">
                <span class="protein_grams <?php echo $show_hide;?>">000</span><span class="<?php echo $show_hide;?>">g</span>
                <small class="<?php //echo $show_hide;?>">Protein</small>
              </div>
            </div>
            <div class="target-list-in">
              <div class="target-img">
                <img src="<?php echo $template_directory;?>carbs.png" alt="Carbs" />
              </div>
              <div class="target-text">
                <div class="member-only <?php echo $mo_show_hide;?>">
                  <small>Members</small> Only
                </div>
                <input type="hidden" name="carb_grams">
                <span class="carb_grams <?php echo $show_hide;?>">000</span><span class="<?php echo $show_hide;?>">g</span>
                <small class="<?php //echo $show_hide;?>">Carbs</small>
              </div>
            </div>
            <div class="target-list-in">
              <div class="target-img">
                <img src="<?php echo $template_directory;?>fat.png" alt="Fat" />
              </div>
              <div class="target-text">
                <div class="member-only <?php echo $mo_show_hide;?>">
                  <small>Members</small> Only
                </div>
                <input type="hidden" name="fat_grams">
                <span class="fat_grams <?php echo $show_hide;?>">000</span><span class="<?php echo $show_hide;?>">g</span>
                <small class="<?php //echo $show_hide;?>">Fat</small>
              </div>
            </div>
            <div class="target-list-in">
              <div class="target-img">
                <img src="<?php echo $template_directory;?>calories.png" alt="Calories" />
              </div>
              <div class="target-text">
                <div class="member-only <?php echo $mo_show_hide;?>">
                  <small>Members</small> Only
                </div>
                <input type="hidden" name="average_daily_calories">
                <span class="average_daily_calories <?php echo $show_hide;?>">000</span><span class="<?php echo $show_hide;?>">g</span>
                <small class="<?php //echo $show_hide;?>">Total Calories</small>
              </div>
            </div>
          </div>
        </div>
        
        <? //if ( !is_user_logged_in() ): ?>
        <?php //endif;?>

        <div class="form-list">
          <p>Your Stats</p>
          <div class="stats-list d-flex">
            <div class="stats-list-in">
              <div class="stats-text">
                <span class="">
                  <span class="natural_calories">0000</span><span> kcal</span>
                </span>
                <small>Natural calories burned</small>
              </div>
            </div>
            <div class="stats-list-in">
              <div class="stats-text">
                <span class="">
                  <span class="workout_calories">000</span><span> kcal</span>
                </span>
                <small>Calories burned from workout</small>
              </div>
            </div>
            <div class="stats-list-in">
              <div class="stats-text">
                <span class="">
                  <span class="cardio_calories">000</span><span> kcal</span>
                </span>
                <small>Calories burned from cardio</small>
              </div>
            </div>
            <div class="stats-list-in">
              <div class="stats-text">
                <span class="">
                  <span class="bmr_rate">0000 </span><span> kcal</span>
                </span>
                <small>Basal Metabolic rate (BMR)</small>
              </div>
            </div>
            <div class="stats-list-in">
              <div class="stats-text">
                <span class="">
                  <span class="tdee_calories">0000</span><span> kcal</span>
                </span>
                <small>Total daily energy expenditure</small>
              </div>
            </div>
          </div>
        </div>

        <?php if ( is_user_logged_in() ) :?>

        <div class="" style="text-align: center;">
          <div class="stats-text">
            <a href="<?php echo site_url();?>/macro-calculator" class="recalculate_btn" id="recalculate_btn" >RECALCULATE</a>
          </div>
        </div>

        <div class="" style="text-align: center;">
          <div class="stats-text">
            <a href="#" class="recalculate_btn" id="recalculate_btn" >DOWNLOAD BONUS ITEMS</a>
          </div>
        </div>

        <?php endif;?>

      </div>
    </div>

    <?php if ( !is_user_logged_in() ) :?>

    <div class="new-elem-sec">
      <div class="get-full-access">
        <div class="container">
          <div class="get-full-access-wrap">
            <span class="yellow">Get Full Access Now</span>
            <p class="get-sub-para">Sign up to get your results and gain full access to all of our perks.</p>
            <div class="get-full-in-wrap">
              <ul class="get-full-points">
                <li>6-Pack Abs Routine</li>
                <li>Fat Burning Finishers</li>
                <li>100+ Exercise Routines (home and gym)</li>
                <li>40+ Recipes</li>
                <li>Exclusive Facebook Group</li>
                <li>Macro Tracker</li>
              </ul>
              <div class="get-full-value">
                <ul class="d-fl">
                  <li class="get-full-v">
                    <span class="red text-line">$150</span>
                    <small>Value</small>
                  </li>
                  <li class="get-full-m">
                    <span class="yellow"><em>$</em><span class="totalprice"></span><small>/month</small></span>
                  </li>
                </ul>
                <a href="<?php echo site_url('/');?>macro-checkout" class="btn btn-main btn-begin">Start Now</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="free-six-pack sec-full">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h3 class="heading-custom-rad">Six Pack<br> Abs Routine</h3>
              <div class="get-full-value-wrap">
                <ul class="d-fl">
                  <li class="get-full-v">
                    <span class="red text-line">$25</span>
                  </li>
                  <li class="get-full-m">
                    <span class="yellow">FREE</span>
                  </li>
                </ul>
                <div class="img-doc">
                  <img src="<?php echo $template_directory;?>2-doc.png" alt="" />
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="img-group">
                <img src="<?php echo $template_directory;?>neil.jpg" alt="">
                <div class="img-bonus bonus-1"><img src="<?php echo $template_directory;?>bonus.png" alt="" /></div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="our-trms sec-full">
        <div class="container">
          <h3 class="heading-custom-rad custom-heading">Our Transformations</h3>
          <div class="row">
            <div class="col-md-4">
              <div class="our-trms-group">
                <img src="<?php echo $template_directory;?>dalton-transform.jpg" alt="">
              </div>
              <div class="our-trms-group-name">
                <p>dalton dinatale</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="our-trms-group">
                <img src="<?php echo $template_directory;?>shannon-transform.jpg" alt="">
              </div>
              <div class="our-trms-group-name">
                <p>SHANNON DIJLAS</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="our-trms-group">
                <img src="<?php echo $template_directory;?>neil-transform.jpg" alt="">
              </div>
              <div class="our-trms-group-name">
                <p>neil parsont</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="start-transform">
        <div class="container">
          <div class="d-flex">
            <div class="st-logo">
              <img src="<?php echo $template_directory;?>black-logo-new.png" alt="" />
            </div>
            <div class="st-center">
              <span>Start your transformation</span>
            </div>
            <div class="st-right">
              <div class="just-value d-flex">
                <div class="jus-left">
                  <span><em>Just</em><i>$</i><span class="totalprice"></span><small>/mo</small></span>
                </div>
                <div class="jus-right">
                  <div class="get-full-v">
                    <span class="red text-line">$150</span>
                    <small>Value</small>
                  </div>
                </div>
              </div>
              <a href="<?php echo site_url('/');?>macro-checkout" class="btn btn-main btn-black">Buy Now</a>
            </div>
          </div>
        </div>
      </div>

      <div class="burning-finisher sec-full">
        <div class="container">
          <div class="row">
            <div class="col-md-7">
              <h3 class="heading-custom-rad">Fat Burning Finishers</h3>

              <div class="get-full-value-wrap" style="text-align: center;">
                <ul class="d-fl">
                  <li class="get-full-v">
                    <span class="red text-line">$25</span>
                  </li>
                  <li class="get-full-m">
                    <span class="yellow">FREE</span>
                  </li>
                </ul>
              </div>

              <ul class="counter-list">
                <li>Maximize calories burned</li>
                <li>Improve cardiovascular health</li>
                <li>Finish workout with a pump</li>
              </ul>
            </div>
            <div class="col-md-5">
              <div class="img-group">
                <img src="<?php echo $template_directory;?>4.jpg" alt="">
                <div class="img-bonus bonus-5"><img src="<?php echo $template_directory;?>bonus-2.png" alt=""></div>

              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="edorse-wrap sec-full">
        <div class="container">
          <h3 class="heading-custom-rad custom-heading text-center">Endorsements</h3>
          <div class="row">
            <div class="col-md-5">
              <div class="our-trms-group">
                <img src="<?php echo $template_directory;?>edorse-1.jpg" alt="">
              </div>
              <div class="our-trms-group-name">
                <p>Justin Woodard IFBB PRO</p>
                </div>
            </div>
            <div class="col-md-5">
              <div class="our-trms-group">
                <img src="<?php echo $template_directory;?>edorse-2.jpg" alt="">
              </div>
              <div class="our-trms-group-name">
                <p>Burak King 1st PLACE NPC</p>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="start-transform">
        <div class="container">
          <div class="d-flex">
            <div class="st-logo">
              <img src="<?php echo $template_directory;?>black-logo-new.png" alt="" />
            </div>
            <div class="st-center">
              <span>Start Sculpting Your New Physique</span>
            </div>
            <div class="st-right">
              <div class="just-value d-flex">
                <div class="jus-left">
                  <span><em>Just</em><i>$</i><span class="totalprice"></span><small>/mo</small></span>
                </div>
                <div class="jus-right">
                  <div class="get-full-v">
                    <span class="red text-line">$150</span>
                    <small>Value</small>
                  </div>
                </div>
              </div>
              <a href="<?php echo site_url('/');?>macro-checkout" class="btn btn-main btn-black">Buy Now</a>
            </div>
          </div>
        </div>
      </div>

      <div class="exe-routine sec-full">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="heading-custom-rad">100+ Exercise Routines</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <p>Includes a combination of gym, home, and body weight routines. They vary in difficulty to match all levels of fitness.</p>
              <p>Routines can easily be modified in terms of sets, reps, and rest time to match your fitness level. </p>

              <div class="get-full-value-wrap" style="text-align: center;">
                <ul class="d-fl">
                  <li class="get-full-v">
                    <span class="red text-line">$25</span>
                  </li>
                  <li class="get-full-m">
                    <span class="yellow">FREE</span>
                  </li>
                </ul>
              </div>

            </div>
            <div class="col-md-6">
              <div class="img-group">
                <img src="<?php echo $template_directory;?>100-exercise.jpg" alt="">
                <div class="img-bonus bottom-left"><img src="<?php echo $template_directory;?>bonus-3.png" alt=""></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="our-trms sec-full">
        <div class="container">
          <h3 class="heading-custom-rad custom-heading">Our Transformations</h3>
          <div class="row">
            <div class="col-md-4">
              <div class="our-trms-group">
                <img src="<?php echo $template_directory;?>Tyler-transform.jpg" alt="">
              </div>
              <div class="our-trms-group-name">
                <p>Tyler Gidseg</p>
              </div>
              
            </div>
            <div class="col-md-4">
              <div class="our-trms-group">
                <img src="<?php echo $template_directory;?>Sam-transform.jpg" alt="">
              </div>
              <div class="our-trms-group-name">
                <p>Sam Brooks</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="our-trms-group">
                <img src="<?php echo $template_directory;?>Zack-transform.jpg" alt="">
              </div>
              <div class="our-trms-group-name">
                <p>Zack Monawar </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="start-transform">
        <div class="container">
          <div class="d-flex">
            <div class="st-logo">
              <img src="<?php echo $template_directory;?>black-logo-new.png" alt="" />
            </div>
            <div class="st-center">
              <span>Start your transformation</span>
            </div>
            <div class="st-right">
              <div class="just-value d-flex">
                <div class="jus-left">
                  <span><em>Just</em><i>$</i><span class="totalprice"></span><small>/mo</small></span>
                </div>
                <div class="jus-right">
                  <div class="get-full-v">
                    <span class="red text-line">$150</span>
                    <small>Value</small>
                  </div>
                </div>
              </div>
              <a href="<?php echo site_url('/');?>macro-checkout" class="btn btn-main btn-black">Buy Now</a>
            </div>
          </div>
        </div>
      </div>

      <div class="free-six-pack free-recipes sec-full extra-pd">
        <div class="container">
          <div class="row">
            <div class="col-md-5">
              <h3 class="heading-custom-rad">40+ Recipes</h3>
              <!-- <p class="sub-para-full">Easy to prepare meals that are nutritionally dense and tasty. Our recipes allow you to approach dieting as a completely new lifestyle.</p> -->

              <ul class="counter-list">
                <li>Easy to prepare</li>
                <li>Nutritionally dense & tasty</li>
                <li>Maximum flexibility</li>
              </ul>
              <div class="get-full-value-wrap">
                <ul class="d-fl">
                  <li class="get-full-v">
                    <span class="red text-line">$25</span>
                  </li>
                  <li class="get-full-m">
                    <span class="yellow">FREE</span>
                  </li>
                </ul>
              </div>
              <!-- <a href="" class="btn btn-main">Sign Up</a> -->
            </div>
            <div class="col-md-6 col-md-push-1">
              <div class="img-group">
                <img src="<?php echo $template_directory;?>meal.png" alt="">
                <div class="img-bonus bonus-4"><img src="<?php echo $template_directory;?>bonus-4.png" alt=""></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="start-transform">
        <div class="container">
          <div class="d-flex">
            <div class="st-logo">
              <img src="<?php echo $template_directory;?>black-logo-new.png" alt="" />
            </div>
            <div class="st-center">
              <span>Start your transformation</span>
            </div>
            <div class="st-right">
              <div class="just-value d-flex">
                <div class="jus-left">
                  <span><em>Just</em><i>$</i><span class="totalprice"></span><small>/mo</small></span>
                </div>
                <div class="jus-right">
                  <div class="get-full-v">
                    <span class="red text-line">$150</span>
                    <small>Value</small>
                  </div>
                </div>
              </div>
              <a href="<?php echo site_url('/');?>macro-checkout" class="btn btn-main btn-black">Buy Now</a>
            </div>
          </div>
        </div>
      </div>

      <div class="free-six-pack sec-full pd-50">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="img-group">
                <img src="<?php echo $template_directory;?>2.png" alt="">
                <div class="img-bonus bonus-2"><img src="<?php echo $template_directory;?>bonus-5.png" alt=""></div>
                <div class="tel-fb">
                  <img src="<?php echo $template_directory;?>fb-logo-yellow.png" alt="">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <h3 class="heading-custom-rad">Access to Exclusive Facebook Group</h3>
              <div class="get-full-value-wrap">
                <ul class="d-fl">
                  <li class="get-full-v">
                    <span class="red text-line">$25</span>
                  </li>
                  <li class="get-full-m">
                    <span class="yellow">FREE</span>
                  </li>
                </ul>
              </div>
              <ul class="counter-list">
                <li>Share your journey and progress</li>
                <li>Receive fitness & nutrition guidance</li>
                <li>Increase motivation & accountability</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="our-trms sec-full">
        <div class="container">
          <h3 class="heading-custom-rad custom-heading">Our Transformations</h3>
          <div class="row">
            <div class="col-md-4">
              <div class="our-trms-group">
                <img src="<?php echo $template_directory;?>Ben-transform.jpg" alt="">
              </div>
              <div class="our-trms-group-name">
                <p>Ben Marasco</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="our-trms-group">
                <img src="<?php echo $template_directory;?>Lisa-transform.jpg" alt="">
              </div>
              <div class="our-trms-group-name">
                <p>Lisa Cohen</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="our-trms-group">
                <img src="<?php echo $template_directory;?>Minh-transform.jpg" alt="">
              </div>
              <div class="our-trms-group-name">
                <p>Minh Chung  </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="start-transform">
        <div class="container">
          <div class="d-flex">
            <div class="st-logo">
              <img src="<?php echo $template_directory;?>black-logo-new.png" alt="" />
            </div>
            <div class="st-center">
              <span>Start Sculpting Your New Physique</span>
            </div>
            <div class="st-right">
              <div class="just-value d-flex">
                <div class="jus-left">
                  <span><em>Just</em><i>$</i><span class="totalprice"></span><small>/mo</small></span>
                </div>
                <div class="jus-right">
                  <div class="get-full-v">
                    <span class="red text-line">$150</span>
                    <small>Value</small>
                  </div>
                </div>
              </div>
              <a href="<?php echo site_url('/');?>macro-checkout" class="btn btn-main btn-black">Buy Now</a>
            </div>
          </div>
        </div>
      </div>

      <div class="exe-routine macro-tracker sec-full">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h3 class="heading-custom-rad">Macro Tracker</h3>
              <p>Set your target macros to easily log and track your progress. Our Macro Tracker performs all calculations, measures variances, and provides suggetions to ensure you stay on track!</p>

              <div class="get-full-value-wrap" style="text-align: center;">
                <ul class="d-fl">
                  <li class="get-full-v">
                    <span class="red text-line">$25</span>
                  </li>
                  <li class="get-full-m">
                    <span class="yellow">FREE</span>
                  </li>
                </ul>
              </div>

            </div>
            <div class="col-md-6">
              <div class="img-group">
                <img src="<?php echo $template_directory;?>bonus-6.png" alt="">
                <!-- <div class="img-bonus bottom-left"><img src="<?php echo $template_directory;?>bonus-3.png" alt=""></div> -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="why-marocs">
        <div class="container">
          <h3 class="heading-custom-rad">Why are our macros better?</h3>
          <div class="marcos-main">
            <div class="marcos-wrap-in d-flex">
              <p>We used a Harvard Study to create a proprietary formula to provide the best estimate of calories burned</p>
              <div class="marcos-wrap-img">
                <img src="<?php echo $template_directory;?>university.png" alt="">
              </div>
            </div>
            <a href="https://www.health.harvard.edu/diet-and-weight-loss/calories-burned-in-30-minutes-of-leisure-and-routine-activities" class="btn btn-main" target="_blank">View Study</a>
          </div>
          <div class="t-transform-shapes">
            <div class="row">
              <div class="col-md-4">
                <div class="our-trms-group">
                  <img src="<?php echo $template_directory;?>k-1.png" alt="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="our-trms-group">
                  <img src="<?php echo $template_directory;?>k-2.png" alt="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="our-trms-group">
                  <img src="<?php echo $template_directory;?>k-3.png" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="includes-all pd-50">
        <div class="container">
          <div class="in-all-wrap">
            <div class="in-all-title">Includes all this:</div>
            <ul class="in-all-list get-full-points">
              <li>6-Pack Abs Routine</li>
              <li>Fat Burning Finishers</li>
              <li>100+ Exercise Routines (home and gym)</li>
              <li>40+ Recipes</li>
              <li>Exclusive Facebook Group</li>
              <li>Macro Tracker</li>
              <!-- <li>6-Pack Abs Routine <span class="red">$25</span></li>
              <li>Access to Exclusive Facebook Group <span class="red">$25</span></li>
              <li>One-on-One phone session with Zack <span class="red">$25</span></li>
              <li>Sample Meal Plans<span class="red">$25</span></li>
              <li>Fat Burning Finishers <span class="red">$25</span></li> -->
            </ul>

            <div class="purchase-wrap">
              <div class="st-right">
                <div class="just-value d-flex">
                  <div class="jus-right">
                    <div class="get-full-v">
                      <span class="red text-line">$150</span>
                      <small>Value</small>
                    </div>
                  </div>
                  <div class="jus-left">
                    <span><em>Now Just</em><i>$</i><span class="totalprice"></span><small>/mo</small></span>
                  </div>
                </div>
                <div class="d-flex custom-btn-n-cnt">
                  <a href="<?php echo site_url('/');?>macro-checkout" class="btn btn-main btn-black">Buy Now</a>
                  <span>No Contract. <br>
                    Cancel Anytime.</span>
                </div>
                <div class="tip-notes">Tip: update your macros every week to avoid plateaus.</div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php endif;?>


  </div>

</section>

<?php get_footer('macro-calculator'); ?>

<style type="text/css">
/*Custom Select*/

.custom-select-wrapper {
  position: relative;
  display: inline-block;
  user-select: none;
}
.custom-select-wrapper select {
  display: none;
}
.custom-select {
  position: relative;
  display: inline-block;
}
.custom-select-trigger {
  position: relative;
  display: block;
  width: 300px;
  padding: 0 84px 0 22px;
  font-size: 16px;
  font-weight: 400;
  color: #c4c4c4;
  line-height: 49px;
  background: #212121;
  border-radius: 5px;
  cursor: pointer;
}
/*.custom-select-trigger:hover {
   border:   2px solid #e2b30d; 
}*/

.custom-select-trigger:after {
  position: absolute;
  display: block;
  content: '';
  width: 10px; height: 10px;
  top: 50%; right: 25px;
  margin-top: -3px;
  border-bottom: 1px solid #fff;
  border-right: 1px solid #fff;
  transform: rotate(45deg) translateY(-50%);
  transition: all .4s ease-in-out;
  transform-origin: 50% 0;
}
.custom-select.opened .custom-select-trigger:after {
  margin-top: 3px;
  transform: rotate(-135deg) translateY(-50%);
}
.custom-options {
  position: absolute;
  display: block;
  top: 100%; left: 0; right: 0;
  min-width: 100%;
  margin: 5px 0;
  border: 2px solid #3f3f3f;
  border-radius: 5px;
  box-sizing: border-box;
  box-shadow: 0 2px 1px rgba(0,0,0,.07);
  background: #212121;
  transition: all .4s ease-in-out;

  opacity: 0;
  visibility: hidden;
  pointer-events: none;
  transform: translateY(-15px);
}
.custom-select.opened .custom-options {
  opacity: 1;
  visibility: visible;
  pointer-events: all;
  transform: translateY(0);
  z-index: 9;
  /*border: 2px solid #e2b30d;
      border-radius: 5px;*/
}
.custom-options:before {
  position: absolute;
  display: block;
  content: '';
  bottom: 100%; right: 25px;
  width: 7px; height: 7px;
  margin-bottom: -4px;
  border-top: 2px solid #3f3f3f;
  border-left: 2px solid #3f3f3f;
  background: #212121;
  transform: rotate(45deg);
  transition: all .4s ease-in-out;
}
.option-hover:before {
  background: #f9f9f9;
}
.custom-option {
  position: relative;
  display: block;
  padding: 0 22px;
  border-bottom: 1px solid #3f3f3f;
  font-size: 16px;
  font-weight: 400;
  color: #bab8b8;
  line-height: 47px;
  cursor: pointer;
  transition: all .4s ease-in-out;
}
.custom-option:first-of-type {
  border-radius: 4px 4px 0 0;
}
.custom-option:last-of-type {
  border-bottom: 0;
  border-radius: 0 0 4px 4px;
}
.custom-option:hover,
.custom-option.selection {
  background: #e2b30d;
  color: white;
}

/*Custom Select*/

.in-info:hover+.in-info-show {
  z-index: 9;
}

.blur{
  filter: blur(6px);
}

.form-list .members-only{
  background: #9E9E9E;
  padding: 10px;
  width: 60%;
  text-align: center;
}

input:focus, select:focus {border:2px solid #e2b30d !important;}

/*input.count:focus + .plus, input.count:focus - .minus{border:2px solid #e2b30d !important;}*/

/*input[class="error"]+.plus, input[class="error"]-.minus, {border:2px solid #e2b30d !important;}*/
input[class="error"] + span, input[class="error"] - span {border:2px solid #e2b30d !important;}

input[class="error"]{border:2px solid #e2b30d !important;}
select[class="error"]{border:2px solid #e2b30d !important;} 
/*.error{color:#f00 !important;}*/

#loading { width: 100%; height: 100%; top: 0px; left: 0px; position: fixed; display: block; opacity: 0.8; background-color: transparent; z-index: 9999; text-align: center; display: none; }
#loading-image { position: absolute; top: 40%; left: 50%; z-index: 100; }
#loading p { left: 48%; position: absolute; top: 40%; z-index: 100; color: #e2b30d;font-weight: bold;font-size: 36px;}

.recalculate_btn {
    display: block;
    width: 50%;
    background: #e1b30d;
    padding: 8px 0;
    font-size: 35.15px;
    font-weight: 600;
    text-transform: uppercase;
    color: #000;
    font-family: roboto slab;
    border-radius: 7px;
}

a.recalculate_btn:hover,a.recalculate_btn:focus {
  color: #000000!important;
}

</style>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap-select.js"></script>
<script type="text/javascript">

/*Custom Select*/

$(".custom-select").each(function() {
  var classes = $(this).attr("class"),
      id      = $(this).attr("id"),
      name    = $(this).attr("name");
  var template =  '<div class="' + classes + '">';
      template += '<span class="custom-select-trigger">' + $(this).attr("placeholder") + '</span>';
      template += '<div class="custom-options">';
      $(this).find("option").each(function() {
        template += '<span class="custom-option ' + $(this).attr("class") + '" data-value="' + $(this).attr("value") + '">' + $(this).html() + '</span>';
      });
  template += '</div></div>';
  
  $(this).wrap('<div class="custom-select-wrapper"></div>');
  $(this).hide();
  $(this).after(template);
});

$(".custom-option:first-of-type").hover(function() {
  $(this).parents(".custom-options").addClass("option-hover");
}, function() {
  $(this).parents(".custom-options").removeClass("option-hover");
});

$(".custom-select-trigger").on("click", function() {
  var sel_id = $(this).parents(".custom-select-wrapper").find("select").attr('id');

  $('html').one('click',function() {
    $(".custom-select").removeClass("opened");
  });
  $(this).parents(".custom-select").toggleClass("opened");
  event.stopPropagation();

  remove_empty_option(sel_id);
});

function remove_empty_option(sel_id){
  //console.log(sel_id);
  $("#"+sel_id).find('option[value=""]').remove();
  $("."+sel_id).find(".custom-options span.empty").remove();
}

$(".custom-option").on("click", function() {

  $(this).parents(".custom-select-wrapper").find("select").val($(this).data("value")).change();

  //op_val = $(this).data("value");
  //$(this).parents(".custom-select-wrapper").find("select").find('option[value="'+ op_val +'"]').prop('selected', 'selected').change();

  var sel_id = $(this).parents(".custom-select-wrapper").find("select").attr('id');

  if(sel_id == 'job_activity'){
    var gender = jQuery("#personal_form input[name='gender']:checked").val();
    var height_ft = jQuery("#personal_form input[name='height_ft']").val();
    var height_in = jQuery("#personal_form input[name='height_in']").val();
    var weight = jQuery("#personal_form input[name='weight']").val();
    var age = jQuery("#personal_form input[name='age']").val();
    var bmr_rate = jQuery("#personal_form input[name='bmr_rate']").val();
    var job_activity = jQuery("#personal_form select[name='job_activity']").children("option:selected").val();
    if(gender != '' && height_ft != '' && height_in != '' && weight != '' && age != '' && job_activity != ''){
          jQuery("#personal_form .personal_check").click();
    }else{
      jQuery("#personal_form .personal_next").addClass('disabled');
    }
  }

  if(sel_id == 'workout_type' || sel_id == 'intensity'){
    var workout_type = jQuery("#exercise_form_workout select[name='workout_type']").children("option:selected").val();
    var days_per_week_workout = jQuery("#exercise_form_workout input[name='days_per_week_workout']").val();
    var intensity = jQuery("#exercise_form_workout select[name='intensity']").children("option:selected").val();
    var duration_of_workout = jQuery("#exercise_form_workout input[name='duration_of_workout']").val();
    if(workout_type != '' && days_per_week_workout != '' && intensity != '' && duration_of_workout != ''){
      jQuery("#exercise_form_workout .workout_check").click();
      jQuery("#exercise_form_adc .adc_check").click();
    }else{
      //jQuery("#exercise_form_adc .exercise_next").addClass('disabled');
    }
  }

  if(sel_id == 'cardio_intensity'){
    var days_per_week_cardio = jQuery("#exercise_form_cardio input[name='days_per_week_cardio']").val();
    var cardio_intensity = jQuery("#exercise_form_cardio select[name='cardio_intensity']").children("option:selected").val();
    var duration_of_cardio = jQuery("#exercise_form_cardio input[name='duration_of_cardio']").val();
    if(days_per_week_cardio != '' && cardio_intensity != '' && duration_of_cardio != ''){
      jQuery("#exercise_form_cardio .cardio_check").click();
      jQuery("#exercise_form_adc .adc_check").click();
    }else{
      jQuery("#exercise_form_adc .exercise_next").addClass('disabled');
    }
  }

  if(sel_id == 'goal'){
    var goal = jQuery("#exercise_form_adc select[name='goal']").children("option:selected").val();
    if(goal != ''){
      jQuery("#exercise_form_adc .adc_check").click();
    }else{
      jQuery("#exercise_form_adc .exercise_next").addClass('disabled');
    }
  }

  //console.log(sel_id);

  $(this).parents(".custom-options").find(".custom-option").removeClass("selection");
  $(this).addClass("selection");
  $(this).parents(".custom-select").removeClass("opened");
  $(this).parents(".custom-select").find(".custom-select-trigger").text($(this).text());
});


  var program_plan = 'macro-calculator';

  jQuery.ajax({
      url: ajaxUrl,
      type: 'POST',
      dataType: 'JSON',
      data: {action: 'get_plans_details', program_plan: program_plan},
      success: function (response) {
          if (response.success == '1') {
              plan_ID = response.id;
              //jQuery('.chooseLeft h4').html(response.title);
              //jQuery('.chooseLeft h5').text(response.sub_title);
              //jQuery('.chooseRight h3').html('<span>$</span><label>'+response.sale_price_1+'</label>');
              jQuery('.totalprice').html(response.sale_price_1);
              //jQuery('#plan_price').val(response.sale_price_1);
              //jQuery('#plan_ID').val(plan_ID);
              
          }
      }
  });

  /*start Macro Calculator*/

  function currencyFormat(num) {
    return num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
  }

  function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
  }

  jQuery("input.count").focus(function(){
      jQuery(".plus").css("border", "2px solid #e2b30d");
      jQuery(".minus").css("border", "2px solid #e2b30d");
  });

  jQuery("input.count").blur(function(){
      jQuery(".plus").css("border", "2px solid #555");
      jQuery(".minus").css("border", "2px solid #555");
  })

  $("document").ready(function () {

      // Main wrapper subtract height from header and footer on resize
      $(window).on('load resize scroll', function (e) {
          var heightH = $('header').height();

          $('.sec-macro-calculator').css({
              'min-height': 'calc(100vh - ' + heightH + 'px)'
          });
      });

      jQuery(".plus").click(function(){
        var inpt = jQuery(this).parents(".custom-number").find('.count');
        var val = parseInt(inpt.val());
        if ( val < 7 ) inpt.val(val+1);

        var workout_type = jQuery("#exercise_form_workout select[name='workout_type']").children("option:selected").val();
        var days_per_week_workout = jQuery("#exercise_form_workout input[name='days_per_week_workout']").val();
        var intensity = jQuery("#exercise_form_workout select[name='intensity']").children("option:selected").val();
        var duration_of_workout = jQuery("#exercise_form_workout input[name='duration_of_workout']").val();
         
        var days_per_week_cardio = jQuery("#exercise_form_cardio input[name='days_per_week_cardio']").val();
        var cardio_intensity = jQuery("#exercise_form_cardio select[name='cardio_intensity']").children("option:selected").val();
        var duration_of_cardio = jQuery("#exercise_form_cardio input[name='duration_of_cardio']").val();

        var exercise_type = inpt.attr("exercise_type");

         if(exercise_type == 'workout'){
          if(workout_type != '' && days_per_week_workout != '' && intensity != '' && duration_of_workout != ''){
            jQuery("#exercise_form_workout .workout_check").click();
            jQuery("#exercise_form_adc .adc_check").click();
          }else{
            //jQuery("#exercise_form_adc .exercise_next").addClass('disabled');
          }
          //jQuery("#exercise_form_workout .workout_check").click();
         }

         if(exercise_type == 'cardio'){
          if(days_per_week_cardio != '' && cardio_intensity != '' && duration_of_cardio != ''){
           jQuery("#exercise_form_cardio .cardio_check").click();
           jQuery("#exercise_form_adc .adc_check").click();
          }else{
           //jQuery("#exercise_form_adc .exercise_next").addClass('disabled');
          }
          //jQuery("#exercise_form_cardio .cardio_check").click();
         }

       });

       jQuery(".minus").click(function(){
         var inpt = jQuery(this).parents(".custom-number").find('.count');
         var val = parseInt(inpt.val());
         if (val > 0) inpt.val(val-1);

         var workout_type = jQuery("#exercise_form_workout select[name='workout_type']").children("option:selected").val();
         var days_per_week_workout = jQuery("#exercise_form_workout input[name='days_per_week_workout']").val();
         var intensity = jQuery("#exercise_form_workout select[name='intensity']").children("option:selected").val();
         var duration_of_workout = jQuery("#exercise_form_workout input[name='duration_of_workout']").val();
          
         var days_per_week_cardio = jQuery("#exercise_form_cardio input[name='days_per_week_cardio']").val();
         var cardio_intensity = jQuery("#exercise_form_cardio select[name='cardio_intensity']").children("option:selected").val();
         var duration_of_cardio = jQuery("#exercise_form_cardio input[name='duration_of_cardio']").val();

         var exercise_type = inpt.attr("exercise_type");
         if(exercise_type == 'workout'){
          if(workout_type != '' && days_per_week_workout != '' && intensity != '' && duration_of_workout != ''){
            jQuery("#exercise_form_workout .workout_check").click();
            jQuery("#exercise_form_adc .adc_check").click();
          }else{
            jQuery("#exercise_form_adc .exercise_next").addClass('disabled');
          }
          //jQuery("#exercise_form_workout .workout_check").click();
         }

         if(exercise_type == 'cardio'){
          if(days_per_week_cardio != '' && cardio_intensity != '' && duration_of_cardio != ''){
           jQuery("#exercise_form_cardio .cardio_check").click();
           jQuery("#exercise_form_adc .adc_check").click();
          }else{
           jQuery("#exercise_form_adc .exercise_next").addClass('disabled');
          }
          //jQuery("#exercise_form_cardio .cardio_check").click();
         }
       });

  });

  /*End Macro Calculator*/

  jQuery(document).on('click','.personal_next', function(){
    jQuery('.marco-cal-steps').find('ul li.personal_li').removeClass('active');
    jQuery('#personal').hide();

    jQuery('.marco-cal-steps').find('ul li.exercise_li').addClass('active');
    jQuery('#exercise').show();
    jQuery("html, body").animate({ scrollTop: 0 }, "slow");
  });

  jQuery(document).on('click','.exercise_next', function(){
    jQuery('.marco-cal-steps').find('ul li.exercise_li').removeClass('active');
    jQuery('#exercise').hide();

    jQuery('.marco-cal-steps').find('ul li.results').addClass('active');
    jQuery('#results').show();
    jQuery("html, body").animate({ scrollTop: 0 }, "slow");
  });

  jQuery( "#exercise_form_adc select[name='goal']" ).change(function() {

    var gender = jQuery("#personal_form input[name='gender']:checked").val();
    var height_ft = jQuery("#personal_form input[name='height_ft']").val();
    var height_in = jQuery("#personal_form input[name='height_in']").val();
    var weight = jQuery("#personal_form input[name='weight']").val();
    var age = jQuery("#personal_form input[name='age']").val();
    var bmr_rate = jQuery("#personal_form input[name='bmr_rate']").val();
    var job_activity = jQuery("#personal_form select[name='job_activity']").children("option:selected").val();

    var days_per_week_workout = jQuery("#exercise_form_workout input[name='days_per_week_workout']").val();
    var duration_of_workout = jQuery("#exercise_form_workout input[name='duration_of_workout']").val();
    var workout_type = jQuery("#exercise_form_workout select[name='workout_type']").children("option:selected").val();
    var intensity = jQuery("#exercise_form_workout select[name='intensity']").children("option:selected").val();

    var days_per_week_cardio = jQuery("#exercise_form_cardio input[name='days_per_week_cardio']").val();
    var cardio_intensity = jQuery("#exercise_form_cardio select[name='cardio_intensity']").children("option:selected").val();
    var duration_of_cardio = jQuery("#exercise_form_cardio input[name='duration_of_cardio']").val();

    var goal = jQuery("#exercise_form_adc select[name='goal']").children("option:selected").val();

    if(goal == '' || goal == 'undefined'){
      jQuery("#exercise_form_adc .exercise_next").addClass('disabled');
    }else{
      //jQuery("#exercise_form_adc .exercise_next").removeClass('disabled');
    }

    //gender != '' && height_ft != '' && height_in != '' && weight != '' && age != '' && job_activity != '' && days_per_week_workout != '' && duration_of_workout != '' && workout_type != '' && intensity != '' && days_per_week_cardio != '' && cardio_intensity != '' && duration_of_cardio != '' && goal != ''

    if(gender != '' && height_ft != '' && height_in != '' && weight != '' && age != '' && job_activity != '' && goal != ''){
      jQuery("#exercise_form_adc .adc_check").click();
    }else{
      jQuery("#exercise_form_adc .exercise_next").addClass('disabled');
    }

  });

  jQuery("#exercise_form_adc").validate({
    ignore: ".ignore",
      rules: {
          goal: {
              required: true,
          },
      },
      errorPlacement: function (error, element) {
          /*if (element.attr("type") == "checkbox") {
              error.insertAfter($(element).parents('.termsNote'));
          } else {
              error.insertAfter($(element));
          }*/
      },
      submitHandler: function (form) {
          jQuery('#loading').show();

          var gender = jQuery("#personal_form input[name='gender']:checked").val();
          var height_ft = jQuery("#personal_form input[name='height_ft']").val();
          var height_in = jQuery("#personal_form input[name='height_in']").val();
          var weight = jQuery("#personal_form input[name='weight']").val();
          var age = jQuery("#personal_form input[name='age']").val();
          var bmr_rate = jQuery("#personal_form input[name='bmr_rate']").val();
          var job_activity = jQuery("#personal_form select[name='job_activity']").children("option:selected").val();

          var days_per_week_workout = jQuery("#exercise_form_workout input[name='days_per_week_workout']").val();
          var duration_of_workout = jQuery("#exercise_form_workout input[name='duration_of_workout']").val();
          var workout_type = jQuery("#exercise_form_workout select[name='workout_type']").children("option:selected").val();
          var intensity = jQuery("#exercise_form_workout select[name='intensity']").children("option:selected").val();

          var days_per_week_cardio = jQuery("#exercise_form_cardio input[name='days_per_week_cardio']").val();
          var cardio_intensity = jQuery("#exercise_form_cardio select[name='cardio_intensity']").children("option:selected").val();
          var duration_of_cardio = jQuery("#exercise_form_cardio input[name='duration_of_cardio']").val();

          var goal = jQuery("#exercise_form_adc select[name='goal']").children("option:selected").val();

          var bmr_rate_know = jQuery("#personal_form input[name='bmr_rate_know']").val();
          var natural_calories = jQuery("#personal_form input[name='natural_calories']").val();

          jQuery.ajax({
              url: ajaxUrl,
              dataType: 'JSON',
              type: 'POST',
              data: { action: 'user_total_check', gender:gender, height_ft:height_ft, height_in:height_in, weight:weight, age:age, bmr_rate:bmr_rate, job_activity:job_activity, days_per_week_workout:days_per_week_workout, duration_of_workout:duration_of_workout, workout_type:workout_type, intensity:intensity, days_per_week_cardio:days_per_week_cardio, cardio_intensity:cardio_intensity, duration_of_cardio:duration_of_cardio, goal:goal, bmr_rate_know:bmr_rate_know, natural_calories:natural_calories },
              success: function (response) {
                  jQuery('#loading').hide();
                  //console.log(response);
                  if (response.status == true) {

                    jQuery("#exercise_form_adc input[name='tdee_calories']").val(response.data.tdee);
                    jQuery("#exercise_form_adc .tdee_calories").html(formatNumber(response.data.tdee));

                    jQuery("#results input[name='carb_grams']").val(response.data.carb_grams.toFixed(0));
                    jQuery("#results .carb_grams").html(formatNumber(response.data.carb_grams.toFixed(0)));

                    jQuery("#results input[name='protein_grams']").val(response.data.protein_grams.toFixed(0));
                    jQuery("#results .protein_grams").html(formatNumber(response.data.protein_grams.toFixed(0)));

                    jQuery("#results input[name='fat_grams']").val(response.data.fat_grams.toFixed(0));
                    jQuery("#results .fat_grams").html(formatNumber(response.data.fat_grams.toFixed(0)));
                    
                    jQuery("#results input[name='average_daily_calories']").val(response.data.average_daily_calories.toFixed(0));
                    jQuery("#results .average_daily_calories").html(formatNumber(response.data.average_daily_calories.toFixed(0)));

                    jQuery("#results .tdee_calories").html(formatNumber(response.data.tdee.toFixed(2)));

                    //jQuery("#results input[name='remaining_calories']").val(response.data.remaining_calories);
                    //jQuery("#results .remaining_calories").html(formatNumber(response.data.average_daily_calories));

                    jQuery("#exercise_form_adc .exercise_next").removeClass('disabled');
                  } else {
                    alert(response.message);
                    jQuery("#exercise_form_adc .exercise_next").addClass('disabled');
                  }
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
              },
              statusCode: {
                404: function() {
                  alert( "Page not found" );
                }
              }
          });
      }
  });

  jQuery( "#exercise_form_cardio input[name='days_per_week_cardio'], #exercise_form_cardio select[name='cardio_intensity'], #exercise_form_cardio input[name='duration_of_cardio']" ).change(function() {

    var name_attr = jQuery(this).attr('name');

    if(name_attr == 'days_per_week_cardio'){
      if(jQuery("#exercise_form_cardio input[name='days_per_week_cardio']").val() > 7){
          jQuery("#exercise_form_cardio input[name='days_per_week_cardio']").val(7);
      }
    }

    var days_per_week_cardio = jQuery("#exercise_form_cardio input[name='days_per_week_cardio']").val();
    var cardio_intensity = jQuery("#exercise_form_cardio select[name='cardio_intensity']").children("option:selected").val();
    var duration_of_cardio = jQuery("#exercise_form_cardio input[name='duration_of_cardio']").val();
    
    if(cardio_intensity == '' || cardio_intensity == 'undefined'){
      jQuery("#exercise_form_adc .exercise_next").addClass('disabled');
    }else{
      //jQuery("#exercise_form_adc .exercise_next").removeClass('disabled');
    }

    if(days_per_week_cardio != '' && cardio_intensity != '' && duration_of_cardio != ''){
      jQuery("#exercise_form_cardio .cardio_check").click();
      jQuery("#exercise_form_adc .adc_check").click();
    }else{
      jQuery("#exercise_form_adc .exercise_next").addClass('disabled');
    }

  });

  jQuery("#exercise_form_cardio").validate({
    ignore: ".ignore",
      rules: {
          days_per_week_cardio: {
              required: true,
          },
          cardio_intensity: {
              required: true,
          },
          duration_of_cardio: {
              required: true,
          },
      },
      errorPlacement: function (error, element) {
          /*if (element.attr("type") == "checkbox") {
              error.insertAfter($(element).parents('.termsNote'));
          } else {
              error.insertAfter($(element));
          }*/
      },
      submitHandler: function (form) {
          jQuery('#loading').show();

          var weight = jQuery("#personal_form input[name='weight']").val();

          var days_per_week_cardio = jQuery("#exercise_form_cardio input[name='days_per_week_cardio']").val();
          var cardio_intensity = jQuery("#exercise_form_cardio select[name='cardio_intensity']").children("option:selected").val();
          var duration_of_cardio = jQuery("#exercise_form_cardio input[name='duration_of_cardio']").val();

          jQuery.ajax({
              url: ajaxUrl,
              dataType: 'JSON',
              type: 'POST',
              data: { action: 'user_cardio_check', weight:weight, days_per_week_cardio:days_per_week_cardio, cardio_intensity:cardio_intensity, duration_of_cardio:duration_of_cardio},
              success: function (response) {
                  jQuery('#loading').hide();
                  //console.log(response);
                  if (response.status == true) {
                    jQuery("#exercise_form_cardio input[name='cardio_calories']").val(response.data.cardio_calories.toFixed(2));
                    jQuery("#exercise_form_cardio .cardio_calories").html(formatNumber(response.data.cardio_calories.toFixed(2)));
                    jQuery("#results .cardio_calories").html(formatNumber(response.data.cardio_calories.toFixed(2)));
                    //jQuery("#exercise_form_workout .exercise_next").removeClass('disabled');
                  }else if(response == 0){
                    jQuery("#exercise_form_cardio input[name='cardio_calories']").val(0.00);
                    jQuery("#exercise_form_cardio .cardio_calories").html(formatNumber('000.00'));
                    jQuery("#results .cardio_calories").html(formatNumber('000.00'));
                  }else {
                    alert(response.message);
                    jQuery("#exercise_form_cardio .exercise_next").addClass('disabled');
                  }
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
              },
              statusCode: {
                404: function() {
                  alert( "Page not found" );
                }
              }
          });
      }
  });

  jQuery( "#exercise_form_workout select[name='workout_type'], #exercise_form_workout input[name='days_per_week_workout'], #exercise_form_workout select[name='intensity'], #exercise_form_workout input[name='duration_of_workout']" ).change(function() {

    var name_attr = jQuery(this).attr('name');

    if(name_attr == 'days_per_week_workout'){
      if(jQuery("#exercise_form_workout input[name='days_per_week_workout']").val() > 7){
          jQuery("#exercise_form_workout input[name='days_per_week_workout']").val(7);
      }
    }

    var workout_type = jQuery("#exercise_form_workout select[name='workout_type']").children("option:selected").val();
    var days_per_week_workout = jQuery("#exercise_form_workout input[name='days_per_week_workout']").val();
    var intensity = jQuery("#exercise_form_workout select[name='intensity']").children("option:selected").val();
    var duration_of_workout = jQuery("#exercise_form_workout input[name='duration_of_workout']").val();

    if(workout_type == '' || workout_type == 'undefined' || intensity == '' || intensity == 'undefined'){
      //jQuery("#exercise_form_adc .exercise_next").addClass('disabled');
    }else{
      //jQuery("#exercise_form_adc .exercise_next").removeClass('disabled');
    }

    if(workout_type != '' && days_per_week_workout != '' && intensity != '' && duration_of_workout != ''){
      jQuery("#exercise_form_workout .workout_check").click();
      jQuery("#exercise_form_adc .adc_check").click();
    }else{
      //jQuery("#exercise_form_adc .exercise_next").addClass('disabled');
    }
    
  });

  jQuery("#exercise_form_workout").validate({
    ignore: ".ignore",
      rules: {
          workout_type: {
              required: true,
          },
          days_per_week_workout: {
              required: true,
          },
          intensity: {
              required: true,
          },
          duration_of_workout: {
              required: true,
          },
      },
      errorPlacement: function (error, element) {
          /*if (element.attr("type") == "checkbox") {
              error.insertAfter($(element).parents('.termsNote'));
          } else {
              error.insertAfter($(element));
          }*/
      },
      submitHandler: function (form) {
          jQuery('#loading').show();

          var weight = jQuery("#personal_form input[name='weight']").val();

          var workout_type = jQuery("#exercise_form_workout select[name='workout_type']").children("option:selected").val();
          var days_per_week_workout = jQuery("#exercise_form_workout input[name='days_per_week_workout']").val();
          var intensity = jQuery("#exercise_form_workout select[name='intensity']").children("option:selected").val();
          var duration_of_workout = jQuery("#exercise_form_workout input[name='duration_of_workout']").val();

          jQuery.ajax({
              url: ajaxUrl,
              dataType: 'JSON',
              type: 'POST',
              data: { action: 'user_workout_check', weight:weight, workout_type:workout_type, days_per_week_workout:days_per_week_workout, intensity:intensity, duration_of_workout:duration_of_workout},
              success: function (response) {
                  jQuery('#loading').hide();
                  //console.log(response);
                  if (response.status == true) {
                    jQuery("#exercise_form_workout input[name='workout_calories']").val(response.data.workout_calories.toFixed(2));
                    jQuery("#exercise_form_workout .workout_calories").html(formatNumber(response.data.workout_calories.toFixed(2)));
                    jQuery("#results .workout_calories").html(formatNumber(response.data.workout_calories.toFixed(2)));
                    //jQuery("#exercise_form_workout .exercise_next").removeClass('disabled');
                  }else if(response == 0){
                    jQuery("#exercise_form_workout input[name='workout_calories']").val(0.00).toFixed(2);
                    jQuery("#exercise_form_workout .workout_calories").html(formatNumber('000.00'));
                    jQuery("#results .workout_calories").html(formatNumber('000.00'));
                  }else {
                    alert(response.message);
                    //jQuery("#exercise_form_workout .exercise_next").addClass('disabled');
                  }
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
              },

              statusCode: {
                404: function() {
                  alert( "Page not found" );
                }
              }
          });
      }
  });

  jQuery( "#personal_form input[name='height_ft'], #personal_form input[name='height_in'], #personal_form input[name='weight'], #personal_form input[name='age'], #exercise_form_workout input[name='days_per_week'], #exercise_form_cardio input[name='days_per_week']" ).keypress(function(event) {
      if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
        event.preventDefault(); //stop character from entering input
      }
       
  });

  jQuery('#personal').on('change',"#personal_form input[name='gender'], #personal_form input[name='height_ft'], #personal_form input[name='height_in'], #personal_form input[name='weight'], #personal_form input[name='age'], #personal_form select[name='job_activity'], #personal_form input[name='bmr_rate'], #personal_form input[name='bmr_rate_no']",function(){

  //jQuery( "#personal_form input[name='gender'], #personal_form input[name='height_ft'], #personal_form input[name='height_in'], #personal_form input[name='weight'], #personal_form input[name='age'], #personal_form select[name='job_activity'], #personal_form input[name='bmr_rate'], #personal_form input[name='bmr_rate_no']" ).change(function() {
    var name_attr = jQuery(this).attr('name');

    var gender = jQuery("#personal_form input[name='gender']:checked").val();
    var height_ft = jQuery("#personal_form input[name='height_ft']").val();
    var height_in = jQuery("#personal_form input[name='height_in']").val();
    var weight = jQuery("#personal_form input[name='weight']").val();
    var age = jQuery("#personal_form input[name='age']").val();
    var bmr_rate = jQuery("#personal_form input[name='bmr_rate']").val();
    var job_activity = jQuery("#personal_form select[name='job_activity']").children("option:selected").val();

    var bmr_rate_no = jQuery("#personal_form input[name='bmr_rate_no']").val();
    var bmr_rate_know = jQuery("#personal_form input[name='bmr_rate_know']").val();

    if(name_attr == 'gender'){

      if(gender == 'M'){
        var male_bimg = 'https://6packmacros.com/wp-content/themes/monawar/assets/img/cal-banner.jpg';
        jQuery('.sec-macro-calculator').removeClass('female_bimg').addClass('male_bimg');
        jQuery('body').css('color', '#000');
        //jQuery('.sec-macro-calculator').css('background', 'url(#000 '+male_bimg+' no-repeat right 90px/contain)');
      }else{
        var female_bimg = 'https://6packmacros.com/wp-content/themes/monawar/assets/img/before-footer.jpg';
        //jQuery('.sec-macro-calculator').css('background', 'url(#000 '+female_bimg+' no-repeat right 90px/contain)');
        jQuery('.sec-macro-calculator').removeClass('male_bimg').addClass('female_bimg');
        jQuery('body').css('color', '#070707');
      }

    }

    if(name_attr == 'bmr_rate'){
      if(bmr_rate == ''){
        if(jQuery("#personal_form input[name='bmr_rate_no']").is(":not(:checked")){
          jQuery("#personal_form input[name='bmr_rate_no']").prop('checked',true);
          jQuery("#personal_form input[name='bmr_rate_know']").val('no');
          var bmr_rate_know = jQuery("#personal_form input[name='bmr_rate_know']").val();
        }
        jQuery("#personal_form .personal_next").addClass('disabled');
      }else{
        if(jQuery("#personal_form input[name='bmr_rate_no']").is(":checked")){
          jQuery("#personal_form input[name='bmr_rate_no']").prop('checked',false);
          jQuery("#personal_form input[name='bmr_rate_know']").val('yes');
          var bmr_rate_know = jQuery("#personal_form input[name='bmr_rate_know']").val();
        }
        jQuery("#personal_form .personal_next").removeClass('disabled');
      }
    }

    if(name_attr == 'bmr_rate_no'){
      if(jQuery(this).is(":checked")){
        jQuery("#personal_form input[name='bmr_rate_know']").val('no');
        var bmr_rate_know = jQuery("#personal_form input[name='bmr_rate_know']").val();
        jQuery("#personal_form input[name='bmr_rate']").addClass('ignore');

      }
      else if(jQuery(this).is(":not(:checked)")){
        jQuery("#personal_form input[name='bmr_rate_know']").val('yes');
        var bmr_rate_know = jQuery("#personal_form input[name='bmr_rate_know']").val();
        jQuery("#personal_form input[name='bmr_rate']").removeClass('ignore');

      }
    }

    if(gender != '' && height_ft != '' && height_in != '' && weight != '' && age != '' && job_activity != ''){
      jQuery("#personal_form .personal_check").click();
    }else{
      jQuery("#personal_form .personal_next").addClass('disabled');
    }
    
    // console.log(name_attr);
    // console.log(bmr_rate_know);
    // console.log(height_ft);
    // console.log(height_in);
    // console.log(weight);
    // console.log(age);
    // console.log(job_activity);

  });
  
  jQuery("#personal_form").validate({
    ignore: ".ignore",
    onkeyup: false,
    debug: true,
      rules: {
          gender: {
              required: true,
          },
          height_ft: {
              required: true,
              digits: true,
              range: [1, 10],
          },
          height_in: {
              required: true,
              digits: true,
              range: [0, 11],
          },
          weight: {
              required: true,
              number: true,
              range: [1, 300],
          },
          age: {
              required: true,
              digits: true,
              range: [1, 100],
          },
          bmr_rate: {
              required: true,
              number: true,
          },
          job_activity: {
              required: true,
          },
          
      },
      messages: {
          // au_emailaddress: {
          //     required: "E-mail is required",
          //     number: "Please enter valid CVV",
          // },
      },
      errorPlacement: function (error, element) {
          /*if (element.attr("type") == "checkbox") {
              error.insertAfter($(element).parents('.termsNote'));
          } else {
              error.insertAfter($(element));
          }*/
      },
      submitHandler: function (form) {
          //form.submit();
          jQuery('#loading').show();
          var gender = jQuery("#personal_form input[name='gender']:checked").val();
          var height_ft = jQuery("#personal_form input[name='height_ft']").val();
          var height_in = jQuery("#personal_form input[name='height_in']").val();
          var weight = jQuery("#personal_form input[name='weight']").val();
          var age = jQuery("#personal_form input[name='age']").val();
          var bmr_rate = jQuery("#personal_form input[name='bmr_rate']").val();
          var job_activity = jQuery("#personal_form select[name='job_activity']").children("option:selected").val();

          var bmr_rate_no = jQuery("#personal_form input[name='bmr_rate_no']").val();
          var bmr_rate_know = jQuery("#personal_form input[name='bmr_rate_know']").val();

          jQuery.ajax({
              url: ajaxUrl,
              dataType: 'JSON',
              type: 'POST',
              data: { action: 'user_personal_check', gender:gender, height_ft:height_ft, height_in:height_in, weight:weight, age:age, bmr_rate:bmr_rate, job_activity:job_activity, bmr_rate_no:bmr_rate_no, bmr_rate_know:bmr_rate_know },
              success: function (response) {
                  jQuery('#loading').hide();
                  //console.log(response);
                  if (response.status == true) {

                    if(jQuery('#personal_form input[name="bmr_rate_no"]').is(":checked")){
                      jQuery("#personal_form input[name='bmr_rate']").val(response.data.bmr_rate.toFixed(2));
                      jQuery("#results .bmr_rate").html(formatNumber(response.data.bmr_rate.toFixed(2)));
                    }
                    else if(jQuery('#personal_form input[name="bmr_rate_no"]').is(":not(:checked)")){
                      jQuery("#results .bmr_rate").html(formatNumber(jQuery('#personal_form input[name="bmr_rate"]').val()));
                    }

                    jQuery("#personal_form input[name='natural_calories']").val(response.data.natural_calories);
                    jQuery("#personal_form .natural_calories").html(formatNumber(response.data.natural_calories.toFixed(2)));
                    jQuery("#results .natural_calories").html(formatNumber(response.data.natural_calories.toFixed(2)));

                    jQuery("#personal_form .personal_next").removeClass('disabled');
                    
                  } else {
                    alert(response.message);
                    jQuery("#personal_form .personal_next").addClass('disabled');
                  }
              },

              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
              },

              statusCode: {
                404: function() {
                  alert( "Page not found" );
                }
              }

          });
      }
  });
</script>
