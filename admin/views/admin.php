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

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
    
    <p>Thanks for installing the plugin.</p>
    
    <p>Here are steps and ways you can use this plugin.
    		<ol>
            	<li> Add the "Easy Facebook Likebox" widget in sidebar to show the like box in your website sidebar</li>
                <li> Add widget in sidebar and generate shortcode by saving the widgets optiosn to show likebox somewhere else on your website.</li>
                <li> You can also directly add below shortcode (without quotes) in post/page editor and change default values with your custom one according to your needs and requirments.
                "[efb_likebox fanpage_url="Your_fb_fan_page_url_goes_here" fb_appid="" box_width="300" box_height="" colorscheme="light" show_faces="1" show_header="1" show_stream="0" show_border="1" ]"
                </li>
             </ol>
            </p>
     <p>I am working on the betterment and improvement of this plugin so stay tuned.</p> 
     
     Support us by liking us on facebook!
     
     <div class="fb-like-box" data-href="https://www.facebook.com/jwebsol" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>
     <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=517129121754984&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>       

	<!-- @TODO: Provide markup for your options page here. -->

</div>
