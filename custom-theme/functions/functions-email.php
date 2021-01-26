<?php
add_action('admin_menu', 'register_my_custom_menu');

function register_my_custom_menu() {
    add_menu_page('Exit Popup', 'Exit Popup', 'publish_posts', 'email_setting', 'func_master_screen', 'dashicons-desktop');
}

function func_master_screen() {
    require ABSPATH . 'wp-content/themes/monawar/tpl-email.php';
}

add_action('wp_ajax_get_all_email_list', 'get_all_email_list');
add_action('wp_ajax_nopriv_get_all_email_list', 'get_all_email_list');
function get_all_email_list() {
    global $wpdb;
    if($_POST['order'][0]['column'] == 1){
        $oreder_by = "ORDER BY `email` ".$_POST['order'][0]['dir'];
    }
    if(empty($_POST['search']['value'])){
        $sql = "SELECT * FROM wp_client_email WHERE 1";
        $wpdb->get_results($sql);
        $count = $wpdb->num_rows;
        if ($_POST['start'] == 0 || empty($_POST['start'])) {
            $sql = "SELECT * FROM wp_client_email WHERE 1 " . $oreder_by . " LIMIT " . $_POST['length'] . "  OFFSET 0";
            $result = $wpdb->get_results($sql);
        } else {
            $sql = "SELECT * FROM wp_client_email WHERE 1 " . $oreder_by . " LIMIT " . $_POST['length'] . " OFFSET " . $_POST['start'];
            $result = $wpdb->get_results($sql);
        }
        $data = array();
        $sr_no =  $_POST['start'];
        if ($result) {
            foreach ($result as $post) {
                $sr_no++;
                $data[] = array('id' => $sr_no, 'mail' => $post->email, 'update' => $post->id, 'delete' => $post->id);
            }
        }
        $req = array('draw' => $_GET['draw'], "recordsTotal" => $count, "recordsFiltered" => $count, 'data' => $data);
    } else {
        $sql = "SELECT * FROM wp_client_email WHERE `email` LIKE '%" . $_POST['search']['value'] . "%'";
        $wpdb->get_results($sql);
        $count = $wpdb->num_rows;
        if ($_POST['start'] == 0 || empty($_POST['start'])) {
            $sql = "SELECT * FROM wp_client_email WHERE `email` LIKE '%" . $_POST['search']['value'] . "%' " . $oreder_by . " LIMIT " . $_POST['length'] . " OFFSET 0";
            $result = $wpdb->get_results($sql);
        } else {
            $sql = "SELECT * FROM wp_client_email WHERE `email` LIKE '%" . $_POST['search']['value'] . "%' " . $oreder_by . " LIMIT " . $_POST['length'] . " OFFSET " . $_POST['start'];
            $result = $wpdb->get_results($sql);
        }
        $data = array();
        $sr_no =  $_POST['start'];
        if ($result) {
            foreach ($result as $post) {
                $sr_no++;
                $data[] = array('id' => $sr_no, 'mail' => $post->email, 'update' => $post->id, 'delete' => $post->id);
            }
        }
        $req = array('draw' => $_GET['draw'], "recordsTotal" => $count, "recordsFiltered" => $count, 'data' => $data);
    }
    echo json_encode($req);
    exit();
}

add_action('wp_ajax_add_email_data', 'add_email_data');
add_action('wp_ajax_nopriv_add_email_data', 'add_email_data');
function add_email_data() {
        global $wpdb;
        $date = date("Y-m-d");
        $data_id = $wpdb->insert('wp_client_email', array(
                'email' => $_POST['email'],
                'mail_date' => $date,
                'mail_template_id' => 1281
            )
        );
        if ($data_id) {
            $return = array(
                'data_id' => $data_id,
                'status' => "success"
            );
            $post = get_post(1281);
            $mail_subject = get_field('subject_line', $post->ID);
            $mail_message = $post->post_content;
            sendMailNow($_POST['email'], $mail_subject, $mail_message);
        } else {
            $return = array(
                'data_id' => "missing",
                'status' => "fail"
            );
        }
        // $post = get_post(1198);
        // $mail_subject = get_field('subject_line', $post->ID);
        // $mail_message = $post->post_content;
        // sendMailNow($_POST['email'], $mail_subject, $mail_message);
        echo json_encode($return);
        wp_die();
}

add_action('wp_ajax_delete_email_data', 'delete_email_data');
add_action('wp_ajax_nopriv_delete_email_data', 'delete_email_data');
function delete_email_data() {
    global $wpdb;
    $id = $_POST['id'];
    $email = $_POST['email'];
    $sql = "DELETE FROM `wp_client_email` WHERE `id` = " . $id . " AND `email` = '" . $email . "'";
    $result = $wpdb->get_results($sql);
    $return = "success";
    echo json_encode($return);
    wp_die();
}

