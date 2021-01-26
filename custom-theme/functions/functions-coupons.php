<?php
add_action('wp_ajax_nopriv_check_plan_type', 'check_plan_type');
add_action('wp_ajax_check_plan_type', 'check_plan_type');

function check_plan_type(){ 
    $plan_type = $_POST['plan_type'];
    $plan_ID = $_POST['plan_ID'];
    $promo_code = $_POST['promo_code'];     
    $autorenew = $_POST['autorenew'];
    // $key_price = 'plan_price_'.$plan_type; 
    // $key_sell_price = 'plan_sell_price_'.$plan_type;
    // $regular_price = get_field($key_price , $plan_ID);
    // $sale_price = get_field($key_sell_price , $plan_ID);

    // if($sale_price !='' && $sale_price < $regular_price)
    // {
    //     $plan_price = $sale_price;
    // } else {
    //     $plan_price = $regular_price;
    // }
    if($autorenew == 'yes'){
        $key_sell_price = 'plan_sell_price_'.$plan_type;
        $sale_price = get_field($key_sell_price , $plan_ID);
        $plan_price = $sale_price;
        $monthly_price= $plan_price;
    } else{
        $key_price = 'plan_price_'.$plan_type; 
        $regular_price = get_field($key_price , $plan_ID);
        $plan_price = $regular_price;
        $monthly_price = $plan_price;
    }
    if($plan_type == 2){
        $plan_price = 3*$plan_price;
    } elseif ($plan_type == 3) {
        $plan_price = 6*$plan_price;
    } elseif ($plan_type == 4) {
        $plan_price = 12*$plan_price;
    }
    if(empty($promo_code)) {
        $response = array('success'=>1, 'discounted_price' => round($plan_price), 'monthly_price' => $monthly_price);        
    } else {
        $response = validate_coupon($promo_code, $plan_ID , $plan_price, $plan_type);    
    }
    
    echo json_encode($response);
    exit();
}

add_action('wp_ajax_nopriv_validate_coupon', 'validate_coupon_callback');
add_action('wp_ajax_validate_coupon', 'validate_coupon_callback');

function validate_coupon($coupon_code, $plan_ID, $actual_price, $plan_type) {
    //$actual_price = get_post_meta($plan_ID, 'price' , true );
    $error= false;
    $response = array();
    $message= '';
    
    global $wpdb;
     $sqlQuery = "SELECT post_id FROM $wpdb->postmeta WHERE `meta_key` = 'coupon_code' AND `meta_value` = '{$coupon_code}'"; // add between date code 
     $post_id = $wpdb->get_var($sqlQuery);
     $specific_plan =  get_field('specific_plan' , $post_id);
     $dateTime = new DateTime('now'); 
     $plans = get_field('for_plan' ,$post_id); 
     
    $today = time(); // or your date as well
    if($post_id) { 
         $start_date = get_field('start_date',$post_id);
         $start_timestamp = strtotime($start_date); 
         $end_date = get_field('end_date',$post_id);
         $end_timestamp = strtotime($end_date);
    } else { 
        $error = true;
        //$message['coupon_exist'] = 'Coupon does not exist';
        $message = 'Coupon Code Not Valid';
         $response['success']= 0;
         $response['message']=$message;
         //echo $result = json_encode($response); 
         //die;
    }
    
    if($today>=$start_timestamp && $today<=$end_timestamp){
        $use_only = get_field('singlemultipal',$post_id);
    } else {
        $error = true;
        $message ='Coupon Code Expired';
        $response['success']= 0;
        $response['message']=$message;
        //echo $result = json_encode($response); die;
    }
    
    if($use_only = 'single'){
        $coupon_used = get_post_meta($post_id , 'coupon_used' , true);
        if($coupon_used){
            $error = true;
            //$message['coupon_used'] = 'Coupon already used';
            $message = 'Coupon already used';
            $response['success']= 0;
            $response['message']=$message;
            //echo $result = json_encode($response); die;
        }
    }

    if($specific_plan){
        $plans = get_field('for_plan' ,$post_id);
        if(!in_array($plan_ID, $plans)){
            $error = true;
            $message = 'Coupon is not valid for your selected membership';
            $response['success']= 0;
            $response['message']=$message;
            //echo $result = json_encode($response); die;
            }
    }
    if(!$error){       
         $message ='Coupon has been applied';
         $response['success']= 1;
         $response['message']=$message;
         $coupon_type = get_field( 'coupon_type' , $post_id);

         $billing_days_delay = get_field( 'billing_days_delay' , $post_id);
         $response['billing_days_delay']=$billing_days_delay ? $billing_days_delay : '';
         
         //$response['actual_price'] = round($actual_price);
         $response['actual_price'] = number_format($actual_price, 2);
         
         if($coupon_type == 'price') {
            $discount_price = get_field('discounted_price' , $post_id);
            $discount_price = (int) $discount_price;

            if($plan_type == 2){
                $discount_price = 3*$discount_price;
            } elseif($plan_type == 3){
                $discount_price = 6*$discount_price;
            } elseif($plan_type == 4){
                $discount_price = 12*$discount_price;
            }

            $new_discount_price = $actual_price - $discount_price;            
            $response['discount'] = $discount_price;
            $response['type'] = 'price';
        }
        
        if($coupon_type =='percentage') {
            $discount_percentage = get_field('discount_percentage' , $post_id);
            $new_discount_price = $actual_price - (($actual_price * $discount_percentage) / 100);
            $response['discount'] = $discount_percentage;
            $response['type'] = 'percentage';
        }
        
        //$response['discounted_price'] = round($new_discount_price);
        $response['discounted_price'] = number_format($new_discount_price, 2);
    }   
   
   return $response;
}


