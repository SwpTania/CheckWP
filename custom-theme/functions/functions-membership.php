<?php

add_action('wp_ajax_get_age_group', 'get_age_group');
add_action('wp_ajax_nopriv_get_age_group', 'get_age_group');
function get_age_group() {
    $args = array(
        'post_type' => 'age_group',
        'post_status' => 'publish',
        'order' => 'ASC',
    );
    $the_query = new WP_Query($args);
    $data['result'] = array();
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $data['result'][] = array(
                'title' => get_the_title(),
                'id' => get_the_ID()
            );
        }
        $data['success'] = true;
    } else {
        $data['success'] = false;
    }

    echo json_encode($data);
    exit();
}

add_action('wp_ajax_get_body_type', 'get_body_type');
add_action('wp_ajax_nopriv_get_body_type', 'get_body_type');
function get_body_type() {
    $age_range_id = $_POST['age_range'];
    $gender_id = $_POST['gender'];
    $args = array(
        'post_type' => 'program_body_type',
        'post_status' => 'publish',
        'order' => 'ASC',
        'meta_key' => 'select_gender',
        'meta_value' => $gender_id,
        'compare' => '='
    );
    echo $GLOBALS['wp_query']->request;
    $the_query = new WP_Query($args);
    $data['result'] = array();
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $age_id = get_field('select_age');
            foreach ($age_id as $value) {
                if($age_range_id == $value->ID){
                    $data['result'][] = array(
                        'title' => get_the_title(),
                        'id' => get_the_ID()
                    );
                }
            }
        }
        $data['success'] = true;
    } else {
        $data['success'] = false;
    }
    echo json_encode($data);
    exit();
}

add_action('wp_ajax_get_goal_type', 'get_goal_type');
add_action('wp_ajax_nopriv_get_goal_type', 'get_goal_type');
function get_goal_type() {
    $body_type_id = $_POST['body_type'];
    $age = $_POST['age_id'];
    $gender = $_POST['gender'];
    $plan_by_age = array();
    $args = array(
        'post_type' => 'program_goal_types',
        'post_status' => 'publish',
        'order' => 'ASC',
        'posts_per_page' => -1,
        'meta_key' => 'select_gender',
        'meta_value' => $gender,
        'compare' => '='
    );
    $the_query = new WP_Query($args);
    $data['result'] = array();
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $age_group = get_field('select_age');
            foreach ($age_group as $value) {
                if($age == $value->ID){
                    $plan_by_age[] =  get_the_ID();
                }
            }
        }
        if(!empty($plan_by_age)){
            foreach ($plan_by_age as $goal_by_age) {
                $body_type = get_field('select_body_type',$goal_by_age);
                foreach ($body_type as $body_goal) {
                    if($body_goal->ID == $body_type_id){
                        $data['result'][] = array(
                            'title' => get_the_title($goal_by_age),
                            'id' => $goal_by_age
                        );
                    }
                }   
            }
        }
        $data['success'] = true;
    } else {
        $data['success'] = false;
    }
    echo json_encode($data);
    exit();
}


