    </div> <!-- /container -->

		<?php do_action( 'bp_after_container' ) ?>

		<?php do_action( 'bp_before_footer' ) ?>

		<?php do_action( 'bp_after_footer' ) ?>

    <div class="topbar">
      <div class="padder">


				<?php wp_footer(); ?>
      </div>
    </div>
	<?php do_action('cookie_bar'); ?>
		<?php global $options;
    foreach ($options as $value) {
      if(array_key_exists('id', $value)) {
        if (get_option( $value['id'] ) === FALSE) {
          if (array_key_exists('std', $value)) {
            $$value['id'] = $value['std'] or NULL;
          }
        } else {
          $$value['id'] = get_option( $value['id'] );
        }
      }
    }
      if ( $okfn_mailinglist_bar_location == "footer" ) {
				include('mailing-bar.php');
			} ?>

    <footer>
    <div class="inner">
      <div class="container">
        <?php
        $active_footers = 0;
        if ( is_active_sidebar( 'first-footer-widget-area'  ) ) $active_footers++;
        if ( is_active_sidebar( 'second-footer-widget-area' ) ) $active_footers++;
        if ( is_active_sidebar( 'third-footer-widget-area'  ) ) $active_footers++;
        //if ( is_active_sidebar( 'fourth-footer-widget-area' ) ) $active_footers++;
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
            <div class="footer-buttons">
				 			<?php if ( !empty( $okfn_twitter_username ) && $okfn_twitter_link == "true" && $okfn_twitter_location != "default" ) : ?>
                <a class="twitter" href="https://twitter.com/<?php echo $okfn_twitter_username ?>">twitter</a>
              <?php endif; ?>
              <?php if ( !empty( $okfn_facebook_username ) && $okfn_facebook_link == "true" && $okfn_facebook_location != "default" ) : ?>
                <a class="facebook" href="http://www.facebook.com/<?php echo $okfn_facebook_username ?>">facebook</a>
              <?php endif; ?>

              <?php if ( $okfn_flattr_okfn == "true" ) : ?>
                <a href="http://flattr.com/thing/605365/Open-Knowledge-Foundation" target="_blank">
                  <img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" />
                </a>
              <?php endif; ?>
              <?php if ($okfn_sharethis == "true" && $okfn_sharethis_location == "footer") : ?>
                  <span class='st_facebook' displayText='Facebook'></span>
                  <span class='st_twitter' displayText='Twitter'></span>
              <?php endif; ?>
            </div>
          </div><!-- /footer-widgets -->
          </div><!-- /row -->
        <?php endif; ?>

        <div id="row">
          <?php do_action( 'bp_footer' ) ?>
        </div>

      </div><!-- /container -->
    </div><!-- /inner -->
    <?php do_action('okf_footer'); ?>
    </footer>

		<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/include/jquery.dotdotdot-1.5.6-packed.js"></script>

		<script>
		  // Tweeter
			$("div.tweeter.carousel > ul").addClass("carousel-inner");
			$("div.tweeter.carousel > ul li").addClass("item");
			$("div.tweeter.carousel > ul li:nth-child(1)").addClass("active");

		  // cycling for carousel
      $(".carousel.ticker").carousel({ interval: 6000 });
			$(".carousel.cycle").carousel({ interval: 8000 });

		  // allow button to hide elements
			$(".hide-it").click(function () {
				$(".hide-me").hide("slow");
			});

			// button for mailchimp form
		  $("div.nm_mc_form input.nm_mc_button").addClass("btn btn-primary");
    </script>

		<?php if (($okfn_header_search == "true") && ($okfn_subheader_search == "false")) : ?>
    <script>
			$("div.header-search a").click(function(){
			  $("div.header-search").toggleClass("active");
			});
    </script>
    <?php endif; ?>

    <!-- sharethis -->
    <?php if ($okfn_sharethis == "true") : ?>
		  <script type="text/javascript" src="//w.sharethis.com/button/buttons.js"></script>
      <script type="text/javascript">stLight.options({publisher: "<?php if ($okfn_sharethis_id) : echo $okfn_sharethis_id; else: ?>ur-c524706a-c88f-82a8-ea44-7140256786d3<?php endif; ?>"}); </script>
		<?php endif; ?>
	</body>

</html>
