<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Understrap
 */
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой веб-сайт</title>
    <!-- Подключение Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            background-color: #f8f9fa;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            height: 100%;
        }
        .card-title a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }
        .card-title a:hover {
            color: #007bff;
        }
        .form-group label {
            font-weight: bold;
        }
        .form-group input[type="text"],
        .form-group textarea {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
        }
        .form-group select {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            width: 100%;
        }
        .btn-primary {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <section>
                    <h2>Последние объекты недвижимости</h2>
                    <div class="row">
                        <?php
                        $args = array(
                            'post_type' => 'real_estate',
                            'posts_per_page' => 5,
                        );
                        $latest_properties = new WP_Query($args);
                        if ($latest_properties->have_posts()) {
                            $count = 0;
                            while ($latest_properties->have_posts()) {
                                $latest_properties->the_post();                             
                                $selected_city_id = get_post_meta(get_the_ID(), 'selected_city', true);                               
                                if (has_post_thumbnail()) {
                                    echo '<div class="col-md-4">';
                                    echo '<div class="card">';
                                    echo '<div class="post-thumbnail">';
                                    the_post_thumbnail('medium', array('class' => 'custom-image'));
                                    echo '</div>';
                                    echo '<div class="card-body">';
                                    echo '<h3 class="card-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
                                    $area = get_field('площадь');
                                    $price = get_field('стоимость');
                                    $address = get_field('адрес');
                                    $living_area = get_field('жилая_площадь');
                                    $floor = get_field('этаж');
                                    // Получаем информацию о городе
                                    $city = get_post_meta(get_the_ID(), 'city_id', true);
                                    $city_name = $city ? get_the_title($city) : '';
                                    if ($area) {
                                        echo '<p class="card-text">Площадь: ' . $area . '</p>';
                                    }
                                    if ($price) {
                                        echo '<p class="card-text">Стоимость: ' . $price . '</p>';
                                    }
                                    if ($address) {
                                        echo '<p class="card-text">Адрес: ' . $address . '</p>';
                                    }
                                    if ($living_area) {
                                        echo '<p class="card-text">Жилая площадь: ' . $living_area . '</p>';
                                    }
                                    if ($floor) {
                                        echo '<p class="card-text">Этаж: ' . $floor . '</p>';
                                    }
                                    if ($city_name) {
                                        echo '<p class="card-text">Город: ' . $city_name . '</p>';
                                    }
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                    $count++;
                                }
                                if ($count % 5 == 0) {
                                    echo '</div><div class="row">';
                                }
                            }
                            wp_reset_postdata();
                        } else {
                            echo 'Нет последних объектов недвижимости.';
                        }
                        ?>
                    </div>
                </section>
                <section>
                    <h2>Последние города</h2>
                    <div class="row">
                        <?php
                        $args = array(
                            'post_type' => 'city',
                            'posts_per_page' => 5,
                        );
                        $latest_cities = new WP_Query($args);
                        if ($latest_cities->have_posts()) {
                            while ($latest_cities->have_posts()) {
                                $latest_cities->the_post();
                                echo '<div class="col-md-4">';
                                echo '<div class="card">';
                                echo '<div class="card-body">';
                                echo '<h3 class="card-title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                            wp_reset_postdata();
                        } else {
                            echo 'Нет последних городов.';
                        }
                        ?>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <form id="add-property-form">
                    <div class="form-group">
                        <label for="property-title">Название объекта недвижимости:</label>
                        <input type="text" id="property-title" name="property-title" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="property-description">Описание:</label>
                        <textarea id="property-description" name="property-description" required class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="property-area">Площадь:</label>
                        <input type="text" id="property-area" name="property-area" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="property-price">Стоимость:</label>
                        <input type="text" id="property-price" name="property-price" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="property-city">Город:</label>
                        <select id="property-city" name="property-city" required class="form-control">
                            <option value="">Выберите город</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Добавить</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Подключение Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/ajax-scripts.js"></script>
    <script src="./js/ajax-form.js"></script>
</body>
</html>
<?php
get_footer();
?>
