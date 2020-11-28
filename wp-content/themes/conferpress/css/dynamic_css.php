<?php
/*Dynamic CSS*/
if(leaf_get_option('retina_logo')){?>
	@media only screen and (-webkit-min-device-pixel-ratio: 2),(min-resolution: 192dpi) {
		/* Retina Logo */
		.logo{background:url(<?php echo esc_url(leaf_get_option('retina_logo')); ?>) no-repeat center; display:inline-block !important; background-size:contain;}
		.logo img{ opacity:0; visibility:hidden}
		.logo *{display:inline-block}
		.affix .logo.sticky{ background:transparent !important; display:block !important}
		.affix .logo.sticky img{ opacity:1; visibility: visible;}
	}
<?php }

if(leaf_get_option('sticky_logo_image') != '' && leaf_get_option('nav_sticky','on')=='on'):?>
    .navbar-header .logo.sticky{ display:none !important;}
    #main-nav.affix .navbar-header .logo{ display:none !important;}
    #main-nav.affix .navbar-header .logo.sticky{ display:inline-block !important;}
    #main-nav.affix .style-off-canvas .navbar-header .logo.sticky{ display:block !important; }
<?php endif; ?>

#pageloader{
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    z-index:99999;
    background:<?php echo esc_attr(leaf_get_option('loading_bg','#111')) ?>;
}

<?php
if(!function_exists('leaf_hex2rgba')){
function leaf_hex2rgba($hex,$opacity) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $opacity = $opacity/100;
   $rgba = array($r, $g, $b, $opacity);
   return implode(",", $rgba);
}
}

//fonts
if($custom_font_1 = leaf_get_option( 'custom_font_1')){ ?>
	@font-face
    {
    	font-family: 'custom-font-1';
    	src: url('<?php echo esc_url($custom_font_1) ?>');
    }
<?php }
if($custom_font_2 = leaf_get_option( 'custom_font_2')){ ?>
	@font-face
    {
    	font-family: 'custom-font-2';
    	src: url('<?php echo esc_url($custom_font_2) ?>');
    }
<?php }
$main_font = leaf_get_option( 'main_font', false);
$main_font_family = explode(":", $main_font);
$main_font_family = $main_font_family[0];
$heading_font = leaf_get_option( 'heading_font', false);
$heading_font_family = explode(":", $heading_font);
$heading_font_family = $heading_font_family[0];
$heading_font_style = leaf_get_option( 'heading_font_style', false);

if($main_font){?>
    body{
        font-family: '<?php echo esc_attr($main_font_family) ?>';
    }
<?php }
if($main_size = leaf_get_option( 'main_size' )){ ?>
	body {
        font-size: <?php echo esc_attr($main_size) ?>px;
    }
<?php }
if($heading_font || $heading_font_style){?>
    h1, .h1, .font-2, .media-heading, h2, .h2,
    button, input[type=button], input[type=submit], .btn,
    #main-nav, header .dropdown-menu, .mobile-menu > li > a,
    .item-content .item-title, .widget-title, .widget_recent_comments ul#recentcomments li .comment-author-link,
    h4.wpb_toggle, .wpb_accordion .wpb_accordion_wrapper h3.wpb_accordion_header,
    .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button,
    .woocommerce #reviews h3, .woocommerce ul.products li.product h3,
    .woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce ul.products li.product h3,
    .woocommerce #reviews h2,
    #tribe-events .tribe-events-button, .tribe-events-button, .heading-event-meta-content .tribe-events-cost a, .heading-event-meta-content a.tribe-events-gmap,
    .tribe-events-meta-group .tribe-events-single-section-title, #tribe-bar-form label,
    table.tribe-events-calendar > thead > tr > th, .tribe-events-calendar div[id*=tribe-events-daynum-], .tribe-events-calendar div[id*=tribe-events-daynum-] a, #tribe-events-content .tribe-events-tooltip h4, #tribe-events-content .tribe-events-tooltip .entry-title, .tribe-mobile-day-heading, #tribe-mobile-container .type-tribe_events h4, .tribe-events-list-widget ol li .tribe-event-title, .tribe-events-sub-nav li a,
    h3.tribe-events-related-events-title, h2.tribe-attendees-list-title,
    .tribe-events-single ul.tribe-related-events .tribe-related-events-title,
    .tribe-events-list-separator-month span, .tribe-events-day .tribe-events-day-time-slot h5,
    .tribe-events-day .tribe-events-day-time-slot .tribe-events-day-time-slot-heading
    {
        font-family: "<?php echo esc_attr($heading_font_family) ?>";
        font-style: <?php echo esc_attr($heading_font_style) ?>;
    }
<?php }


