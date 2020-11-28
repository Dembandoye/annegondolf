<?php
if ( ! defined( 'ABSPATH' ) ) { die( '-1' ); }

do_action('eventon_before_main_content');

$layout = leaf_get_option('event_sidebar_layout','right');
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
                        	<div id="leaf-eventon-template">
                        		<?php do_action('eventon_single_content_wrapper');?>
								<?php while ( have_posts() ) : the_post();
									//the_content();
									do_action('eventon_single_content');
								endwhile; ?>
								<div class="clear"></div>
								<?php do_action('eventon_single_after_loop'); ?>
                            </div>
                        </article>
                    </div><!--/content-->
                    <?php if($layout != 'full' && $layout != 'true-full'){ get_sidebar(); } ?>
                </div><!--/row-->
            </div><!--/content-pad-4x-->
        <?php if($layout!='true-full'){ ?>
        </div><!--/container-->
        <?php }?>
    </div><!--/body-->
<?php get_footer(); ?>
<?php do_action('eventon_after_main_content'); ?>