<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */
?>

 
        
        
<div class="wrap efbl" id="dashboard-widgets">
<a target="_blank" class="go_pro_ad" href="http://jwebsol.com/product/easy-facebook-like-box-pro/" title="GoPro">GoPro</a>
<h2>&nbsp;</h2>
<form method="post" action="<?php echo admin_url('options.php')?>">
 

   
    <div id="normal-sortables" class="meta-box-sortables ui-sortable">
    
    <?php do_meta_boxes($this->plugin_screen_hook_suffix, 'normal', $data); ?>
       
       
    </div>
 
 
  
  <div id="normal-sortables" class="meta-box-sortables ui-sortable">
  
   <?php do_meta_boxes($this->plugin_screen_hook_suffix, 'additional', $data); ?>
   </div>
   <div class="clearfix"></div>
   
   <div id="normal-sortables" class="meta-box-sortables ui-sortable">
    <?php do_meta_boxes($this->plugin_screen_hook_suffix, 'side', $data); ?>
        
    </div>
   
</form>  
</div>

<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready( function($) {
			// close postboxes that should be closed
			$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
			// postboxes setup
			postboxes.add_postbox_toggles('<?php echo $this->plugin_screen_hook_suffix; ?>');
		});
		//]]>
	</script>
    
<style type="text/css">
#dashboard_right_now li{
	width:100%;
}
.hndle{
	padding: 10px;
	margin:0px;
}
</style>
