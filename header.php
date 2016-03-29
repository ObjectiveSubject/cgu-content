<?php
/**
 * The template for displaying the header.
 */
 ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <div id="page" class="outer-container">

        <h1 class="site-title h3 strong">Claremont Graduate University</h1>

        <?php $description = get_bloginfo('description');
        if ( $description ) : ?>
            <div class="h3 site-description hug"><?php echo $description; ?></div>
        <?php endif; ?>

        <hr>
