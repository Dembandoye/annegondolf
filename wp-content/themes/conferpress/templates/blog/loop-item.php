<div <?php post_class('blog-item '.(has_post_thumbnail()?'':' no-thumbnail')) ?>>
    <div class="post-item blog-post-item row">
    	<?php if(has_post_thumbnail()){ ?>
        <div class="col-md-6 col-sm-12">
            <div class="content-pad">
                <div class="blog-thumbnail">
                    <?php get_template_part('templates/blog/loop','item-thumbnail'); ?>
                </div><!--/blog-thumbnail-->
            </div>
        </div>
        <?php } ?>
        <div class="<?php echo has_post_thumbnail()?'col-md-6':'col-md-12' ?> col-sm-12">
            <div class="content-pad">
                <div class="item-content">
                    <h3 class="item-title font-2"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="main-color-1-hover"><?php the_title(); ?></a></h3>
                    <div class="item-excerpt blog-item-excerpt"><?php the_excerpt(); ?></div>
                    <div class="item-meta blog-item-meta">
                        <span><i class="lnr lnr-user"></i> <?php the_author_posts_link(); ?> &nbsp;&nbsp;</span>
                        <span><i class="lnr lnr-bookmark"></i> <?php the_category(' <span class="dot">.</span> '); ?></span>
                    </div>
                    <a class="btn btn-lighter" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e('DETAIL','conferpress') ?> <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div><!--/post-item-->
</div><!--/blog-item-->