function validate_coupon_callback() {
    $coupon_code = $_POST['coupon_code'];
    $plan_ID = $_POST['plan_ID'];
    $plan_type = $_POST['plan_type'];
    $autorenew = $_POST['autorenew'];
    if($autorenew == 'yes'){
        $key_sell_price = 'plan_sell_price_'.$plan_type;
        $sale_price = get_field($key_sell_price , $plan_ID);
        $plan_price = $sale_price;
    } else{
        $key_price = 'plan_price_'.$plan_type; 
        $regular_price = get_field($key_price , $plan_ID);
        $plan_price = $regular_price;
    }
    if($plan_type == 2){
        $plan_price = 3*$plan_price;
    } elseif ($plan_type == 3) {
        $plan_price = 6*$plan_price;
    } elseif ($plan_type == 4) {
        $plan_price = 12*$plan_price;
    }
    $response = validate_coupon($coupon_code, $plan_ID, $plan_price, $plan_type);
    echo json_encode($response);
    exit();
}

add_action('wp_ajax_nopriv_validate_macro_coupon', 'validate_macro_coupon_callback');
add_action('wp_ajax_validate_macro_coupon', 'validate_macro_coupon_callback');

function validate_macro_coupon_callback() {
    $coupon_code = $_POST['coupon_code'];
    $plan_ID = $_POST['plan_ID'];
    $plan_type = 1;//$_POST['plan_type'];
    $autorenew = $_POST['autorenew'];
    if($autorenew == 'yes'){
        $key_sell_price = 'plan_sell_price_'.$plan_type;
        $sale_price = get_field($key_sell_price , $plan_ID);
        $plan_price = $sale_price;
    } else{
        $key_price = 'plan_price_'.$plan_type; 
        $regular_price = get_field($key_price , $plan_ID);
        $plan_price = $regular_price;
    }
    //echo '<pre>'; print_r($plan_price); print_r($_POST);die('Testing..');

    if($plan_type == 2){
        $plan_price = 3*$plan_price;
    } elseif ($plan_type == 3) {
        $plan_price = 6*$plan_price;
    } elseif ($plan_type == 4) {
        $plan_price = 12*$plan_price;
    }
    $response = validate_macro_coupon($coupon_code, $plan_ID, $plan_price, $plan_type);
    echo json_encode($response);
    exit();
}

