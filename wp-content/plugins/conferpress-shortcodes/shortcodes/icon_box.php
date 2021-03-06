<?php
function parse_sc_iconbox($atts, $content=''){
	$icon = isset($atts['icon']) ? $atts['icon'] : '';
	$heading = isset($atts['heading']) ? $atts['heading'] : '';
	$layout = isset($atts['layout']) ? $atts['layout'] : 'left';
	$link = isset($atts['link']) ? $atts['link'] : '';
	$target = isset($atts['target']) ? $atts['target'] : '';
	
	$icon_color = isset($atts['icon_color']) ? $atts['icon_color'] : '';
	$icon_background_hover = isset($atts['icon_background_hover']) ? $atts['icon_background_hover'] : $icon_color;
	
	$animation_class = (isset($atts['css_animation']) && $atts['css_animation'])?'wpb_'.$atts['css_animation'].' wpb_animate_when_almost_visible':'';
	$animation_delay = isset($atts['animation_delay']) ? $atts['animation_delay'] : 0;
	global $textbox_ID;
	if(!$textbox_ID){
		$textbox_ID = 1;
	}else{
		$textbox_ID++;
	}
	
	//display
	ob_start(); ?>
    	<?php if($link!=''){?>
        <a href="<?php echo esc_url($link);?>" <?php if($target){?> target="_blank"<?php } ?>>
        <?php }?>
    	<div id="leaf-icon-box-<?php echo $textbox_ID ?>" class="media leaf-icon-box <?php echo ' '.$animation_class; ?>" data-delay=<?php echo $animation_delay; ?>>
            <div class="<?php echo $layout=='right'?'pull-right':($layout=='center'?'text-center':'pull-left') ?>">
            	<?php if($icon){ ?>
                <div class="ia-icon">
                	<i class="fa <?php echo $icon; ?>"></i>
                </div>
                <?php } ?>
            </div>
            <div class="media-body <?php echo $layout=='right'?'text-right':($layout=='center'?'text-center':'') ?>">
                <?php
				echo $heading?'<h4 class="media-heading">'.$heading.'</h4>':'';
				echo $content?'<p>'.$content.'</p>':''
				?>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php if($link!=''){?>
        </a>
        <?php }?>
	<?php
	if($icon_color || $icon_background_hover){ ?>
		<style scoped>
        <?php
        if($icon_color){ echo '#leaf-icon-box-'.$textbox_ID.' .ia-icon{ color: '.$icon_color.'; border-color: '.$icon_color.'}'; }
        if($icon_background_hover){
			 echo '#leaf-icon-box-'.$textbox_ID.' .ia-icon:hover, #leaf-icon-box-'.$textbox_ID.':hover .ia-icon{ background: '.$icon_background_hover.'; border-color: '.$icon_background_hover.'; color:#fff; box-shadow: 0 0 25px -3px '.$icon_background_hover.';}'; 
		}
        ?>
        </style>
    <?php }
	
	//return
	$output_string=ob_get_contents();
	ob_end_clean();
	return $output_string;
}
add_shortcode( 'sc_iconbox', 'parse_sc_iconbox' );

add_action( 'after_setup_theme', 'reg_sc_iconbox' );
function reg_sc_iconbox(){
	if(function_exists('vc_map')){
	vc_map( array(
	   "name" => __("Icon Boxes"),
	   "base" => "sc_iconbox",
	   "class" => "",
	   "icon" => "textbox-icon",
	   "controls" => "full",
	   "category" => __('Content'),
	   "params" => array(
	      array(
			"type" => "textfield",
			"heading" => __("Icon", "leafcolor"),
			"param_name" => "icon",
			"value" => "",
			"description" => __("FontAwesome 4.0+ icon name. For example: fa-star."),
		  ),
		  array(
			"type" => "textfield",
			"heading" => __("Heading", "leafcolor"),
			"param_name" => "heading",
			"value" => "",
			"description" => __("Heading text"),
		  ),
		  array(
			"type" => "textfield",
			"heading" => __("Link", "leafcolor"),
			"param_name" => "link",
			"value" => "",
			"description" => __(""),
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => esc_html__("Open in new tab?", "leafcolor"),
			 "param_name" => "target",
			 "value" => array(
			 	esc_html__('No', 'conferencepro') => '',
				esc_html__('Yes', 'conferencepro') => '1',
			 ),
			 "description" => "",
		  ),
		  array(
			"type" => "textarea",
			"heading" => __("Content text", "leafcolor"),
			"param_name" => "content",
			"value" => "",
			"description" => __("Content text"),
		  ),
		  array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Layout", 'conferencepro'),
			 "param_name" => "layout",
			 "value" => array(
			 	__('Left', 'conferencepro') => 'left',
				__('Right', 'conferencepro') => 'right',
				__('Center', 'conferencepro') => 'center',
			 ),
			 "description" => 'Choose icon layout'
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon Color", 'conferencepro'),
			 "param_name" => "icon_color",
			 "value" => '',
			 "description" => 'Choose Icon and Border Color (Optional)',
		  ),
		  array(
			 "type" => "colorpicker",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Icon Background Hover", 'conferencepro'),
			 "param_name" => "icon_background_hover",
			 "value" => '',
			 "description" => 'Choose Icon Background when hovered (Optional)',
		  ),
	   )
	));
	}
}