<?php
/**
 * The main template file
 */

get_header(); ?>

	<p class="h4"><a href="<?php echo home_url(); ?>">« Home</a> / School</p>
	<h2><?php the_title(); ?></h2>

	<?php the_content(); ?>

	<h3>Programs</h3>
	<?php
	$study_areas = get_terms('_study_area', array('parent'=>0));
	foreach($study_areas as $area) : ?>

		<?php
		$child_study_areas = get_terms('_study_area', array( 'child_of'=>$area->term_id ));

		// if Area of Study child terms, list programs by child term
		if ( !empty( $child_study_areas ) ) : ?>

			<hr>
			<h4 class="push-double"><a href="<?php echo site_url("area-of-study/{$area->slug}/"); ?>" class="blue-link"><?php echo $area->name; ?></a></h4>

			<?php
			foreach ($child_study_areas as $child_area) : ?>

				<?php
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
							'terms'    => $child_area->slug
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

					<h5><?php echo $child_area->name; ?></h5>
					<ul class="hug list-unstyled grid">
						<?php foreach ( $programs as $program ) : ?>
							<?php include('content-program-listing.php'); ?>
						<?php endforeach; ?>
					</ul>

				<?php endif;

			endforeach; ?>

		<?php else : ?>

			<?php
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
						<?php include('content-program-listing.php'); ?>
					<?php endforeach; ?>
				</ul>

			<?php endif; ?>

		<?php endif; ?>

	<?php endforeach; ?>

<?php get_footer();