function validate_macro_coupon($coupon_code, $plan_ID, $actual_price, $plan_type) {
    //$actual_price = get_post_meta($plan_ID, 'price' , true );
    $error= false;
    $response = array();
    $message= '';
    
    global $wpdb;
     $sqlQuery = "SELECT post_id FROM $wpdb->postmeta WHERE `meta_key` = 'coupon_code' AND `meta_value` = '{$coupon_code}'"; // add between date code 
     $post_id = $wpdb->get_var($sqlQuery);
     $specific_plan =  get_field('specific_plan' , $post_id);
     $dateTime = new DateTime('now'); 
     $plans = get_field('for_plan' ,$post_id); 
     
    $today = time(); // or your date as well
    if($post_id) { 
         $start_date = get_field('start_date',$post_id);
         $start_timestamp = strtotime($start_date); 
         $end_date = get_field('end_date',$post_id);
         $end_timestamp = strtotime($end_date);
    } else { 
        $error = true;
        //$message['coupon_exist'] = 'Coupon does not exist';
        $message = 'Coupon Code Not Valid';
         $response['success']= 0;
         $response['message']=$message;
         //echo $result = json_encode($response); 
         //die;
    }
    
    if($today>=$start_timestamp && $today<=$end_timestamp){
        $use_only = get_field('singlemultipal',$post_id);
    } else {
        $error = true;
        $message ='Coupon Code Expired';
        $response['success']= 0;
        $response['message']=$message;
        //echo $result = json_encode($response); die;
    }
    
    if($use_only = 'single'){
        $coupon_used = get_post_meta($post_id , 'coupon_used' , true);
        if($coupon_used){
            $error = true;
            //$message['coupon_used'] = 'Coupon already used';
            $message = 'Coupon already used';
            $response['success']= 0;
            $response['message']=$message;
            //echo $result = json_encode($response); die;
        }
    }

    if($specific_plan){
        $plans = get_field('for_plan' ,$post_id);
        if(!in_array($plan_ID, $plans)){
            $error = true;
            $message = 'Coupon is not valid for your selected membership';
            $response['success']= 0;
            $response['message']=$message;
            //echo $result = json_encode($response); die;
            }
    }
    if(!$error){       
         $message ='Coupon has been applied';
         $response['success']= 1;
         $response['message']=$message;
         $coupon_type = get_field( 'coupon_type' , $post_id);

         $billing_days_delay = get_field( 'billing_days_delay' , $post_id);
         $response['billing_days_delay']=$billing_days_delay ? $billing_days_delay : '';
         
         //$response['actual_price'] = round($actual_price);
         $response['actual_price'] = number_format($actual_price, 2);
         
         if($coupon_type == 'price') {
            $discount_price = get_field('discounted_price' , $post_id);
            $discount_price = (int) $discount_price;

            if($plan_type == 2){
                $discount_price = 3*$discount_price;
            } elseif($plan_type == 3){
                $discount_price = 6*$discount_price;
            } elseif($plan_type == 4){
                $discount_price = 12*$discount_price;
            }

            $new_discount_price = $actual_price - $discount_price;            
            $response['discount'] = $discount_price;
            $response['type'] = 'price';
        }
        
        if($coupon_type =='percentage') {
            $discount_percentage = get_field('discount_percentage' , $post_id);
            $new_discount_price = $actual_price - (($actual_price * $discount_percentage) / 100);
            $response['discount'] = $discount_percentage;
            $response['type'] = 'percentage';
        }
        
        //$response['discounted_price'] = round($new_discount_price);
        $response['discounted_price'] = number_format($new_discount_price, 2);
    }   
   
   return $response;
}



function get_autorenewprice() {
    $plan = $_REQUEST['planid'];
    $coupon_code = $_REQUEST['code'];
    $sale_price = array();
    $sale_price['1 month'] = get_field('plan_sell_price_1',$plan);
    $sale_price['3 months'] = get_field('plan_sell_price_2',$plan);
    $sale_price['6 months'] = get_field('plan_sell_price_3',$plan);
    $year = get_field('plan_sell_price_4',$plan);
    if(!empty($year)){
        $sale_price['1 year'] = $year;
    }
    if (!empty($coupon_code)){
        $discounted_price = validate_coupon($coupon_code, $plan, $sale_price['1 month'],1);
        $response['discounted_price'] = $discounted_price['discounted_price'];
    } else {
        $response['discounted_price'] = '';
    }
    $response['sale_price'] = $sale_price;
    echo json_encode($response);
    exit();
}



add_action('wp_ajax_nopriv_get_autorenewprice', 'get_autorenewprice');
add_action('wp_ajax_get_autorenewprice', 'get_autorenewprice');

function get_nonautorenewprice() {
    $plan = $_REQUEST['planid'];
    $coupon_code = $_REQUEST['code'];
    $sale_price = array();
    $sale_price['1 month'] = get_field('plan_price_1',$plan);
    $sale_price['3 months'] = get_field('plan_price_2',$plan);
    $sale_price['6 months'] = get_field('plan_price_3',$plan);
    $year = get_field('plan_price_4',$plan);
    if(!empty($year)){
        $sale_price['1 year'] = $year;
    }
    if (!empty($coupon_code)){
        $discounted_price = validate_coupon($coupon_code, $plan, $sale_price['1 month'],1);
        $response['discounted_price'] = $discounted_price['discounted_price'];
    } else {
        $response['discounted_price'] = '';
    }
    $response['sale_price'] = $sale_price;
    echo json_encode($response);
    exit();
}

add_action('wp_ajax_nopriv_get_nonautorenewprice', 'get_nonautorenewprice');
add_action('wp_ajax_get_nonautorenewprice', 'get_nonautorenewprice');


function get_plans_details() {
    $plan_slug = $_POST['program_plan'];
    $args = array(
        'post_type' => 'plans',
        'post_status' => 'publish',
        'name' => $plan_slug,

    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post(); 
            $result = array(
                'title' => get_the_title(),
                'id' => get_the_ID(),
                'sale_price_1' => get_field('plan_sell_price_1'),
                'sale_price_2' => get_field('plan_sell_price_2'),
                'sale_price_3' => get_field('plan_sell_price_3'),
                'sale_price_4' => get_field('plan_sell_price_4'),
                'sub_title' => get_field('bottom_quote')
            );
        }
    }
    $result['success'] = '1';
    echo json_encode($result);
    exit();
}

add_action('wp_ajax_nopriv_get_plans_details', 'get_plans_details');
add_action('wp_ajax_get_plans_details', 'get_plans_details');
