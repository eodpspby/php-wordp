<?php
/**
 * UnderStrap functions and definitions
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once get_theme_file_path( $understrap_inc_dir . $file );
}


// Добавление метаполя для выбора города
function add_city_meta_box() {
    add_meta_box(
        'city_meta_box',
        'Выбор города',
        'render_city_meta_box',
        'Недвижимость', 
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'add_city_meta_box');

// Отображение поля выбора города
function create_city_post_type() {
    $labels = array(
        'name' => 'Города',
        'singular_name' => 'Город',
        'menu_name' => 'Города',
        'add_new' => 'Добавить новый',
        'add_new_item' => 'Добавить новый город',
        'edit' => 'Редактировать',
        'edit_item' => 'Редактировать город',
        'new_item' => 'Новый город',
        'view' => 'Просмотреть',
        'view_item' => 'Просмотреть город',
        'search_items' => 'Найти город',
        'not_found' => 'Города не найдены',
        'not_found_in_trash' => 'В корзине города не найдены',
        'parent' => 'Родительский город'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-location',
        'supports' => array('title', 'editor', 'thumbnail'),
    );
    register_post_type('city', $args);
}
add_action('init', 'create_city_post_type');

function add_city_field_to_property() {
    $args = array(
        'post_type' => 'city',
        'numberposts' => -1,
    );
    $cities = get_posts($args);
    $selected_city = get_post_meta(get_the_ID(), 'city_id', true);
    echo '<label for="selected_city">Выберите город:</label>';
    echo '<select name="city_id" id="selected_city">';
    echo '<option value="">- Не выбрано -</option>';
    foreach ($cities as $city) {
        $city_id = $city->ID;
        $city_name = $city->post_title;
        $selected = ($selected_city == $city_id) ? 'selected' : '';
        echo '<option value="' . $city_id . '" ' . $selected . '>' . $city_name . '</option>';
    }
    echo '</select>';
}

function save_selected_city($post_id) {
    if (isset($_POST['city_id'])) {
        update_post_meta($post_id, 'city_id', $_POST['city_id']);
    }
}
add_action('save_post', 'save_selected_city');
add_action('edit_form_after_title', 'add_city_field_to_property');









function create_post_type() {
  register_post_type( 'real_estate',
    array(
      'labels' => array(
        'name' => __( 'Недвижимость' ),
        'singular_name' => __( 'Недвижимость' )
      ),
      'public' => true,
      'has_archive' => true,
      'supports' => array( 'title', 'editor', 'thumbnail' ),
      'taxonomies' => array('real_estate_type')
    )
  );
}
add_action( 'init', 'create_post_type' );

function create_real_estate_taxonomies() {
  register_taxonomy(
    'real_estate_type',
    'real_estate',
    array(
      'label' => __( 'Тип недвижимости' ),
      'rewrite' => array( 'slug' => 'real_estate_type' ),
      'hierarchical' => true,
    )
  );
}
add_action( 'init', 'create_real_estate_taxonomies', 0 );

function add_property() {
    $property_title = $_POST['property_title'];
    $city_id = $_POST['city_id'];
    
    // Обработка и сохранение данных объекта недвижимости
    
    $response = array(
        'success' => true,
        'message' => 'Объект недвижимости успешно добавлен.'
    );
    
    wp_send_json($response);
}
add_action('wp_ajax_add_property', 'add_property');
add_action('wp_ajax_nopriv_add_property', 'add_property');
// Добавьте этот код перед закрывающим тегом `
function enqueue_ajax_scripts() {
    wp_enqueue_script('ajax-scripts', get_template_directory_uri() . '/js/ajax-scripts.js', array('jquery'), '1.0', true);
    wp_localize_script('ajax-scripts', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'enqueue_ajax_scripts');
?>