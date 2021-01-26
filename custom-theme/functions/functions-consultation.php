<?php
add_action('admin_menu', 'register_my_cconsultation_menu');

function register_my_cconsultation_menu() {
    add_menu_page('Consultation Popup', 'Consultation Popup', 'publish_posts', 'consultation_setting', 'func_consultation_screen', 'dashicons-desktop');
}

function func_consultation_screen() {
    require ABSPATH . 'wp-content/themes/monawar/tpl-consultation.php';
}

add_action('wp_ajax_get_all_consultation_email_list', 'get_all_consultation_email_list');
add_action('wp_ajax_nopriv_get_all_consultation_email_list', 'get_all_consultation_email_list');
function get_all_consultation_email_list() {
    global $wpdb;
    if($_POST['order'][0]['column'] == 1){
        $oreder_by = "ORDER BY `user_name` ".$_POST['order'][0]['dir'];
    } else if($_POST['order'][0]['column'] == 2){
        $oreder_by = "ORDER BY `user_number` ".$_POST['order'][0]['dir'];
    } else if($_POST['order'][0]['column'] == 3){
        $oreder_by = "ORDER BY `user_email` ".$_POST['order'][0]['dir'];
    }
    if(empty($_POST['search']['value'])){
        $sql = "SELECT * FROM consultation_popup WHERE 1";
        $wpdb->get_results($sql);
        $count = $wpdb->num_rows;
        if ($_POST['start'] == 0 || empty($_POST['start'])) {
            $sql = "SELECT * FROM consultation_popup WHERE 1 " . $oreder_by . " LIMIT " . $_POST['length'] . "  OFFSET 0";
            $result = $wpdb->get_results($sql);
        } else {
            $sql = "SELECT * FROM consultation_popup WHERE 1 " . $oreder_by . " LIMIT " . $_POST['length'] . " OFFSET " . $_POST['start'];
            $result = $wpdb->get_results($sql);
        }
        $data = array();
        $sr_no =  $_POST['start'];
        if ($result) {
            foreach ($result as $post) {
                $sr_no++;
                $data[] = array('id' => $sr_no, 'name' => $post->user_name, 'number' => $post->user_number ,'mail' => $post->user_email, 'update' => $post->id, 'delete' => $post->id);
            }
        }
        $req = array('draw' => $_GET['draw'], "recordsTotal" => $count, "recordsFiltered" => $count, 'data' => $data);
    } else {
        $sql = "SELECT * FROM consultation_popup WHERE `user_name` LIKE '%" . $_POST['search']['value'] . "%' OR `user_number` LIKE '%" . $_POST['search']['value'] . "%' OR `user_email` LIKE '%" . $_POST['search']['value'] . "%'";
        $wpdb->get_results($sql);
        $count = $wpdb->num_rows;
        if ($_POST['start'] == 0 || empty($_POST['start'])) {
            $sql = "SELECT * FROM consultation_popup WHERE `user_name` LIKE '%" . $_POST['search']['value'] . "%' OR `user_number` LIKE '%" . $_POST['search']['value'] . "%' OR `user_email` LIKE '%" . $_POST['search']['value'] . "%' " . $oreder_by . " LIMIT " . $_POST['length'] . " OFFSET 0";
            $result = $wpdb->get_results($sql);
        } else {
            $sql = "SELECT * FROM consultation_popup WHERE `user_name` LIKE '%" . $_POST['search']['value'] . "%' OR `user_number` LIKE '%" . $_POST['search']['value'] . "%' OR `user_email` LIKE '%" . $_POST['search']['value'] . "%' " . $oreder_by . " LIMIT " . $_POST['length'] . " OFFSET " . $_POST['start'];
            $result = $wpdb->get_results($sql);
        }
        $data = array();
        $sr_no =  $_POST['start'];
        if ($result) {
            foreach ($result as $post) {
                $sr_no++;
                $data[] = array('id' => $sr_no, 'name' => $post->user_name, 'number' => $post->user_number ,'mail' => $post->user_email, 'update' => $post->id, 'delete' => $post->id);
            }
        }
        $req = array('draw' => $_GET['draw'], "recordsTotal" => $count, "recordsFiltered" => $count, 'data' => $data);
    }
    echo json_encode($req);
    exit();
}

add_action('wp_ajax_delete_consultation_email_data', 'delete_consultation_email_data');
add_action('wp_ajax_nopriv_delete_consultation_email_data', 'delete_consultation_email_data');
function delete_consultation_email_data() {
    global $wpdb;
    $id = $_POST['id'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $sql = "DELETE FROM `consultation_popup` WHERE `id` = " . $id . " AND `user_email` = '" . $email . "' AND `user_name` = '" . $name . "' AND `user_number` = '" . $number . "'";
    $result = $wpdb->get_results($sql);
    $return = "success";
    echo json_encode($return);
    wp_die();
}

add_action('wp_ajax_update_consultation_email_data', 'update_consultation_email_data');
add_action('wp_ajax_nopriv_update_consultation_email_data', 'update_consultation_email_data');
function update_consultation_email_data() {
    global $wpdb;
    $id = $_POST['id'];
    $email = $_POST['email'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $sql = "UPDATE `consultation_popup` SET `user_email`='" . $email . "',`user_name`='" . $name . "',`user_number`='" . $number . "' WHERE `id` = " . $id . " ;";
    $result = $wpdb->get_results($sql);
    $return = "success";
    echo json_encode($return);
    wp_die();
}

add_action('wp_ajax_set_consultation_email_data', 'set_consultation_email_data');
add_action('wp_ajax_nopriv_set_consultation_email_data', 'set_consultation_email_data');
function set_consultation_email_data() {
    global $wpdb;
    $email = $_POST['email'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $sql = "INSERT INTO `consultation_popup`(`user_name`, `user_number`, `user_email`) VALUES ('" . $name . "','" . $number . "','" . $email . "');";
    $result = $wpdb->get_results($sql);
    $post = get_post(1387);
    $mail_subject = get_field('subject_line', $post->ID);
    $mail_message = $post->post_content;

    $mail_data['FIRST_NAME'] = $name;
    $mail_message = replaceKeyWords($mail_data, $mail_message);
    
    sendMailNow($email, $mail_subject, $mail_message);

    $post = get_post(1414);
    $mail_subject = get_field('subject_line', $post->ID);
    $mail_message = $post->post_content;

    $mail_data['USER_NAME'] = $name;
    $mail_data['USER_EMAIL'] = $email;
    $mail_data['PHONE_NUMBER'] = $number;

    $mail_message = replaceKeyWords($mail_data, $mail_message);
    
    // sendMailNow('lattoo.krushang@gmail.com', $mail_subject, $mail_message);
    sendMailNow('nparsont@gmail.com', $mail_subject, $mail_message);
    sendMailNow('zackmonawarfitness@gmail.com', $mail_subject, $mail_message);

    $return = "success";
    echo json_encode($return);
    wp_die();
}

add_action('wp_ajax_consultation_popup_data', 'consultation_popup_data');
add_action('wp_ajax_nopriv_consultation_popup_data', 'consultation_popup_data');
function consultation_popup_data() {
    // update_option( 'consultation_heading_text', $_POST['consultation_heading']);
    update_option( 'show_consultation_popup', $_POST['consultation_popup']);
    $return = array(
        'status' => "success"
    );
    echo json_encode($return);
    wp_die();
}