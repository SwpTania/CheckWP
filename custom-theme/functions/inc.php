<?php

$template_directory = get_template_directory();
$include_file_array = array(
    'functions-post.php',
    'function-transformations.php',
    'functions-membership.php',
    'functions-coupons.php',
    'functions-mail-templates.php',
    'functions-export.php',
    'functions-email.php',
    'functions-consultation.php',
    'functions-macro-calculator.php',
);

foreach ($include_file_array as $include_file) {
    include_once( $template_directory . '/functions/' . $include_file);
}
