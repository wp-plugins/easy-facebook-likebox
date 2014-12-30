<?php
/**
 * Represents the view for the public-facing component of the plugin.
 *
 * This typically includes any information, if any, that is rendered to the
 * frontend of the theme when the plugin is activated.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */
 
$options = get_option( 'efbl_settings_display_options' );
/*echo "<pre>";
print_r($options);
exit;*/
$delay = ($options['efbl_popup_interval']) ? $options['efbl_popup_interval'] : 1000;
$width = ($options['efbl_popup_width']) ? $options['efbl_popup_width'] : 400;
$height = ($options['efbl_popup_height']) ? $options['efbl_popup_height'] : 300;
$shortcode = $options['efbl_popup_shortcode'];

if($options['efbl_enable_popup']){

?>
<div style="display:none">
<a class="popup-with-form efbl_popup_trigger" href="#efbl_popup" >Inline</a>
</div>
<!-- This file is used to markup the public facing aspect of the plugin. -->

<div style="width:400px;display: none;">
<div id="efbl_popup" class="white-popup" style="width:<?php echo $width?>px; height:<?php echo $height?>px">
		<?php 
		if(empty($shortcode)){
			echo __('Please enter easy facebook like box shortcode from settings > Easy Fcebook Likebox', 'easy-facebook-likebox');
		}else{
 			if( preg_match('/efb_likebox/i', $shortcode ) ){
				echo do_shortcode($shortcode);
			}else{
				echo __('Please enter easy facebook like box shortcode from settings > Easy Fcebook Likebox', 'easy-facebook-likebox');
			}
		}
		?>
 </div>       
	</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
								
	 $('.popup-with-form').magnificPopup({
          type: 'inline',
          preloader: false,
         });							
								
	/*$(".efbl").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: true,
		'scrolling'   : 'no',
		width		: '<?php echo $width?>px',
		height		: '<?php echo $height?>px',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none',
		padding     : 0,
	});*/
	
	openFancybox(<?php echo $delay?>);
	
});

function openFancybox(interval) {
    setTimeout( function() {jQuery('.efbl_popup_trigger').trigger('click'); },interval);
}
</script>
<?php }?>