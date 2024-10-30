<?php
// Silence is golden.
/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param  string $string
 * @return string
 */
function classyea_addon_kses_basic( $string = '' ) {
    return wp_kses( $string, classyea_get_allowed_html_tags( 'basic' ) );
}

function classyea_get_custom_posts() {
    $options = array();

    $args = array(
        'post_type'   => array( 'any' ),
        'post_status' => 'publish',
        'posts_per_page' => 15,
    );

    $args = new \WP_Query( $args );

    // The Loop
    if ( $args->have_posts() ) {

        while ( $args->have_posts() ) {
            $args->the_post();
            $options[ 'title' ] = get_the_title();
            $options[ 'id' ]    = get_the_ID();
        }
    }
    return $options;
    wp_reset_postdata();
}

 function classyea_singular_post_list() {
    $query_args = array(
        'post_status'    => 'publish',
        'posts_per_page' => 15,
        'post_type'      => 'any',
    );


    $query   = new \WP_Query( $query_args );
    $options = array();
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) {
            $query->the_post();
            $options[] = array(
                'id'   => get_the_ID(),
                'title' => get_the_title(),
            );
        }
    endif;

    return $options;
    wp_reset_postdata();
}


/**
 * Strip all the tags except allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param  string $string
 * @return string
 */
function classyea_addon_kses_tag( $string = '' ) {
    return wp_kses( $string, classyea_get_allowed_html_tags( 'classyea_desc_kses' ) );
}

add_filter( 'wpcf7_autop_or_not', '__return_false' );
/**
 * Strip all the  allowed html tags
 *
 * The name is based on inline editing toolbar name
 *
 * @param  string $level
 * @return string
 */
function classyea_get_allowed_html_tags( $level = 'basic' ) {
    $allowed_html = array(
        'b'      => array(),
        'i'      => array(),
        'u'      => array(),
        'em'     => array(),
        'br'     => array(),
        'abbr'   => array(
            'title' => array(),
        ),
        'span'   => array(
            'class' => array(),
        ),
        'strong' => array(),
    );

    if ( $level === 'intermediate' ) {
        $allowed_html['a'] = array(
            'href'  => array(),
            'title' => array(),
            'class' => array(),
            'id'    => array(),
        );
    }

    return $allowed_html;
}

if ( !function_exists( 'classyea_get_elementor_library' ) ) {
    function classyea_get_elementor_library() {
        $pageslist = get_posts(
            array(
                'post_type'      => 'elementor_library',
                'posts_per_page' => -1,
            )
        );
        $pagearray = array();
        if ( !empty( $pageslist ) ) {
            foreach ( $pageslist as $page ) {
                $pagearray[$page->ID] = $page->post_title;
            }
        }
        return $pagearray;
    }
}


function classyea_kses_allowed_html( $classyea_tags, $classyea_context ) {
    switch ( $classyea_context ) {
    case 'classyea_kses':
        $classyea_tags = array(
            'div'    => array(
                'class' => array(),
            ),
            'ul'     => array(
                'class' => array(),
            ),
            'li'     => array(),
            'span'   => array(
                'class' => array(),
            ),
            'a'      => array(
                'href'  => array(),
                'class' => array(),
            ),
            'i'      => array(
                'class' => array(),
            ),
            'p'      => array(),
            'em'     => array(),
            'br'     => array(),
            'strong' => array(),
            'h1'     => array(),
            'h2'     => array(),
            'h3'     => array(),
            'h4'     => array(),
            'h5'     => array(),
            'h6'     => array(),
            'del'    => array(),
            'ins'    => array(),
        );
        return $classyea_tags;
    case 'classyea_img':
        $classyea_tags = array(
            'img' => array(
                'class'  => array(),
                'height' => array(),
                'width'  => array(),
                'src'    => array(),
                'alt'    => array(),
            ),
        );
        return $classyea_tags;
    default:
        return $classyea_tags;

    }
}

add_filter( 'wp_kses_allowed_html', 'classyea_kses_allowed_html', 10, 2 );

/*
 * Get Post Type
 * return array
 */

if ( !function_exists( 'classyea_get_post_types' ) ) {
    function classyea_get_post_types() {
        $post_type_args = [
            'show_in_nav_menus' => true,
        ];

        if ( !empty( $args['post_type'] ) ) {
            $post_type_args['name'] = $args['post_type'];
        }
        $posts = array();
        if ( !empty( $args['defaultadd'] ) ) {
            $posts[strtolower( $args['defaultadd'] )] = ucfirst( $args['defaultadd'] );
        }
        $post_types = get_post_types( $post_type_args, 'objects' );

        foreach ( $post_types as $post_type ) {
            $posts[$post_type->name] = $post_type->labels->singular_name;
        }
        return $posts;
    }
}


function classyea_get_categories() {
    $taxonomy_categories_list = array();
    $taxonomy_category        = 'category';
    if ( !empty( $taxonomy_category ) ) {

        $terms_cat = get_terms(
            array(
                'parent'     => 0,
                'taxonomy'   => $taxonomy_category,
                'hide_empty' => false,
            )
        );

        if ( !empty( $terms_cat ) ) {
            $taxonomy_categories_list[''] = 'Select';
            foreach ( $terms_cat as $term ) {
                if ( isset( $term ) ) {
                    if ( isset( $term->slug ) && isset( $term->name ) ) {
                        $taxonomy_categories_list[$term->slug] = $term->name;
                    }
                }
            }
        }
    }
    return $taxonomy_categories_list;
}