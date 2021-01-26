<?php
/*
 * Template Name: Password Reset Page
 *
 */
get_header(); ?>
<?php
$success="";

if($_POST['somfrp_action'] == 'somfrp_reset_pass'){    
      $errors = array();

  $user_pass = trim( $_POST['som_new_user_pass'] );
  $user_pass_repeat = trim( $_POST['som_new_user_pass_again'] );

  if ( empty( $user_pass ) || empty( $user_pass_repeat ) ) {
   
    $errors['no_password'] = esc_html__( 'Please enter a new password.', 'frontend-reset-password' );
    $_REQUEST['errors'] = $errors;
   // return;
  } elseif ( $user_pass !== $user_pass_repeat ) {
    
    $errors['password_mismatch'] = esc_html__( 'The passwords don\'t match.', 'frontend-reset-password' );

    $_REQUEST['errors'] = $errors;
    //return;
  }

  //list( $rp_path ) = explode( '?', wp_unslash( $_SERVER['REQUEST_URI'] ) );
  //$rp_cookie = 'wp-resetpass-' . COOKIEHASH;

  $key = sanitize_text_field( $_GET['key'] );
  $user_id = sanitize_text_field( $_GET['uid'] );
  //$login = sanitize_text_field( $_GET['login'] ); // This is the user ID number

  if ( empty( $key ) || empty( $user_id ) ) {
    $errors['key_login'] = esc_html__( 'The reset link is not valid.', 'frontend-reset-password' );
    $_REQUEST['errors'] = $errors;
    wp_redirect( som_get_lost_password_url() );
    //exit;
    // For good measure
    //return;
  }

  $userdata = get_userdata( absint( $user_id ) );
  $login = $userdata ? $userdata->user_login : '';

  $user = check_password_reset_key( $key, $login );

  if ( is_wp_error( $user ) ) {

    if ( $user->get_error_code() === 'expired_key' ) {

      $errors['expired_key'] = esc_html__( 'Sorry, that key has expired. Please reset your password again.', 'frontend-reset-password' );

    } else {

      $errors['invalid_key'] = esc_html__( 'Sorry, that key does not appear to be valid. Please reset your password again.', 'frontend-reset-password' );

    }

  }

  if ( ! empty( $errors ) ) {    
    $_REQUEST['errors'] = $errors;
    //return;
  }else{
      $success = "Password Reset Successfully";
      do_action( 'validate_password_reset', new WP_Error(), $user );

      $reset_pwd = reset_password( $user, $user_pass );
     
    }

}
    ?>
<section class="myContact startPro parallax-window" data-parallax="scroll" data-image-src="<?php echo $background_image; ?>">
    <div class="container">
        <div class="innerPro contOver">
            <div class="contactForm">
                <h3 class="text-center"><?php the_title(); ?></h3>
                <?php                 
                 if ( ! empty( $errors ) ) : ?>

                  <?php if ( is_array( $errors ) ) : ?>

                    <?php foreach ( $errors as $error ) : ?>
                      <p class="som-password-sent-message som-password-error-message">
                        <span><?php echo esc_html( $error ); ?></span>
                      </p>
                    <?php endforeach; ?>

                  <?php endif; ?>

                <?php endif; ?>
                <?php//  if($success); ?>
                  <p class="som-password-sent-message som-password-success-message">
                   <span><?php echo esc_html( $success ); ?></span>                 
                 </p>
                 <?php// endif; ?>

                <form id="resetpasswordform" method="post" class="account-page-form som-pass-strength-form">
                   <div class="innerForm">
                     <div class="row">
                     <p class="status"></p>
                      <?php wp_nonce_field('ajax-forgot-nonce', 'forgotsecurity'); ?>  

                    <div class="listInput">
                        <label>New Password*</label>
                        <input name="som_new_user_pass" id="som_new_user_pass"  type="password" minlength="6" class="required" >
                    </div> 

                    <div class="listInput">
                        <label>Re-enter Password*</label>
                        <input name="som_new_user_pass_again" id="som_new_user_pass_again" type="password" minlength="6" class="required" >
                    </div>  
                

                  <div class="col-md-12">
                      <div class="btnCheckOut">
                        <?php wp_nonce_field( 'somfrp_reset_pass', 'somfrp_nonce' ); ?>
                
                    <input type="hidden" name="submitted" id="submitted" value="true">
                    <input type="hidden" name="somfrp_action" id="somfrp_post_action" value="somfrp_reset_pass">
                    
                        <input type="submit" class="btnbyNow checkOutBtn" id="reset-pass-submit" name="reset-pass-submit"  value="RESET">
                       </div>
                  </div>   
                </div>
                </div>
             </form>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
