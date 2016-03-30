<?php
/**
 * The main template file
 */

get_header(); ?>

	<h3 class="h4">Schools</h3>
	<?php $schools = get_posts(array('post_type'=>'school', 'posts_per_page'=>500)); ?>
	<ul class="push list-unstyled" style="-webkit-columns: 2">
		<?php foreach ( $schools as $school ) : ?>
			<li class="hug"><a href="<?php echo get_permalink($school->ID); ?>"><?php echo get_the_title($school->ID); ?></a></li>
		<?php endforeach; ?>
	</ul>

	<h3 class="h4">Areas of Study</h3>
	<?php $schools = get_posts(array('post_type'=>'study_area', 'posts_per_page'=>500, 'post_parent'=>0)); ?>
	<ul class="push list-unstyled" style="-webkit-columns: 2">
		<?php foreach ( $schools as $school ) : ?>
			<li class="hug"><a href="<?php echo get_permalink($school->ID); ?>"><?php echo get_the_title($school->ID); ?></a></li>
		<?php endforeach; ?>
	</ul>

	<h3 class="h4">Programs</h3>
	<?php
	$args = array(
		'post_type'=>'program',
		'orderby' => 'title',
		'order'=>'ASC',
		'posts_per_page'=>500
	);
	$programs = get_posts( $args ); ?>
	<ul class="push list-unstyled" style="-webkit-columns: 2">
		<?php foreach ( $programs as $program ) : ?>
			<li class="hug"><a href="<?php echo get_permalink($program->ID); ?>"><?php echo get_the_title($program->ID); ?></a></li>
		<?php endforeach; ?>
	</ul>

<?php get_footer();
