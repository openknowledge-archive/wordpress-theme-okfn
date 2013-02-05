<!DOCTYPE HTML>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
		
    <title>
    <? if ($okfn_flags_sprite == "true") : ?>
      <link rel="stylesheet" type="text/css" href="http://cloud.github.com/downloads/lafeber/world-flags-sprite/flags16.css" />
      <link rel="stylesheet" type="text/css" href="http://cloud.github.com/downloads/lafeber/world-flags-sprite/flags32.css" />
    <? endif; ?>
    <link rel="stylesheet" href="<?php echo bloginfo('stylesheet_url') . '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/carousels.css"/>
    <? if ($okfn_colours == "blue") : ?>
      <link rel="shortcut icon" href="http://assets.okfn.org/p/ckan/img/ckan.ico" />
    <?php elseif ($okfn_colours == "white" || $okfn_colours == "turquoise") : ?>
      <link rel="shortcut icon" href="http://assets.okfn.org/p/okfn/img/grey-favicon.ico" />
    <?php elseif ($okfn_colours == "school") : ?>
      <link rel="shortcut icon" href="http://assets.okfn.org/p/schoolofdata/img/favicon.ico" />
    <?php else: ?>
      <link rel="shortcut icon" href="http://assets.okfn.org/p/okfn/img/favicon.ico" />
    <? endif; ?>
    <? if ($okfn_okf_ribbon == "true"):?>
      <link rel="stylesheet" href="http://assets.okfn.org/themes/okfn/okf-panel.css"/>
    <? endif; ?>
    <? if ($okfn_tall_header == "true") : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/tall-header.css"/>
    <? endif; ?>
    <? if ($okfn_subheader == "true") : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/sub-header.css"/>
    <? endif; ?>
    <? if ($okfn_colours == "blue") : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/blue.css"/>
    <?php elseif ($okfn_colours == "grey") : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/grey.css"/>
    <?php elseif ($okfn_colours == "white") : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/white.css"/>
    <?php elseif ($okfn_colours == "turquoise") : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/turquoise.css"/>
    <?php elseif ($okfn_colours == "school") : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/school.css"/>
    <? endif; ?>
    
		<style type="text/css">
    <? if ($okfn_large_title == "true" && $okfn_tall_header == "true") : ?>
      .navbar .brand {font-size: 36px; letter-spacing:-1px; text-indent:-5px; line-height: 62px;}
    <? endif; ?>
    <? if ($okfn_logo_font == "ubuntu") : ?>
      @import url(http://fonts.googleapis.com/css?family=Ubuntu);
      .navbar .brand {font-family: 'Ubuntu', sans-serif; font-weight:400;}
    <? endif; ?>
    <? if ($okfn_subheader == "true" && !is_front_page()) : ?>
      .navbar-inner {border-bottom:none;}
    <? endif; ?>
		<? if ($okfn_buddypress_disable == "true") : ?>
			.topbar {display:none; }
			html {margin-top: 0px !important;}
    <? endif; ?>
    </style>
    <? if (is_front_page()) : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/include/jquery.zcarousel.css"/>
    <? endif; ?>

    <!-- no stylesheets below here -->
      <?php
        /* Force our chosen version of jquery */
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', 'http://code.jquery.com/jquery-1.7.2.min.js');
      ?>
		  <?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?>
      <?
      global $options;
      foreach ($options as $value) {
          if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
      }
     if ($okfn_tagline_title == "true" && get_bloginfo( 'description' )) : ?>
      - <?php echo bloginfo( 'description' ); ?>
     <? endif; ?>
    </title>
		 
		<? if (get_bloginfo( 'description' )) : ?>
    <meta name="description" content="<?php echo bloginfo( 'description' ); ?>" />
    <? endif; ?>
    <meta name="author" content="Sam Smith" />
		<?php do_action( 'bp_head' ) ?>
    
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" />
		
		<?php
			if ( is_singular() && bp_is_blog_page() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			wp_head();
		?>
    
    <script type="text/javascript">
      var Okfn = Okfn || {};
      // Make this variable available to Javascript
      Okfn.theme_directory = '<?php echo bloginfo('stylesheet_directory'); ?>';
    </script>
    
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- Theme Settings -->
    
    <? if (is_front_page()) : ?>
      <script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/include/spin.min.js"></script>
      <script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/include/jquery.zcarousel.min.js"></script>
    <? endif; ?>
    
  </head>
  
	<body <?php body_class() ?> id="bp-default">
    <?php 
      /* Javascript includes */
      do_action( 'bp_before_header' ) 
    ?>
    <? if (!empty($okfn_corner_ribbon_text) && $okfn_corner_ribbon == "true") {
			echo '
      <a class="corner ribbon" href="'.stripslashes($okfn_corner_ribbon_link). '" >
        ' . stripslashes($okfn_corner_ribbon_text).'
      </a>';
		} ?>
    
    <? if ($okfn_okf_ribbon == "true") :?>
      <div id="okf-panel" class="collapse">
        <iframe src="http://assets.okfn.org/themes/okfn/okf-panel.html" scrolling="no"></iframe>
      </div>
    <? endif; ?>
	  <? if ( $okfn_mailinglist_bar == "true" && $okfn_mailinglist_bar_location == "header" && is_front_page()) : ?>
      <section class="subscribe">
        <div class="container">
          <? if ( $okfn_mailinglist_bar_type == "mailchimp") : ?>
          <!-- Begin MailChimp Signup Form -->
          <div id="mc_embed_signup">
            <form action="<?php echo $okfn_mailinglist_action?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <table width="100%">
              <tr>
                <th scope="row"><? if (!empty($okfn_mailinglist_heading)) { echo $okfn_mailinglist_heading;} else { echo 'Mailing List';} ?></th>
                <td><label for="mce-EMAIL">Email Address </label>
                    <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email Address"></td>
                <td><label for="mce-FNAME">First Name </label>
                    <input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="First Name"></td>
                <td><label for="mce-LNAME">Last Name </label>
                    <input type="text" value="" name="LNAME" class="" id="mce-LNAME" placeholder="Last Name"></td>
                <td class="submit"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></td>
              </tr>
            </table>
            <div id="mce-responses" class="clear">
              <div class="response" id="mce-error-response" style="display:none"></div>
              <div class="response" id="mce-success-response" style="display:none"></div>
            </div>
            </form>
          </div>
          <!--End mc_embed_signup-->
          <?php elseif ( $okfn_mailinglist_bar_type == "mailman") : ?>
          <form method="post" action="<?php echo $okfn_mailinglist_action?>">
            <table width="100%">
              <tr>
                <th scope="row"><? if (!empty($okfn_mailinglist_heading)) { echo $okfn_mailinglist_heading;} else { echo 'Mailing List';} ?></th>
                <td>
                  <label><? echo __("Name", "okfn")?></label>
                  <input name="fullname" placeholder="<? echo __("Name", "okfn")?>" type="text">
                </td>
                <td>
                  <label><? echo __("Email Address", "okfn")?></label>
                  <input name="email" placeholder="<? echo __("Email Address", "okfn")?>" type="email">
                </td>
                <td class="announce">
                  <label class="checkbox">
                    <input type="checkbox" value="" disabled>
                    <? echo __("Receive newsletter", "okfn")?>
                  </label>
                </td>
                <td class="submit">
                  <input type="submit" name="email-button" value="<? echo __("Subscribe", "okfn")?>" class="button">
                </td>
              </tr>
            </table>
          </form>
         <? endif; ?>
        </div>
      </section>
    <? endif; ?>
    <header<? if ($okfn_subheader == "true"):?> class="has-subheader"<? endif; ?>>
      <div class="navbar">
        <div class="navbar-inner">
          <div class="container">
          <? if ($okfn_okf_ribbon == "true"):?>
            <div class="okfn-ribbon">
              <a href="http://okfn.org/" data-toggle="collapse" data-target="#okf-panel" title="Part of the Open Knowledge Foundation Network">An Open Knowledge Foundation Site</a>
            </div>
          <? endif; ?>
          <? if (($okfn_twitter_link == "true") or ($okfn_facebook_link == "true")) : ?>
            <div class="social-links">
              <?php if ( !empty( $okfn_twitter_username ) && $okfn_twitter_link == "true" && $okfn_twitter_location != "footer" ) : ?>
                <a class="twitter" href="https://twitter.com/<?php echo $okfn_twitter_username ?>">twitter</a>
              <? endif; ?>
              <?php if ( !empty( $okfn_facebook_username ) && $okfn_facebook_link == "true" && $okfn_facebook_location != "footer" ) : ?>
                <a class="facebook" href="http://www.facebook.com/<?php echo $okfn_facebook_username ?>">facebook</a>
              <? endif; ?>
            </div>
          <? endif; ?>
          
          <? if (!empty($okfn_header_textarea) && $okfn_header_text == "true") : ?>
            <div class="header-text"<? if ($okfn_header_text_align == "left") : ?> style="float:left; padding-left:0px; padding-right:5px;"<? endif; ?>>
              <? echo stripslashes($okfn_header_textarea); ?>
            </div>
          <? endif; ?>
          <? if (!empty($okfn_header_textarea2) && $okfn_header_text2 == "true") : ?>
            <div class="header-text"<? if ($okfn_header_text_align2 == "left") : ?> style="float:left; padding-left:0px; padding-right:5px;"<? endif; ?>>
              <? echo stripslashes($okfn_header_textarea2); ?>
            </div>
          <? endif; ?>
        
          <a title="<?php _ex( 'Home', 'Home page banner link title', 'buddypress' ); ?>" 
              class="brand" 
              href="<?php echo home_url(); ?>">
              
            <?php
              // Check for header image
              $header_image = get_header_image();
              if ( ! empty( $header_image ) && $okfn_logo_icon == "false" ) :
            ?>
              <img src="<?php header_image(); ?>" alt="logo" />
            <?php elseif ($okfn_logo_icon == "false") : ?>
              <img src="http://assets.okfn.org/web/images/header-logox2.png" alt="logo"/>
            <?php endif; ?>

            <?php if ( $okfn_logo_text == "false" ) : ?>
              <?php bp_site_name(); ?>
            <?php endif; ?>
          </a>
          
          <?
           if ($okfn_tagline_location == "header" && get_bloginfo( 'description' )) : ?>
             <span class="sub-brand">
              <?php echo bloginfo( 'description' ); ?>
             </span>
          <?php endif; ?>
          
            <nav>
              <?php  
                wp_nav_menu( array( 
                  'container' => false, 
                  'menu_class' => 'nav', 
                  'menu_id' => 'nav', 
                  'theme_location' => 'primary', 
                  'fallback_cb' => 'okfn_fallback_nav_menu' ) ) 
                ; ?>
            </nav>
            <!-- Disabled until I've got separate images and confirmed link addresses -->
          </div>
        </div>
        
      </div>

      <form action="<?php echo bp_search_form_action() ?>" method="post" class="search-form" role="search">
        <label for="search-terms" class="accessibly-hidden"><?php _e( 'Search for:', 'buddypress' ); ?></label>
        <input type="text" id="search-terms" name="search-terms" value="<?php echo isset( $_REQUEST['s'] ) ? esc_attr( $_REQUEST['s'] ) : ''; ?>" />

        <?php echo bp_search_form_type_select() ?>

        <input type="submit" name="search-submit" id="search-submit" value="<?php _e( 'Search', 'buddypress' ) ?>" />
        <?php wp_nonce_field( 'bp_search_form' ) ?>
      </form><!-- #search-form -->
      <?php do_action( 'bp_search_login_bar' ) ?>
      <?php do_action( 'bp_header' ) ?>
      
      <div class="sub-header">
        <div class="container">
        
        	<? if ($okfn_subheader == "true" && $okfn_subheader_search == "true" && !is_front_page()) : ?>
            <div class="search-bar">
              <?php do_action( 'bp_before_blog_search_form' ) ?>
              <form role="search" method="get" id="searchform" action="<?php echo home_url() ?>/">
                <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="Search" />
                <input type="submit" id="searchsubmit" value="<?php _e( 'Search', 'buddypress' ) ?>" />
                <?php do_action( 'bp_blog_search_form' ) ?>
              </form>
              <?php do_action( 'bp_after_blog_search_form' ) ?>
            </div>
					<? endif; ?>
          
          <?php
            //function_exists() — Return TRUE if the given function has been defined.
            //code by BOUTROS ABICHEDID. Adding breadcrumb trail to the WordPress theme.
            if (function_exists('wp_bac_breadcrumb') && $okfn_subheader == "true") {wp_bac_breadcrumb();}
          ?>
        </div>
      </div>
      
    </header>
		<?php do_action( 'bp_after_header' ) ?>

		
    
		 <?
      global $options;
      foreach ($options as $value) {
          if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
      }
     if ($okfn_tagline_location == "default" && get_bloginfo( 'description' )) : ?>
      <h2 id="site-description"></h2>
      <div class="container">
        <div class="strapline">
        <div class="inner">
          <?php echo bloginfo( 'description' ); ?>
        </div><!-- /inner     -->
        </div><!-- /strapline -->
      </div><!-- /container -->
    <?php elseif ($okfn_tagline_location == "home" && get_bloginfo( 'description' ) && is_front_page()) : ?>
      <div class="container">
        <div class="strapline">
          <div class="inner">
            <?php echo bloginfo( 'description' ); ?>
          </div><!-- /inner     -->
        </div><!-- /strapline -->
      </div><!-- /container -->
    <?php endif; ?>

		<?php do_action( 'bp_before_container' ) ?>
    <div class="container">


