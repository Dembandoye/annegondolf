<?php
add_action( 'admin_init', 'leaf_custom_theme_options' );
function leaf_custom_theme_options() {
	$saved_settings = get_option( 'option_tree_settings', array() );
	$theme_uri = get_template_directory_uri(); 
	$custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'general',
        'title'       => '<i class="fa fa-cogs"></i>'.esc_html__('General','conferpress')
      ),
      array(
        'id'          => 'color',
        'title'       => '<i class="fa fa-magic"></i>'.esc_html__('Colors & Background','conferpress')
      ),
      array(
        'id'          => 'fonts',
        'title'       => '<i class="fa fa-font"></i>'.esc_html__('Fonts','conferpress')
      ),
	  array(
        'id'          => 'nav',
        'title'       => '<i class="fa fa-bars"></i>'.esc_html__('Main Navigation','conferpress')
      ),
      array(
        'id'          => 'single_post',
        'title'       => '<i class="fa fa-file-text-o"></i>'.esc_html__('Single Post','conferpress')
      ),
      array(
        'id'          => 'single_page',
        'title'       => '<i class="fa fa-file"></i>'.esc_html__('Single Page','conferpress')
      ),
      array(
        'id'          => 'archive',
        'title'       => '<i class="fa fa-pencil-square"></i>'.esc_html__('Archives','conferpress')
      ),
      array(
        'id'          => '404',
        'title'       => '<i class="fa fa-exclamation-triangle"></i>'.esc_html__('404','conferpress')
      ),
	  array(
        'id'          => 'event',
        'title'       => '<i class="fa fa-calendar "></i>'.esc_html__('Event','conferpress')
      ),
	  array(
        'id'          => 'member',
        'title'       => '<i class="fa fa-users "></i>'.esc_html__('Member','conferpress')
      ),
	  array(
        'id'          => 'woocommerce',
        'title'       => '<i class="fa fa-shopping-cart "></i>'.esc_html__('WooCommerce','conferpress')
      ),
      array(
        'id'          => 'social_account',
        'title'       => '<i class="fa fa-twitter-square"></i>'.esc_html__('Social Accounts','conferpress')
      ),
      array(
        'id'          => 'social_share',
        'title'       => '<i class="fa fa-share-square"></i>'.esc_html__('Social Sharing','conferpress')
      ),
	  
    ),
    'settings'        => array( 
	  array(
        'id'          => 'copyright',
        'label'       => esc_html__('Copyright Text','conferpress'),
        'desc'        => esc_html__('Appear in footer','conferpress'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
      ),
      array(
        'id'          => 'right_to_left',
        'label'       => esc_html__('RTL mode','conferpress'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'checkbox',
        'section'     => 'general',
        'choices'     => array( 
          array(
            'value'       => '1',
            'label'       => esc_html__('Enable RTL','conferpress'),
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'custom_code',
        'label'       => esc_html__('Custom Code','conferpress'),
        'desc'        => esc_html__('Enter custom code or JS code here. For example, enter Google Analytics','conferpress'),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'logo_image',
        'label'       => esc_html__('Logo Image','conferpress'),
        'desc'        => esc_html__('Upload your logo image','conferpress'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
      array(
        'id'          => 'retina_logo',
        'label'       => esc_html__('Retina Logo (optional)','conferpress'),
        'desc'        => esc_html__('Retina logo should be two time bigger than the custom logo. Retina Logo is optional, use this setting if you want to strictly support retina devices.','conferpress'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'footer_logo',
        'label'       => esc_html__('Footer Logo Image','conferpress'),
        'desc'        => esc_html__('Upload Footer logo image','conferpress'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'login_logo',
        'label'       => esc_html__('Login Logo Image','conferpress'),
        'desc'        => esc_html__('Upload your Admin Login logo image','conferpress'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'general',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),
	  array(
        'id'          => 'pre-loading',
        'label'       => esc_html__('Pre-loading Effect','conferpress'),
        'desc'        => esc_html__('Enable Pre-loading Effect','conferpress'),
        'std'         => '2',
        'type'        => 'select',
        'section'     => 'general',
        'rows'        => '',
		'choices'     => array( 
          array(
            'value'       => '-1',
            'label'       => esc_html__('Disable','conferpress'),
            'src'         => ''
          ),
		  array(
            'value'       => '1',
            'label'       => esc_html__('Enable','conferpress'),
            'src'         => ''
          ),
		  array(
            'value'       => '2',
            'label'       => esc_html__('Enable for Homepage Only','conferpress'),
            'src'         => ''
          )
        ),
      ),
	  array(
        'id'          => 'loading_bg',
        'label'       => esc_html__('Pre-Loading Background Color','conferpress'),
        'desc'        => esc_html__('Default is Black','conferpress'),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
      ),
      array(
        'id'          => 'loading_spin_color',
        'label'       => esc_html__('Pre-Loading Spinners Color','conferpress'),
        'desc'        => esc_html__('Default is Main color','conferpress'),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'general',
      ),
	  //color
      array(
        'id'          => 'main_color_1',
        'label'       => esc_html__('Main color','conferpress'),
        'desc'        => esc_html__('Choose Main color (Default is #39ba93)','conferpress'),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
	  array(
        'id'          => 'heading_bg',
        'label'       => esc_html__('Page Heading Background','conferpress'),
        'desc'        => esc_html__('Choose Page Heading background (Default is Main color)','conferpress'),
        'std'         => '',
        'type'        => 'background',
        'section'     => 'color',
      ),
	  array(
        'id'          => 'footer_bg',
        'label'       => esc_html__('Footer Background Color','conferpress'),
        'desc'        => esc_html__('Choose Footer background color (Default is Main color)','conferpress'),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'color',
      ),
	  
	  
	  //font
      array(
        'id'          => 'main_font',
        'label'       => esc_html__('Main Font Family','conferpress'),
        'desc'        => esc_html__('Enter font-family name here. <a href="http://www.google.com/fonts/" target="_blank">Google Fonts</a> are supported. For example, if you choose "Source Code Pro" Google Font with font-weight 400,500,600, enter <i>Source Code Pro:400,500,600</i>','conferpress'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
      ),
      array(
        'id'          => 'main_size',
        'label'       => esc_html__('Main Font Size','conferpress'),
        'desc'        => esc_html__('Select base font size (px)','conferpress'),
        'std'         => '14',
        'type'        => 'numeric-slider',
        'section'     => 'fonts',
        'min_max_step'=> '10,18,1',
      ),
	  array(
        'id'          => 'heading_font',
        'label'       => esc_html__('Heading Font Family','conferpress'),
        'desc'        => esc_html__('Enter font-family name here. <a href="http://www.google.com/fonts/" target="_blank">Google Fonts</a> are supported. For example, if you choose "Source Code Pro" Google Font with font-weight 400,500,600, enter <i>Source Code Pro:400,500,600</i>','conferpress'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
      ),
	  array(
        'id'          => 'heading_font_style',
        'label'       => esc_html__('Heading Font Style','conferpress'),
        'desc'        => esc_html__('Ex: italic','conferpress'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'fonts',
      ),
      array(
        'id'          => 'custom_font_1',
        'label'       => esc_html__('Upload Custom Font 1','conferpress'),
        'desc'        => esc_html__('Upload your own font and enter name "custom-font-1" in "Main Font Family" or "Heading Font Family" setting above','conferpress'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'fonts',
      ),
	  array(
        'id'          => 'custom_font_2',
        'label'       => esc_html__('Upload Custom Font 2','conferpress'),
        'desc'        => esc_html__('Upload your own font and enter name "custom-font-2" in "Main Font Family" or "Heading Font Family" setting above','conferpress'),
        'std'         => '',
        'type'        => 'upload',
        'section'     => 'fonts',
      ),
	  
	  //nav
	  array(
        'id'          => 'nav_style',
        'label'       => esc_html__('Main Navigation Style','conferpress'),
        'desc'        => esc_html__('Choose Main Navigation Style','conferpress'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'nav',
        'min_max_step'=> '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => esc_html__('Default','conferpress'),
          ),
          array(
            'value'       => '1',
            'label'       => esc_html__('Off Canvas','conferpress'),
          ),
        ),
      ),
    array(
        'id'          => 'nav_layout',
        'label'       => esc_html__('Main Navigation Layout','conferpress'),
        'desc'        => esc_html__('Choose Main Navigation Layout','conferpress'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'nav',
        'min_max_step'=> '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => esc_html__('Full','conferpress'),
          ),
          array(
            'value'       => '1',
            'label'       => esc_html__('Boxed','conferpress'),
          ),
        ),
      ),
	  array(
        'id'          => 'nav_schema',
        'label'       => esc_html__('Main Navigation Schema','conferpress'),
        'desc'        => esc_html__('Choose Main Navigation color schema','conferpress'),
        'std'         => '',
        'type'        => 'select',
        'section'     => 'nav',
        'min_max_step'=> '',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => esc_html__('Dark','conferpress'),
          ),
          array(
            'value'       => '1',
            'label'       => esc_html__('Light','conferpress'),
          ),
        ),
      ),

    array(
        'id'          => 'top_nav_enable',
        'label'       => esc_html__('Enable Top Navigation?','conferpress'),
        'desc'        => esc_html__('Choose Off to hide TOP Navigation','conferpress'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'nav',
      ),
    array(
        'id'          => 'top_nav_bg',
        'label'       => esc_html__('Top Navigation Background Color','conferpress'),
        'desc'        => esc_html__('Choose TOP Navigation background color','conferpress'),
        'std'         => '',
        'type'        => 'colorpicker',
        'condition'   => 'top_nav_enable:not(off)',
        'section'     => 'nav',
      ),
    array(
        'id'          => 'top_nav_opacity',
        'label'       => esc_html__('Top Navigation Background Opacity','conferpress'),
        'desc'        => esc_html__('Choose TOP Navigation background opacity (%)','conferpress'),
        'std'         => '100',
        'type'        => 'numeric-slider',
        'section'     => 'nav',
        'condition'   => 'top_nav_bg:not(),top_nav_enable:not(off)',
        'min_max_step'=> '0,100,5',
      ),
	  array(
        'id'          => 'nav_bg',
        'label'       => esc_html__('Main Navigation Background Color','conferpress'),
        'desc'        => esc_html__('Choose Main Navigation background color','conferpress'),
        'std'         => '',
        'type'        => 'colorpicker',
        'section'     => 'nav',
      ),
	  array(
        'id'          => 'nav_opacity',
        'label'       => esc_html__('Main Navigation Background Opacity','conferpress'),
        'desc'        => esc_html__('Choose Main Navigation background opacity (%)','conferpress'),
        'std'         => '100',
        'type'        => 'numeric-slider',
        'section'     => 'nav',
        'condition'   => 'nav_bg:not()',
		    'min_max_step'=> '0,100,5',
      ),
	  array(
        'id'          => 'nav_sticky',
        'label'       => esc_html__('Sticky Navigation','conferpress'),
        'desc'        => esc_html__('Choose to Enable Sticky Navigation','conferpress'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'nav',
      ),
	  array(
        'id'          => 'sticky_logo_image',
        'label'       => esc_html__('Sticky Logo','conferpress'),
        'desc'        => esc_html__('Upload logo image if you want sticky menu has different logo','conferpress'),
        'std'         => '',
        'type'        => 'upload',
        'condition'   => 'nav_sticky:not(off)',
        'section'     => 'nav',
      ),
	  array(
        'id'          => 'enable_search',
        'label'       => esc_html__('Enable Search','conferpress'),
        'desc'        => esc_html__('Enable or disable default search button on Top Navigation','conferpress'),
        'std'         => '',
        'type'        => 'on-off',
        'condition'   => 'top_nav_enable:not(off)',
        'section'     => 'nav',
      ),
    array(
        'id'          => 'enable_cart',
        'label'       => esc_html__('Enable Cart','conferpress'),
        'desc'        => esc_html__('Enable or disable default Cart button on Top Navigation','conferpress'),
        'std'         => '',
        'type'        => 'on-off',
        'condition'   => 'top_nav_enable:not(off)',
        'section'     => 'nav',
      ),
	  
	  array(
		'label'       => esc_html__('Top Navigation Content','conferpress'),
		'id'          => 'top_nav_content',
		'type'        => 'textarea-simple',
		'desc'        => esc_html__('Ex: <span><i class="fa fa-phone"></i> 0123-456-789</span>','conferpress'),
		'std'         => '',
    'condition'   => 'top_nav_enable:not(off)',
		'section'     => 'nav',
	 ),
	  array(
			'label'       => esc_html__('Top Navigation Tabs','conferpress'),
			'id'          => 'top_tabs',
			'type'        => 'list-item',
      'condition'   => 'top_nav_enable:not(off)',
			'section'     => 'nav',
			'desc'        => esc_html__('Add Top Navigation Tabs','conferpress'),
			'settings'    => array(
				 array(
					'label'       => esc_html__('Icon Font Class','conferpress'),
					'id'          => 'icon',
					'type'        => 'text',
					'desc'        => esc_html__('Enter Font Awesome class (Ex: fa-facebook)','conferpress'),
					'std'         => '',
				 ),
				 array(
					'label'       => esc_html__('Content','conferpress'),
					'id'          => 'content',
					'type'        => 'textarea',
					'desc'        => esc_html__('Enter Tab Content','conferpress'),
					'std'         => '',
				 ),
				 array(
					'label'       => esc_html__('URL','conferpress'),
					'id'          => 'link',
					'type'        => 'text',
					'desc'        => esc_html__('Enter URL for this item (will redirect instead of expand tab content)','conferpress'),
					'std'         => '',
				 ),
				 array(
					'label'       => esc_html__('Full width content','conferpress'),
					'id'          => 'fullwidth',
					'desc'        => esc_html__('Full width or in Container (default)?','conferpress'),
					'std'         => 'off',
					'type'        => 'on-off',
				 ),
				 array(
					'label'       => esc_html__('Show Tab Title','conferpress'),
					'id'          => 'show_title',
					'desc'        => esc_html__('Choose to show Title next to icon','conferpress'),
					'std'         => 'off',
					'type'        => 'on-off',
				 ),
			)
	  ),
	  


	  //single post
      array(
        'id'          => 'post_sidebar_layout',
        'label'       => esc_html__('Sidebar Layout','conferpress'),
        'desc'        => esc_html__('Select Sidebar Layout (Right, Left or Fullwidth)','conferpress'),
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => esc_html__('Sidebar Right','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-right.png'
          ),
          array(
            'value'       => 'left',
            'label'       => esc_html__('Sidebar Left','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-left.png'
          ),
		  array(
            'value'       => 'full',
            'label'       => esc_html__('Hidden','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-full.png'
          ),
        ),
      ),
	  array(
        'id'          => 'enable_author',
        'label'       => esc_html__('Author','conferpress'),
        'desc'        => esc_html__('Enable Author info','conferpress'),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
      ),
      array(
        'id'          => 'single_published_date',
        'label'       => esc_html__('Published Date','conferpress'),
        'desc'        => esc_html__('Enable Published Date info','conferpress'),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
      ),	
	  array(
        'id'          => 'single_categories',
        'label'       => esc_html__('Categories','conferpress'),
        'desc'        => esc_html__('Enable Categories info','conferpress'),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
      ),	
	  array(
        'id'          => 'single_tags',
        'label'       => esc_html__('Tags','conferpress'),
        'desc'        => esc_html__('Enable Categories info','conferpress'),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
      ),
	  array(
        'id'          => 'single_cm_count',
        'label'       => esc_html__('Comment Count','conferpress'),
        'desc'        => esc_html__('Enable Comment Count Info','conferpress'),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'single_post',
        'rows'        => '',
      ),
	  array(
        'id'          => 'single_navi',
        'label'       => esc_html__('Post Navigation','conferpress'),
        'desc'        => esc_html__('Enable Post Navigation','conferpress'),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'single_post',
      ),	  

      array(
        'id'          => 'page_sidebar_layout',
        'label'       => esc_html__('Sidebar Layout','conferpress'),
        'desc'        => esc_html__('Select Sidebar Layout (Right, Left or Fullwidth)','conferpress'),
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'single_page',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => esc_html__('Sidebar Right','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-right.png'
          ),
          array(
            'value'       => 'left',
            'label'       => esc_html__('Sidebar Left','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-left.png'
          ),
		  array(
            'value'       => 'full',
            'label'       => esc_html__('Hidden','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-full.png'
          ),
        ),
      ),
	  
      array(
        'id'          => 'archive_sidebar_layout',
        'label'       => esc_html__('Sidebar Layout','conferpress'),
        'desc'        => esc_html__('Select Sidebar position for Archive pages','conferpress'),
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'archive',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => esc_html__('Sidebar Right','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-right.png'
          ),
          array(
            'value'       => 'left',
            'label'       => esc_html__('Sidebar Left','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-left.png'
          ),
		  array(
            'value'       => 'full',
            'label'       => esc_html__('Hidden','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-full.png'
          ),
        ),
      ),
	  array(
        'id'          => 'listing_style',
        'label'       => esc_html__('Archive Post Listing Style','conferpress'),
        'desc'        => esc_html__('Select Post Listing Style for Archive pages (Quick Ajax need to be installed)','conferpress'),
        'std'         => 'wide',
        'type'        => 'select',
        'section'     => 'archive',
        'choices'     => array( 
          array(
            'value'       => '0',
            'label'       => esc_html__('Classic','conferpress'),
          ),
          array(
            'value'       => 'wide',
            'label'       => esc_html__('Wide','conferpress'),
          ),
          array(
            'value'       => 'ajax',
            'label'       => esc_html__('Quick Ajax','conferpress'),
          )
        ),
      ),
	  array(
        'id'          => 'blog_thumb_show_date',
        'label'       => esc_html__('Show datetime on Post Thumbnail','conferpress'),
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'archive',
      ),
	  array(
        'id'          => 'custom_excerpt_length',
        'label'       => esc_html__('Custom default excerpt length','conferpress'),
        'desc'        => esc_html__('Default is 22 words','conferpress'),
        'std'         => '22',
        'type'        => 'text',
        'section'     => 'archive',
      ),
	  
      array(
        'id'          => 'page404_title',
        'label'       => esc_html__('Page Title','conferpress'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => '404',
      ),
      array(
        'id'          => 'page404_content',
        'label'       => esc_html__('Page Content','conferpress'),
        'desc'        => '',
        'std'         => '',
        'type'        => 'textarea',
        'section'     => '404',
        'rows'        => '8',
      ),
	  array(
        'id'          => 'page404_search',
        'label'       => esc_html__('Search Form','conferpress'),
        'desc'        => esc_html__('Enable Search Form in 404 page','conferpress'),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => '404',
      ),
	  
	  
	  array(
        'id'          => 'woocommerce_layout',
        'label'       => esc_html__('Shop & Product Layout','conferpress'),
        'desc'        => esc_html__('Select default layout of shop & product pages','conferpress'),
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'woocommerce',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => esc_html__('Sidebar Right','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-right.png'
          ),
          array(
            'value'       => 'left',
            'label'       => esc_html__('Sidebar Left','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-left.png'
          ),
		  array(
            'value'       => 'full',
            'label'       => esc_html__('Hidden','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-full.png'
          ),
        ),
      ),
	  
	  
	array(
        'id'          => 'event_sidebar_layout',
        'label'       => esc_html__('Event Sidebar Layout','conferpress'),
        'desc'        => esc_html__('Select default layout of event pages','conferpress'),
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'event',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => esc_html__('Sidebar Right','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-right.png'
          ),
          array(
            'value'       => 'left',
            'label'       => esc_html__('Sidebar Left','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-left.png'
          ),
		  array(
            'value'       => 'full',
            'label'       => esc_html__('Hidden','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-full.png'
          ),
        ),
      ),
	  array(
        'id'          => 'event_show_top_info',
        'label'       => esc_html__('Show Heading Info','conferpress'),
        'desc'        => esc_html__('in Single Event','conferpress'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'event',
      ),
	  array(
        'id'          => 'event_show_top_category',
        'label'       => esc_html__('Show Heading Categories','conferpress'),
        'desc'        => esc_html__('in Single Event','conferpress'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'event',
      ),
	  array(
        'id'          => 'event_show_content_info',
        'label'       => esc_html__('Show Second Title, Info & All Event link in Single content','conferpress'),
        'desc'        => esc_html__('in Single Event','conferpress'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'event',
      ),
	  array(
        'id'          => 'event_show_thumbnail',
        'label'       => esc_html__('Show Event Thumbnail in Single content','conferpress'),
        'desc'        => esc_html__('in Single Event','conferpress'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'event',
      ),
	  array(
        'id'          => 'event_show_post_nav',
        'label'       => esc_html__('Show Next/Prev Event','conferpress'),
        'desc'        => esc_html__('in Single Event','conferpress'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'event',
      ),
	  array(
        'id'          => 'event_list_sidebar_layout',
        'label'       => esc_html__('Event Listing Sidebar Layout','conferpress'),
        'desc'        => esc_html__('Select layout of event archiver pages','conferpress'),
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'event',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => esc_html__('Sidebar Right','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-right.png'
          ),
          array(
            'value'       => 'left',
            'label'       => esc_html__('Sidebar Left','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-left.png'
          ),
		  array(
            'value'       => 'full',
            'label'       => esc_html__('Hidden','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-full.png'
          ),
        ),
      ),


	
	array(
        'id'          => 'member_sidebar_layout',
        'label'       => esc_html__('Member Sidebar Layout','conferpress'),
        'desc'        => esc_html__('Select default layout of member pages','conferpress'),
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'member',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => esc_html__('Sidebar Right','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-right.png'
          ),
          array(
            'value'       => 'left',
            'label'       => esc_html__('Sidebar Left','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-left.png'
          ),
		  array(
            'value'       => 'full',
            'label'       => esc_html__('Hidden','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-full.png'
          ),
        ),
      ),
	  array(
        'id'          => 'member_list_sidebar_layout',
        'label'       => esc_html__('Member List Sidebar Layout','conferpress'),
        'desc'        => esc_html__('Select default layout of member list pages','conferpress'),
        'std'         => '',
        'type'        => 'radio-image',
        'section'     => 'member',
        'choices'     => array( 
          array(
            'value'       => 'right',
            'label'       => esc_html__('Sidebar Right','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-right.png'
          ),
          array(
            'value'       => 'left',
            'label'       => esc_html__('Sidebar Left','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-left.png'
          ),
		  array(
            'value'       => 'full',
            'label'       => esc_html__('Hidden','conferpress'),
            'src'         => $theme_uri.'/images/options/layout-full.png'
          ),
        ),
      ),
	  array(
        'id'          => 'member_show_event',
        'label'       => esc_html__('Show Member\'s Upcomming Events','conferpress'),
        'desc'        => esc_html__('in Single Member','conferpress'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'member',
      ),
	  array(
        'id'          => 'member_show_member',
        'label'       => esc_html__('Show Other Members','conferpress'),
        'desc'        => esc_html__('in Single Member','conferpress'),
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'member',
      ),
	  array(
        'id'          => 'member_label',
        'label'       => esc_html__('Member Post Label','conferpress'),
        'desc'        => esc_html__('Ex: Trainers, Teachers...','conferpress'),
        'std'         => 'Speakers',
        'type'        => 'text',
        'section'     => 'member',
      ),
	  array(
        'id'          => 'member_slug',
        'label'       => esc_html__('Member Post Slug','conferpress'),
        'desc'        => esc_html__('Need to re-save permalink options','conferpress'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'member',
      ),



      array(
        'id'          => 'acc_facebook',
        'label'       => esc_html__('Facebook','conferpress'),
        'desc'        => esc_html__('Enter full link to your account (including http://)','conferpress'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
      ),
      array(
        'id'          => 'acc_twitter',
        'label'       => esc_html__('Twitter','conferpress'),
        'desc'        => esc_html__('Enter full link to your account (including http://)','conferpress'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
      ),
      array(
        'id'          => 'acc_linkedin',
        'label'       => esc_html__('LinkedIn','conferpress'),
        'desc'        => esc_html__('Enter full link to your account (including http://)','conferpress'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
      ),
      array(
        'id'          => 'acc_tumblr',
        'label'       => esc_html__('Tumblr','conferpress'),
        'desc'        => esc_html__('Enter full link to your account (including http://)','conferpress'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
      ),
      array(
        'id'          => 'acc_google-plus',
        'label'       => esc_html__('Google Plus','conferpress'),
        'desc'        => esc_html__('Enter full link to your account (including http://)','conferpress'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
      ),
      array(
        'id'          => 'acc_pinterest',
        'label'       => esc_html__('Pinterest','conferpress'),
        'desc'        => esc_html__('Enter full link to your account (including http://)','conferpress'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
      ),
      array(
        'id'          => 'acc_youtube',
        'label'       => esc_html__('Youtube','conferpress'),
        'desc'        => esc_html__('Enter full link to your account (including http://)','conferpress'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
      ),
      array(
        'id'          => 'acc_flickr',
        'label'       => esc_html__('Flickr','conferpress'),
        'desc'        => esc_html__('Enter full link to your account (including http://)','conferpress'),
        'std'         => '',
        'type'        => 'text',
        'section'     => 'social_account',
      ),
	  array(
			'label'       => esc_html__('Custom Social Account','conferpress'),
			'id'          => 'custom_acc',
			'type'        => 'list-item',
			'class'       => '',
			'section'     => 'social_account',
			'desc'        => esc_html__('Add Social Account','conferpress'),
			'choices'     => array(),
			'settings'    => array(
				 array(
					'label'       => esc_html__('Icon Font Awesome','conferpress'),
					'id'          => 'icon',
					'type'        => 'text',
					'desc'        => esc_html__('Enter Font Awesome class (Ex: fa-facebook)','conferpress'),
				 ),
				 array(
					'label'       => esc_html__('URL','conferpress'),
					'id'          => 'link',
					'type'        => 'text',
					'desc'        => esc_html__('Enter full link to your account (including http://)','conferpress'),
				 ),
			)
	  ),
	  array(
        'id'          => 'social_link_open',
        'label'       => esc_html__('Open Social link in new tab?','conferpress'),
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on-off',
        'section'     => 'social_account',
      ),
      array(
        'id'          => 'share_facebook',
        'label'       => esc_html__('Facebook Share','conferpress'),
        'desc'        => esc_html__('Enable Facebook Share button','conferpress'),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'social_share',
      ),
      array(
        'id'          => 'share_twitter',
        'label'       => esc_html__('Twitter Share','conferpress'),
        'desc'        => esc_html__('Enable Twitter Tweet button','conferpress'),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'social_share',
      ),
      array(
        'id'          => 'share_linkedin',
        'label'       => esc_html__('LinkedIn Share','conferpress'),
        'desc'        => esc_html__('Enable LinkedIn Share button','conferpress'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'social_share',
      ),
      array(
        'id'          => 'share_tumblr',
        'label'       => esc_html__('Tumblr Share','conferpress'),
        'desc'        => esc_html__('Enable Tumblr Share button','conferpress'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'social_share',
      ),
      array(
        'id'          => 'share_google_plus',
        'label'       => esc_html__('Google+ Share','conferpress'),
        'desc'        => esc_html__('Enable Google+ Share button','conferpress'),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'social_share',
      ),
      array(
        'id'          => 'share_pinterest',
        'label'       => esc_html__('Pinterest Share','conferpress'),
        'desc'        => esc_html__('Enable Pinterest Pin button','conferpress'),
        'std'         => 'off',
        'type'        => 'on-off',
        'section'     => 'social_share',
      ),
      array(
        'id'          => 'share_email',
        'label'       => esc_html__('Email Share','conferpress'),
        'desc'        => esc_html__('Enable Email button','conferpress'),
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'social_share',
      ),
	  
	  
    )
  );
  
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
}