<?php
/**
 * Initialize the meta boxes. 
 */
add_action( 'admin_init', 'leaf_custom_posttype_meta_boxes' );
if ( ! function_exists( 'leaf_custom_posttype_meta_boxes' ) ){
	function leaf_custom_posttype_meta_boxes() {
	  $theme_uri = get_template_directory_uri();
	  $meta_box_event = array(
		'id'        => 'sc_event_meta',
		'title'     => 'Event settings',
		'desc'      => '',
		'pages'     => array( 'tribe_events'),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			//event meta
			array(
			  'label'       => esc_html__( 'Event Settings', 'conferpress' ),
			  'id'          => 'event_meta_tab',
			  'type'        => 'tab'
      		),
			array(
			  'id'          => 'product-id',
			  'label'       => esc_html__('Product for Ticket','conferpress'),
			  'desc'        => esc_html__('Select a product for selling ticket','conferpress'),
			  'type'        => 'custom-post-type-select',
			  'post_type'   => 'product',
			),
			array(
			  'id'          => 'member-id',
			  'label'       => esc_html__('Trainers','conferpress'),
			  'desc'        => esc_html__('Select Event Trainers/Host','conferpress'),
			  'type'        => 'custom-post-type-checkbox',
			  'post_type'   => 'sp_member',
			),
			array(
			  'id'          => 'white-label',
			  'label'       => esc_html__('White label Layout','conferpress'),
			  'desc'        => esc_html__('Enable ONLY if you want to build standalone Event page (Hide all Menus, Sidebars, Footer)','conferpress'),
			  'std'         => 'off',
			  'type'        => 'on-off',
			),
			//layout
			array(
			  'label'       => esc_html__( 'Layout Settings', 'conferpress' ),
			  'id'          => 'event_layout_tab',
			  'type'        => 'tab'
      		),
			array(
			  'id'          => 'event_sidebar_layout',
			  'label'       => esc_html__('Sidebar','conferpress'),
			  'desc'        => esc_html__('Select "Default" to use settings in Theme Options','conferpress'),
			  'std'         => '',
			  'type'        => 'radio-image',
			  'class'       => '',
			  'choices'     => array(
				  array(
					'value'       => '',
					'label'       => 'Default',
					'src'         => $theme_uri.'/images/options/layout-default.png'
				  ),
				  array(
					'value'       => 'right',
					'label'       => 'Sidebar Right',
					'src'         => $theme_uri.'/images/options/layout-right.png'
				  ),
				  array(
					'value'       => 'left',
					'label'       => 'Sidebar Left',
					'src'         => $theme_uri.'/images/options/layout-left.png'
				  ),
				  array(
					'value'       => 'full',
					'label'       => 'Hidden',
					'src'         => $theme_uri.'/images/options/layout-full.png'
				  ),
			   )
			),
			array(
			  'id'          => 'heading_bg',
			  'label'       => esc_html__('Heading Background','conferpress'),
			  'desc'        => esc_html__('Upload Custom Heading Background Image','conferpress'),
			  'std'         => '',
			  'type'        => 'background',
			  'class'       => '',
			  'choices'     => array()
			),
		 )
		);
	  $meta_box3 = array(
		'id'        => 'port_layout',
		'title'     => 'Layout settings',
		'desc'      => '',
		'pages'     => array('app_portfolio'),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
			  'id'          => 'port_sidebar',
			  'label'       => esc_html__('Sidebar','conferpress'),
			  'desc'        => esc_html__('Select "Default" to use settings in Theme Options','conferpress'),
			  'std'         => '',
			  'type'        => 'radio-image',
			  'class'       => '',
			  'choices'     => array(
				 array(
					'value'       => '',
					'label'       => 'Default',
					'src'         => $theme_uri.'/images/options/layout-default.png'
				  ),
				  array(
					'value'       => 'right',
					'label'       => 'Sidebar Right',
					'src'         => $theme_uri.'/images/options/layout-right.png'
				  ),
				  array(
					'value'       => 'left',
					'label'       => 'Sidebar Left',
					'src'         => $theme_uri.'/images/options/layout-left.png'
				  ),
				  array(
					'value'       => 'full',
					'label'       => 'Hidden',
					'src'         => $theme_uri.'/images/options/layout-full.png'
				  ),
			   )
			),
		 )
		);
	  
	  if (function_exists('ot_register_meta_box')) {
		  ot_register_meta_box( $meta_box_event );
		  ot_register_meta_box( $meta_box3 );
	  }
	}
}

add_action( 'admin_init', 'cs_post_meta_boxes' );
if ( ! function_exists( 'cs_post_meta_boxes' ) ){
	function cs_post_meta_boxes() {
	  $theme_uri = get_template_directory_uri();
	  //layout
	  $meta_box = array(
		'id'        => 'page_layout',
		'title'     => 'Layout settings',
		'desc'      => '',
		'pages'     => array( 'post' ),
		'context'   => 'normal',
		'priority'  => 'high',
		'fields'    => array(
			array(
			  'id'          => 'post_sidebar_layout',
			  'label'       => esc_html__('Sidebar','conferpress'),
			  'desc'        => esc_html__('Select "Default" to use settings in Theme Options','conferpress'),
			  'std'         => '',
			  'type'        => 'radio-image',
			  'class'       => '',
			  'choices'     => array(
				  array(
					'value'       => '',
					'label'       => 'Default',
					'src'         => $theme_uri.'/images/options/layout-default.png'
				  ),
				  array(
					'value'       => 'right',
					'label'       => 'Sidebar Right',
					'src'         => $theme_uri.'/images/options/layout-right.png'
				  ),
				  array(
					'value'       => 'left',
					'label'       => 'Sidebar Left',
					'src'         => $theme_uri.'/images/options/layout-left.png'
				  ),
				  array(
					'value'       => 'full',
					'label'       => 'Hidden',
					'src'         => $theme_uri.'/images/options/layout-full.png'
				  ),
			   )
			),
			array(
			  'id'          => 'heading_bg',
			  'label'       => esc_html__('Heading Background','conferpress'),
			  'desc'        => esc_html__('Upload Custom Heading Background Image','conferpress'),
			  'std'         => '',
			  'type'        => 'background',
			  'class'       => '',
			  'choices'     => array()
			),
		 )
		);
	  
	  if (function_exists('ot_register_meta_box')) {
		  ot_register_meta_box( $meta_box );
	  }
	}
}