<?php
/*
Template Name: Full Width Banner
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

<?php if (has_post_thumbnail( $post->ID ) ): ?>
<?php $bannerimage = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>
<?php $bannercolour = get_post(get_post_thumbnail_id())->post_content; ?>
<div class="banner" style="background-image: url('<?php echo $bannerimage[0]; ?>');<?php if (!empty($bannercolour)) { echo 'background-color:' . $bannercolour; }?>">
  <div class="container">
  	<div class="text">
	  	<h1><?php the_title(); ?></h1>
      <span class="caption">
        <?php echo get_post(get_post_thumbnail_id())->post_title; ?>
      </span>   
      <?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="container">
  <div class="row">
    <div id="content" class="span12">
      <?php the_content(); ?>
    </div>
  </div>
</div>
  
<?php endwhile; endif; ?>
		
<?php get_footer() ?>