add_action('wp_ajax_update_email_data', 'update_email_data');
add_action('wp_ajax_nopriv_update_email_data', 'update_email_data');
function update_email_data() {
    global $wpdb;
    $id = $_POST['id'];
    $email = $_POST['email'];
    $sql = "UPDATE `wp_client_email` SET `email`='" . $email . "' WHERE `id` = " . $id . " ;";
    $result = $wpdb->get_results($sql);
    $return = "success";
    echo json_encode($return);
    wp_die();
}

add_action('wp_ajax_set_email_data', 'set_email_data');
add_action('wp_ajax_nopriv_set_email_data', 'set_email_data');
function set_email_data() {
    global $wpdb;
    $email = $_POST['email'];
    $date = new date("Y-m-d");
    $sql = "INSERT INTO `wp_client_email`(`email`, `mail_date`, `mail_template_id`) VALUES ('" . $email . "','" . $date . "','1281');";
    $result = $wpdb->get_results($sql);
    $post = get_post(1281);
    $mail_subject = get_field('subject_line', $post->ID);
    $mail_message = $post->post_content;
    // sendMailNow($email, $mail_subject, $mail_message);
    $return = "success";
    echo json_encode($return);
    wp_die();
}


/************************** CRON JOB **************************/
add_action('wp_ajax_send_email_data', 'send_email_data');
add_action('wp_ajax_nopriv_send_email_data', 'send_email_data');
function send_email_data() {
    
     global $wpdb;
    $sql = "SELECT * FROM `wp_client_email` WHERE 1 ";
    $result = $wpdb->get_results($sql);
    $args = array(
    'post_type' => 'mail-template',
    'meta_key' => 'exit_popup_mail_template',
    'meta_value' => 'YES',
    'meta_compare' => '=',
    );
    $mail_template = new WP_Query( $args );
    foreach ($result as $user_data) {
        $f = 1;
        $mail_sent = explode(',',$user_data->mail_template_id);
        while ($mail_template->have_posts()) {
                $mail_template->the_post();
                if(!in_array(get_the_ID(),$mail_sent) && $f == 1){
                    echo get_the_ID().'<br>';
                    $f++;
                    $mail_subject = get_field('subject_line', get_the_ID());
                    $post = get_post(get_the_ID());
                    $mail_message = $post->post_content;

                    $today_date = new DateTime("now");
                    
                    $mail_date = new DateTime($user_data->mail_date);
                    $interval = $mail_date->diff($today_date);
                    $diff = $interval->format('%a');
                    $mail_sent_date = date("Y-m-d");
                    if ($diff > get_post_meta(get_the_ID(), 'number_of_days_deyal_after_previous_email',true)){
                        $mail_template_id = $user_data->mail_template_id .','.get_the_ID();
                        $sql = "UPDATE `wp_client_email` SET `mail_date`='" .$mail_sent_date. "',`mail_template_id`='" . $mail_template_id . "' WHERE `id` = '". $user_data->id ."' AND `email`= '". $user_data->email ."'";
                        $wpdb->query($sql);
                        sendMailNow($user_data->email, $mail_subject, $mail_message);
                    } else if(empty(get_post_meta(get_the_ID(), 'number_of_days_deyal_after_previous_email',true))){
                        $sql = "UPDATE `wp_client_email` SET `mail_date`='" .$mail_sent_date. "',`mail_template_id`='" . get_the_ID() . "' WHERE `id` = '". $user_data->id ."' AND `email`= '". $user_data->email ."'";
                        $wpdb->query($sql);
                        sendMailNow($user_data->email, $mail_subject, $mail_message);
                    }
                }
        }
    }
    echo json_encode('Email Sent successfully');
    wp_die();
}

add_action('wp_ajax_exit_popup_data', 'exit_popup_data');
add_action('wp_ajax_nopriv_exit_popup_data', 'exit_popup_data');
function exit_popup_data() {
    update_option( 'exit_popup_heading_text', $_POST['heading']);
    update_option( 'exit_popup_regular_text', $_POST['regular']);
    update_option( 'exit_popup_text_after_image', $_POST['text_after_image']);
    update_option( 'exit_popup_input_placeholder', $_POST['input_placeholder']);
    update_option( 'exit_popup_button_text', $_POST['button']);
    update_option( 'show_exit_popup', $_POST['exit_popup']);
    $return = array(
        'status' => "success"
    );
    echo json_encode($return);
    wp_die();
}