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
		$degrees = get_terms('degree', array('orderby' => 'count', 'order' => 'DESC'));
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

					<h4 class="push-double"><?php echo $area->name; ?></h4>

					<?php foreach ( $degrees as $degree ) : ?>
						<ul class="hug list-unstyled grid">
							<?php
							$count = 1;
							foreach ( $programs as $program ) {
								if ( has_term($degree->slug, 'degree', $program->ID) ) {
									include('content-program-listing.php');
									$count++;
								}
							} ?>
						</ul>
					<?php endforeach; ?>

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

				<h4 class="push-double"><a href="<?php echo site_url("school/{$school->slug}/"); ?>" class="blue-link"><?php echo $school->name; ?></a></h4>
				<?php foreach ( $degrees as $degree ) : ?>
					<ul class="hug list-unstyled grid">
						<?php
						$count = 1;
						foreach ( $programs as $program ) {
							if ( has_term($degree->slug, 'degree', $program->ID) ) {
								include('content-program-listing.php');
								$count++;
							}
						} ?>
					</ul>
				<?php endforeach; ?>

			<?php endif; ?>

		<?php endif; ?>

	<?php endif; ?>

<?php get_footer();
