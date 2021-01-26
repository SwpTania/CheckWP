<?php
function get_optimized_image($imageURL, $imageSize = array(300, 300)) {
	$imageId = attachment_url_to_postid($imageURL);
	if($imageId !== 0) {
		$imageData = wp_get_attachment_image_src($imageId, $imageSize);
		if(($imageData != false) && is_array($imageData)) {
			if($imageData[3] == false) {
				$imagePath = get_attached_file($imageId);
				$editor = wp_get_image_editor($imagePath, array());
				if(!is_wp_error($editor)) {
					$resizedImage = $editor->resize($imageSize[0], $imageSize[1], true);
					if(!is_wp_error($resizedImage)) {
						$resizedImage = $editor->save($editor->generate_filename());
						if(!is_wp_error($resizedImage)) {
							$images = wp_get_attachment_metadata($imageId);
							$images['sizes'][$imageSize[0].'x'.$imageSize[1]] = array(
								'file' => $resizedImage['file'],
								'width' => $imageSize[0],
								'height' => $imageSize[1]
							);
							wp_update_attachment_metadata($imageId, $images);
							
							$resizedImage = explode('public_html/', $resizedImage['path']);
							return 'https://'.$resizedImage[1];
						}
					}
				}
			}
			return $imageData[0];
		}
	}
	return $imageURL;
}
?>