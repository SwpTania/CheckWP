<?php

function mail_template_type() {

    $labels = array(
        'name' => 'Mail Templates',
        'singular_name' => 'Mail Template',
        'menu_name' => 'Mail Template',
    );
    $args = array(
        'label' => 'Mail Template',
        'labels' => $labels,
        'supports' => array('title', 'editor'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 5,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('mail-template', $args);
}

add_action('init', 'mail_template_type');

function CustomerMailTemplate($data) {
    
    if(isset($data['subscription_type'])=='macro'){
        $post = get_post(2039);
        $mail_data['USER_PASSWORD'] = $data['user_password'];
    }else{
        $post = get_post(301);
    }

    $mail_subject = get_field('subject_line', $post->ID);
    $mail_message = $post->post_content;
    //$mail_message = apply_filters('the_content', $mail_message);

    $mail_data['USER_NAME'] = $data['user_name'];
    $mail_data['USER_EMAIL'] = $data['user_email'];
    $mail_data['PACKAGE_NAME'] = $data['package_name'];
    $mail_data['TRANSACTION_ID'] = $data['transaction_id'];
    $mail_data['INVOICE_NO'] = $data['invoice_no'];
    $mail_data['PLAN_TYPE'] = $data['plan_type'];
    $mail_data['AMOUNT_PAID'] = $data['amount_paid'];
    $mail_data['PURCHASE_DATE'] = $data['purchase_date'];
    $mail_data['AUTORENEW'] = $data['plan_autorenew'];
    $mail_data['START_DATE'] = $data['start_date'];

    $mail_subject = replaceKeyWords($mail_data, $mail_subject);
    $mail_message = replaceKeyWords($mail_data, $mail_message);

    sendMailNow($mail_data['USER_EMAIL'], $mail_subject, $mail_message);
}

function CustomerYourPlanMailTemplate($data) {
    $post = get_post(625);
    $mail_subject = get_field('subject_line', $post->ID);
    $mail_message = $post->post_content;
    
    $mail_data['USER_EMAIL'] = $data['email'];
    $mail_data['html'] = $data['html'];

    $mail_subject = replaceKeyWords($mail_data, $mail_subject);
    $mail_message = replaceKeyWords($mail_data, $mail_message);

    sendMailNow($mail_data['USER_EMAIL'], $mail_subject, $mail_message);
}

function AdministratorMailTemplate($data) {
    $post = get_post(327);

    $mail_subject = get_field('subject_line', $post->ID);
    $mail_message = $post->post_content;

    $mail_data['USER_NAME'] = $data['user_name'];
    $mail_data['USER_EMAIL'] = $data['user_email'];
    $mail_data['PACKAGE_NAME'] = $data['package_name'];
    $mail_data['TRANSACTION_ID'] = $data['transaction_id'];
    $mail_data['INVOICE_NO'] = $data['invoice_no'];
    $mail_data['PLAN_TYPE'] = $data['plan_type'];
    $mail_data['AMOUNT_PAID'] = $data['amount_paid'];
    $mail_data['PURCHASE_DATE'] = $data['purchase_date'];
    $mail_data['AUTORENEW'] = $data['plan_autorenew'];
    $mail_data['START_DATE'] = $data['start_date'];


    $mail_subject = replaceKeyWords($mail_data, $mail_subject);
    $mail_message = replaceKeyWords($mail_data, $mail_message);

    sendMailNow('wp-admin', $mail_subject, $mail_message);
}

function replaceKeyWords($array, $str) {
    foreach ($array as $key => $value) {
        $str = str_replace("[[" . $key . "]]", $value, $str);
    }
    return $str;
}

function sendMailNow($to, $subject, $message) {
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: 6PackMacros <info@6packbyzack.com>" . "\r\n";
// echo $to; die;
    // if ($to == 'wp-admin') { 
        // $to = 'info@6packbyzack.com';        
    // }
    $to1 = get_field('email_sent_to','option');
    $to2 = get_field('email_sent_to_1','option');
    $to3 = $to1.','.$to2;
    wp_mail($to, $subject, $message, $headers);
    wp_mail($to3, $subject, $message, $headers);
    wp_mail('shalabh2019cisin@mailinator.com', $subject, $message, $headers);
}
