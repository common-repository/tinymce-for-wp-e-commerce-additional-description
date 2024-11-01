<?php
/*
Plugin Name: TinyMCE for WPEC Additional Description
Plugin URI: http://wordpress.org/extend/plugins/tinymce-for-wpec-additional-description/
Description: Add TinyMCE to the Additional Description field of WPEC.
Version: 1.0
Author: Will Brikus
Author URI: http://www.LeaderWebsites.com/
Text Domain: tinymce-for-wpec-additional-description 

Copyright 2012 Will Brikus

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function tme_convert_excerpt_js()
{
	if ( ! tme_rich_editing() ) return;
?>
<script type="text/javascript">
	jQuery(document).ready( tme_convertExcerpt ); 
    function tme_convertExcerpt() {
		jQuery("#additional_description").addClass("mceEditor"); 
		if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
			if ( ! jQuery("#additional_description").length )
				jQuery("#additional_description").wrap( "<div id='excerpteditorcontainer'></div>" ); 
			tinyMCE.execCommand("mceAddControl", false, "additional_description");
		}
	}
</script>
<?php
}
function tme_admin_enqueue_js()
{
	if ( ! tme_rich_editing() ) return;
	wp_enqueue_script('jquery');
}
function tme_admin_css()
{
	if ( ! tme_rich_editing() ) return;
?>
<style type='text/css'>
	#postexcerpt .mceStatusbarResize { margin-right: 0; }
	#postexcerpt #excerpteditorcontainer { border-style: solid; padding: 0; }	
</style>
<?php
}
function tme_rich_editing()
{
	global $editing;
	return ( $editing && user_can_richedit() );
}
add_action('admin_xml_ns', 'tme_admin_enqueue_js');
add_filter('excerpt_save_pre', 'wpautop');
add_action('admin_head', 'tme_admin_css');
add_action('admin_head', 'tme_convert_excerpt_js');
?>