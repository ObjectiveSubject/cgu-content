<?php
/**
 * The main template file
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<p class="h4"><a href="<?php echo home_url(); ?>">« Home</a> / Area of Study</p>
		<h2><?php the_title(); ?></h2>

		<?php the_content(); ?>

		<h3>Programs</h3>
		<?php
		$current_study_area = get_term_by('slug', $post->post_name, '_study_area');
		$child_areas = get_terms('_study_area', array('parent'=>$current_study_area->term_id));

		if ( !empty( $child_areas ) ) :

			foreach($child_areas as $area) : ?>

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
							'terms'    => $area->slug
						)
					)
				);
				$programs = get_posts( $args );
				if ( $programs ) : ?>

					<h4><?php echo $area->name; ?></h4>

					<ul class="push list-unstyled" style="-webkit-columns: 2">
						<?php foreach ( $programs as $program ) : ?>
							<li class="hug"><a href="<?php echo get_permalink($program->ID); ?>"><?php echo get_the_title($program->ID); ?></a></li>
						<?php endforeach; ?>
					</ul>

				<?php endif; ?>

			<?php endforeach; ?>

		<?php else : ?>

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
			$programs = get_posts( $args );
			if ( $programs ) : ?>

				<ul class="push list-unstyled" style="-webkit-columns: 2">
					<?php foreach ( $programs as $program ) : ?>
						<li class="hug"><a href="<?php echo get_permalink($program->ID); ?>"><?php echo get_the_title($program->ID); ?></a></li>
					<?php endforeach; ?>
				</ul>

			<?php endif; ?>

		<?php endif; ?>

		<hr>
		<p><a href="<?php echo home_url(); ?>">« Home</a></p>
	<?php endif; ?>

<?php get_footer();
