<?php

add_filter('acf/settings/path', 'my_acf_settings_path');

function my_acf_settings_path($path) {
    $path = get_template_directory() . '/acf/';
    return $path;
}

add_filter('acf/settings/dir', 'my_acf_settings_dir');

function my_acf_settings_dir($dir) {
    $dir = get_template_directory_uri() . '/acf/';
    return $dir;
}

include_once( get_template_directory() . '/acf/acf.php' );

add_filter('acf/settings/save_json', 'my_acf_json_save_point');

function my_acf_json_save_point($path) {
    $path = get_template_directory() . '/acf/fields1/';
    return $path;
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point($paths) {
    unset($paths[0]);
    $paths[] = get_template_directory() . '/acf/fields1/';
    return $paths;
}

$parent = acf_add_options_page(array(
'page_title' => 'Theme Options',
'menu_title' => 'Theme Options',
'menu_slug' => 'theme-options',
'capability' => 'manage_options',
'redirect' => false,
'position' => 30
    ));

//acf_add_options_sub_page(array(
//    'page_title' => 'General Setting',
//    'menu_title' => 'General Setting',
//    'parent_slug' => $parent['menu_slug'],
//    'capability' => 'manage_options',
//));
//
//acf_add_options_sub_page(array(
//    'page_title' => 'Footer Setting',
//    'menu_title' => 'Footer Setting',
//    'menu_slug' => 'footer-setting',
//    'parent_slug' => $parent['menu_slug'],
//    'capability' => 'manage_options',
//));
//
//acf_add_options_page(array(
//    'page_title' => "FAQ's",
//    'menu_title' => "FAQ's",
//    'menu_slug' => 'drivehi-faq',
//    'capability' => 'manage_options',
//    'redirect' => false,
//    'position' => 30
//));

// add_filter('acf/settings/google_api_key', function () {
//     return 'AIzaSyB3jGpqQJkdFEyCgg_1etq9rkoa5DhJYKM';
// });
