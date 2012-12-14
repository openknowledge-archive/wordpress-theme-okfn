<?php
/*
Template Name: Minimal (fluid) 
 */
 
 /* body class */
add_filter('body_class','browser_body_class');
function browser_body_class($classes = '') {
  array_push($classes,"fluid");
  return $classes;
}
?>

<?php get_header() ?>

<?php do_action( 'bp_before_blog_home' ) ?>

<?php do_action( 'template_notices' ) ?>
		
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <?php the_content(); ?>
<?php endwhile; endif; ?>
		
<?php get_footer() ?>