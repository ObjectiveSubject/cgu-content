<?php
/**
 * The main template file
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<p class="h4">Area of Study</p>
		<h2><?php the_title(); ?></h2>

		<h3 class="h4">Programs</h3>
		<?php
		$args = array(
			'post_type'=>'program',
			'orderby' => 'title',
			'order'=>'ASC',
			'posts_per_page'=>500,
			'tax_query' => array(
				array(
					'taxonomy' => '_study_area',
					'field'    => 'slug',
					'terms'    => $post->post_name
				)
			)
		);
		$programs = get_posts( $args ); ?>
		<ul class="push list-unstyled" style="-webkit-columns: 2">
			<?php foreach ( $programs as $program ) : ?>
				<li class="hug"><a href="<?php echo get_permalink($program->ID); ?>"><?php echo get_the_title($program->ID); ?></a></li>
			<?php endforeach; ?>
		</ul>

		<?php the_content(); ?>
		<hr>
		<p><a href="<?php echo home_url(); ?>">« Home</a></p>
	<?php endif; ?>

<?php get_footer();
