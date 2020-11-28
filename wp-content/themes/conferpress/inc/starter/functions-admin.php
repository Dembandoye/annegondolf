<?php
function leaf_construct_filename( $post_id ) {
	$filename = get_the_title( $post_id );
	$filename = sanitize_title( $filename, $post_id );
	$filename = urldecode( $filename );
	$filename = preg_replace( '/[^a-zA-Z0-9\-]/', '', $filename );
	$filename = substr( $filename, 0, 32 );
	$filename = trim( $filename, '-' );
	if ( $filename == '' ) $filename = (string) $post_id;
	return $filename;
}
function leaf_save_to_media_library( $image_url, $post_id ) {

	$error = '';
	$response = wp_remote_get( $image_url, array( 'sslverify' => false ) );
	if( is_wp_error( $response ) ) {
		$error = new WP_Error( 'thumbnail_retrieval', sprintf( 'Error retrieving a thumbnail from the URL <a href="%1$s">%1$s</a> using <code>wp_remote_get()</code><br />If opening that URL in your web browser returns anything else than an error page, the problem may be related to your web server and might be something your host administrator can solve.', $image_url ) . '<br>' . esc_html__( 'Error Details:', 'conferpress' ) . ' ' . $response->get_error_message() );
	} else {
		$image_contents = $response['body'];
		$image_type = wp_remote_retrieve_header( $response, 'content-type' );
	}

	if ( $error != '' ) {
		return $error;
	} else {
		if( isset($_POST['store-link-apple']) ){
			$url = $_POST['store-link-apple'];
		}
		if( $url =='' && isset($_POST['store-link-google']) ){
			$url = $_POST['store-link-google'];
		}
		if(strpos($url, 'play.google.com') !== true){
			// Translate MIME type into an extension
			if ( $image_type == 'image/jpeg' ) {
				$image_extension = '.jpg';
			} elseif ( $image_type == 'image/png' ) {
				$image_extension = '.png';
			} elseif ( $image_type == 'image/gif' ) {
				$image_extension = '.gif';
			} else {
				return new WP_Error( 'thumbnail_upload', esc_html__( 'Unsupported MIME type:', 'conferpress' ) . ' ' . $image_type );
			}
	
			// Construct a file name with extension
			$new_filename = construct_filename( $post_id ) . $image_extension;
		}else{
			$new_filename = construct_filename( $post_id ) . '.webp';
		}

		// Save the image bits using the new filename
		do_action( 'video_thumbnails/pre_upload_bits', $image_contents );
		$upload = wp_upload_bits( $new_filename, null, $image_contents );
		do_action( 'video_thumbnails/after_upload_bits', $upload );

		// Stop for any errors while saving the data or else continue adding the image to the media library
		if ( $upload['error'] ) {
			$error = new WP_Error( 'thumbnail_upload', esc_html__( 'Error uploading image data:', 'conferpress' ) . ' ' . $upload['error'] );
			return $error;
		} else {

			do_action( 'video_thumbnails/image_downloaded', $upload['file'] );

			$image_url = $upload['url'];

			$filename = $upload['file'];

			$wp_filetype = wp_check_filetype( basename( $filename ), null );
			$attachment = array(
				'post_mime_type'	=> $wp_filetype['type'],
				'post_title'		=> get_the_title( $post_id ),
				'post_content'		=> '',
				'post_status'		=> 'inherit'
			);
			$attach_id = wp_insert_attachment( $attachment, $filename, $post_id );
			// you must first include the image.php file
			// for the function wp_generate_attachment_metadata() to work
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
			wp_update_attachment_metadata( $attach_id, $attach_data );

		}

	}

	return $attach_id;

}
// End Fetch
add_filter('pre_post_title', 'leaf_post_mask_empty');
add_filter('pre_post_content', 'leaf_post_mask_empty');
function leaf_post_mask_empty($value)
{
    if ( empty($value) ) {
        return ' ';
    }
    return $value;
}

/*load admin js & css*/
function leaf_admin_styles() {	
	wp_enqueue_style( 'style', get_template_directory_uri().'/admin/style.css');	
}
if(is_admin()){
	add_action('admin_print_styles', 'leaf_admin_styles');
	add_filter('manage_edit-post_columns', 'leaf_add_posts_columns');
	add_filter('manage_edit-page_columns', 'leaf_add_pages_columns');
	add_filter('manage_edit-category_columns', 'leaf_add_pages_columns' );

	function leaf_add_posts_columns($columns) {
		$cols = array_merge(array('id' => esc_html__('ID','conferpress')),$columns);
		$cols = array_merge($cols,array('thumbnail'=> esc_html__('Thumbnail','conferpress')));
		return $cols;
	}
	
	function leaf_add_pages_columns($columns) {
		$cols = array_merge(array('id' => esc_html__('ID','conferpress')),$columns);
		
		return $cols;
	}
	add_action( 'manage_pages_custom_column' , 'leaf_set_posts_columns_value', 10, 2 );
	add_action( 'manage_posts_custom_column' , 'leaf_set_posts_columns_value', 10, 2 );
	add_filter( 'manage_category_custom_column', 'leaf_set_cats_columns_value', 10, 3 );
	function leaf_set_posts_columns_value( $column, $post_id ) {
		if ($column == 'id'){
			echo esc_attr($post_id);
		} else if($column == 'thumbnail'){
			echo esc_url(get_the_post_thumbnail($post_id,'thumbnail'));
		} else if($column == 'startdate'){
			// for event
			$date_str = get_post_meta($post_id,'start_day',true);
			if($date_str != ''){
				$date = date_create_from_format('m/d/Y H:i', $date_str);
				echo esc_attr($date->format(get_option('date_format')));
			}
		}
	}
	
	function leaf_set_cats_columns_value( $value, $name, $cat_id ){
		if( 'id' == $name ) 
			echo esc_attr($cat_id);
	}

	function leaf_image_custom_sizes( $sizes ) {
		global $_wp_additional_image_sizes;

		// make the names human friendly by removing dashes and capitalising
		foreach( $_wp_additional_image_sizes as $key => $value ) {
			$custom[ $key ] = ucwords( str_replace( '-', ' ', $key ) );
		}

		return array_merge( $sizes, $custom );
	}
	add_filter( 'image_size_names_choose', 'leaf_image_custom_sizes' );/* Add Image Sizes to Media Chooser */
	
	/* Allow to upload custom fonts */
	function leaf_addUploadMimes($mimes) {
		$mimes = array_merge($mimes, array(
		'eot' => 'application/octet-stream',
		'svg' => 'application/octet-stream',
		'ttf' => 'application/octet-stream',
		'otf' => 'application/octet-stream',
		'woff' => 'application/octet-stream',
		));
		return $mimes;
    }
    add_filter('upload_mimes', 'leaf_addUploadMimes');
	add_action('admin_head', 'leaf_custom_admin_styling');
	function leaf_custom_admin_styling() {
		echo '<style type="text/css">th#id{width:40px;}</style>';
	}
}

add_action( 'login_enqueue_scripts', 'leaf_login_logo' );
function leaf_login_logo() {
	if($img = ot_get_option('login_logo')){
	?>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo esc_url($img) ?>);
			width: 320px;
			height: 120px;
			background-size:auto;
			background-position:center;
        }
    </style>
<?php }
}