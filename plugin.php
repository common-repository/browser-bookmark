<?php
/*
Plugin Name: Browser Bookmark
Plugin URI: http://mr.hokya.com/browser-bookmark/
Description: Allow the visitor to REAL bookmark your page via Firefox, Internet Explorer, or other browsers by clicking the button on widgets
Version: 1.11
Author: Julian Widya Perdana
Author URI: http://mr.hokya.com/
*/

if(!get_option("browmark_time")) update_option("browmark_time",10);

function browmark_foot () {
	$home = get_option("home");
	echo "<!-- start script for Browser Bookmark plugin -->\n";
	echo "<script src='$home/wp-content/plugins/browser-bookmark/bookmark.js'></script>\n";
	echo "<noscript>Browser Bookmark powered by <a href='http://mr.hokya.com/browser-bookmark/' target='_blank'>Mr Hokya Dot Com</a></noscript>\n";
	echo "<!-- end script for Browser Bookmark plugin -->\n";
}

function browmark_widget($args) {
	extract($args);
	$title = get_option("browmark_title");
	$color = get_option("browmark_color");
	$bg = get_option("browmark_bg");
	$txt = get_option("browmark_txt");
	echo $before_widget.$before_title.$title.$after_title;
	echo "<input type='button' style='color:#$color;background-color:#$bg;padding:5px;border:none;-moz-border-radius:5px;' value='$txt' onclick='browser_bookmark()'/>";
	echo $after_widget;
}

function browmark_control() {
	if ($_POST["browmark_submit"]) {
		update_option("browmark_title",$_POST["title"]);
		update_option("browmark_txt",$_POST["txt"]);
		update_option("browmark_bg",$_POST["bg"]);
		update_option("browmark_color",$_POST["color"]);
	}
	$title = get_option("browmark_title");
	$txt = get_option("browmark_txt");
	$bg = get_option("browmark_bg");
	$color = get_option("browmark_color");
	
	echo "<input type='hidden' name='browmark_submit' value=1/>";
	echo "<p>Title:<input name='title' value='$title'/></p>";
	echo "<p>Caption of the button :<input name='txt' value='$txt'/></p>";
	echo "<p>Background of the button :<input name='bg' value='$bg'/></p>";
	echo "<p>Color of the text :<input name='color' value='$color'/></p>";
	echo "<p><small>for more information please visit <a href='http://mr.hokya.com/browser-bookmark/' target='_blank'>documentation</a></small></p>";
}

function browmark_register () {
	register_sidebar_widget("Browser Bookmark","browmark_widget");
	register_widget_control("Browser Bookmark","browmark_control");
}

add_action('plugins_loaded','browmark_register');
add_action('get_footer','browmark_foot');

?>