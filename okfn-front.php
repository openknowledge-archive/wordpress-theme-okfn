<?php
/*
Template Name: OKFN Front Page 
 */
?>
<?php get_header(); ?>

	<div id="content" class="okfn-front">
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
        jQuery(document).ready(function() {
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
  <section class="subscribe">
    <div class="container">
      <!-- Begin MailChimp Signup Form -->
      <div id="mc_embed_signup">
        <form action="http://okfn.us2.list-manage2.com/subscribe/post?u=a3f1f88a62b23f51641693977&amp;id=1524478d61" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
          <div class="row">
            <div class="span11">
              <h5>Join the OKFN Mailing List</h5>
              <div class="mc-field-group">
                <label for="mce-EMAIL">Email Address </label>
                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email Address">
              </div>
              <div class="mc-field-group">
                <label for="mce-FNAME">First Name </label>
                <input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="First Name">
              </div>
              <div class="mc-field-group">
                <label for="mce-LNAME">Last Name </label>
                <input type="text" value="" name="LNAME" class="" id="mce-LNAME" placeholder="Last Name">
              </div>
              <div id="mce-responses" class="clear">
                <div class="response" id="mce-error-response" style="display:none"></div>
                <div class="response" id="mce-success-response" style="display:none"></div>
              </div>
            </div>
            <div class="span1">
            	<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
            </div>
          </div>
        </form>
      </div>
			<!--End mc_embed_signup-->
    </div>
  </section>
<?php get_footer(); ?>
