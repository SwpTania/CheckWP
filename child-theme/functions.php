<?php
/**
 * Enqueues child theme stylesheet, loading first the parent theme stylesheet.
 */
function seese_enqueue_child_theme_styles() {
	wp_enqueue_style( 'seese-child-style', get_stylesheet_uri(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'seese_enqueue_child_theme_styles', 11 );


/** Checkout Feilds  **/

// Add checkout field
function seese_add_custom_checkout_fields($fields){

    unset($fields['billing']['billing_first_name']);
    unset($fields['billing']['billing_last_name']);
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_email']);
    unset($fields['billing']['billing_phone']);
    unset($fields['order']['order_comments']);

    $fields['sender_fields'] = array(
      'sender_name' => array(
        'type'         => 'text',
        'class'        => array('col-lg-4 col-md-4 col-sm-4 col-xs-12'),
        'required'     => true,
        'label'        => esc_html__('Sender Full name', 'seese'),
      ),
      'sender_phone' => array(
        'type'         => 'tel',
        'class'        => array('col-lg-4 col-md-4 col-sm-4 col-xs-12'),
        'label'        => esc_html__('Sender Phone number', 'seese'),
        'validate'     => array( 'phone' ),
        'autocomplete' => 'tel',    
        'required'     => true,
      ),
      'sender_email' => array(
        'type'         => 'email',
        'class'        => array('col-lg-4 col-md-4 col-sm-4 col-xs-12'),
        'label'        => esc_html__('Sender Email address', 'seese'),
        'validate'     => array( 'email' ),
        'autocomplete' => 'no' === get_option( 'woocommerce_registration_generate_username' ) ? 'email' : 'email username',
        'required'     => true,
      )
    );

    $fields['recipient_fields'] = array(
      'recipient_name' => array(
        'type'         => 'text',
        'class'        => array('col-lg-4 col-md-4 col-sm-4 col-xs-12'),
        'label'        => esc_html__('Recipient Full name', 'seese'),
        'required'     => true,
      ),
      'recipient_phone' => array(
        'type'         => 'tel',
        'class'        => array('col-lg-4 col-md-4 col-sm-4 col-xs-12'),
        'label'        => esc_html__('Recipient Phone number', 'seese'),
        'validate'     => array( 'phone' ),  
        'required'     => true,
      ),
      'delivery_option' => array(
        'type'         => 'select',
        'class'        => array('col-lg-4 col-md-4 col-sm-4 col-xs-12'),
        'label'        => esc_html__('Delivery option', 'seese'),
        'options'      => array( 'A' => esc_html__('Specify the address and time of delivery', 'seese'), 'B' => esc_html__('Do not call the recipient before the delivery', 'seese') ),   
        'required'     => true,
      )
    );

    $fields['delivery_fields'] = array(
      'delivery_date' => array(
        'type'         => 'text',
        'class'        => array('col-lg-6 col-md-6 col-sm-6 col-xs-12'),
        'label'        => esc_html__('Delivery date', 'seese'),
        'id'           => 'delivery-datepicker',
        'required'     => false,
      ),
      'delivery_time' => array(
        'type'         => 'select',
        'class'        => array('col-lg-6 col-md-6 col-sm-6 col-xs-12'),
        'label'        => esc_html__('Delivery time', 'seese'),
        'options'      => array( 'A' => esc_html__('Arrange time + 499 '.get_woocommerce_currency().' ', 'seese'), 'B' => esc_html__('Nearest time (1 - 2 hours)', 'seese') ),
        'required'     => true,
      ),
    );

    $fields['delivery_address_check'] = array(     
      'delivery_checkbox' => array(
        'type'         => 'checkbox',
        'id'           => 'sc-delivery-check',
        'label'        => esc_html__('To know the shipping address of the recipient', 'seese'),
        'required'     => false,
      ),
      'delivery_address' => array(
        'type'         => 'textarea',
        'id'           => 'sc-delivery-address-id',
        'class'        => array('sc-delivery-address'),
        'label'        => esc_html__('Delivery address', 'seese'),
        'required'     => false,
      ),
      'freegift_checkbox' => array(
        'type'         => 'checkbox',
        'id'           => 'sc-addfree-check',
        'label'        => esc_html__('Add Gift Card - Free', 'seese'),
        'required'     => false,
      ),
      'freegift_msg' => array(
        'type'         => 'textarea',
        'id'           => 'sc-addfree-id',
        'class'        => array('sc-addfree-msg'),
        'label'        => esc_html__('Enter Your Message', 'seese'),
        'required'     => false,
      ),
    );

    return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'seese_add_custom_checkout_fields' );

// display the extra field on the checkout form
function seese_display_custom_checkout_fields() { 

  $checkout = WC()->checkout(); ?>

  <div class="seese-checkout-custom-fields">
    <div id="seese-checkout-sender-field"><h3><?php echo esc_html__('Sender', 'seese'); ?></h3>
      <div class="row">
        <?php foreach ( $checkout->checkout_fields['sender_fields'] as $key => $field ) : ?>
          <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
        <?php endforeach; ?>
      </div>
    </div>

    <div id="seese-checkout-recipient-field"><h3><?php echo esc_html__('Recipient', 'seese'); ?></h3>
      <div class="row">
        <?php foreach ( $checkout->checkout_fields['recipient_fields'] as $key => $field ) : ?>
          <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
        <?php endforeach; ?>
      </div>
    </div>

    <div id="seese-checkout-date-field"><h3><?php echo esc_html__('Date and Time of Delivery', 'seese'); ?></h3>
      <div class="row">
        <?php foreach ( $checkout->checkout_fields['delivery_fields'] as $key => $field ) : ?>
          <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
        <?php endforeach; ?>
      </div>    
      <?php foreach ( $checkout->checkout_fields['delivery_address_check'] as $key => $field ) : ?>
        <?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
      <?php endforeach; ?>   
    </div>
  </div>

<?php }
add_action( 'woocommerce_checkout_after_customer_details' ,'seese_display_custom_checkout_fields' );

/*add_action('woocommerce_checkout_process', 'seese_custom_checkout_field_process');
function seese_custom_checkout_field_process() {
  if ( ! $_POST['sender_name'] ) wc_add_notice( __( 'Please enter <strong>Sender Name</strong>.', 'seese' ), 'error' );
  if ( ! $_POST['sender_phone'] ) wc_add_notice( __( 'Please enter <strong>Sender Phone</strong>', 'seese' ), 'error' );
  if ( ! $_POST['sender_email'] ) wc_add_notice( __( 'Please enter <strong>Sender Email Address</strong>', 'seese' ), 'error' );
  if ( ! $_POST['recipient_name'] ) wc_add_notice( __( 'Please enter <strong>Recipient Name</strong>', 'seese' ), 'error' );
  if ( ! $_POST['recipient_phone'] ) wc_add_notice( __( 'Please enter <strong>Recipient Phone</strong>', 'seese' ), 'error' );
}*/

// save the field when checkout is processed
function seese_save_custom_checkout_fields( $order, $data ){
    if( isset( $data['sender_name'] ) ) {
        $order->update_meta_data( '_sender_name', sanitize_text_field( $data['sender_name'] ) );
    }
    if( isset( $data['sender_phone'] ) ) {
        $order->update_meta_data( '_sender_phone', sanitize_text_field( $data['sender_phone'] ) );
    }
    if( isset( $data['sender_email'] ) ) {
        $order->update_meta_data( '_sender_email', sanitize_text_field( $data['sender_email'] ) );
    }

    if( isset( $data['recipient_name'] ) ) {
        $order->update_meta_data( '_recipient_name', sanitize_text_field( $data['recipient_name'] ) );
    }
    if( isset( $data['recipient_phone'] ) ) {
        $order->update_meta_data( '_recipient_phone', sanitize_text_field( $data['recipient_phone'] ) );
    }
    if( isset( $data['delivery_option'] ) && in_array( $data['delivery_option'], array( 'A', 'B' ) ) ) {
        $order->update_meta_data( '_delivery_option', $data['delivery_option'] );
    } 

    if( isset( $data['delivery_date'] ) ) {
        $order->update_meta_data( '_delivery_date', $data['delivery_date'] );
    }
    if( isset( $data['delivery_time'] ) && in_array( $data['delivery_time'], array( 'A', 'B' ) ) ) {
        $order->update_meta_data( '_delivery_time', $data['delivery_time'] );
    } 

    if( isset( $data['delivery_address'] ) ) {
        $order->update_meta_data( '_delivery_address', sanitize_text_field( $data['delivery_address'] ) );
    }

    if( isset( $data['freegift_checkbox'] ) ) {
        $order->update_meta_data( '_freegift_checkbox', sanitize_text_field( $data['freegift_checkbox'] ) );
    }
    if( isset( $data['freegift_msg'] ) ) {
        $order->update_meta_data( '_freegift_msg', sanitize_text_field( $data['freegift_msg'] ) );
    }
}
add_action( 'woocommerce_checkout_create_order', 'seese_save_custom_checkout_fields', 10, 2 );

// display the extra data in the order admin panel
function seese_display_custom_checkout_data_in_admin( $order ){  ?>
  <div class="order_data_column">
    <h4><?php esc_html_e( 'Billing Details', 'seese' ); ?><a href="#" class="edit_address"><?php _e( 'Edit', 'seese' ); ?></a></h4>
    <div class="address">
      <?php 
      if ($order->get_meta( '_delivery_option' ) == 'A') { $delOption = esc_html__('Specify the address and time of delivery', 'seese'); } 
      else { $delOption = esc_html__('Do not call the recipient before the delivery', 'seese'); }

      if ($order->get_meta( '_delivery_time' ) == 'A') { $delTime = esc_html__('Arrange time + 499 '.get_woocommerce_currency().' ', 'seese'); } 
      else { $delTime = esc_html__('Nearest time (1 - 2 hours)', 'seese'); }

      if ($order->get_meta( '_freegift_checkbox' )) { $giftCard = esc_html__('Yes', 'seese'); } 
      else { $giftCard = esc_html__('No', 'seese'); }

      echo '<p><strong>' . esc_html__( 'Sender Name', 'seese' ) . ':</strong>' . $order->get_meta( '_sender_name' ) . '</p>';
      echo '<p><strong>' . esc_html__( 'Sender Phone', 'seese' ) . ':</strong>' . $order->get_meta( '_sender_phone' ) . '</p>'; 
      echo '<p><strong>' . esc_html__( 'Sender Email', 'seese' ) . ':</strong>' . $order->get_meta( '_sender_email' ) . '</p>';
      echo '<p><strong>' . esc_html__( 'Recipient Name', 'seese' ) . ':</strong>' . $order->get_meta( '_recipient_name' ) . '</p>';
      echo '<p><strong>' . esc_html__( 'Recipient Phone', 'seese' ) . ':</strong>' . $order->get_meta( '_recipient_phone' ) . '</p>';
      echo '<p><strong>' . esc_html__( 'Delivery Option', 'seese' ) . ':</strong>' .$delOption . '</p>';
      echo '<p><strong>' . esc_html__( 'Delivery Date', 'seese' ) . ':</strong>' . $order->get_meta( '_delivery_date' ) . '</p>';
      echo '<p><strong>' . esc_html__( 'Delivery Time', 'seese' ) . ':</strong>' .$delTime . '</p>'; 
      echo '<p><strong>' . esc_html__( 'Delivery Address', 'seese' ) . ':</strong>' . $order->get_meta( '_delivery_address' ) . '</p>';
      echo '<p><strong>' . esc_html__( 'Gift Card', 'seese' ) . ':</strong>' . $giftCard . '</p>'; 
      echo '<p><strong>' . esc_html__( 'Gift Card Message', 'seese' ) . ':</strong>' . $order->get_meta( '_freegift_msg' ) . '</p>'; ?>
    </div>
    <div class="edit_address">
      <?php woocommerce_wp_text_input( array( 'id' => '_sender_name', 'label' => esc_html__( 'Sender Name', 'seese'), 'wrapper_class' => '_billing_company_field' ) ); ?>
      <?php woocommerce_wp_text_input( array( 'id' => '_sender_phone', 'label' => esc_html__( 'Sender Phone', 'seese' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
      <?php woocommerce_wp_text_input( array( 'id' => '_sender_email', 'label' => esc_html__( 'Sender Email', 'seese' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
      <?php woocommerce_wp_text_input( array( 'id' => '_recipient_name', 'label' => esc_html__( 'Recipient Name', 'seese' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
      <?php woocommerce_wp_text_input( array( 'id' => '_recipient_phone', 'label' => esc_html__( 'Recipient Phone', 'seese' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
      <?php woocommerce_wp_text_input( array( 'id' => '_delivery_option', 'label' => esc_html__( 'Delivery Option', 'seese' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
      <?php woocommerce_wp_text_input( array( 'id' => '_delivery_date', 'label' => esc_html__( 'Delivery Date', 'seese' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
      <?php woocommerce_wp_text_input( array( 'id' => '_delivery_time', 'label' => esc_html__( 'Delivery Time', 'seese' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
      <?php woocommerce_wp_text_input( array( 'id' => '_delivery_address', 'label' => esc_html__( 'Delivery Address', 'seese' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
      <?php woocommerce_wp_text_input( array( 'id' => '_freegift_checkbox', 'label' => esc_html__( 'Gift Card', 'seese' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
      <?php woocommerce_wp_text_input( array( 'id' => '_freegift_msg', 'label' => esc_html__( 'Gift Card Message', 'seese' ), 'wrapper_class' => '_billing_company_field' ) ); ?>
    </div>
  </div>
<?php }
add_action( 'woocommerce_admin_order_data_after_order_details', 'seese_display_custom_checkout_data_in_admin' );

function seese_edit_custom_checkout_data_in_admin( $order_id, $post ){
  $order = wc_get_order( $order_id );
  $order->update_meta_data( '_sender_name', wc_clean( $_POST[ '_sender_name' ] ) );
  $order->update_meta_data( '_sender_phone', wc_clean( $_POST[ '_sender_phone' ] ) );
  $order->update_meta_data( '_sender_email', wc_clean( $_POST[ '_sender_email' ] ) );
  $order->update_meta_data( '_recipient_name', wc_clean( $_POST[ '_recipient_name' ] ) );
  $order->update_meta_data( '_recipient_phone', wc_clean( $_POST[ '_recipient_phone' ] ) );
  $order->update_meta_data( '_delivery_option', wc_clean( $_POST[ '_delivery_option' ] ) );
  $order->update_meta_data( '_delivery_date', wc_clean( $_POST[ '_delivery_date' ] ) );
  $order->update_meta_data( '_delivery_time', wc_clean( $_POST[ '_delivery_time' ] ) );
  $order->update_meta_data( '_delivery_address', wc_clean( $_POST[ '_delivery_address' ] ) );
  $order->update_meta_data( '_freegift_checkbox', wc_clean( $_POST[ '_freegift_checkbox' ] ) );
  $order->update_meta_data( '_freegift_msg', wc_clean( $_POST[ '_freegift_msg' ] ) );
  $order->save_meta_data();
}
add_action( 'woocommerce_process_shop_order_meta', 'seese_edit_custom_checkout_data_in_admin', 45, 2 );

function seese_display_custom_order_data( $order_id ){  
    $order = wc_get_order( $order_id ); 
    
    if ($order->get_meta( '_delivery_option' ) == 'A') { $delOption = esc_html__('Specify the address and time of delivery', 'seese'); } 
    else { $delOption = esc_html__('Do not call the recipient before the delivery', 'seese'); }

    if ($order->get_meta( '_delivery_time' ) == 'A') { $delTime = esc_html__('Arrange time + 499 '.get_woocommerce_currency().' ', 'seese'); } 
    else { $delTime = esc_html__('Nearest time (1 - 2 hours)', 'seese'); }

    if ($order->get_meta( '_freegift_checkbox' )) { $giftCard = esc_html__('Yes', 'seese'); } 
    else { $giftCard = esc_html__('No', 'seese'); } ?>

    <h2><?php esc_html_e( 'Billing details', 'seese' ); ?></h2>
    <table class="woocommerce-table woocommerce-table--order-details shop_table order_details custom_billing_details">
        <tbody>
            <tr>
                <th><?php esc_html_e( 'Sender Name:', 'seese' ); ?></th>
                <td><?php echo $order->get_meta( '_sender_name' ); ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Sender Phone:', 'seese' ); ?></th>
                <td><?php echo $order->get_meta( '_sender_phone' ); ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Sender Email:', 'seese' ); ?></th>
                <td><?php echo $order->get_meta( '_sender_email' ); ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Recipient Name:', 'seese' ); ?></th>
                <td><?php echo $order->get_meta( '_recipient_name' ); ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Recipient Phone:', 'seese' ); ?></th>
                <td><?php echo $order->get_meta( '_recipient_phone' ); ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Delivery Option:', 'seese' ); ?></th>
                <td><?php echo $delOption; ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Delivery Date:', 'seese' ); ?></th>
                <td><?php echo $order->get_meta( '_delivery_date' ); ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Delivery Time:', 'seese' ); ?></th>
                <td><?php echo $delTime; ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Delivery Address:', 'seese' ); ?></th>
                <td><?php echo $order->get_meta( '_delivery_address' ); ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Gift Card:', 'seese' ); ?></th>
                <td><?php echo $giftCard; ?></td>
            </tr>
            <tr>
                <th><?php esc_html_e( 'Gift Card Message:', 'seese' ); ?></th>
                <td><?php echo $order->get_meta( '_freegift_msg' ); ?></td>
            </tr>
        </tbody>
    </table>
<?php }
add_action( 'woocommerce_thankyou', 'seese_display_custom_order_data', 20 );
add_action( 'woocommerce_view_order', 'seese_display_custom_order_data', 20 );

function seese_remove_customer_details_in_emails( $order, $sent_to_admin, $plain_text, $email ){
    $mailer = WC()->mailer();
    remove_action( 'woocommerce_email_customer_details', array( $mailer, 'customer_details' ), 10, 4 );
    remove_action( 'woocommerce_email_customer_details', array( $mailer, 'email_addresses' ), 20, 4 );
}
add_action( 'woocommerce_email_customer_details', 'seese_remove_customer_details_in_emails', 5, 4 );

function seese_email_order_meta_fields( $order, $sent_to_admin, $plain_text, $email ) {
    $output = '';

    if ($order->get_meta( '_delivery_option' ) == 'A') { $delOption = esc_html__('Specify the address and time of delivery', 'seese'); } 
    else { $delOption = esc_html__('Do not call the recipient before the delivery', 'seese'); }

    if ($order->get_meta( '_delivery_time' ) == 'A') { $delTime = esc_html__('Arrange time + 499 '.get_woocommerce_currency().' ', 'seese'); } 
    else { $delTime = esc_html__('Nearest time (1 - 2 hours)', 'seese'); }

    if ($order->get_meta( '_freegift_checkbox' )) { $giftCard = esc_html__('Yes', 'seese'); } 
    else { $giftCard = esc_html__('No', 'seese'); }
    
    $output .= '<div><h2>' . esc_html__( 'Billing details', 'seese' ) .'</h2></div>';
    $output .= '<div><strong>' . esc_html__( 'Sender Name:', 'seese' ) . '</strong> <span class="text">' . $order->get_meta( '_sender_name' ) . '</span></div>';
    $output .= '<div><strong>' . esc_html__( 'Sender Phone:', 'seese' ) . '</strong> <span class="text">' . $order->get_meta( '_sender_phone' ) . '</span></div>';
    $output .= '<div><strong>' . esc_html__( 'Sender Email:', 'seese' ) . '</strong> <span class="text">' . $order->get_meta( '_sender_email' ) . '</span></div>';
    $output .= '<div><strong>' . esc_html__( 'Recipient Name:', 'seese' ) . '</strong> <span class="text">' . $order->get_meta( '_recipient_name' ) . '</span></div>';
    $output .= '<div><strong>' . esc_html__( 'Recipient Phone:', 'seese' ) . '</strong> <span class="text">' . $order->get_meta( '_recipient_phone' ) . '</span></div>';
    $output .= '<div><strong>' . esc_html__( 'Delivery Option:', 'seese' ) . '</strong> <span class="text">' . $delOption . '</span></div>';
    $output .= '<div><strong>' . esc_html__( 'Delivery Date:', 'seese' ) . '</strong> <span class="text">' . $order->get_meta( '_delivery_date' ) . '</span></div>';
    $output .= '<div><strong>' . esc_html__( 'Delivery Time:', 'seese' ) . '</strong> <span class="text">' . $delTime . '</span></div>';
    $output .= '<div><strong>' . esc_html__( 'Delivery Address:', 'seese' ) . '</strong> <span class="text">' . $order->get_meta( '_delivery_address' ) . '</span></div>';
    $output .= '<div><strong>' . esc_html__( 'Gift Card:', 'seese' ) . '</strong> <span class="text">' . $giftCard . '</span></div>';
    $output .= '<div><strong>' . esc_html__( 'Gift Card Message:', 'seese' ) . '</strong> <span class="text">' . $order->get_meta( '_freegift_msg' ) . '</span></div>';

    echo $output;
}
add_action('woocommerce_email_customer_details', 'seese_email_order_meta_fields', 25, 4 );

if ( ! function_exists( 'seese_child_scripts_styles' ) ) {
  function seese_child_scripts_styles() {
    wp_enqueue_style( 'jquery-ui-css', get_stylesheet_directory_uri()  .'/assets/css/jquery-ui.css', array(), '1.12.1', 'all' );
    wp_enqueue_script( 'jquery-ui-datepicker', array( 'jquery' ) );
    wp_enqueue_script( 'seese-child-scripts', get_stylesheet_directory_uri() . '/assets/js/child-scripts.js', array( 'jquery' ), ELSEY_VERSION, true );
  }
  add_action( 'wp_enqueue_scripts', 'seese_child_scripts_styles' );
}

add_action( 'woocommerce_cart_calculate_fees', 'woo_custom_add_cart_fee' ); 
function woo_custom_add_cart_fee( $cart ) {
  global $woocommerce;
  if ( ! $_POST || ( is_admin() && ! is_ajax() ) ) {
    return;
  }
  if ( isset( $_POST['post_data'] ) ) {
    parse_str( $_POST['post_data'], $post_data );
  } else {
	$post_data = $_POST;
  }
  if ( $post_data['delivery_time'] === 'A' ) {
	$surcharge = 499;    
	$woocommerce->cart->add_fee( esc_html__('Charge', 'seese'), $surcharge, true, '' );
  }
}