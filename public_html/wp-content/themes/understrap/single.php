<?php
/**
 * The template for displaying all single posts
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
        .property-details img {
            height: 300px;
            object-fit: cover;
            object-position: center;
        }
    </style>
</head>
<body>
    <div class="wrapper" id="single-wrapper">
        <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
            <div class="row">
                <?php
                // Do the left sidebar check and open div#primary.
                get_template_part( 'global-templates/left-sidebar-check' );
                ?>
                <main class="site-main" id="main">
                    <?php
                    while ( have_posts() ) {
                        the_post();
                        get_template_part( 'loop-templates/content', 'single' );
                        //understrap_post_nav();
                       
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    }
                    $city_id = get_post_meta(get_the_ID(), 'city_id', true);
                    ?>
                    <div class="property-details">
                        <?php
                        $post_id = get_the_ID();
                        $area = get_field('площадь', $post_id);
                        $price = get_field('стоимость', $post_id);
                        $address = get_field('адрес', $post_id);
                        $living_area = get_field('жилая_площадь', $post_id);
                        $floor = get_field('этаж', $post_id);
                        if ( $city_id ) {
                            $city = get_post( $city_id );
                            if ( $city ) {
                                echo '<h2>Город: ' . $city->post_title . '</h2>';
                            }
                        }
                        if ($area) {
                            echo '<p>Площадь: ' . $area . '</p>';
                        }
                        if ($price) {
                            echo '<p>Стоимость: ' . $price . '</p>';
                        }
                        if ($address) {
                            echo '<p>Адрес: ' . $address . '</p>';
                        }
                        if ($living_area) {
                            echo '<p>Жилая площадь: ' . $living_area . '</p>';
                        }
                        if ($floor) {
                            echo '<p>Этаж: ' . $floor . '</p>';
                        }
                        ?>
                    </div>
                </main>
                <?php
               
                get_template_part( 'global-templates/right-sidebar-check' );
                ?>
            </div><!-- .row -->
        </div><!-- #content -->
    </div><!-- #single-wrapper -->
    <!-- Подключение Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php
get_footer();
?>