add_action('wp_ajax_get_result_type', 'get_result_type');
add_action('wp_ajax_nopriv_get_result_type', 'get_result_type');
function get_result_type() {
    $data = array();
    $goal_type_id = $_POST['goal_type'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $formdata = $_POST['formData'];
    $email = $_POST['email'];
    $plans_id = get_field('select_plan',$goal_type_id);
    if (!empty($plans_id)) {
        foreach ($plans_id as $value) {
        	if($value['plan_gender'] == $gender && $value['plan_age'] == $age && $value['plan_body_type'] == $formdata['body_id']){
        		$plan = get_post($value['plan_name']);
        		$data['result'][] = array(
	                'title' => $plan->post_title,
	                'id' => $plan->ID,
	                'slug' => $plan->post_name,
	                'saleprice' => get_field('plan_sell_price_1',$plan->ID),
	                'price' => get_field('plan_price',$plan->ID),
	                'plan_highlight' => get_field('plan_highlight',$plan->IDq),
	                'bottom_quote' => get_field('bottom_quote',$plan->ID),
	                'top_benefits' => get_field('top_benefits',$plan->ID),          
	                'img_url' => get_the_post_thumbnail_url( $plan->ID,'full' )
	            );
        	}
            
        }
        $data['gender'] = get_the_title($gender);
        $data['success'] = true;
    } else {
        $data['success'] = false;
    }
    $data['option'][] = array(
        'member_option' => get_field('member_option', 'option'),
        'membership_title' => get_field('membership_title', 'option'),
        'buy_section1' => get_field('buy_section_heading_1', 'option'),
        'buy_section2' => get_field('buy_section_heading_2', 'option'),
        'buy_section3' => get_field('buy_section_heading_3', 'option'),
        'vimeo_video' => get_field('vimeo_video_url', 'option')
    );
    $args = array(
        'post_type' => 'testimonial',
        'post_status' => 'publish',
        'order' => 'ASC',
        'posts_per_page' => -1,
        'meta_key' => 'select_gender',
        'meta_value' => $gender,
        'compare' => '='
    );
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $data['testimonial'][] = array(
                'title' => get_the_title(),
                'content' => get_the_content(),
                'img_url' => get_the_post_thumbnail_url(get_the_ID(),'medium')
            );
        }
    }
    $args = array(
        'post_type' => 'program_goal_types',
        'post_status' => 'publish',
        'order' => 'ASC',
        'posts_per_page' => -1,
        'meta_key' => 'select_gender',
        'meta_value' => $gender,
        'compare' => '='
    );
    $goal = array();
    $the_query = new WP_Query($args);
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $age_group = get_field('select_age');
            foreach ($age_group as $value) {
                if($formdata['ageId'] == $value->ID){
                    $plan_by_age[] =  get_the_ID();
                }
            }
        }
        if(!empty($plan_by_age)){
            foreach ($plan_by_age as $goal_by_age) {
                $body_type = get_field('select_body_type',$goal_by_age);
                foreach ($body_type as $body_goal) {
                    if($body_goal->ID == $formdata['body_id']){
                        $goal[] = $goal_by_age;
                    }
                }   
            }
        }
    }
    if(!empty($goal)){
        foreach ($goal as $goal_id) {
            $recommended_plan = get_field('select_plan',$goal_id);
            foreach ($recommended_plan as $value) {
	            if($value['plan_gender'] == $gender && $value['plan_age'] == $age && $value['plan_body_type'] == $formdata['body_id']){
	            	if($data['result'][0]['id'] != $value['plan_name']){
	            		$plan = get_post($value['plan_name']);
		        		$data['recomended_plan'][] = array(
			                'title' => $plan->post_title,
			                'id' => $plan->ID,
			                'slug' => $plan->post_name,
			                'saleprice' => get_field('plan_sell_price_1',$plan->ID),
			                'price' => get_field('plan_price',$plan->ID),
			                'plan_highlight' => get_field('plan_highlight',$plan->IDq),
			                'bottom_quote' => get_field('bottom_quote',$plan->ID),
			                'top_benefits' => get_field('top_benefits',$plan->ID),          
			                'img_url' => get_the_post_thumbnail_url( $plan->ID,'full' )
			            );
	            	}
	            }
	        }
        }
    }

    $mail_data['email'] = $email;
    $mail_data['html'] = '';
    foreach ($data['result'] as $value) {
        $mail_data['html'] .= '
        <tr>
    <td style="text-align: center;" width="100%" bgcolor="#3b3b3b">
        <span style="font-size: 35px ; line-height: 50px ; color: #e1b30d ; font-weight: 600 ;">'.$value['title'].'</span>
    </td>
</tr>
<tr>
    <td width="100%" bgcolor="#3b3b3b">
        <ul style="text-align: center;font-weight: 600;none;padding: 0;">
            <li style="font-size: 30px;line-height: 30px;text-align: center;float: none;top: 15px;display: inline-block;position: relative;margin-left: 5px;color: #fff;margin-right: 0px;text-decoration: line-through;padding: 0;"><span>$</span>'.$value['price'].'</li>
            <li style="font-size: 30px ; line-height: 30px ; text-align: center ; float: none ; top: 15px ; display: inline-block ; position: relative ; margin-left: 5px ; color: #e1b30d ; margin-right: 0px ; padding: 0"><span>$</span>'.$value['saleprice'].'</li>
            <li style="font-size: 16.87px;line-height: 30px;text-align: center;float: none;display: inline-block;top: 12px;position: relative;margin-left: 5px;color: #fff;margin-right: 5px;padding: 0;">/Month</li>
        </ul>      
    </td>
</tr>
<tr>
    <td class="" width="100%" style="padding: 0;">
        <a href="' . site_url() . '/checkout/?data='.$value['slug'].'" target="_other" rel="nofollow">
            <img src="'.$value['img_url'].'" alt="" width="100%" style="border-radius: 15px ;">
        </a>
    </td>
</tr>
<tr>
    <td bgcolor="#3b3b3b">
        <h3 style="    margin: 0px !important;font-size: 20px ; font-weight: 100 ; text-align: center ; padding-bottom: 0px ; color: #fff">'.$value['bottom_quote'].'</h3>
    </td>
</tr>
<tr>
    <td bgcolor="#3b3b3b">
        <h3 style="font-size: 25px ; color: #fff ;margin: 0px; position: relative ; line-height: 37px ; font-weight: 600 ; padding: 16px 12px ; text-align: center ; border-top-left-radius: 7px ; border-top-right-radius: 7px">TOP BENEFITS</h3>
        <ul style="text-align: center ;margin: 0px;padding: 0px 20px 20px; list-style: none ; border-bottom-left-radius: 7px ; border-bottom-right-radius: 7px">';
            foreach ($value['top_benefits'] as $benefits) {
                $mail_data['html'] .= '<li style=" font-size: 18px; font-weight: 400; padding-top: 15px; color: #fff;">'.$benefits['benefits'].'</li>';
            }
        $mail_data['html'] .='</ul>
        <a href="' . site_url() . '/checkout/?data='.$value['slug'].'" class="btnbyNow" style="display: block ; width: 100% ; background: #e1b30d ; padding: 8px 0px ; text-align: center ; text-decoration: unset !important;font-size: 25px ; font-weight: 600 ; margin: 7px ; text-transform: uppercase ; color: #000 ; font-family: &quot;roboto slab&quot; ; border-radius: 7px" target="_other" rel="nofollow">
            Buy Now<span style="color: #fff ; position: relative ; top: 0px ; left: 1px ; font-weight: 900 ; font-family: &quot;roboto slab&quot; ; font-size: 20px">&gt;</span>
        </a>                    
    </td>
</tr>';
    }
    $args = array(
        'post_title'=>$email, 
        'post_type'=>'start_my_program',
        'post_status' => 'publish',
        'meta_input'=> array(
            'gender'=> get_the_title($formdata['gender']),
            'age'=> $formdata['ageId'],
            'body_type'=> $formdata['body_id'],
            'goal_type'=> $formdata['goal_id'],
            'selected_plan' => $data['result'][0]['id']
        )
    );

    global $wpdb;
    $sql = "INSERT INTO `wp_client_email`(`email`) VALUES ('" . $email . "')";
    $wpdb->query($sql);

    $post_id = wp_insert_post($args);
    CustomerYourPlanMailTemplate($mail_data);
    // $post = get_post(1205);
    // $mail_subject = get_field('subject_line', $post->ID);
    // $mail_message = $post->post_content;
    // sendMailNow($_POST['email'], $mail_subject, $mail_message);
    echo json_encode($data);
    exit();
}

function get_plans() {
    $args = array(
        'post_type' => 'plans',
        'post_status' => 'publish',
        'order' => 'ASC',
    );
    $the_query = new WP_Query($args);
    $data['result'] = array();
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $data['result'][] = array(
                'title' => get_the_title(),
                'id' => get_the_ID(),
                'saleprice' => get_field('plan_sell_price_1'),
                'price' => get_field('plan_price'),
                'plan_highlight' => get_field('plan_highlight'),
                'bottom_quote' => get_field('bottom_quote'),
                'top_benefits' => get_field('top_benefits'),          
                'img_url' => get_the_post_thumbnail_url( get_the_ID(),'full' )
            );
        }
        $data['success'] = true;
    } else {
        $data['success'] = false;
    }
    $data['option'][] = array(
        'member_option' => get_field('member_option', 'option'),
        'membership_title' => get_field('membership_title', 'option')
    );
    return $data;
    exit();
}