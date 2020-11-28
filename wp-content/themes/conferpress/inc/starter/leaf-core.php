<?php
/**
 * Option Tree integration ===========
 */
 /**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_true' );

/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Required: set 'ot_theme_mode' filter to true.
 */
add_filter( 'ot_theme_mode', '__return_false' );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if(!class_exists( 'OT_Loader' ))
{
    if ( ! function_exists( 'ot_get_option' ) ){
        function ot_get_option($id, $default_value=null)
        {
            return $default_value;
        }
    }

    if ( ! function_exists( 'ot_settings_id' ) ){
        function ot_settings_id()
        {
            return null;
        }
    }

    if ( ! function_exists( 'ot_register_meta_box' ) ){
        function ot_register_meta_box()
        {
            return null;
        }
    }
}

//Menu Walker
require_once get_template_directory().'/inc/starter/leaf-menu-walker.php';

//Metadata boxes
require_once get_template_directory().'/inc/meta/meta-boxes.php';


add_action( 'tgmpa_register', 'leaf_acplugins' );
function leaf_acplugins($plugins) {
	
	global $__required_plugins;
	
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain'            => 'conferpress',           // Text domain - likely want to be the same as your theme.
        'default_path'      => '',                           // Default absolute path to pre-packaged plugins
        'parent_slug'   	=> 'themes.php',         // Default parent URL slug
        'menu'              => 'install-required-plugins',   // Menu slug
        'has_notices'       => true,                         // Show admin notices or not
        'is_automatic'      => false,            // Automatically activate plugins after installation or not
        'message'           => '',               // Message to output right before the plugins table
        'strings'           => array(
            'page_title'                                => esc_html__( 'Install Required &amp; Recommended Plugins', 'conferpress' ),
            'menu_title'                                => esc_html__( 'Install Plugins', 'conferpress' ),
            'installing'                                => esc_html__( 'Installing Plugin: %s', 'conferpress' ), // %1$s = plugin name
            'oops'                                      => esc_html__( 'Something went wrong with the plugin API.', 'conferpress' ),
            'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'conferpress' ), // %1$s = plugin name(s)
            'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'conferpress' ), // %1$s = plugin name(s)
            'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'conferpress' ), // %1$s = plugin name(s)
            'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'conferpress' ), // %1$s = plugin name(s)
            'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'conferpress' ), // %1$s = plugin name(s)
            'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'conferpress' ), // %1$s = plugin name(s)
            'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'conferpress' ), // %1$s = plugin name(s)
            'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'conferpress' ), // %1$s = plugin name(s)
            'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'conferpress' ),
            'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'conferpress' ),
            'return'                                    => esc_html__( 'Return to Required Plugins Installer', 'conferpress' ),
            'plugin_activated'                          => esc_html__( 'Plugin activated successfully.', 'conferpress' ),
            'complete'                                  => esc_html__( 'All plugins installed and activated successfully. %s', 'conferpress' ) // %1$s = dashboard link
        )
    );
 
    tgmpa( $__required_plugins, $config);
}

function leaf_get_option($options, $default = NULL){
	global $post;
	global $wp_query;
    $meta = '';
	if(is_singular()){
		if(is_singular('tribe_events')){
			global $wp_query;
			global $post;
			$post = $wp_query->post;
		}
        if(isset($post->ID)){
            $meta = get_post_meta($post->ID,$options,true);
        }
		return $meta != '' ?$meta:ot_get_option($options, $default);
	}
	return ot_get_option($options, $default);
}

function leaf_print_nav_al_event($dir = 'next'){ ?>
	<div class="col-sm-6 <?php echo esc_attr($dir=='next'?'col-nav-next':''); ?>">
        <a class="post-nav-item dark-div" href="<?php echo esc_url( tribe_get_events_link() ); ?>">
        	<?php $thumbnail = leaf_print_default_thumbnail(); ?>
            <img src="<?php echo esc_url($thumbnail[0]) ?>" alt="<?php printf( esc_attr__( 'All %s', 'conferpress' ), tribe_get_event_label_plural() ); ?>">
            <div class="post-nav-item-content">
                <div class="small"><i class="fa-2x lnr lnr-calendar-full"></i></div>
                <h4 class="font-2"><?php printf( esc_html__( 'All %s', 'conferpress' ), tribe_get_event_label_plural() ); ?></h4>
            </div>
        </a>
    </div>
<?php }

function leaf_print_nav_blog($dir = 'next'){ ?>
	<div class="col-sm-6 <?php echo esc_attr($dir=='next'?'col-nav-next':''); ?>">
        <a class="post-nav-item dark-div" href="<?php echo esc_url( get_option('page_for_posts')?get_permalink(get_option('page_for_posts')):home_url('/') ); ?>">
        	<?php $thumbnail = leaf_print_default_thumbnail(); ?>
            <img src="<?php echo esc_url($thumbnail[0]) ?>" alt="<?php esc_attr_e( 'Blog', 'conferpress' ); ?>">
            <div class="post-nav-item-content">
                <div class="small"><i class="fa fa-2x fa-newspaper-o"></i></div>
                <h4 class="font-2"><?php esc_html_e( 'Blog', 'conferpress' ); ?></h4>
            </div>
        </a>
    </div>
<?php }

function leaf_print_blog_thumbnail_date(){
	if(leaf_get_option('blog_thumb_show_date','off')!='off'){
	global $post; ?>
	<div class="thumbnail-overflow-2">
        <div class="date-block-2 btn btn-primary btn-date-blog">
            <div class="btn-text">
                <div class="day"><?php the_time( 'd' ); ?></div>
                <div class="month-year">
                    <?php the_time( 'F' ); ?><br />
                    <?php the_time( 'Y' ); ?>
                </div>
            </div>
        </div>
    </div>
<?php }
}