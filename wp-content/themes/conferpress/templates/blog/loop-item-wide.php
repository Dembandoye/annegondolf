<div <?php post_class('blog-item blog-item-wide '.(has_post_thumbnail()?'':' no-thumbnail')) ?>>
    <div class="post-item blog-post-item row">
    	<?php if(has_post_thumbnail()){ ?>
        <div class="col-md-12">
            <div class="content-pad-0">
                <div class="blog-thumbnail">
                    <?php get_template_part('templates/blog/loop','item-thumbnail'); ?>
                </div><!--/blog-thumbnail-->
            </div>
        </div>
        <?php } ?>
        <div class="col-md-12">
            <div class="content-pad-0">
                <div class="item-content">
                    <h3 class="item-title font-2 h2"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="main-color-1-hover"><?php the_title(); ?></a></h3>
                    <div class="item-excerpt blog-item-excerpt"><?php the_excerpt(); ?></div>
                    <div class="item-meta blog-item-meta">
                        <?php if (is_sticky()) { ?>
                            <span><i class="lnr lnr-pushpin"></i> <?php esc_html_e('Sticky','conferpress') ?> &nbsp;&nbsp;</span>
                        <?php } ?>
                        <span><i class="lnr lnr-user"></i> <?php the_author_posts_link(); ?> &nbsp;&nbsp;</span>
                        <span><i class="lnr lnr-bookmark"></i> <?php the_category(' <span class="dot">.</span> '); ?></span>
                    </div>
                    <a class="btn btn-lighter" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php _e('DETAIL','conferpress') ?> <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div><!--/post-item-->
</div><!--/blog-item-->