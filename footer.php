    </div> <!-- /container -->
		
		<?php do_action( 'bp_after_container' ) ?>
    
		<?php do_action( 'bp_before_footer' ) ?>

		<?php do_action( 'bp_after_footer' ) ?>
    
    <div class="topbar">
      <div class="padder">
       <?
				global $options;
				foreach ($options as $value) {
						if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
				}
				 if ($okfn_sharethis == "true" && $okfn_buddypress_disable == "false") : ?>
					<div class="social">
            <span class='st_facebook' displayText='Facebook'></span>
            <span class='st_twitter' displayText='Twitter'></span>
          </div>
				<? endif; ?>
        
        <a href="http://flattr.com/thing/605365/Open-Knowledge-Foundation" class="donate"><?php _e('Donate', "okfn"); ?></a>
		    
				<?php wp_footer(); ?>
      </div>     
    </div>

    <footer>
    <div class="inner">
      <div class="container">
        <?php 
        $active_footers = 0;
        if ( is_active_sidebar( 'first-footer-widget-area'  ) ) $active_footers++;
        if ( is_active_sidebar( 'second-footer-widget-area' ) ) $active_footers++;
        if ( is_active_sidebar( 'third-footer-widget-area'  ) ) $active_footers++;
        if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) $active_footers++;
        if ( $active_footers > 0) :
          $footer_width = (940 - 20 * ($active_footers - 1)) / $active_footers;
        ?>
          <style scoped>
            #footer-widget-area > div {
              width: <?php echo $footer_width; ?>px !important;
						}
          </style>
          <div class="row">
          <div id="footer-widgets">
            <?php get_sidebar( 'footer' ) ?>
          </div><!-- /footer-widgets -->
          </div><!-- /row -->
        <?php endif; ?>

        <div id="row">
          <?php do_action( 'bp_footer' ) ?>
        </div>
      </div><!-- /container -->
    </div><!-- /inner -->
    </footer>
    
		<script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/theme-okfn/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/theme-okfn/js/jquery.dotdotdot-1.4.0-packed.js"></script>
    
    <? if ($okfn_sharethis == "true" && $okfn_buddypress_disable == "false") : ?>
		  <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script> 
      <script type="text/javascript">stLight.options({publisher: "<? if ($okfn_sharethis_id) : echo $okfn_sharethis_id; else: ?>ur-c524706a-c88f-82a8-ea44-7140256786d3<? endif; ?>"}); </script>
		<? endif; ?>
	</body>

</html>
