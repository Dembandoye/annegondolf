<?php
$page_content = ot_get_option('page404_content',__('Page not found','conferpress'));
$layout = 'full';
get_header();
?>
	<?php if(!is_page_template('page-templates/front-page.php')){
		get_template_part( 'templates/header/header', 'heading' );
	}?>
    <div id="body">
    	<div class="container">
        	<?php if(!is_page_template('page-templates/front-page.php')){ ?>
        	<div class="content-pad-4x">
			<?php } ?>
            	<?php if(is_active_sidebar('top_sidebar')){
                        dynamic_sidebar( 'top_sidebar' );
				} ?>
                <div class="row">
                    <div id="content" class="col-md-4 col-md-offset-4" role="main">
                        <article class="single-page-content text-center">
                        	<span class="main-color-1-border banner-404">
                            	<span class="main-color-1 font-2">4<i class="lnr lnr-neutral"></i>4</span>
                            </span>
                            <br />
                        	<div class="content-text-404"><?php echo apply_filters('the_content', $page_content); ?></div>
                            <br />
                            <?php
							if(ot_get_option('page404_search','on')!='off'){
								if ( is_active_sidebar( 'search_sidebar' ) ) : ?>
									<?php dynamic_sidebar( 'search_sidebar' ); ?>
								<?php else: ?>
									<form class="form-404 search-form" action="<?php echo esc_url(home_url('/')) ?>">
										<input type="text" name="s" class="form-control" placeholder="<?php echo esc_attr(__('Try a search...','conferpress'));?>">
									</form>
								<?php endif;
							}?>
                        </article>
                    </div><!--/content-->
                </div><!--/row-->
            <?php if(!is_page_template('page-templates/front-page.php')){ ?>
            </div><!--/content-pad-4x-->
			<?php }?>
        </div><!--/container-->
    </div><!--/body-->
<?php get_footer(); ?>