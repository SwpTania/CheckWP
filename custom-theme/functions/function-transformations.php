<?php

add_action('wp_ajax_transformations', 'transformations');
add_action('wp_ajax_nopriv_transformations', 'transformations');

function transformations() {
    $page = $_GET['page'];
    $args = array(
        'post_type' => 'transformations',
        'post_status' => 'publish',
        'paged' => $page,
        'order' => 'DESC',
        'posts_per_page' => 5
    );
    $the_query = new WP_Query($args);
    $data['result'] = array();
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $data['result'][] = array(
                'image' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                'title' => get_the_title(),
                'content' => get_the_content()
            );
        }
        $data['page'] = ++$page;
    }

    echo json_encode($data);
    exit();
}

add_action('wp_ajax_blogs_listing_function', 'blogs_listing_function');
add_action('wp_ajax_nopriv_blogs_listing_function', 'blogs_listing_function');

function blogs_listing_function() {
    $page = $_GET['page'];
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'paged' => $page,
        'order' => 'DESC',
        'posts_per_page' => 5
    );
    $the_query = new WP_Query($args);
    $data['result'] = array();
    if ($the_query->have_posts()) {
        while ($the_query->have_posts()) {
            $the_query->the_post();
            $data['result'][] = array(
                'image' => get_the_post_thumbnail_url(get_the_ID(), 'medium'),
                'title' => get_the_title(),
                'content' => get_the_content()
            );
        }
        $data['page'] = ++$page;
    }
    echo json_encode($data);
    exit();
}