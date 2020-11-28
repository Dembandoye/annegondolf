<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$layout = leaf_get_option('event_sidebar_layout','right');
if(is_post_type_archive('tribe_events') || is_tax('tribe_events_cat')
	|| (is_tax('post_tag') && get_query_var('post_type')=='tribe_events') ) {
	$layout = leaf_get_option('event_list_sidebar_layout','right');
}
get_header();
?>
	<?php get_template_part( 'templates/header/header', 'heading' ); ?>    
    <div id="body">
    	<?php if($layout!='true-full'){ ?>
    	<div class="container">
        <?php }?>
        	<div class="content-pad-4x">
                <div class="row">
                    <div id="content" class="<?php if($layout != 'full' && $layout != 'true-full'){ ?> col-md-9 <?php }else{?> col-md-12 <?php } if($layout == 'left'){ ?> revert-layout <?php }?>" role="main">
                        <article class="single-page-content">
                        	<div id="tribe-events-pg-template">
								<?php tribe_events_before_html(); ?>
                                <?php tribe_get_view(); ?>
                                <?php tribe_events_after_html(); ?>
                            </div> <!-- #tribe-events-pg-template -->
                        </article>
                    </div><!--/content-->
                    <?php if($layout != 'full' && $layout != 'true-full'){get_sidebar();} ?>
                </div><!--/row-->
            </div><!--/content-pad-4x-->
        <?php if($layout!='true-full'){ ?>
        </div><!--/container-->
        <?php }?>
    </div><!--/body-->
<?php get_footer(); ?>
