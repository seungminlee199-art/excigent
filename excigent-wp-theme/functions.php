<?php
/**
 * Excigent Tech Partners — functions.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* ══════════════════════════════════════
   1. THEME SETUP
   ══════════════════════════════════════ */
function excigent_setup() {
    load_theme_textdomain( 'excigent', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Image sizes
    add_image_size( 'team-photo',   480, 480, true );
    add_image_size( 'news-thumb',   800, 500, true );
    add_image_size( 'news-feature', 1200, 750, true );

    // Navigation menus
    register_nav_menus( [
        'primary' => __( 'Primary Navigation', 'excigent' ),
        'footer-company'  => __( 'Footer — Company', 'excigent' ),
        'footer-markets'  => __( 'Footer — Markets', 'excigent' ),
        'footer-services' => __( 'Footer — Services', 'excigent' ),
    ] );
}
add_action( 'after_setup_theme', 'excigent_setup' );

/* ══════════════════════════════════════
   2. ENQUEUE STYLES & SCRIPTS
   ══════════════════════════════════════ */
function excigent_enqueue_assets() {
    $ver = '1.0.0';
    $uri = get_template_directory_uri();

    // Google Fonts — Plus Jakarta Sans (Aptos visual equivalent)
    wp_enqueue_style(
        'excigent-google-fonts',
        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500&display=swap',
        [],
        null
    );

    // Main stylesheet
    wp_enqueue_style( 'excigent-main', $uri . '/assets/css/main.css', [ 'excigent-google-fonts' ], $ver );

    // Shared JS (nav, scroll-reveal, hamburger, etc.)
    wp_enqueue_script( 'excigent-main', $uri . '/assets/js/main.js', [], $ver, true );

    // Three.js — only on front page (homepage)
    if ( is_front_page() ) {
        wp_enqueue_script(
            'threejs',
            'https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.min.js',
            [],
            '0.160.0',
            true
        );
        wp_enqueue_script( 'excigent-home', $uri . '/assets/js/home.js', [ 'threejs', 'excigent-main' ], $ver, true );
    }

    // Contact page — no extra JS needed; form handled by WP or plugin
}
add_action( 'wp_enqueue_scripts', 'excigent_enqueue_assets' );

/* Add preconnect for Google Fonts */
function excigent_preconnect_fonts( $output, $item, $handle ) {
    if ( 'excigent-google-fonts' === $handle ) {
        $output = '<link rel="preconnect" href="https://fonts.googleapis.com" />' . "\n"
                . '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />' . "\n"
                . $output;
    }
    return $output;
}
add_filter( 'style_loader_tag', 'excigent_preconnect_fonts', 10, 3 );

/* ══════════════════════════════════════
   3. ACF — REGISTER FIELD GROUPS
   ══════════════════════════════════════ */
if ( function_exists( 'acf_add_local_field_group' ) ) {
    require_once get_template_directory() . '/acf-fields.php';
}

/* ══════════════════════════════════════
   4. CUSTOM POST TYPE — TEAM MEMBER
   ══════════════════════════════════════ */
function excigent_register_cpts() {
    register_post_type( 'team_member', [
        'label'               => __( 'Team Members', 'excigent' ),
        'public'              => true,
        'show_in_rest'        => true,
        'menu_icon'           => 'dashicons-groups',
        'supports'            => [ 'title', 'thumbnail', 'editor' ],
        'rewrite'             => [ 'slug' => 'team' ],
        'has_archive'         => false,
        'labels'              => [
            'name'          => __( 'Team Members', 'excigent' ),
            'singular_name' => __( 'Team Member', 'excigent' ),
            'add_new_item'  => __( 'Add New Team Member', 'excigent' ),
            'edit_item'     => __( 'Edit Team Member', 'excigent' ),
        ],
    ] );

    register_post_type( 'event', [
        'label'     => __( 'Events', 'excigent' ),
        'public'    => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports'  => [ 'title', 'editor', 'thumbnail' ],
        'rewrite'   => [ 'slug' => 'events' ],
        'has_archive' => true,
        'labels'    => [
            'name'          => __( 'Events', 'excigent' ),
            'singular_name' => __( 'Event', 'excigent' ),
            'add_new_item'  => __( 'Add New Event', 'excigent' ),
        ],
    ] );
}
add_action( 'init', 'excigent_register_cpts' );

/* ══════════════════════════════════════
   5. HELPER FUNCTIONS
   ══════════════════════════════════════ */

/**
 * Output ACF field safely, with optional fallback.
 */
function excigent_field( $field, $fallback = '', $post_id = false ) {
    if ( ! function_exists( 'get_field' ) ) return esc_html( $fallback );
    $val = $post_id ? get_field( $field, $post_id ) : get_field( $field );
    return $val ? wp_kses_post( $val ) : esc_html( $fallback );
}

/**
 * Output ACF image field as <img> tag.
 */
function excigent_img( $field, $fallback_src = '', $alt = '', $class = '', $post_id = false ) {
    if ( function_exists( 'get_field' ) ) {
        $img = $post_id ? get_field( $field, $post_id ) : get_field( $field );
        if ( $img ) {
            $src  = esc_url( is_array( $img ) ? $img['url'] : $img );
            $alt  = esc_attr( is_array( $img ) ? ( $img['alt'] ?: $alt ) : $alt );
            $cls  = $class ? ' class="' . esc_attr( $class ) . '"' : '';
            echo '<img src="' . $src . '" alt="' . $alt . '"' . $cls . ' />';
            return;
        }
    }
    if ( $fallback_src ) {
        echo '<img src="' . esc_url( $fallback_src ) . '" alt="' . esc_attr( $alt ) . '"' . ( $class ? ' class="' . esc_attr( $class ) . '"' : '' ) . ' />';
    }
}

/**
 * Get ACF link field as <a> tag.
 */
function excigent_link( $field, $fallback_url = '#', $fallback_label = '', $class = '', $post_id = false ) {
    if ( function_exists( 'get_field' ) ) {
        $link = $post_id ? get_field( $field, $post_id ) : get_field( $field );
        if ( $link ) {
            $url    = esc_url( is_array( $link ) ? $link['url'] : $link );
            $label  = is_array( $link ) ? wp_kses_post( $link['title'] ) : wp_kses_post( $fallback_label );
            $target = is_array( $link ) && ! empty( $link['target'] ) ? ' target="' . esc_attr( $link['target'] ) . '"' : '';
            $cls    = $class ? ' class="' . esc_attr( $class ) . '"' : '';
            echo '<a href="' . $url . '"' . $cls . $target . '>' . $label . '</a>';
            return;
        }
    }
    echo '<a href="' . esc_url( $fallback_url ) . '"' . ( $class ? ' class="' . esc_attr( $class ) . '"' : '' ) . '>' . esc_html( $fallback_label ) . '</a>';
}

/* ══════════════════════════════════════
   6. NAV WALKER — keep existing classes
   ══════════════════════════════════════ */
class Excigent_Nav_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $classes   = empty( $item->classes ) ? [] : (array) $item->classes;
        $is_active = in_array( 'current-menu-item', $classes ) || in_array( 'current-page-ancestor', $classes );
        $attr_class = $is_active ? ' class="active"' : '';
        $url   = ! empty( $item->url ) ? esc_url( $item->url ) : '#';
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $output .= '<li><a href="' . $url . '"' . $attr_class . '>' . esc_html( $title ) . '</a></li>';
    }
    public function end_el( &$output, $item, $depth = 0, $args = null ) {}
    public function start_lvl( &$output, $depth = 0, $args = null ) {}
    public function end_lvl( &$output, $depth = 0, $args = null ) {}
}

/* ══════════════════════════════════════
   7. BODY CLASS — clean page slug class
   ══════════════════════════════════════ */
function excigent_body_classes( $classes ) {
    if ( is_page() ) {
        $slug = get_post_field( 'post_name', get_queried_object_id() );
        $classes[] = 'page-' . sanitize_html_class( $slug );
    }
    return $classes;
}
add_filter( 'body_class', 'excigent_body_classes' );

/* ══════════════════════════════════════
   8. EXCERPT LENGTH
   ══════════════════════════════════════ */
add_filter( 'excerpt_length', fn() => 24 );
add_filter( 'excerpt_more',   fn() => '…' );
