
<?php get_header() ?>
<div class="span8 box extend">
 <div class="padder">
    <div class="row">
      <div id="content" class="span6">
        <?php do_action( 'bp_before_blog_single_post' ) ?>
  
        <div class="page" id="blog-single" role="main">
  
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
          <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  
            <div class="post-content">
              <h2 class="posttitle"><?php the_title(); ?></h2>
  
              
  
              <div class="entry">
                <?php the_content( __( 'Read the rest of this entry &rarr;', 'buddypress' ) ); ?>
  
                <?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . __( 'Pages: ', 'buddypress' ), 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>
              </div>
  
              <p class="postmetadata"><?php the_tags( '<span class="tags">' . __( 'Tags: ', 'buddypress' ), ', ', '</span>' ); ?></p>
  
              <div class="alignleft"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'buddypress' ) . '</span> %title' ); ?></div>
              <div class="alignright"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'buddypress' ) . '</span>' ); ?></div>
            </div>
  
          </div>
  
          <?php comments_template(); ?>
          
          <?php endwhile; else: ?>
    
            <p><?php _e( 'Sorry, no posts matched your criteria.', 'buddypress' ) ?></p>
    
          <?php endif; ?>
    
        </div>
    
        <?php do_action( 'bp_after_blog_single_post' ) ?>
      </div><!-- #content -->
    
      <div class="span2">
        <?
          global $options;
          foreach ($options as $value) {
              if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
          }
         if ($okfn_large_avatars == "true") : ?>
        <div class="author-box">
          <?php echo get_avatar( get_the_author_meta( 'user_email' ), '130' ); ?>
          <h3><?php printf( _x( 'Written by %s', 'Post written by...', 'buddypress' ), str_replace( '<a href=', '<a rel="author" href=', bp_core_get_userlink( $post->post_author ) ) ); ?></h3>
          <p><!--Replace this with buddypress field --><?php the_author_meta('user_description'); ?></p>
        </div>
        <?php else: ?>
        <div class="author-box small">
          <div class="avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), '50' ); ?></div>
          <h3><?php printf( _x( 'Written by <br /> %s', 'Post written by...', 'buddypress' ), str_replace( '<a href=', '<a rel="author" href=', bp_core_get_userlink( $post->post_author ) ) ); ?></h3>
          <p><!--Replace this with buddypress field --><?php the_author_meta('user_description'); ?></p>
        </div>
       <? endif; ?>
       
       <div class="date">
         <?php printf( __( '%1$s <span>in %2$s</span>', 'buddypress' ), get_the_date(), get_the_category_list( ', ' ) ); ?>
       </div>
       <span class="post-utility"><?php edit_post_link( __( 'Edit this entry', 'buddypress' ) ); ?></span>
       
     </div>
     <div style="clear:both;"></div>
     </div>
  </div>
</div>
	<?php get_sidebar() ?>

<?php get_footer() ?>
