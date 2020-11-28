<?php 
if(is_post_type_archive('sp_member')){
	$layout = leaf_get_option('member_list_sidebar_layout','full');
}else{
	$layout = leaf_get_option('archive_sidebar_layout','right');
}
$listing_style = leaf_get_option('listing_style','wide');
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
						if(have_posts()){
							if(is_post_type_archive('sp_member')){
								echo do_shortcode('[sc_post_grid column="3" post_type="sp_member" count="800" orderby="title" order="ASC"]');
							}elseif($listing_style=='ajax' && function_exists('wp_ajax_shortcode')){
								echo do_shortcode("[wpajax global_query=1 /]");
							}elseif($listing_style=='wide'){
								while ( have_posts() ) : the_post();
									get_template_part('templates/blog/loop','item-wide');
								endwhile;
							}else{
								// The Loop
								while ( have_posts() ) : the_post();
									get_template_part('templates/blog/loop','item');
								endwhile;
							}
						}else{
							get_template_part('templates/blog/loop','none');
						}
						?>
                        </div>
                        <?php
						if($listing_style!='ajax' && !is_post_type_archive('sp_member')){
							if(function_exists('wp_pagenavi')){
								wp_pagenavi();
							}else{
								leaf_content_nav('paging');
							}
						}
						?>
                    </div><!--/content-->
                    <?php if($layout != 'full'){get_sidebar();} ?>
                </div><!--/row-->
            </div><!--/content-pad-->
        </div><!--/container-->
    </div><!--/body-->
<?php get_footer(); ?>