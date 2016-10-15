<?php
  /*
function dwwp_list_job_by_location ($atts, $content = null) {

	if (!isset ( $atts['location'] )) {
		return '<p class="job-error">You must provide a location for this shortcode to work.</p>';
	}

	$atts = shortcode_atts( array(
			'title' 		=> 'Current Job Openings In',
			'count' 		=> 5,
			'location' 		=> '.-. .....',
			'pagination' 	=> false
		), $atts);

	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	$args = array(
            'post_type' 		=> 'job',
            'post_status'       => 'publish',
            'no_found_rows'     => $pagination,
            'posts_per_page'    => $atts[ 'count' ],
            'paged'			    => $paged,
            'tax_query' 		=> array(
                    array(
                            'taxonomy' => 'location',
                            'field'    => 'slug',
                            'terms'    => $atts[ 'location' ],
                    ),
            )
    );

	$jobs_by_location = new WP_Query ($args);

	if($jobs_by_location->have_posts() ) : 
		$location = str_replace( '-', ' ', $atts['location']);
		$display_by_location = '<div id="jobs-by-location"';
		$display_by_location .= '<h4>' . esc_html__( $atts[ 'title' ] ) . '&nbsp' . esc_html__( ucwords( $location ) ) . '</h4>';
		$display_by_location .= '<ul>';

		while( $jobs_by_location->have_posts() ) : $jobs_by_location->the_post();
			global $post;
			$deadline = get_post_meta(get_the_ID(), 'application_deadline', true);
			$title = get_the_title();
			$slug = get_permalink();

			$display_by_location .= '<li class="job-listing">';
            $display_by_location .= sprintf( '<a href="%s">%s</a>&nbsp&nbsp', esc_url( $slug ), esc_html__( $title ) );
            $display_by_location .= '<span>' . esc_html( $deadline ) . '</span>';
            $display_by_location .= '</li>';
		endwhile;

	$display_by_location .= '</ul>';
	$display_by_location .= '</div>';
	endif;
	wp_reset_postdata();

	return $display_by_location;

}

add_shortcode ( 'jobs_by_location', 'dwwp_list_job_by_location');
  */


function tvg_list_all_liveticker ($atts, $content = null) {

	$atts = shortcode_atts( array(
			'title' => 'Standard Titel',
		), $atts);

	
	$args = array (
		'post_type' => 'liveticker',
		'post_status' => 'publish'
	);

	$all_liveticker = new WP_Query($args);

	if($all_liveticker->have_posts() ) {

		$countTickers = 1;

		while ($all_liveticker->have_posts() ) : $all_liveticker->the_post();

			global $post;
			$heimmannschaft = get_post_meta(get_the_ID(), 'heimmannschaft', true);
			$gastmannschaft = get_post_meta(get_the_ID(), 'gastmannschaft', true);
			$heimTore = get_post_meta(get_the_ID(), 'heimTore', true);
			$gastTore = get_post_meta(get_the_ID(), 'gastTore', true);	
			$heimToreHalbzeit = get_post_meta(get_the_ID(), 'heimToreHalbzeit', true);
			$gastToreHalbzeit = get_post_meta(get_the_ID(), 'gastToreHalbzeit', true);
			$date_time = get_post_meta(get_the_ID(), 'date_time', true);
			$location = get_post_meta(get_the_ID(), 'location', true);
			$referee = get_post_meta(get_the_ID(), 'referee', true);

			$displaylist .= '<div class="liveticker collapseomatic" id="collapseme' . $countTickers .'">';
			$displaylist .= '<div class="vc_col-sm-4 wpb_column column_container _ height-full"><h2 class="heimmannschaft">' . esc_html($heimmannschaft) . '</h2></div>';
			$displaylist .= '<div class="vc_col-sm-4 wpb_column column_container _ height-full"><div class="score"><span class="heimScore">' . esc_html($heimTore) . '</span>:<span class="gastScore">' . esc_html($gastTore) . '</span></div>';
			$displaylist .= '<div class="halbzeitScore">(' . esc_html($heimToreHalbzeit) . ':' . esc_html($gastToreHalbzeit) . ')</div></div>';
			$displaylist .= '<div class="vc_col-sm-4 wpb_column column_container _ height-full"><h2 class="gastmannschaft">' . esc_html($gastmannschaft) . '</h2></div>';
			$displaylist .= '<div id="target-collapseme' . $countTickers . '" class="collapseomatic_content">';
			$displaylist .= '<div class="vc_col-sm-4 wpb_column column_container"><span class="date_time"> ' . esc_html($date_time) . '</span></div>'; // .date_time
			$displaylist .= '<div class="vc_col-sm-4 wpb_column column_container"><span class="location">' . esc_html($location) . '</span></div>'; // .location
			$displaylist .= '<div class="vc_col-sm-4 wpb_column column_container"><span class="referee">' . esc_html($referee) . '</span></div>'; // .referee
			$displaylist .= '</div>'; //.collapseomatic_content
			$displaylist .= '<div class="mk-divider center thin_solid"><div class="divider-inner"></div></div>';
			$displaylist .= '</div>'; //.liveticker

			$countTickers++;

		endwhile;
	} else {
		return 'Aktuell kein Liveticker vorhanden.';
	}

	wp_reset_postdata();

	return $displaylist;

}

add_shortcode('list_liveticker', 'tvg_list_all_liveticker');
?>
