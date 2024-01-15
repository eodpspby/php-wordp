<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>

<div class="wrapper" id="page-wrapper">

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
					get_template_part( 'loop-templates/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				}
				?>

			</main>

			<?php
			// Do the right sidebar check and close div#primary.
			get_template_part( 'global-templates/right-sidebar-check' );
			?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #page-wrapper -->
<?php
// Получаем ID текущей записи
$post_id = get_the_ID();

// Получаем значение метаполя "Площадь"
$area = get_field('площадь', $post_id);

// Получаем значение метаполя "Стоимость"
$price = get_field('стоимость', $post_id);

// Получаем значение метаполя "Адрес"
$address = get_field('адрес', $post_id);

// Получаем значение метаполя "Жилая площадь"
$living_area = get_field('жилая_площадь', $post_id);

// Получаем значение метаполя "Этаж"
$floor = get_field('этаж', $post_id);
?>

<div class="property-details">
    <?php if ($area) : ?>
        <p>Площадь: <?php echo $area; ?></p>
    <?php endif; ?>

    <?php if ($price) : ?>
        <p>Стоимость: <?php echo $price; ?></p>
    <?php endif; ?>

    <?php if ($address) : ?>
        <p>Адрес: <?php echo $address; ?></p>
    <?php endif; ?>

    <?php if ($living_area) : ?>
        <p>Жилая площадь: <?php echo $living_area; ?></p>
    <?php endif; ?>

    <?php if ($floor) : ?>
        <p>Этаж: <?php echo $floor; ?></p>
    <?php endif; ?>
</div>
<?php
get_footer();