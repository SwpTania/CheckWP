<?php
/*
 * Template Name: Macro Result Page
 *
 */
get_header('macro-result');

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
} else {
    $bg_img = 'male_bimg';
    $blur = "blur";
    $show_hide = 'hide';
    $mo_show_hide = '';
}


//echo '<pre>'; print_r($macro_membership_amount);die('macro_membership_amount');

$template_directory = get_template_directory_uri() . '/assets/img/';
$site_url = get_site_url();
//all param

?> 
<div id="loading">
    <center>
      <p> Calculating...</p>
        <!-- <img id="loading-image" src="<?php echo $template_directory;?>BigCircleBall.gif" alt="Loading..." /> -->
    </center>
</div>
<section class="sec sec-macro-calculator <?php echo $bg_img; ?>">

  <div class="marco-content-result" id="results">
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
                <span class="protein_grams <?php echo $show_hide;?>"><?php echo $protein_grams ? round($protein_grams, 0) : '000'; ?></span><span class="<?php echo $show_hide;?>">g</span>
                <small>Protein</small>
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
                <span class="carb_grams <?php echo $show_hide;?>"><?php echo $carb_grams ? round($carb_grams, 0) : '000'; ?></span class="<?php echo $show_hide;?>"><span class="<?php echo $show_hide;?>">g</span>
                <small>Carbs</small>
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
                <span class="fat_grams <?php echo $show_hide;?>"><?php echo $fat_grams ? round($fat_grams, 0) : '000'; ?></span class="<?php echo $show_hide;?>"><span class="<?php echo $show_hide;?>">g</span>
                <small>Fat</small>
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
                <span class="average_daily_calories <?php echo $show_hide;?>"><?php echo $average_daily_calories ? round($average_daily_calories, 0) : '000';?></span><span class="<?php echo $show_hide;?>">g</span>
                <small>Total Calories</small>
              </div>
            </div>
          </div>
        </div>

        <? if ( !is_user_logged_in() ): ?>
        <!-- <div class="form-list">
          <div class="stats-text members-only">          	
            <span class="">MEMBERS ONLY!</span>
          </div>
        </div> -->
       <?php endif;?>

        <div class="form-list">
          <p>Your Stats</p>
          <div class="stats-list d-flex">
            <div class="stats-list-in">
              <div class="stats-text">
                <span class="">
                  <span class="natural_calories"><?php echo $natural_calories ? number_format($natural_calories, 2) : '000';?></span><span> kcal</span>
                </span>
                <small>Natural calories burned</small>
              </div>
            </div>
            <div class="stats-list-in">
              <div class="stats-text">
                <span class="">
                  <span class="workout_calories"><?php echo $workout_calories ? number_format($workout_calories, 2) : '000';?></span><span> kcal</span>
                </span>
                <small>Calories burned from workout</small>
              </div>
            </div>
            <div class="stats-list-in">
              <div class="stats-text">
                <span class="">
                  <span class="cardio_calories"><?php echo $cardio_calories ? number_format($cardio_calories, 2) : '000';?></span><span> kcal</span>
                </span>
                <small>Calories burned from cardio</small>
              </div>
            </div>
            <div class="stats-list-in">
              <div class="stats-text">
                <span class="">
                  <span class="bmr_rate"><?php echo $bmr_rate ? number_format($bmr_rate, 2) : '000';?> </span><span> kcal</span>
                </span>
                <small>Base Metabolic rate (BMR)</small>
              </div>
            </div>
            <div class="stats-list-in">
              <div class="stats-text">
                <span class="">
                  <span class="tdee_calories"><?php echo $tdee ? number_format($tdee, 2) : '000';?></span><span> kcal</span>
                </span>
                <small>Total daily energy expenditure</small>
              </div>
            </div>
          </div>
        </div>

        <? if ( is_user_logged_in() ): ?>

        <div class="" style="text-align: center;">
          <div class="stats-text">
            <a href="<?php echo site_url();?>/macro-calculator" class="recalculate_btn" id="recalculate_btn" >RECALCULATE</a>
          </div>
        </div>

        <div class="" style="text-align: center;">
          <div class="stats-text">
            <a href="https://drive.google.com/uc?export=download&id=1QP_eiwzd-q5nxN8QcE3nAM_AYIq5RNW4" class="recalculate_btn" id="recalculate_btn" >DOWNLOAD BONUS ITEMS</a>
          </div>
        </div>

        <?php endif;?>
                    

      </div>
    </div>  
  </div>

</section>

<?php get_footer('macro-calculator'); ?>

<style type="text/css">
  .blur{
    filter: blur(6px);
  }

  .form-list .members-only{
    background: #9E9E9E;
    padding: 10px;
    width: 60%;
    text-align: center;
  }

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

  @media only screen and (max-width: 991px) {
  .stats-text .recalculate_btn {
      width: auto;
      font-size: 20px;
  }
  }
</style>


