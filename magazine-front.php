<?php
/*
Template Name: Magazine 
 */
function print_post($post, $is_featured) {
    $post_class = $is_featured ? 'featured' : 'preview';
    $post_category = best_category( array( get_the_category()) );
    // Extract the first img src from the post body
    $regex = '/magazine.image\s*=\s*"?([^"\s->]*)/';
    preg_match($regex, get_the_content(), $matches);
    $post_img = get_bloginfo( 'stylesheet_directory' ) . '/img/default-image.png';
    if (count($matches)) $post_img = $matches[1];
    echo '<div class="box post '.$post_class.'">';
    echo '<div class="padder"> <a class="image" href="'.get_permalink().'" style="background-image:url('.$post_img.');"></a>';
    echo '<div class="text">';
    echo '<h2><a href="'.get_permalink().'"rel="bookmark">'; the_title(); echo '</a></h2>';
    echo '<span class="entry-meta"> Posted on '; 
    printf( __( '%1$s <span>in %2$s</span>', 'buddypress' ), get_the_date(), get_the_category_list( ', ' ) );
    echo 'by ' . bp_core_get_userlink( $post->post_author );
    echo '</span>';
    echo the_excerpt();
    echo '</div>';
    echo '<a href="'.get_permalink().'" class="btn btn-info">Full Post</a> </div>';
    echo '<h3 class="ribbon">';
    echo $post_category;
    echo '</h3>';
    echo '</div>';
}
?>

<?php get_header() ?>

    <div id="content" class="magazine">
        <div class="padder">

        <?php do_action( 'bp_before_blog_home' ) ?>

        <?php do_action( 'template_notices' ) ?>

        <div class="page" id="blog-latest" role="main">

        <?php 
        /* =================== */
        /* == Magazine Body == */
        /* =================== */
          $post_filter_main = array('category_name' => 'Featured', 'posts_per_page' => 1 );

          // Print the main post
          query_posts( $post_filter_main );
          the_post();
          print_post($post, true);

          // Skip that post's ID in the remining section
          $idToSkip = $post->ID;
          $post_filter_etc = array('posts_per_page' => 4, 'post__not_in' => array($idToSkip));

          // Print the remaining posts
          query_posts( $post_filter_etc );
          while (have_posts()) {
            the_post();
            print_post($post, false);
          }
        /* =================== */
        ?>
        </div>

        <?php do_action( 'bp_after_blog_home' ) ?>

        </div><!-- .padder -->
    </div><!-- #content -->

    <?php get_sidebar() ?>

<?php get_footer() ?>
