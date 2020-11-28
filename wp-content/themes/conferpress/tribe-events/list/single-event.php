<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// Venue
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

?>
<div class="event-carousel-item event-item">
    <div class="event-item-inner">
        <div class="event-item-thumbnail">
            <a href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute(); ?>" >
                <?php if(has_post_thumbnail()){
                    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'leaf_thumb_524x366', true);
                }else{
                    $thumbnail = leaf_print_default_thumbnail();
                }?>
                <img src="<?php echo esc_url($thumbnail[0]) ?>" width="<?php echo esc_attr($thumbnail[1]) ?>" height="<?php echo esc_attr($thumbnail[2]) ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>">
                <?php if(class_exists('Tribe__Events__Main')){
                    $startdate = get_post_meta(get_the_ID(), '_EventStartDate', true);
                    if($startdate){
                        $con_date = new DateTime($startdate);
                        $month = $con_date->format('M');
                        $day = $con_date->format('d');
                        $year = $con_date->format('Y');
                    }
                    ?>
                    <div class="event-date-block font-2 main-color-1-bg text-center">
                        <div class="day"><?php echo esc_html($day); ?></div>
                        <div class="month"><?php echo date_i18n( 'M', strtotime( $startdate ) ); ?></div>
                        <div class="year hidden"><?php echo date_i18n( 'Y', strtotime( $startdate ) ); ?></div>
                    </div>
                <?php }?>
            </a>
        </div>
        
        <?php do_action( 'tribe_events_before_the_content' ) ?>
        <div class="event-item-content">

            <?php do_action( 'tribe_events_before_the_event_title' ) ?>
            <h3 class="event-title font-2"><a href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>"><?php the_title(); ?></a></h3>
            <?php do_action( 'tribe_events_after_the_event_title' ) ?>

            <div class="event-meta small-meta">
                <?php if(class_exists('Tribe__Events__Main')){?>
                    <div><i class="lnr lnr-calendar-full"></i> <?php echo tribe_events_event_schedule_details(); ?></div>
                    <?php
                    if (tribe_get_venue() || tribe_get_address()){ ?>
                        <div class="venue-details">
                            <i class="lnr lnr-map-marker"></i><?php echo tribe_get_venue()?tribe_get_venue():tribe_get_address(); ?>
                        </div>
                    <?php } ?>
                <?php }else{ ?>
                    <div><?php echo esc_html__('By ','conferpress').get_the_author(); ?></div>
                    <div><?php esc_html_e('At ','conferpress'); the_time( get_option( 'time_format' ) ); ?></div>
                <?php }?>
            </div>

            <div class="event-excerpt"><?php echo tribe_events_get_the_excerpt( null, wp_kses_allowed_html( 'post' ) ); ?></div>

            <a class="btn btn-lighter event-button btn-block" href="<?php echo esc_url( tribe_get_event_link() ); ?>">
                <?php if(class_exists('Tribe__Events__Main')){?>
                <span class="btn-text">
                    <?php esc_html_e('Join Now', 'conferpress'); ?>
                    <?php echo tribe_get_cost( null, true )?' - '.tribe_get_cost( null, true ):''; ?>
                </span>
                <?php }else{?>
                <span class="btn-text"><?php esc_html_e('Read More', 'conferpress'); ?></span>
                <?php }?>
                <span class="btn-icon"><i class="lnr lnr-chevron-right"></i></span>
            </a>
            

        </div>
        <?php do_action( 'tribe_events_after_the_content' );?>   
    </div><!--inner-->
</div><!--/event-carousel-item-->