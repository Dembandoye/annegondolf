<?php 
/*
 * Template Name: Blog Style 2 (Demo)
 */

$layout = leaf_get_option('archive_sidebar_layout','right');
$listing_style = 0;
get_header();
?>
	<?php get_template_part( 'templates/header/header', 'heading' ); ?>
    <div id="body">
    	<div class="container">
        	<div class="content-pad-4x">
                <div class="row">
                    <div id="content" class="<?php if($layout!='full'){ ?> col-md-9 <?php }else{?> col-md-12 <?php } if($layout == 'left'){ ?> revert-layout <?php }?>">
                        <div class="blog-listing">
                        <?php
                        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                        $args = array(
							'post_type' => 'post',
							'paged' => $paged,
						);
                        $blog_query = new WP_Query($args);
						if($blog_query->have_posts()){
							// The Loop
							while ( $blog_query->have_posts() ) : $blog_query->the_post();
								get_template_part('templates/blog/loop','item');
							endwhile;
						}else{
							get_template_part('templates/blog/loop','none');
						}
						?>
                        </div>

                        <?php
						if(function_exists('wp_pagenavi')){
							wp_pagenavi(array( 'query' => $blog_query ));
						}else{
							leaf_content_nav('paging');
						}
						wp_reset_postdata();
						?>
                    </div><!--/content-->
                    <?php if($layout != 'full'){get_sidebar();} ?>
                </div><!--/row-->
            </div><!--/content-pad-->
        </div><!--/container-->
    </div><!--/body-->
<?php get_footer(); ?>