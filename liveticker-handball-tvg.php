<?php
/**
 * Plugin Name: Handball Live Ticker
 * Plugin URI: http://alexander-haelbich.de
 * Description: This plugin allows you to add a simple handball liveticker to your website.
 * Author: Alexander Hälbich
 * Author URI: http://alexander-haelbich.de
 * Version: 0.0.1
 * License: GPLv2
 */

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once ( plugin_dir_path(__FILE__) . 'liveticker-cpt.php' );
require_once ( plugin_dir_path(__FILE__) . 'liveticker-fields.php' );
require_once ( plugin_dir_path(__FILE__) . 'liveticker-shortcode.php' );



function tvg_admin_enqueue_scripts() {
	global $pagenow, $typenow;

	if ( $typenow == 'liveticker') {

		wp_enqueue_style( 'tvg-admin-css', plugins_url( 'css/admin-liveticker.css', __FILE__ ) );

	}

	
	if ( ($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'liveticker' ) {
		
		wp_enqueue_script( 'tvg-job-js', plugins_url( 'js/admin-liveticker.js', __FILE__ ), array( 'jquery', 'jquery-ui-datepicker', 'jquery-ui-spinner' ), '06092016', true );
		wp_enqueue_style( 'jquery-style', 'https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css' );

	}
/*
	if ( $pagenow =='edit.php' && $typenow == 'job') {

		wp_enqueue_script( 'reorder-js', plugins_url( 'js/reorder.js', __FILE__ ), array( 'jquery', 'jquery-ui-sortable' ), '20150626', true );
		wp_localize_script( 'reorder-js', 'WP_JOB_LISTING', array(
			'security' => wp_create_nonce( 'wp-job-order' ),
			'success' => __( 'Jobs sort order has been saved.' ),
			'failure' => __( 'There was an error saving the sort order, or you do not have proper permissions.' )
		) );

	}
	*/

}
add_action( 'admin_enqueue_scripts', 'tvg_admin_enqueue_scripts' );

function tvg_enqueue_scripts() {
		wp_enqueue_style ('tvg-liveticker-css-frontend', plugins_url('css/tvg-liveticker.css', __FILE__));
}
add_action ('wp_enqueue_scripts', 'tvg_enqueue_scripts');


