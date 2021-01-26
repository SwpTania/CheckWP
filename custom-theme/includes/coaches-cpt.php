<?php
add_action('init', function() {
    $labels = array( 
        'name' => 'Coaches',
        'singular_name' => 'Coach',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Coach',
        'edit_item' => 'Edit Coach',
        'new_item' => 'New Coach',
        'view_item' => 'View Coach',
        'search_items' => 'Search Coaches',
        'not_found' => 'No Coaches found',
        'not_found_in_trash' => 'No Coaches found in Trash',
        'parent_item_colon' => 'Parent Coach:',
        'menu_name' => 'Coaches',
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Coaches',
        'supports' => array( 'title'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 3,
		'register_meta_box_cb' => 'coaches_register_metabox',    
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type('coach', $args);
});

add_filter('post_updated_messages', function($messages) {
	$post = get_post();
	$post_type = get_post_type($post);
	$post_type_object = get_post_type_object($post_type);

	$messages['coach'] = array(
		0  => '',
		1  => 'Coach updated.',
		2  => 'Custom field updated.',
		3  => 'Custom field deleted.',
		4  => 'Coach updated.',
		5  => isset($_GET['revision']) ? sprintf('Coach restored to revision from %s', wp_post_revision_title((int)$_GET['revision'], false)) : false,
		6  => 'Coach published.',
		7  => 'Coach saved.',
		8  => 'Coach submitted.',
		9  => sprintf('Coach scheduled for: <strong>%1$s</strong>.', date_i18n( 'M j, Y @ G:i', strtotime($post->post_date))),
		10 => 'Coach draft updated.'
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

function coaches_register_metabox() {
	add_meta_box('coaches_metabox_details', 'Coach Details', 'coaches_metabox_details_content', 'coach', 'normal', 'default');
}

function coaches_metabox_details_content() {
	global $post;
	$pageSettings = get_post_meta($post->ID, 'page_settings', true);
	wp_nonce_field(plugin_basename( __FILE__ ), 'coaches_nonce');
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
		
	echo 'function add_transformations_item() {'."\r\n";
		echo 'if(jQuery("#page_settings_transformations_new_image_url").val() != "") {'."\r\n";
			echo 'var transformations_item = jQuery("<div></div>");'."\r\n";
			echo 'transformations_item.attr("class", "transformations_item");'."\r\n";
			echo 'transformations_item.attr("style", "background: #DDDDDD; border: 1px solid #999; margin: 10px 0; padding: 10px; position: relative; cursor: move;");'."\r\n";
			echo 'var transformations_item_fieldset = jQuery("<fieldset></fieldset>");'."\r\n";
			echo 'transformations_item.append(transformations_item_fieldset);'."\r\n";
			echo 'var transformations_item_fieldset_p = jQuery("<p>"+jQuery("#page_settings_transformations_new_transformation option:selected").text()+"</p>").attr("style", "margin: 0 !important;font-weight: bold;");'."\r\n";		;
			echo 'transformations_item_fieldset_p.append(jQuery("<input />").attr("type", "hidden").attr("class", "multilanguage-input input widefat").attr("name", "page_settings[transformations][]").val(jQuery("#page_settings_transformations_new_transformation").val()));'."\r\n";
			echo 'transformations_item_fieldset.append(transformations_item_fieldset_p);'."\r\n";
			echo 'transformations_item.append(jQuery("<span></span>").attr("onclick", "remove_transformations_item(this)").attr("style", "position: absolute; cursor: pointer; top: 8px; right: 10px; color: #930F27;").attr("class", "dashicons dashicons-no"));'."\r\n";
			echo 'transformations_item.appendTo(".transformations_items_wrapper");'."\r\n";
			
			//echo 'jQuery(".smartlogix_uploader_button").click(smartlogix_uploader_button);'."\r\n";
		echo '}'."\r\n";
	echo '}'."\r\n";

	echo 'function remove_transformations_item(sender) {'."\r\n";
		echo 'jQuery(sender).parent().remove();'."\r\n";
	echo '}'."\r\n";
	echo '</script>';
	echo '<div id="vtabs">';
		echo '<div>';
			echo '<ul>';
				echo '<li id="vtabs-button-listing-page-info"><a href="#vtabs-header">Listing Page Info</a></li>';
				echo '<li id="vtabs-button-coach-bio"><a href="#vtabs-transformations">Coach Page Bio</a></li>';
				echo '<li id="vtabs-button-transformations"><a href="#vtabs-section2">Transformations</a></li>';
			echo '</ul>';
		echo '</div>';
		echo '<div>';
			echo '<div id="#vtabs-listing-page-info">';
				echo '<div style="margin: 15px 0; padding: 5px; border: 1px solid #ddd; border-radius: 5px; position: relative;">';
					echo '<label style="font-weight: bold; position: absolute; left: 15px; top: -10px; background: #FFF; padding: 0px 10px;">Coach Listing Page Info</label>';
					echo '<div style="background: #DDDDDD; margin: 10px 0; padding: 10px; position: relative;">';
						echo smartlogix_get_control('text', 'Coach Name', 'page_settings_listing_page_coach_name', 'page_settings[listing_page_coach_name]', (isset($pageSettings['listing_page_coach_name'])?$pageSettings['listing_page_coach_name']:''));
						echo smartlogix_get_control('text', 'Coach Qualification', 'page_settings_listing_page_coach_qualification', 'page_settings[listing_page_coach_qualification]', (isset($pageSettings['listing_page_coach_qualification'])?$pageSettings['listing_page_coach_qualification']:''));
						echo smartlogix_get_control('text', 'Coach Title', 'page_settings_listing_page_coach_title', 'page_settings[listing_page_coach_title]', (isset($pageSettings['listing_page_coach_title'])?$pageSettings['listing_page_coach_title']:''));
						echo smartlogix_get_control('textarea-big', 'Coach Short Description', 'page_settings_listing_page_coach_description', 'page_settings[listing_page_coach_description]', (isset($pageSettings['listing_page_coach_description'])?$pageSettings['listing_page_coach_description']:''));
						echo smartlogix_get_control('text', 'Program Page Link', 'page_settings_listing_page_coach_program_link_url', 'page_settings[listing_page_coach_program_link_url]', (isset($pageSettings['listing_page_coach_program_link_url'])?$pageSettings['listing_page_coach_program_link_url']:''));
						echo smartlogix_get_control('upload', 'Coach Sample Photo', 'page_settings_listing_page_coach_before_n_after_image', 'page_settings[listing_page_coach_before_n_after_image]', (isset($pageSettings['listing_page_coach_before_n_after_image'])?$pageSettings['listing_page_coach_before_n_after_image']:''));
					echo '</div>';
				echo '</div>';
			echo '</div>';
			
			echo '<div id="#vtabs-coach-bio">';
				echo '<div style="margin: 15px 0; padding: 5px; border: 1px solid #ddd; border-radius: 5px; position: relative;">';
					echo '<label style="font-weight: bold; position: absolute; left: 15px; top: -10px; background: #FFF; padding: 0px 10px;">Coach Bio</label>';
					echo '<div style="background: #DDDDDD; margin: 10px 0; padding: 10px; position: relative;">';
						echo smartlogix_get_control('text', 'Coach Name', 'page_settings_coach_name', 'page_settings[coach_name]', (isset($pageSettings['coach_name'])?$pageSettings['coach_name']:''));
						echo smartlogix_get_control('text', 'Coach Title', 'page_settings_coach_title', 'page_settings[coach_title]', (isset($pageSettings['coach_title'])?$pageSettings['coach_title']:''));
						echo smartlogix_get_control('text', 'Program Page Link', 'page_settings_coach_program_link_url', 'page_settings[coach_program_link_url]', (isset($pageSettings['coach_program_link_url'])?$pageSettings['coach_program_link_url']:''));
						//echo smartlogix_get_control('textarea-big', 'Coach Detailed Bio', 'page_settings_coach_bio', 'page_settings[coach_bio]', (isset($pageSettings['coach_bio'])?$pageSettings['coach_bio']:''));
						echo smartlogix_get_control('textarea-big', 'Coach Qualification', 'page_settings_coach_qualification', 'page_settings[coach_qualification]', (isset($pageSettings['coach_qualification'])?$pageSettings['coach_qualification']:''), null, 'One Item Per Line');
					echo '</div>';
					echo '<div style="background: #DDDDDD; margin: 10px 0; padding: 10px; position: relative;">';
						for($i = 1; $i <= 10; $i++) {
							echo smartlogix_get_control('upload', 'Coach Gallery Photo '.$i, 'page_settings_coach_gallery_photo_'.$i, 'page_settings[coach_gallery_photo_'.$i.']', (isset($pageSettings['coach_gallery_photo_'.$i])?$pageSettings['coach_gallery_photo_'.$i]:''));
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
			
			echo '<div id="#vtabs-transformations">';
				echo '<div style="margin: 15px 0; padding: 5px; border: 1px solid #ddd; border-radius: 5px; position: relative;">';
					echo '<label style="font-weight: bold; position: absolute; left: 15px; top: -10px; background: #FFF; padding: 0px 10px;">Transformations</label>';
					echo '<div class="transformations_items_wrapper">';
						$transformations = $pageSettings['transformations'];
						if(isset($transformations) && is_array($transformations)) {
							$index = 0;
							foreach($transformations as $transformation) {
								echo '<div class="transformations_item" style="background: #DDDDDD; border: 1px solid #999; margin: 10px 0; padding: 10px; position: relative; cursor: move;">';
									echo '<fieldset>';
										echo '<p style="margin: 0 !important;font-weight: bold;">';
											echo get_the_title($transformation);
											echo '<input type="hidden" class="multilanguage-input input widefat" value="'.$transformations[$index].'" name="page_settings[transformations][]">';
										echo '</p>';
									echo '</fieldset>';
									echo '<span onclick="remove_transformations_item(this)" style="position: absolute; cursor: pointer; top: 8px; right: 10px; color: #930F27;" class="dashicons dashicons-no"></span>';
								echo '</div>';
								$index++;
							}
						}
					echo '</div>';
					
					echo '<div style="background: #DDDDDD; border: 1px solid #999; margin: 10px 0; padding: 10px; position: relative;">';
						echo '<strong>Add New Transformation</strong>';
						echo '<fieldset>';
							echo '<p style="margin: 5px 0 0 !important;">';
								$transformationsData = array();
								$transformations = get_posts(array(
									'numberposts' => -1,
									'post_type' => 'transformed',
								));
								if(isset($transformations) && is_array($transformations)) {
									foreach($transformations as $transformation) {
										$transformationsData[] = array('text' => $transformation->post_title, 'value' => $transformation->ID);
									}
								}
								echo smartlogix_get_control('select', '', 'page_settings_transformations_new_transformation', 'page_settings_transformations_new_transformation', '', $transformationsData);
							echo '</p>';
						echo '</fieldset>';
						echo '<span onclick="add_transformations_item()" style="position: absolute; cursor: pointer; top: 8px; right: 10px; color: #0D670D;" class="dashicons dashicons-plus-alt"></span>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}

add_action('save_post', function($post_id) {
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return; }
	if(!wp_verify_nonce($_POST['coaches_nonce'], plugin_basename( __FILE__ ))) { return; }
	if('coach' == $_POST['post_type']) {
		if(!current_user_can('edit_post', $post_id)) { return; }
	} else { return; }

	update_post_meta($post_id, 'page_settings', $_POST['page_settings']);
});

?>