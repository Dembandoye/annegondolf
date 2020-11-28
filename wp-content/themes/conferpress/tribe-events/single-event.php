<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<div id="tribe-events-content" class="tribe-events-single">

	<!-- Notices -->
	<?php tribe_the_notices() ?>
	
    <?php if(leaf_get_option('event_show_content_info','on')!='off'){ ?>
	<p class="tribe-events-back">
        <a class="btn btn-lighter btn-sm" href="<?php echo esc_url( tribe_get_events_link() ); ?>">
            <span class="btn-text"><i class="lnr lnr-calendar-full"></i> <?php printf( esc_html__( 'All %s', 'conferpress' ), $events_label_plural ); ?></span>
        </a>
	</p>

	<?php the_title( '<h1 class="h2">', '</h1>' ); ?>

	<div class="tribe-events-schedule tribe-clearfix">
		<?php echo tribe_events_event_schedule_details( $event_id, '<span class="single-event-content-detail">', '</span>' ); ?>
		<?php if ( tribe_get_cost() ) : ?>
			<span class="tribe-events-divider">|</span>
			<span class="sc-tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
		<?php endif; ?>
	</div>
    <?php }//if show content info?>

	<!-- Event header -->
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		<!-- Navigation -->
		<h3 class="tribe-events-visuallyhidden"><?php printf( esc_html__( '%s Navigation', 'conferpress' ), $events_label_singular ); ?></h3>
		<ul class="tribe-events-sub-nav">
			<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
			<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
		</ul>
		<!-- .tribe-events-sub-nav -->
	</div>
	<!-- #tribe-events-header -->

	<?php while ( have_posts() ) :  the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- Event featured image, but exclude link -->
			<?php if(leaf_get_option('event_show_thumbnail','on')!='off'){ 
				echo tribe_event_featured_image( $event_id, 'full', false );
			}?>

			<!-- Event content -->
			<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
			<div class="tribe-events-single-event-description tribe-events-content">
				<?php the_content(); ?>
			</div>
            
			<!-- Event meta -->
            <div class="sc-single-event-meta">
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
			<?php tribe_get_template_part( 'modules/meta' ); ?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
            </div>
            
            <div class="sc-single-event-social">
            <ul class="list-inline social-light single-event-share">
				<?php leaf_social_share(); ?>
            </ul>
			<!-- .tribe-events-single-event-description -->
			<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
			<div class="clear"></div>
            </div>
            
            <?php if($event_product_id = get_post_meta(get_the_ID(),'product-id',true) ){ ?>
            <?php do_action( 'woocommerce_before_single_product' ); ?>
            <div id="event-cart" class="sc-single-event-add-to-cart dark-div">
				<?php if ( function_exists( 'woocommerce_template_single_add_to_cart' ) && (get_post_type($event_product_id)=='product') ) {
                    global $product;
                    $product = wc_get_product( $event_product_id );
					if($product && $product->is_type('simple')){ ?>
						<div class="sc-simple-product-price">
                        	<div class="pull-left"><?php esc_html_e('Price: ','conferpress'); ?></div>
                            <div class="pull-left sc-simple-product-price-price"><?php woocommerce_template_single_price(); ?></div>
                            <div class="clearfix"></div>
                        </div>
					<?php }
					
                    woocommerce_template_single_add_to_cart();
                } ?>
                <div class="clearfix"></div>
            </div>
            <?php }//if event_product_id ?>
             
			<?php if($event_member_id = get_post_meta(get_the_ID(),'member-id',true)){ ?>
            <div class="sc-single-event-trainer">
				<?php
				echo do_shortcode('[sc_heading url="" align="center" size="0"]'.leaf_get_option('member_label','Trainers').'[/sc_heading]');
				echo do_shortcode('[sc_post_grid column="3" post_type="sp_member" ids="'.implode(',',$event_member_id).'" order="DESC" orderby="title" count="60"]'); ?>
            </div>
            <?php } ?>
		</div> <!-- #post-x -->
		

	<!-- Event nav -->
    <?php if(leaf_get_option('event_show_post_nav','on')!='off'){ ?>
	<div class="sc-single-event-nav">
		<div class="row">
        	<?php global $post;
			
			if($prev_event = @Tribe__Events__Main::instance()->get_closest_event( $post, 'previous' )){ ?>
			<div class="col-sm-6">
            	<a class="post-nav-item dark-div" href="<?php echo get_permalink($prev_event->ID); ?>">
                	<?php if(has_post_thumbnail($prev_event->ID)){
                    	$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($prev_event->ID),'conferpress_thumb_500x500', true);
					}else{
						$thumbnail = leaf_print_default_thumbnail();
					}?>
                    <img src="<?php echo esc_url($thumbnail[0]) ?>">
                    <div class="post-nav-item-content">
                    	<div class="small"><i class="fa fa-angle-left"></i> <?php esc_html_e('Previous','conferpress'); ?></div>
                    	<h4 class="font-2"><?php echo get_the_title($prev_event->ID); ?></h4>
                    </div>
                </a>
            </div>
            <?php }else{//if prev
				leaf_print_nav_al_event('prev');
			}
			
			if($next_event = @Tribe__Events__Main::instance()->get_closest_event( $post, 'next' )){ ?>
			<div class="col-sm-6 col-nav-next">
            	<a class="post-nav-item dark-div" href="<?php echo get_permalink($next_event->ID); ?>">
                	<?php if(has_post_thumbnail($next_event->ID)){
                    	$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($next_event->ID),'conferpress_thumb_500x500', true);
					}else{
						$thumbnail = leaf_print_default_thumbnail();
					}?>
                    <img src="<?php echo esc_url($thumbnail[0]) ?>">
                    <div class="post-nav-item-content">
                    	<div class="small"><?php esc_html_e('Next','conferpress'); ?> <i class="fa fa-angle-right"></i></div>
                    	<h4 class="font-2"><?php echo get_the_title($next_event->ID); ?></h4>
                    </div>
                </a>
            </div>
            <?php }else{//if next
				leaf_print_nav_al_event('next');
			}?>
		</div>
	</div>
    <?php }//if show nav ?>
    
    <?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ){
		comments_template();
	}?>
	<?php endwhile; ?>

</div><!-- #tribe-events-content -->
