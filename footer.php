    </div> <!-- /container -->
		<?php do_action( 'bp_after_container' ) ?>

		<?php do_action( 'bp_before_footer' ) ?>


		<?php do_action( 'bp_after_footer' ) ?>

		<?php wp_footer(); ?>

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
          <style type="text/css">
            #footer-widget-area > div {
              width: <?php echo $footer_width; ?>px !important;
          </style>
          <div class="row">
          <div id="footer-widgets">
            <?php get_sidebar( 'footer' ) ?>
          </div><!-- /footer-widgets -->
          </div><!-- /row -->
        <?php endif; ?>

        <div id="row">
          <?php do_action( 'bp_footer' ) ?>
        <div id="row">
      </div><!-- /container -->
    </div><!-- /inner -->
    </footer>
		
		<script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/theme-okfn/js/bootstrap.js"></script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script> 
    <script type="text/javascript">stLight.options({publisher: "ur-c524706a-c88f-82a8-ea44-7140256786d3"}); </script>
		
	</body>

</html>
