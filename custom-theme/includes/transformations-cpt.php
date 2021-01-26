<?php
add_action('init', function() {
    $labels = array( 
        'name' => 'Transformations',
        'singular_name' => 'Transformation',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Transformation',
        'edit_item' => 'Edit Transformation',
        'new_item' => 'New Transformation',
        'view_item' => 'View Transformation',
        'search_items' => 'Search Transformations',
        'not_found' => 'No Transformations found',
        'not_found_in_trash' => 'No Transformations found in Trash',
        'parent_item_colon' => 'Parent Transformation:',
        'menu_name' => 'Transformations',
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Transformations',
        'supports' => array('title'),
        'public' => true,
        'show_ui' => true,
        'menu_position' => 3,
		'register_meta_box_cb' => 'transformations_register_metabox',    
        'show_in_nav_menus' => false,
		'show_in_menu' => 'edit.php?post_type=coach',
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type('transformed', $args);
});

add_filter('post_updated_messages', function($messages) {
	$post = get_post();
	$post_type = get_post_type($post);
	$post_type_object = get_post_type_object($post_type);

	$messages['transformed'] = array(
		0  => '',
		1  => 'Transformation updated.',
		2  => 'Custom field updated.',
		3  => 'Custom field deleted.',
		4  => 'Transformation updated.',
		5  => isset($_GET['revision']) ? sprintf('Transformation restored to revision from %s', wp_post_revision_title((int)$_GET['revision'], false)) : false,
		6  => 'Transformation published.',
		7  => 'Transformation saved.',
		8  => 'Transformation submitted.',
		9  => sprintf('Transformation scheduled for: <strong>%1$s</strong>.', date_i18n( 'M j, Y @ G:i', strtotime($post->post_date))),
		10 => 'Transformation draft updated.'
	);

	if($post_type_object->publicly_queryable) {
		$messages[$post_type][1] .= '';
		$messages[$post_type][6] .= '';
		$messages[$post_type][9] .= '';
		$messages[$post_type][8]  .= '';
		$messages[$post_type][10] .= '';
	}

	return $messages;
});


add_action('admin_enqueue_scripts', function($hook) {
	if(($hook == 'post.php') || ($hook == 'post-new.php')) {
        wp_register_style('admin_css', get_template_directory_uri().'/css/admin.css', false, '1.0.0');
        wp_enqueue_style('admin_css');
        //wp_enqueue_script('jquery-ui-sortable');
        wp_register_script('jvert-tabs', get_template_directory_uri().'/js/jquery-jvert-tabs-1.1.4.js', array('jquery'), '1.0.0');
        wp_enqueue_script('jvert-tabs');
		//add_thickbox();
	}
});

function transformations_register_metabox() {
	add_meta_box('transformations_metabox_details', 'Transformation Details', 'transformations_metabox_details_content', 'transformed', 'normal', 'default');
}

function transformations_metabox_details_content() {
	global $post;
	$pageSettings = get_post_meta($post->ID, 'page_settings', true);
	wp_nonce_field(plugin_basename( __FILE__ ), 'transformations_nonce');
	echo '<script type="text/javascript">';
	echo 'var mediaUploader;';
	echo 'jQuery(document).ready(function() {';
		echo 'if(jQuery(".transformations_items_wrapper").length) { jQuery(".transformations_items_wrapper").sortable(); }'."\r\n";	
		echo 'smartlogix_uploader_button()'."\r\n";
		echo 'jQuery("#vtabs").jVertTabs();'."\r\n";
	echo '});'."\r\n";

	echo 'function smartlogix_uploader_button() {'."\r\n";
	
		echo 'jQuery(".smartlogix_uploader_button").on("click",function(e) {'."\r\n";
			echo 'formfield = jQuery(this).prev();'."\r\n";
			echo 'e.preventDefault();'."\r\n";
			echo 'if(mediaUploader){'."\r\n";
				echo 'mediaUploader.open();'."\r\n";
				echo 'return;'."\r\n";
			echo '}'."\r\n";	
			echo 'mediaUploader = wp.media.frames.file_frame = wp.media({'."\r\n";
				echo 'title: "Select an Image",'."\r\n";
				echo 'button: { text: "Select Image" },'."\r\n";
				echo 'multiple: false'."\r\n";
			echo '});'."\r\n";
			echo 'mediaUploader.on("select", function(){'."\r\n";
				echo 'attachment = mediaUploader.state().get("selection").first().toJSON();'."\r\n";
				echo 'formfield.val(attachment.url);'."\r\n";
			echo '});'."\r\n";	
			echo 'mediaUploader.open();'."\r\n";
		echo '});'."\r\n";
	echo '}'."\r\n";
		
	echo '</script>';
	echo '<div style="background: #DDDDDD; margin: 10px 0; padding: 10px; position: relative;">';
		echo smartlogix_get_control('text', 'Transformation Name', 'page_settings_listing_page_transformations_name', 'page_settings[listing_page_transformations_name]', (isset($pageSettings['listing_page_transformations_name'])?$pageSettings['listing_page_transformations_name']:''));
		echo smartlogix_get_control('textarea', 'Transformation Short Description', 'page_settings_listing_page_transformations_description', 'page_settings[listing_page_transformations_description]', (isset($pageSettings['listing_page_transformations_description'])?$pageSettings['listing_page_transformations_description']:''), 238);
		echo smartlogix_get_control('upload', 'Transformation Sample Photo', 'page_settings_listing_page_transformations_before_n_after_image', 'page_settings[listing_page_transformations_before_n_after_image]', (isset($pageSettings['listing_page_transformations_before_n_after_image'])?$pageSettings['listing_page_transformations_before_n_after_image']:''));
	echo '</div>';
}

add_action('save_post', function($post_id) {
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return; }
	if(!wp_verify_nonce($_POST['transformations_nonce'], plugin_basename( __FILE__ ))) { return; }
	if('transformed' == $_POST['post_type']) {
		if(!current_user_can('edit_post', $post_id)) { return; }
	} else { return; }

	update_post_meta($post_id, 'page_settings', $_POST['page_settings']);
});
?>