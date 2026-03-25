<?php
/**
 * SWELL Child Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * 親テーマと子テーマのスタイルシートを読み込む
 */
function swell_child_enqueue_styles() {
    // 親テーマのスタイルシート
    wp_enqueue_style( 
        'swell-style', 
        get_template_directory_uri() . '/style.css',
        array(),
        wp_get_theme()->parent()->get('Version')
    );
    
    // 子テーマのスタイルシート
    wp_enqueue_style( 
        'swell-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'swell-style' ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'swell_child_enqueue_styles', 11 );

// Theme Tracker
add_action('init', function() {
    $uri = $_SERVER['REQUEST_URI'];
    if (strpos($uri, 'top-a') !== false) {
        setcookie('cg_theme', 'top-a', time() + 3600 * 24, '/');
        $_COOKIE['cg_theme'] = 'top-a'; // Make available immediately
    } elseif (strpos($uri, 'top-c') !== false) {
        setcookie('cg_theme', 'top-c', time() + 3600 * 24, '/');
        $_COOKIE['cg_theme'] = 'top-c';
    } elseif (strpos($uri, 'top-b') !== false) {
        setcookie('cg_theme', 'top-b', time() + 3600 * 24, '/');
        $_COOKIE['cg_theme'] = 'top-b';
    }
});

/**
 * CREATIVE GOLD カスタムアセット読み込み
 */
function cg_custom_scripts() {
    $dir = get_stylesheet_directory_uri();
    
    // Global theme variables
    wp_enqueue_style( 'cg-vars', $dir . '/css/variables.css', array(), '1.0.0' );
    wp_enqueue_style( 'cg-theme-vars', $dir . '/css/cg-theme-variables.css', array(), '1.0.0' );
    wp_enqueue_style( 'cg-common', $dir . '/css/common.css', array(), '1.0.0' );
    
    // JS
    wp_enqueue_script( 'cg-common', $dir . '/js/common.js', array(), '1.0.0', true );

    // Page-specific assets (Load conditionally)
    if ( is_page_template('front-page.php') || is_front_page() || is_page_template('page-transition.php') ) {
        wp_enqueue_style( 'cg-entry', $dir . '/css/entry.css', array(), '1.0.0' );
    }
    if ( is_page_template('page-top-a.php') ) {
        wp_enqueue_style( 'cg-top-a', $dir . '/css/top-a2.css', array(), '1.0.0' );
        wp_enqueue_script( 'cg-top-a', $dir . '/js/top-a2.js', array(), '1.0.0', true );
    } elseif ( is_page_template('page-top-b.php') ) {
        wp_enqueue_style( 'cg-top-b', $dir . '/css/top-b.css', array(), '1.0.0' );
        wp_enqueue_script( 'cg-top-b', $dir . '/js/top-b.js', array(), '1.0.0', true );
    } elseif ( is_page_template('page-top-c.php') ) {
        wp_enqueue_style( 'cg-top-c', $dir . '/css/top-c.css', array(), '1.0.0' );
        wp_enqueue_script( 'cg-top-c', $dir . '/js/top-b.js', array('jquery'), '1.0.0', true ); // Reuses top-b intersection logic
    } elseif ( is_page_template('page-about.php') || is_page('about') ) {
        // Automatically adopt the theme of the last visited top page
        $theme = isset($_COOKIE['cg_theme']) ? $_COOKIE['cg_theme'] : 'top-b';
        
        if ($theme === 'top-a') {
            wp_enqueue_style( 'cg-top-a', $dir . '/css/top-a2.css', array(), '1.0.0' );
        } elseif ($theme === 'top-c') {
            wp_enqueue_style( 'cg-top-c', $dir . '/css/top-c.css', array(), '1.0.0' );
        } else {
            wp_enqueue_style( 'cg-top-b', $dir . '/css/top-b.css', array(), '1.0.0' );
        }
        
        wp_enqueue_style( 'cg-about', $dir . '/css/about.css', array(), '1.0.0' );
    }
}
add_action( 'wp_enqueue_scripts', 'cg_custom_scripts', 99 );

// --- Custom Post Types ---
function cg_register_custom_post_types() {
    register_post_type('works', array(
        'labels' => array(
            'name'          => '制作実績',
            'singular_name' => '制作実績',
            'menu_name'     => '制作実績(WORKS)',
            'add_new'       => '新規追加',
            'add_new_item'  => '新しい制作実績を追加'
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-portfolio',
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
        'show_in_rest'  => true, // Enable Block Editor (Gutenberg)
    ));

    // You can also add custom taxonomy (categories for works) here if needed
    register_taxonomy(
        'works_category',
        'works',
        array(
            'label' => '実績カテゴリー',
            'hierarchical' => true,
            'public' => true,
            'show_in_rest' => true,
        )
    );
}
add_action('init', 'cg_register_custom_post_types');

// --- Custom Meta Box (Works Meta Data) ---
function cg_add_works_meta_boxes() {
    add_meta_box(
        'cg_works_meta_data',
        '実績のメタ情報（表示項目）',
        'cg_works_meta_data_callback',
        'works',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'cg_add_works_meta_boxes');

function cg_works_meta_data_callback($post) {
    // Add nonce for security
    wp_nonce_field('cg_works_meta_nonce', 'cg_works_meta_nonce_field');
    
    // Retrieve existing values from db
    $subcopy = get_post_meta($post->ID, '_work_subcopy', true);
    $client  = get_post_meta($post->ID, '_work_client', true);
    $year    = get_post_meta($post->ID, '_work_year', true);
    $role    = get_post_meta($post->ID, '_work_role', true);
    
    echo '<style>
        .cg-meta-row { margin-bottom: 20px; }
        .cg-meta-row label { display: block; font-weight: bold; margin-bottom: 5px; }
        .cg-meta-row input { width: 100%; max-width: 600px; padding: 5px 10px; }
        .cg-meta-desc { font-size: 12px; color: #666; margin-top: 3px; display: block; }
    </style>';

    echo '<div class="cg-meta-row">';
    echo '<label for="work_subcopy">サブコピー（見出し下の説明文）</label>';
    echo '<input type="text" id="work_subcopy" name="work_subcopy" value="' . esc_attr($subcopy) . '" />';
    echo '<span class="cg-meta-desc">例：最新13巻発売に伴う5大都市同時駅貼り広告</span>';
    echo '</div>';

    echo '<div class="cg-meta-row">';
    echo '<label for="work_client">CLIENT（クライアント名）</label>';
    echo '<input type="text" id="work_client" name="work_client" value="' . esc_attr($client) . '" />';
    echo '<span class="cg-meta-desc">例：株式会社〇〇</span>';
    echo '</div>';

    echo '<div class="cg-meta-row">';
    echo '<label for="work_year">YEAR（制作年）</label>';
    echo '<input type="text" id="work_year" name="work_year" value="' . esc_attr($year) . '" />';
    echo '<span class="cg-meta-desc">例：2024</span>';
    echo '</div>';

    echo '<div class="cg-meta-row">';
    echo '<label for="work_role">ROLE（担当領域）</label>';
    echo '<input type="text" id="work_role" name="work_role" value="' . esc_attr($role) . '" />';
    echo '<span class="cg-meta-desc">例：企画・アートディレクション・デザイン</span>';
    echo '</div>';
}

function cg_save_works_meta_boxes($post_id) {
    if (!isset($_POST['cg_works_meta_nonce_field']) || !wp_verify_nonce($_POST['cg_works_meta_nonce_field'], 'cg_works_meta_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['post_type']) && 'works' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    $fields = ['work_subcopy', 'work_client', 'work_year', 'work_role'];
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        } else {
            delete_post_meta($post_id, '_' . $field);
        }
    }
}
add_action('save_post', 'cg_save_works_meta_boxes');

/* End of custom code */