//color
$main_color_1 = leaf_get_option('main_color_1');
if($main_color_1){ ?>
    .main-color-1, .main-color-1-hover:hover, .dark-div .main-color-1, a:hover, a:focus,
    .main-color-2, .main-color-2-hover:hover,
    button, input[type=button], .btn, .btn .btn-icon, .dark-div .btn,
    #main-nav .navbar-nav>.current-menu-item>a, #main-nav .navbar-nav>.current-menu-item>a:focus, #main-nav .navbar-nav .current-menu-item>a,
    header .dropdown-menu>li>a:hover, header .dropdown-menu>li>a:focus,
    #main-nav.light-nav .dropdown-menu>li>a:hover, #main-nav.light-nav .dropdown-menu>li>a:focus,
    .ia-icon, .light .ia-icon,
    .item-meta a:not(.btn):hover,
    .widget_nav_menu ul li ul li:before, .normal-sidebar .widget_nav_menu ul li ul li:before,
    .single-post-navigation-item a:hover h4, .single-post-navigation-item a:hover i,
    .leaf-member:hover .leaf-member-info .h3,
    .woocommerce div.product p.price, .woocommerce div.product span.price,
    .woocommerce ul.products li.product h3:hover, .woocommerce ul.products li.product .price,
    .heading-event-meta-content .tribe-events-cost a,
    .heading-event-meta-content a.tribe-events-gmap,
    .tribe-events-list-widget ol li:before, .tribe-events-list-widget ol li:after,
    .sc-single-event-meta form.cart .tribe-events-tickets button.button:before, table.tribe-events-tickets .add-to-cart .tribe-button:before,
    .sc-single-event-meta form.cart .tribe-events-tickets button.button:hover, table.tribe-events-tickets .add-to-cart .tribe-button:hover,
    .tribe-events-meta-group-details .tribe-events-single-section-title:before, .tribe-events-meta-group-organizer .tribe-events-single-section-title:before, .tribe-events-meta-group-venue .tribe-events-single-section-title:before,
    .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-], .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]>a,
    div.bbp-template-notice a.bbp-author-name, #bbpress-forums .bbp-body li.bbp-forum-freshness .bbp-author-name, #bbpress-forums .type-forum p.bbp-topic-meta span a,
    li.bbp-topic-title .bbp-topic-permalink:hover, #bbpress-forums li.bbp-body ul.topic .bbp-topic-title:hover a, #bbpress-forums li.bbp-body ul.forum .bbp-forum-info:hover .bbp-forum-title,
    #bbpress-forums li.bbp-body ul.topic .bbp-topic-title:hover:before, #bbpress-forums li.bbp-body ul.forum .bbp-forum-info:hover:before, #bbpress-forums .bbp-body li.bbp-topic-freshness .bbp-author-name, .bbp-topic-meta .bbp-topic-started-by a, #bbpress-forums div.bbp-reply-author .bbp-author-role, #bbpress-forums #bbp-user-wrapper h2.entry-title
    {
        color:<?php echo esc_attr($main_color_1) ?>;
    }
    .btn-primary .btn-icon { color: #fff; } /*fix*/
    
    .ia-icon, .light .ia-icon,
    .ia-icon:hover, .leaf-icon-box:hover .ia-icon,
    .main-color-1-border,
    body.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading,
    #tribe-bar-form input[type=text]:focus
    {
        border-color:<?php echo esc_attr($main_color_1) ?>;
    }
    
    .datepicker-dropdown:before,.datepicker-dropdown:after{
        border-bottom-color: <?php echo esc_attr($main_color_1) ?>;
    }
    .tribe-grid-allday .tribe-event-featured.tribe-events-week-allday-single,
    .tribe-grid-allday .tribe-event-featured.tribe-events-week-hourly-single,
    .tribe-grid-body .tribe-event-featured.tribe-events-week-allday-single,
    .tribe-grid-body .tribe-event-featured.tribe-events-week-hourly-single {
        background-color: <?php echo esc_attr($main_color_1) ?>;
        background-color: rgba(<?php echo leaf_hex2rgba($main_color_1,75); ?>);
        border-color: <?php echo esc_attr($main_color_1) ?>;
    }
    
    .nav-layout-boxed #top-nav .navbar,
    .features-control-item:after,
    .main-color-1-bg, .main-color-1-bg-hover:hover,.main-color-2-bg,
    .thumbnail-hoverlay-icon, .post-nav-item:hover:after,
    table:not(.shop_table):not(.tribe-events-calendar):not([class*='tribe-community-event'])>thead,
    table:not(.shop_table):not(.tribe-events-calendar):not([class*='tribe-community-event'])>tbody>tr:hover>td, table:not(.shop_table):not(.tribe-events-calendar):not([class*='tribe-community-event'])>tbody>tr:hover>th,
    .navbar-inverse .navbar-nav>li:after, .navbar-inverse .navbar-nav>li:focus:after,
    header .dropdown-menu>li>a:hover:before, header .dropdown-menu>li>a:focus:before,
    #bottom-nav .social-list .social-icon:hover,
    .single-post-meta:before,
    .leaf-timeline .timeline-item-inner:after,
    .leaf-banner-content:before,
    .ia-icon:hover, .leaf-icon-box:hover .ia-icon, .features-control-item:after,
    .owl-theme .owl-controls .owl-page.active span, .owl-theme .owl-controls.clickable .owl-page:hover span,
    .ia-heading h2:before, .widget-title:before,
    body.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active>a,
    body.wpb-js-composer .vc_tta-color-grey.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading,
    body .vc_toggle_size_md.vc_toggle_default:hover .vc_toggle_title, body .vc_toggle_size_md.vc_toggle_default.vc_toggle_active .vc_toggle_title,
    .woocommerce div.product .products > h2:before,
    .woocommerce span.onsale, .woocommerce ul.products li.product .onsale,
    .woocommerce ul.products li.product.product-category h3:hover,
    .woocommerce-cart .shop_table.cart thead tr,
    .cross-sells > h2:before, .cart_totals h2:before, .woocommerce-shipping-fields h3:before, .woocommerce-billing-fields h3:before,
    .woocommerce-cart #content table.cart .coupon input.button:hover, .woocommerce-cart #content table.cart input[name="update_cart"]:hover,
    .woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range,
    .woocommerce-error:before, .woocommerce-info:before, .woocommerce-message:before,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range,
    .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
    .loader-2 i,
    .event-item-thumbnail:hover,
    .heading-event-meta-title:before, .tribe-mobile-day-heading:before,
    #tribe-events .sc-single-event-add-to-cart .single_add_to_cart_button, .sc-single-event-add-to-cart .single_add_to_cart_button,
    .sc-single-event-meta form.cart .tribe-events-tickets button.button, table.tribe-events-tickets .add-to-cart .tribe-button,
    .sc-single-event-add-to-cart .quantity .minus:hover, .sc-single-event-add-to-cart .quantity .plus:hover,
    .tribe-events-notices:before,
    #tribe-bar-form .tribe-bar-submit input[type=submit], .tribe-bar-views-inner, #tribe-bar-views:before, #tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a, #tribe-bar-views-toggle, #tribe-bar-views-toggle:hover, #tribe-bar-views-toggle:focus,
    #tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a:hover, #tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option.tribe-bar-active a:hover,
    table.tribe-events-calendar > thead > tr > th, #tribe-events-content .tribe-events-tooltip h4, #tribe-events-content .tribe-events-tooltip .entry-title,
    .tribe-events-list-separator-month span:before, .tribe-events-day .tribe-events-day-time-slot h5:before,
    .tribe-events-day .tribe-events-day-time-slot .tribe-events-day-time-slot-heading:before,
    .tribe-events-list-widget .widget-title, .tribe-events-adv-list-widget .widget-title,
    .tribe-events-grid .tribe-grid-header .tribe-week-today,
    .tribe-grid-allday .tribe-event-featured.tribe-events-week-allday-single:hover,
    .tribe-grid-allday .tribe-event-featured.tribe-events-week-hourly-single:hover,
    .tribe-grid-body .tribe-event-featured.tribe-events-week-allday-single:hover,
    .tribe-grid-body .tribe-event-featured.tribe-events-week-hourly-single:hover,
    .datepicker table tr td span.active.active,
    .compare-table-price:before, .price-has-bg.compare-table-price:after,
    #bbpress-forums li.bbp-header, #bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current,
    .wp-block-separator:not(.is-style-dots):before, .wp-block-button__link
    {
        background-color:<?php echo esc_attr($main_color_1) ?>;
    }

    .btn-primary, input[type=submit], .dark-div .btn-primary,
    #main-nav .navbar-nav>li.button>a,
    #tribe-events .tribe-events-button, .tribe-events-button,
    .sc-single-event-meta form.cart .tribe-events-tickets button.button:hover,
    table.tribe-events-tickets .add-to-cart .tribe-button:hover,
    .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt{
        background-color:<?php echo esc_attr($main_color_1) ?>;
        color:#fff;
    }
    button:hover, input[type=button]:hover, .btn:hover, .btn:focus, .btn:active, .btn.active, .open .dropdown-toggle.btn-default, #main-nav .navbar-nav>li.button>a:hover,
    input[type=submit]:hover, .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary,
    .ia-icon:hover, .leaf-icon-box:hover .ia-icon,
    .woocommerce ul.products li.product .button:hover,
    .default-nav-item a:hover,
    .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce #content input.button.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page #content input.button.alt:hover, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce-page #review_form #respond .form-submit input:hover, .woocommerce-message .button:hover,
    #tribe-events .sc-single-event-add-to-cart .single_add_to_cart_button:hover, .sc-single-event-add-to-cart .single_add_to_cart_button:hover,
    #tribe-events .tribe-events-button:hover, .tribe-events-button.tribe-active:hover, .tribe-events-button:hover,
    #tribe-bar-form .tribe-bar-submit input[type=submit]:hover{
        background-color:<?php echo esc_attr($main_color_1) ?>;
        color:#fff;
        box-shadow: 0 0 25px -3px <?php echo esc_attr($main_color_1) ?>;
    }

    .item-thumbnail:hover,
    .leaf-timeline .timeline-item:hover .timeline-item-inner:after,
    .post-nav-item:hover {
        box-shadow: 0 0 25px -3px <?php echo esc_attr($main_color_1) ?>;
    }

    .woocommerce .widget_price_filter .ui-slider .ui-slider-handle:hover {
        box-shadow: 0 0 15px 0 <?php echo esc_attr($main_color_1) ?>;
    }

    .leaf-timeline .timeline-item:hover .timeline-box-content-inner {
        background: rgba(<?php echo leaf_hex2rgba($main_color_1,85); ?>);
        box-shadow: 0 0 25px -3px <?php echo esc_attr($main_color_1) ?>;
    }

    .sc-single-event-add-to-cart .single_add_to_cart_button:hover{
        color:<?php echo esc_attr($main_color_1) ?>;
        background:#000;
    }
    .btn-lighter {
        color: #999;
    }
    .tribe_community_edit .tribe-button.submit, .tribe_community_list .tribe-button.submit,
    .tribe_community_edit .button-primary,
    .tribe_community_edit .tribe-button.tribe-button-primary,
    .tribe_community_list .button-primary,
    .tribe_community_list .tribe-button.tribe-button-primary {
        background: <?php echo esc_attr($main_color_1) ?> !important;
    }

    .social-share-hover .btn:hover{
        box-shadow: 0 0 20px -4px <?php echo esc_attr($main_color_1) ?>;
    }

