<?php
/**
 * The main template file
 */

get_header();
$masters = get_field('masters_degree_awarded');
$phd = get_field('doctoral_degree_awarded');
$certificate = get_field('certificate_awarded');
$specialization = get_field('areas_of_specialization'); ?>

	<?php if ( have_posts() ) : ?>

		<div class="h4">Program</div>
		<h2><?php the_title(); ?></h2>
		<?php echo ( $masters ) ? '<p class="hug"><strong>'.$masters.'</strong></p>' : ''; ?>
		<?php echo ( $phd ) ? '<p class="hug"><strong>'.$phd.'</strong></p>' : ''; ?>
		<?php echo ( $certificate ) ? '<p class="hug"><strong>'.$certificate.'</strong></p>' : ''; ?>

		<h4>Schools</h4>
		<ul>
			<?php
			$schools = get_the_terms( get_the_ID(), '_school' );
			foreach( $schools as $school ) :
				$related_school = get_post_by_slug($school->slug, 'school');
				if ( $related_school ) : ?>
					<li><a href="<?php echo get_permalink($related_school->ID); ?>"><?php echo get_the_title($related_school->ID) ?></a></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>

		<h4>Areas of Study</h4>
		<ul>
			<?php
			$study_areas = get_the_terms( get_the_ID(), '_study_area' );
			foreach( $study_areas as $area ) :
				$related_area = get_post_by_slug($area->slug, 'study_area');
				if ( $related_area ) : ?>
					<li><a href="<?php echo get_permalink($related_area->ID); ?>"><?php echo get_the_title($related_area->ID) ?></a></li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>

		<?php if ( $specialization ) : ?>
			<h4>Areas of Specialization</h4>
			<p class="hug"><?php echo $specialization; ?></p>
		<?php endif; ?>

		<?php the_content(); ?>
		<hr>
		<p><a href="<?php echo home_url(); ?>">« Home</a></p>
	<?php endif; ?>

<?php get_footer();
