<?php

function tvg_register_post_type() {
    
    $name = 'Liveticker';
    
    $labels = array(
        'name'                  => $name,
        'singular_name'         => $name,
        'add_new'               => 'Erstellen',      
        'add_new_item'          => 'Neuen ' . $name . ' erstellen',
        'edit'                  => 'Bearbeiten',
        'edit_item'             => $name. ' bearbeiten',
        'new_item'              => 'Neuer ' . $name,
        'view'                  => 'View ' . $name,
        'view_item'             => 'View ' . $name,
        'search_term'           => 'Search' . $name,
        'parent'                => 'Parent ' . $name,
        'not_found'             => 'Keinen ' . $name . ' gefunden',
        'not_found_in_trash'    => 'No ' . $name . ' in Trash'
    );
    
    
    $args = array( 
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'exclude_from_search'   => false,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_admin_bar'     => true,
        'menu_position'         => 10,
        'menu_icon'             => 'dashicons-chart-line',
        'can_export'            => true,
        'delete_with_user'      => false,
        'hierarchical'          => false,
        'has_archive'           => true,
        'query_var'             => true,
        'capability_type'       => 'page',
        'map_meta_cap'          => true,
        'rewrite'               => array(
            'slug'       => 'liveticker',
            'with_front' => true,
            'pages'      => true,
            'feeds'      => false
        ),
        'supports'              => array(
            'title'
        )
    );
    
    register_post_type( 'liveticker', $args );
}
add_action( 'init', 'tvg_register_post_type');
