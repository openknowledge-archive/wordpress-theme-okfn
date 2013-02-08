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

<?
      global $options;
      foreach ($options as $value) {
          if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
      }
     if (!empty($okfn_magazine_posts)) {
			 $magazinePostNumber = $okfn_magazine_posts;
		 } else {
			 $magazinePostNumber = '39';
		 }
	?>


<?php get_header() ?>
<div id="content" class="span8">
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
      $post_filter_etc = array('posts_per_page' => $magazinePostNumber, 'post__not_in' => $idsToSkip);

		  $counter = 1; ?>
      <div id="magCarousel" class="carousel slide">
        <!-- Carousel items -->
        <div class="carousel-inner">
          <div class="item active">
						<?
            // Print the remaining posts
            query_posts( $post_filter_etc );
            while (have_posts()) {
              the_post();
              echo_magazine_post($post, false);
                
               if ($counter % 4 == 0) : ?>
                </div>
                <div class="item">
              <?php endif;
              $counter += 1;
            }
						/* =================== */
						?>
          </div><!-- close item -->
        </div>
        <div class="blog-nav">
          <a class="carousel-control left" href="#magCarousel" data-slide="prev">&lsaquo;</a>
          <a class="carousel-control right" href="#magCarousel" data-slide="next">&rsaquo;</a>
          <?
					global $options;
					foreach ($options as $value) {
							if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
					}
						if (!empty($okfn_blog_link)) : ?>
						<a href="<? echo $okfn_blog_link ?>" class="all-posts">See all posts</a>
					<? endif; ?>
        </div>
      </div>
    </div>

    <?php do_action( 'bp_after_blog_home' ) ?>

    </div><!-- .padder -->
</div><!-- #content -->
<?php get_sidebar() ?>

<?php get_footer() ?>


<script>
	jQuery("#magCarousel").carousel({ interval: false });
	jQuery(document).ready(function() {
				jQuery(".magazine .post.preview .text").dotdotdot({
						//  configuration goes here
				});
		});
	jQuery('#magCarousel').bind('slid', function() {
			jQuery(".magazine .post.preview .text").trigger("update");
		});
</script>
