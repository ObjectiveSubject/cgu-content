<?php
/**
 * The main template file
 */

get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<p class="h4"><a href="<?php echo home_url(); ?>">« Home</a> / School</p>
		<h2><?php the_title(); ?></h2>

		<?php the_content(); ?>

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

				<h4 class="push-double"><a href="<?php echo site_url("area-of-study/{$area->slug}/"); ?>" class="blue-link"><?php echo $area->name; ?></a></h4>
				<ul class="hug list-unstyled grid" >
					<?php foreach ( $programs as $program ) : ?>
						<?php
							$masters = get_field('masters_degree_awarded', $program->ID);
							$phd = get_field('doctoral_degree_awarded', $program->ID);
							$certificate = get_field('certificate_awarded', $program->ID);
						?>
						<li class="grid-node col-3">
							<hr>
							<h3><a href="<?php echo get_permalink($program->ID); ?>"><?php echo get_the_title($program->ID); ?></a></h3>
							<p class="hug small strong">
								<?php
								echo ($masters) ? "{$masters}<br>" : "";
								echo ($phd) ? "{$phd}<br>" : "";
								echo ($certificate) ? $certificate : "";
								?>
							</p>
						</li>
					<?php endforeach; ?>
				</ul>

			<?php endif; ?>

		<?php endforeach; ?>

	<?php endif; ?>

<?php get_footer();
