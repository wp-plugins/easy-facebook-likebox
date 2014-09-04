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

<div class="wrap" id="dashboard-widgets">

<div id="postbox-container-1" class="postbox-container">
	<div id="normal-sortables" class="meta-box-sortables ui-sortable"><div id="dashboard_right_now" class="postbox ">
<div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span><?php echo esc_html( get_admin_page_title() ); ?></span></h3>
<div class="inside">
	<div class="main">
	 
	 <p>Thanks for installing the plugin.</p>
    
    <p>Here are steps and ways you can use this plugin.
    		<ol>
            	<li> Add the "Easy Facebook Likebox" widget in sidebar to show the like box in your website sidebar</li>
                <li> Add widget in sidebar and generate shortcode by saving the widgets optiosn to show likebox somewhere else on your website.</li>
                <li> You can also directly add below shortcode (without quotes) in post/page editor and change default values with your custom one according to your needs and requirments.
                "[efb_likebox fanpage_url="YOUR_FB_FANPAGE_NAME_OR_ID" fb_appid="" box_width="300" box_height="" colorscheme="light" show_faces="1" show_header="1" show_stream="0" show_border="1" ]"
                </li>
             </ol>
            </p>
     <p>I am working on the betterment and improvement of this plugin so stay tuned.</p> </div>
	</div>
</div>
 
</div>	</div>


<div id="postbox-container-1" class="postbox-container">
	<div id="normal-sortables" class="meta-box-sortables ui-sortable"><div id="dashboard_right_now" class="postbox ">
<div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span> Support us by liking our fan page!</span></h3>
<div class="inside">
	<div class="main">
	 
<div class="fb-like-box" data-href="https://www.facebook.com/jwebsol" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="true"></div>
     <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=517129121754984&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>       

 </div>
	</div>
</div>
 
</div>	</div>	 
    
   
     
    
 

</div>
<style type="text/css">
#dashboard_right_now li{
	width:100%;
}
.hndle{
	padding: 10px;
}
</style>