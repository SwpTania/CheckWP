<?php

// Register Custom Post Type
function transformations_post_type() {

    $labels = array(
        'name' => 'Transformation',
        'singular_name' => 'Transformation',
        'menu_name' => 'Transformations',
        'name_admin_bar' => 'Transformations',
    );
    $args = array(
        'label' => 'Transformation',
        'labels' => $labels,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions',),
        'taxonomies' => array(),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('transformations', $args);
}

add_action('init', 'transformations_post_type', 0);

function team_post_type() {

    $labels = array(
        'name' => 'Team',
        'singular_name' => 'Team',
        'menu_name' => 'Team',
        'name_admin_bar' => 'Team',
    );
    $args = array(
        'label' => 'Team',
        'labels' => $labels,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
        'taxonomies' => array(),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => true,
        'can_export' => false,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'capability_type' => 'page',
    );
    register_post_type('team', $args);
}

add_action('init', 'team_post_type', 0);

function start_my_program_post_type() {

    $labels = array(
        'name' => 'Start My Program',
        'singular_name' => 'Start My Program',
        'menu_name' => 'Start My Program',
        'name_admin_bar' => 'Start My Program',
    );
    $args = array(
        'label' => 'Team',
        'labels' => $labels,
        'supports' => array('title'),
        'taxonomies' => array(),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => true,
        'can_export' => false,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'capability_type' => 'page',
    );
    register_post_type('start_my_program', $args);
}

add_action('init', 'start_my_program_post_type', 0);

// function body_type() {

//     $labels = array(
//         'name' => 'Body Type',
//         'singular_name' => 'Body Type',
//         'menu_name' => 'Body Type',
//         'name_admin_bar' => 'Body Type',
//     );
//     $args = array(
//         'label' => 'Body Type',
//         'labels' => $labels,
//         'supports' => array('title', 'editor'),
//         'taxonomies' => array(),
//         'hierarchical' => false,
//         'public' => true,
//         'show_ui' => true,
//         'show_in_menu' => true,
//         'menu_position' => 5,
//         'show_in_admin_bar' => false,
//         'show_in_nav_menus' => true,
//         'can_export' => false,
//         'has_archive' => false,
//         'exclude_from_search' => true,
//         'publicly_queryable' => false,
//         'capability_type' => 'page',
//     );
//     register_post_type('body_type', $args);
// }

// add_action('init', 'body_type', 0);//GOAL

// function goal_type() {

//     $labels = array(
//         'name' => 'Goal',
//         'singular_name' => 'Goal',
//         'menu_name' => 'Goal',
//         'name_admin_bar' => 'Goal',
//     );
//     $args = array(
//         'label' => 'Goal',
//         'labels' => $labels,
//         'supports' => array('title', 'editor'),
//         'taxonomies' => array(),
//         'hierarchical' => false,
//         'public' => true,
//         'show_ui' => true,
//         'show_in_menu' => true,
//         'menu_position' => 5,
//         'show_in_admin_bar' => false,
//         'show_in_nav_menus' => true,
//         'can_export' => false,
//         'has_archive' => false,
//         'exclude_from_search' => true,
//         'publicly_queryable' => false,
//         'capability_type' => 'page',
//     );
//     register_post_type('goal', $args);
// }

// add_action('init', 'goal_type', 0);

function plans_post_type() {

    $labels = array(
        'name' => 'Plans',
        'singular_name' => 'Plan',
        'menu_name' => 'Plans',
        'name_admin_bar' => 'Plans',
    );
    $args = array(
        'label' => 'Plans',
        'labels' => $labels,
        'supports' => array('title', 'thumbnail', 'revisions',),
        'taxonomies' => array(),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('plans', $args);
}

add_action('init', 'plans_post_type', 0);

function coupan_post_type() {

    $labels = array(
        'name' => 'Coupons',
        'singular_name' => 'Coupon',
        'menu_name' => 'Coupons',
        'name_admin_bar' => 'Coupons',
    );
    $args = array(
        'label' => 'Coupons',
        'labels' => $labels,
        'supports' => array('title', 'editor'),
        'taxonomies' => array(),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => false,
        'capability_type' => 'page',
    );
    register_post_type('coupans', $args);
}

add_action('init', 'coupan_post_type', 0);


// Register Custom Post Type
/*
function invoice_post_type() {

    $labels = array(
        'name'                  => 'Invoices',
        'singular_name'         => 'Invoice',
        'menu_name'             => 'Invoice',
        'name_admin_bar'        => 'Invoice',
        'archives'              => 'Item Archives',
        'attributes'            => 'Item Attributes',
        'parent_item_colon'     => 'Parent Item:',
        'all_items'             => 'All Items',
        'add_new_item'          => 'Add New Item',
        'add_new'               => 'Add New',
        'new_item'              => 'New Item',
        'edit_item'             => 'Edit Item',
        'update_item'           => 'Update Item',
        'view_item'             => 'View Item',
        'view_items'            => 'View Items',
        'search_items'          => 'Search Item',
        'not_found'             => 'Not found',
        'not_found_in_trash'    => 'Not found in Trash',
        'featured_image'        => 'Featured Image',
        'set_featured_image'    => 'Set featured image',
        'remove_featured_image' => 'Remove featured image',
        'use_featured_image'    => 'Use as featured image',
        'insert_into_item'      => 'Insert into item',
        'uploaded_to_this_item' => 'Uploaded to this item',
        'items_list'            => 'Items list',
        'items_list_navigation' => 'Items list navigation',
        'filter_items_list'     => 'Filter items list',
    );
    $args = array(
        'label'                 => 'Invoice',
        'labels'                => $labels,
        'supports'              => array( 'title'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,        
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
    );
    register_post_type( 'invoice', $args );

}
add_action( 'init', 'invoice_post_type', 0 );*/



function fun_set_custom_edit_program_body_type_columns($columns) {    
    $columns['gender'] = 'Gender';
    $columns['age'] = 'Age';
    return $columns;
}
add_filter( 'manage_program_body_type_posts_columns', 'fun_set_custom_edit_program_body_type_columns' );

function fun_set_custom_edit_program_goal_types_columns($columns) {    
    $columns['gender'] = 'Gender';
    $columns['age'] = 'Age';
    $columns['bodytype'] = 'Body Type';
    $columns['plan'] = 'Plan';
    return $columns;
}
add_filter( 'manage_program_goal_types_posts_columns', 'fun_set_custom_edit_program_goal_types_columns' );


function fun_custom_program_body_type_column( $column, $post_id ) {
    switch ( $column ) {
        case 'gender' :
            $gender = get_field('select_gender', $post_id);
            if(!empty($gender)) {
                echo $gender = '<a href="' . admin_url( 'edit.php?post_type=program_gender' ) . '">' . $gender->post_title . '</a>';    
            }            
        break;

        case 'age' :
            $age = get_field('select_age', $post_id);            
            $age_html = '';

            if(!empty($age)) {
                foreach ($age as $a) {
                    $age_html .= '<a href="' . admin_url( 'edit.php?post_type=program_age' ) . '">' . $a->post_title . '</a>';
                }                
                //$age_html = rtrim($age_html, ', ');
            }

            echo $age_html;
        break;
    }
}
add_action( 'manage_program_body_type_posts_custom_column' , 'fun_custom_program_body_type_column', 10, 2 );


function fun_custom_program_goal_types_column( $column, $post_id ) {
    switch ( $column ) {
        case 'gender' :
            $gender = get_field('select_gender', $post_id);
            if(!empty($gender)) {
                echo $gender = '<a href="' . admin_url( 'edit.php?post_type=program_gender' ) . '">' . $gender->post_title . '</a>';    
            }            
        break;

        case 'age' :
            $age = get_field('select_age', $post_id);            
            $age_html = '';

            if(!empty($age)) {
                foreach ($age as $a) {
                    $age_html .= '<a href="' . admin_url( 'edit.php?post_type=program_age' ) . '">' . $a->post_title . '</a>';
                }                
                //$age_html = rtrim($age_html, ', ');
            }

            echo $age_html;
        break; 

        case 'bodytype' :
            $bodytype = get_field('select_body_type', $post_id);            
            $bodytype_html = '';

            if(!empty($bodytype)) {
                foreach ($bodytype as $type) {
                    $bodytype_html .= '<a href="' . admin_url( 'edit.php?post_type=program_body_type' ) . '">' . $type->post_title . '</a>';
                }                
                //$bodytype_html = rtrim($bodytype_html, ', ');
            }

            echo $bodytype_html;
        break;  

        case 'plan' :
            $plan = get_field('select_plan', $post_id);                       
            $plan_html = '';

            if(!empty($plan)) {
                foreach ($plan as $p) {
                    $plan_html .= '<a href="' . admin_url( 'edit.php?post_type=plans' ) . '">' . $p->post_title . '</a>';
                }                
                //$plan_html = rtrim($plan_html, ', ');
            }


            echo $plan_html;
        break;
    }
}
add_action( 'manage_program_goal_types_posts_custom_column' , 'fun_custom_program_goal_types_column', 10, 2 );


function fun_program_body_type_post_type_reorder_columns($defaults) {  
    $new = array();
    $gender = $defaults['gender'];
    unset($defaults['gender']);
    $age = $defaults['age'];
    unset($defaults['age']);    

    foreach($defaults as $key => $value) {
        if($key == 'date') {
          $new['gender'] = $gender;
          $new['age'] = $age;
        }
        $new[$key]=$value;
    }  

    return $new;  
} 
add_filter('manage_program_body_type_posts_columns', 'fun_program_body_type_post_type_reorder_columns'); 


function fun_program_goal_types_post_type_reorder_columns($defaults) {  
    $new = array();
    $gender = $defaults['gender'];
    unset($defaults['gender']);
    $age = $defaults['age'];
    unset($defaults['age']);    
    $bodytype = $defaults['bodytype'];
    unset($defaults['bodytype']);    
    $plan = $defaults['plan'];
    unset($defaults['plan']);    

    foreach($defaults as $key => $value) {
        if($key == 'date') {
          $new['gender'] = $gender;
          $new['age'] = $age;
          $new['bodytype'] = $bodytype;
          $new['plan'] = $plan;
        }
        $new[$key]=$value;
    }  

    return $new;  
} 
add_filter('manage_program_goal_types_posts_columns', 'fun_program_goal_types_post_type_reorder_columns'); 


function admin_column_width() {
    echo '<style type="text/css">';
    echo '  th.column-gender { width:80px !important; overflow:hidden }';
    echo '  th.column-age { width:160px !important; overflow:hidden }';
    echo '  th.column-plan { width:140px !important; overflow:hidden }';
    echo '  td.column-plan a { width: 100%;display: block;background: #e1b30d;padding: 2px 4px;color: #000;margin-bottom: 4px;}';
    echo '  td.column-bodytype a { width: 100%;display: block;background: #e1b30d;padding: 2px 4px;color: #000;margin-bottom: 4px;}';
    echo '  td.column-age a {background: #e1b30d;padding: 2px 4px;display: inline-block;color: #000;margin-bottom: 4px;width: 24%;text-align: center;margin-right: 4px;}';
    echo '</style>';
}
add_action('admin_head', 'admin_column_width');




/**************** Add News Metabox for Admin Approval ****************/
function fun_news_post_type_admin_approval_meta_box() {
   add_meta_box(
       'admin-approval-meta-box',       // $id
       'Personality Options',           // $title
       'fun_program_post_type_admin_approval_meta_box_callback',  // $callback
       'start_my_program',       // $page
       'side',                  // $context
       'low'                     // $priority
   );
}
add_action('add_meta_boxes', 'fun_news_post_type_admin_approval_meta_box');
 /**************** News Metabox Admin Approval Callback ****************/
function fun_program_post_type_admin_approval_meta_box_callback() {
    global $post;
    $post_meta = get_post_meta($post->ID);
    $age = get_the_title($post_meta['age'][0]);
    $body_type = get_the_title($post_meta['body_type'][0]);
    $goal_type = get_the_title($post_meta['goal_type'][0]);
    $plan_title = get_the_title($post_meta['selected_plan'][0]);
    ?>
    <p>
        <label style="font-weight: bold">Gender</label><br/>
        <input name='gender' type="Text" value="<?php echo $post_meta['gender'][0];?>" style="width:100%" disabled="true" />
    </p>
    <p>
        <label style="font-weight: bold">Age</label><br/>
        <input name='age' type="Text" value="<?echo $age;?>" style="width:100%" disabled="true"/>
    </p>
    <p>
        <label style="font-weight: bold">Body Type</label><br/>
        <input name='body_type' type="Text" value="<?echo $body_type;?>" style="width:100%" disabled="true"/>
    </p>
    <p>
        <label style="font-weight: bold">Goal Type</label><br/>
        <input name='goal_type' type="Text" value="<?echo $goal_type;?>" style="width:100%" disabled="true"/>
    </p>
    <p>
        <label style="font-weight: bold">Plan</label><br/>
        <input name='plan' type="Text" value="<?echo $plan_title;?>" style="width:100%" disabled="true" />
    </p>
    <?php
}
