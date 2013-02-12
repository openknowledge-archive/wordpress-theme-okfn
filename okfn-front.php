<?php
/*
Template Name: OKFN Front Page 
 */
?>
<?php get_header(); ?>

	<div id="content" class="okfn-front span12">
		<div class="padder">

		<?php do_action( 'bp_before_blog_page' ); ?>

		<div class="page" id="blog-page" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<h2 class="pagetitle"><?php the_title(); ?></h2>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry">

						<?php the_content( __( '<p class="serif">Read the rest of this page &rarr;</p>', 'buddypress' ) ); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . __( 'Pages: ', 'buddypress' ), 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>
						<?php edit_post_link( __( 'Edit this page.', 'buddypress' ), '<p class="edit-link">', '</p>'); ?>

					</div>

				</div>


			<?php comments_template(); ?>

			<?php endwhile; endif; ?>

			<h3>From our Blog</h3>
			<?php $okfn_front_post_number="4" ?>
      <div class="magazine posts<?php echo $okfn_front_post_number ?>">
      <?php 
        if (switch_to_blog(37,true)) {
          // Query remaining posts
          $post_filter_etc = array('posts_per_page' => $okfn_front_post_number);
          // Print the remaining posts
          query_posts( $post_filter_etc );
          while (have_posts()) {
            the_post();
            echo_magazine_post($post, false);
          }
          restore_current_blog();
        }
      ?>
      <script>
        jQuery(window).load(function() {
          jQuery(".magazine .post.preview .text").dotdotdot({});
					jQuery(".magazine .post.preview .text h2").dotdotdot({});
        });
      </script>
      </div><!-- .magazine -->

		</div><!-- .page -->

		<?php do_action( 'bp_after_blog_page' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php get_sidebar(); ?>
  
<?php get_footer(); ?>
