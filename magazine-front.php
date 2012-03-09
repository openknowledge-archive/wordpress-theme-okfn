<?php
/*
Template Name: Magazine 
 */

/* body class="magazine" */
add_filter('body_class','browser_body_class');
function browser_body_class($classes = '') {
  array_push($classes,"magazine");
  return $classes;
}
?>

<?php get_header() ?>
<div id="content">
    <div class="padder">

    <?php do_action( 'bp_before_blog_home' ) ?>

    <?php do_action( 'template_notices' ) ?>

    <div class="page" id="blog-latest" role="main">

    <?php 
    /* =================== */
    /* == Magazine Body == */
    /* =================== */
      $post_filter_main = array('category_name' => 'Featured', 'posts_per_page' => 1 );

      $idsToSkip = array();
      // Print the main post
      query_posts( $post_filter_main );
      if (have_posts()) {
        the_post();
        echo_magazine_post($post, true);
        // Skip that post's ID in the remining section
        array_push($idsToSkip, $post->ID);
      }

      // Query remaining posts
      $post_filter_etc = array('posts_per_page' => 4, 'post__not_in' => $idsToSkip);

      // Print the remaining posts
      query_posts( $post_filter_etc );
      while (have_posts()) {
        the_post();
        echo_magazine_post($post, false);
      }
    /* =================== */
    ?>
    </div>

    <?php do_action( 'bp_after_blog_home' ) ?>

    </div><!-- .padder -->
</div><!-- #content -->
<?php get_sidebar() ?>

<?php get_footer() ?>
