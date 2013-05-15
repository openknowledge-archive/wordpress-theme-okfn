<!DOCTYPE HTML>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
		<?php
        /* Force our chosen version of jquery */
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', 'http://code.jquery.com/jquery-1.7.2.min.js');
      ?>
    <title>
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
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<? if (get_bloginfo( 'description' )) : ?>
    <meta name="description" content="<?php echo bloginfo( 'description' ); ?>" />
    <? endif; ?>
		<?php do_action( 'bp_head' ) ?>
    
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" />
		
		<?php
			if ( is_singular() && bp_is_blog_page() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			wp_head();
		?>
    <? if ($okfn_flags_sprite == "true") : ?>
      <link rel="stylesheet" type="text/css" href="http://cloud.github.com/downloads/lafeber/world-flags-sprite/flags16.css" />
      <link rel="stylesheet" type="text/css" href="http://cloud.github.com/downloads/lafeber/world-flags-sprite/flags32.css" />
    <? endif; ?>
    <link rel="stylesheet" href="<?php echo bloginfo('stylesheet_url') . '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>"/>
   
    <!-- Theme Settings -->
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
    <? if ($okfn_tall_header == "true") : ?>
      @media (min-width: 980px) {
				.navbar {
					height:65px;
				}
				.navbar .brand {
					line-height: 65px;
				}
				.navbar .brand img {
					margin-top:15px;
					height:35px;
				}
				.navbar .nav > li > a {
					padding: 24px 10px 22px 10px;
				}
				.navbar .sub-brand {
					line-height:60px;
					padding-top:5px;
				}
				.header-text {
					margin-top:15px;
				}
				.navbar .navbar-inner .social-links,
				.navbar .navbar-inner .header-search {
					margin-top:22px;
				}
			}
    <? endif; ?>
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
			#wpadminbar {display:none; }
			html {margin-top: 0px !important;}
    <? endif; ?>
    </style>
    
    <? if ($okfn_colours == "blue") : ?>
      <link rel="shortcut icon" href="http://assets.okfn.org/p/ckan/img/ckan.ico" />
    <?php elseif ($okfn_colours == "white" || $okfn_colours == "turquoise") : ?>
      <link rel="shortcut icon" href="http://assets.okfn.org/p/okfn/img/grey-favicon.ico" />
    <?php elseif ($okfn_colours == "school") : ?>
      <link rel="shortcut icon" href="http://assets.okfn.org/p/schoolofdata/img/favicon.ico" />
    <?php else: ?>
      <link rel="shortcut icon" href="http://assets.okfn.org/p/okfn/img/favicon.ico" />
    <? endif; ?>
    
    <script type="text/javascript">
      var Okfn = Okfn || {};
      // Make this variable available to Javascript
      Okfn.theme_directory = '<?php echo bloginfo('stylesheet_directory'); ?>';
    </script>
    
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
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
    
    <? if ($okfn_okf_ribbon !== "true") :?>
      <? do_action('okf_panel'); ?>
    <? endif; ?>
    <? if ( $okfn_mailinglist_bar_location == "header" && is_front_page() ) {
			include('mailing-bar.php'); 
		} ?>
    <header<? if ($okfn_subheader == "true"):?> class="has-subheader"<? endif; ?>>
      <div class="navbar<? if ($okfn_colours == "default") : ?> navbar-inverse<? endif; ?>">
        <div class="navbar-inner">
          <div class="container">
                    
          <? if ($okfn_okf_ribbon !== "true"):?>
            <? do_action('okf_ribbon'); ?>
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
          <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar collapsed">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
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
          
            <nav class="nav-collapse collapse">
              <? if (($okfn_header_search == "true") && ($okfn_subheader_search == "false")) : ?>
                <div class="header-search">
                  <a>Search</a>
                  <div class="search-bar">
                  <?php do_action( 'bp_before_blog_search_form' ) ?>
                  <form role="search" method="get" id="searchform" action="<?php echo home_url() ?>/">
                    <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="Search" />
                    <input type="submit" id="searchsubmit" value="<?php _e( 'Search', 'buddypress' ) ?>" />
                    <?php do_action( 'bp_blog_search_form' ) ?>
                  </form>
                  <?php do_action( 'bp_after_blog_search_form' ) ?>
                </div>
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
          <div class="row">
            <div class="span8">
              <?php
                //function_exists() — Return TRUE if the given function has been defined.
                //code by BOUTROS ABICHEDID. Adding breadcrumb trail to the WordPress theme.
                if (function_exists('wp_bac_breadcrumb') && $okfn_subheader == "true") {wp_bac_breadcrumb();}
              ?>
            </div>
            <div class="span4">
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
            </div>
          </div>
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
      <div class="row">

