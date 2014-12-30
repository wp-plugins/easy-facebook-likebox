<?php
/**
 * Represents the view for the administration of popup settings.
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
 
settings_fields( 'efbl_settings_display_options' );
do_settings_sections( 'efbl_settings_display_options' );

//settings_fields( 'sandbox_theme_display_options' );
//do_settings_sections( 'sandbox_theme_display_options' );
?>
<div class="button_container">
<?php 
submit_button();
?></div>
<h2 class="promotional_text">Want more control over PopUp? Try our premimum version! <a target="_blank" class="" href="http://jwebsol.com/product/easy-facebook-like-box-pro/" title="GoPro">Click here for pricing & details</a></h2>
