<?php

function tvg_add_custom_metabox() {

	add_meta_box(
		'tvg_meta',
		__( 'Liveticker' ),
		'tvg_meta_callback',
		'liveticker',
		'normal',
		'core'
	);

}

add_action( 'add_meta_boxes', 'tvg_add_custom_metabox' );

function tvg_meta_callback( $post ) {
	wp_nonce_field( basename( __FILE__ ), 'tvg_liveticker_nonce' );
	$tvg_stored_meta = get_post_meta( $post->ID ); ?>

	<div>
		<div class="meta-row">
			
			<div class="meta-th">
				<label for="heimmannschaft" class="dwwp-row-title"><?php _e( 'Heimmannschaft', 'tvg-liveticker' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" class="dwwp-row-content" name="heimmannschaft" id="heimmannschaft" value="<?php if ( ! empty ( $tvg_stored_meta['heimmannschaft'] ) ) echo esc_attr( $tvg_stored_meta['heimmannschaft'][0] ); ?>"/>
			</div>

			<div class="meta-th">
				<label for="gastmannschaft" class="dwwp-row-title"><?php _e( 'Gastmannschaft', 'tvg-liveticker' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" class="dwwp-row-content" name="gastmannschaft" id="gastmannschaft" value="<?php if ( ! empty ( $tvg_stored_meta['gastmannschaft'] ) ) echo esc_attr( $tvg_stored_meta['gastmannschaft'][0] ); ?>"/>
			</div>

			<div class="meta-th">
				<label for="heimTore" class="dwwp-row-title"><?php _e( 'Heimtore', 'tvg-liveticker' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" class="dwwp-row-content lt_spinner" name="heimTore" id="heimTore" value="<?php if ( ! empty ( $tvg_stored_meta['heimTore'] ) ) echo esc_attr( $tvg_stored_meta['heimTore'][0] ); ?>"/>
			</div>

			<div class="meta-th">
				<label for="gastTore" class="dwwp-row-title"><?php _e( 'Gasttore', 'tvg-liveticker' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" class="dwwp-row-content lt_spinner" name="gastTore" id="gastTore" value="<?php if ( ! empty ( $tvg_stored_meta['gastTore'] ) ) echo esc_attr( $tvg_stored_meta['gastTore'][0] ); ?>"/>
			</div>

			<div class="meta-th">
				<label for="heimToreHalbzeit" class="dwwp-row-title"><?php _e( 'Heimtore zur Halbzeit', 'tvg-liveticker' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" class="dwwp-row-content lt_spinner" name="heimToreHalbzeit" id="heimToreHalbzeit" value="<?php if ( ! empty ( $tvg_stored_meta['heimToreHalbzeit'] ) ) echo esc_attr( $tvg_stored_meta['heimToreHalbzeit'][0] ); ?>"/>
			</div>

			<div class="meta-th">
				<label for="gastToreHalbzeit" class="dwwp-row-title"><?php _e( 'Gasttore zur Halbzeit', 'tvg-liveticker' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" class="dwwp-row-content lt_spinner" name="gastToreHalbzeit" id="gastToreHalbzeit" value="<?php if ( ! empty ( $tvg_stored_meta['gastToreHalbzeit'] ) ) echo esc_attr( $tvg_stored_meta['gastToreHalbzeit'][0] ); ?>"/>
			</div>

			<div class="meta-th">
				<label for="date_time" class="dwwp-row-title"><?php _e( 'Datum & Uhrzeit', 'tvg-liveticker' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" class="dwwp-row-content datepicker" name="date_time" id="date_time" value="<?php if ( ! empty ( $tvg_stored_meta['date_time'] ) ) echo esc_attr( $tvg_stored_meta['date_time'][0] ); ?>"/>
			</div>

			<div class="meta-th">
				<label for="location" class="dwwp-row-title"><?php _e( 'Halle', 'tvg-liveticker' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" class="dwwp-row-content" name="location" id="location" value="<?php if ( ! empty ( $tvg_stored_meta['location'] ) ) echo esc_attr( $tvg_stored_meta['location'][0] ); ?>"/>
			</div>

			<div class="meta-th">
				<label for="referee" class="dwwp-row-title"><?php _e( 'Schiedsrichter', 'tvg-liveticker' ); ?></label>
			</div>
			<div class="meta-td">
				<input type="text" class="dwwp-row-content" name="referee" id="referee" value="<?php if ( ! empty ( $tvg_stored_meta['referee'] ) ) echo esc_attr( $tvg_stored_meta['referee'][0] ); ?>"/>
			</div>

		</div>
	</div>	
	<?php
}

function tvg_meta_save( $post_id ) {
	// Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'tvg_jobs_nonce' ] ) && wp_verify_nonce( $_POST[ 'tvg_jobs_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
    if ( isset( $_POST[ 'heimmannschaft' ] ) ) {
    	update_post_meta( $post_id, 'heimmannschaft', sanitize_text_field( $_POST[ 'heimmannschaft' ] ) );
    }
    if ( isset( $_POST[ 'gastmannschaft' ] ) ) {
    	update_post_meta( $post_id, 'gastmannschaft', sanitize_text_field( $_POST[ 'gastmannschaft' ] ) );
    }
    if ( isset( $_POST[ 'heimTore' ] ) ) {
    	update_post_meta( $post_id, 'heimTore', sanitize_text_field( $_POST[ 'heimTore' ] ) );
    }
    if ( isset( $_POST[ 'gastTore' ] ) ) {
    	update_post_meta( $post_id, 'gastTore', sanitize_text_field( $_POST[ 'gastTore' ] ) );
    }
    if ( isset( $_POST[ 'heimToreHalbzeit' ] ) ) {
    	update_post_meta( $post_id, 'heimToreHalbzeit', sanitize_text_field( $_POST[ 'heimToreHalbzeit' ] ) );
    }
    if ( isset( $_POST[ 'gastToreHalbzeit' ] ) ) {
    	update_post_meta( $post_id, 'gastToreHalbzeit', sanitize_text_field( $_POST[ 'gastToreHalbzeit' ] ) );
    }
    if ( isset( $_POST[ 'date_time' ] ) ) {
    	update_post_meta( $post_id, 'date_time', sanitize_text_field( $_POST[ 'date_time' ] ) );
    }
    if ( isset( $_POST[ 'location' ] ) ) {
    	update_post_meta( $post_id, 'location', sanitize_text_field( $_POST[ 'location' ] ) );
    }
    if ( isset( $_POST[ 'referee' ] ) ) {
    	update_post_meta( $post_id, 'referee', sanitize_text_field( $_POST[ 'referee' ] ) );
    }

}
add_action( 'save_post', 'tvg_meta_save' );