<?php
}//main color 1

if($nav_bg = leaf_get_option('nav_bg')){
$nav_bg = leaf_hex2rgba($nav_bg,leaf_get_option('nav_opacity',100));
?>
    #main-nav .navbar, .nav-layout-boxed #main-nav .navbar, #main-nav.light-nav .navbar {
    	background: rgba(<?php echo esc_attr($nav_bg); ?>);
    }
<?php
}

if($top_nav_bg = leaf_get_option('top_nav_bg')){
$top_nav_bg = leaf_hex2rgba($top_nav_bg,leaf_get_option('top_nav_opacity',100));
?>
    #top-nav .navbar, .nav-layout-boxed #top-nav .navbar {
        background: rgba(<?php echo esc_attr($top_nav_bg); ?>);
    }
<?php
}

//footer_bg
if($footer_bg = leaf_get_option('footer_bg','#151515')){ ?>
    footer.main-color-2-bg, .main-color-2-bg.back-to-top{
        background-color:<?php echo esc_attr($footer_bg) ?>;
    }
<?php
}//footer_bg

/* Heading Background */
$ct_hd = get_post_meta(get_the_ID(),'header_content',true);
if(function_exists('is_shop') && is_shop()){
    $ct_hd ='';
    $id_ot = get_option('woocommerce_shop_page_id');
    if($id_ot!=''){
        $ct_hd = get_post_meta($id_ot,'header_content',true);
    }
}
if( is_home()){
    $ct_hd ='';
    $id_ot = get_option('page_for_posts');
    if($id_ot!=''){
        $ct_hd = get_post_meta($id_ot,'header_content',true);
    }
}
if(!is_page_template('page-templates/front-page.php') && $ct_hd==''){
$heading_bg = leaf_get_option('heading_bg');
if($heading_bg){ ?>
.page-heading{
    <?php if($heading_bg['background-image']){ ?>background-image:url(<?php echo esc_url($heading_bg['background-image']) ?>);<?php } ?>
    <?php if($heading_bg['background-color']){ ?>background-color:<?php echo esc_attr($heading_bg['background-color']) ?>;<?php } ?>
    <?php if($heading_bg['background-position']){ ?>background-position:<?php echo esc_attr($heading_bg['background-position']) ?>;<?php } ?>
    <?php if($heading_bg['background-repeat']){ ?>background-repeat:<?php echo esc_attr($heading_bg['background-repeat']) ?>;<?php } ?>
    <?php if($heading_bg['background-size']){ ?>background-size:<?php echo esc_attr($heading_bg['background-size']) ?>;<?php } ?>
    <?php if($heading_bg['background-attachment']){ ?>background-attachment:<?php echo esc_attr($heading_bg['background-attachment']) ?>;<?php } ?>
}
<?php }} //if heading_bg


if($loading_spin_color = leaf_get_option( 'loading_spin_color', false)){ ?>
.loader-2 i {
	background:<?php echo esc_attr($loading_spin_color); ?>
}
<?php }

//white label event
if(is_singular('tribe_events') && get_post_meta(get_the_ID(),'white-label',true) == 'on'){ ?>
#wrap > header,
footer.main-color-2-bg,
#sidebar,
.single-tribe_events .tribe-events-back,.sc-single-event-nav,
#tribe-events-content h1.h2, .single-tribe_events .tribe-events-schedule{
	display:none;
    opacity:0;
}
#content{
	width:100%;
}
.event-heading {
    padding-top: 200px;
    padding-bottom: 200px;
}
<?php } 

//custom CSS
echo wp_kses_post(leaf_get_option('custom_css',''));