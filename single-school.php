<?php
/**
 * The main template file
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<p class="h4"><a href="<?php echo home_url(); ?>">« Home</a> / School</p>
		<h2><?php the_title(); ?></h2>

		<h3>Programs</h3>
		<?php
		$study_areas = get_terms('_study_area');
		foreach($study_areas as $area) :

			$args = array(
				'post_type'=>'program',
				'orderby' => 'title',
				'order'=>'ASC',
				'posts_per_page'=>500,
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => '_study_area',
						'field'    => 'slug',
						'terms'    => $area->slug
					),
					array(
						'taxonomy' => '_school',
						'field'    => 'slug',
						'terms'    => $post->post_name
					)
				)
			);
			$programs = get_posts( $args );

			if ( $programs ) : ?>

				<h4><a href="<?php echo site_url("area-of-study/{$area->slug}/"); ?>"><?php echo $area->name; ?></a></h4>
				<ul class="push list-unstyled" style="-webkit-columns: 2">
					<?php foreach ( $programs as $program ) : ?>
						<li class="hug"><a href="<?php echo get_permalink($program->ID); ?>"><?php echo get_the_title($program->ID); ?></a></li>
					<?php endforeach; ?>
				</ul>

			<?php endif; ?>

		<?php endforeach; ?>

		<?php the_content(); ?>
		<hr>
		<p><a href="<?php echo home_url(); ?>">« Home</a></p>
	<?php endif; ?>

<?php get_footer();
