<!DOCTYPE HTML>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head>
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
		
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
    <link rel="stylesheet" href="<?php echo bloginfo('stylesheet_url') . '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>"/>
    
    <?
      global $options;
      foreach ($options as $value) {
          if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
      }
      if ($okfn_colours == "blue") : ?>
        <link rel="shortcut icon" href="http://assets.okfn.org/p/ckan/img/ckan.ico" />
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
  
    <!-- Theme Settings -->
    <?
     if ($okfn_buddypress_disable == "true") : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/nobuddypress.css"/>
    <? endif; ?>
    <?
     if ($okfn_buddypress_disable == "true" && $okfn_buddypress_slim == "false") : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/tall-header.css"/>
    <? endif; ?>
    <? if ($okfn_carosel == "text-right") : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/theme-okfn/css/carousels/text-right.css"/>
    <? endif; ?>
    <? if ($okfn_subheader == "true") : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/sub-header.css"/>
    <? endif; ?>
    <? if ($okfn_colours == "blue") : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/blue.css"/>
    <?php elseif ($okfn_colours == "grey") : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/grey.css"/>
    <? endif; ?>
    <? if ($okfn_large_title == "true" && $okfn_buddypress_disable == "true") : ?>
      <style type="text/css">.navbar .brand {font-size: 36px; letter-spacing:-1px; text-indent:-5px; line-height: 62px;}</style>
    <? endif; ?>
    <? if ($okfn_logo_font == "ubuntu") : ?>
      <link href='http://fonts.googleapis.com/css?family=Ubuntu:400' rel='stylesheet' type='text/css'>
      <style type="text/css">.navbar .brand {font-family: 'Ubuntu', sans-serif; font-weight:400;}</style>
    <? endif; ?>
    <? if ($okfn_subheader == "true" && !is_front_page()) : ?>
      <style type="text/css">.navbar-inner {border-bottom:none;}</style>
    <? endif; ?>
    <? if (is_front_page()) : ?>
      <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/include/jquery.zcarousel.css"/>
      <script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/include/spin.min.js"></script>
      <script src="<?php echo get_bloginfo('stylesheet_directory'); ?>/include/jquery.zcarousel.min.js"></script>
    <? endif; ?>
  </head>
  
	<body <?php body_class() ?> id="bp-default">
    <?php 
      /* Javascript includes */
      do_action( 'bp_before_header' ) 
    ?>

    <header<? if ($okfn_subheader == "true"):?> class="has-subheader"<? endif; ?>>
      <div class="navbar">
        <div class="navbar-inner">
          <div class="container">
          <? if (($okfn_twitter_link == "true") or ($okfn_facebook_link == "true")) : ?>
            <div class="social-links">
              <?php if ( !empty( $okfn_twitter_username ) && $okfn_twitter_link == "true" ) : ?>
                <a class="twitter" href="https://twitter.com/<?php echo $okfn_twitter_username ?>">twitter</a>
              <? endif; ?>
              <?php if ( !empty( $okfn_facebook_username ) && $okfn_facebook_link == "true" ) : ?>
                <a class="facebook" href="http://www.facebook.com/<?php echo $okfn_facebook_username ?>">facebook</a>
              <? endif; ?>
            </div>
          <? endif; ?>
          
          <? if ($okfn_header_textarea && $okfn_header_text == "true") : ?>
            <div class="header-text"<? if ($okfn_header_text_align == "left") : ?> style="float:left; padding-left:0px; padding-right:5px;"<? endif; ?>>
              <? echo stripslashes($okfn_header_textarea); ?>
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
    <?php endif; ?>

		<?php do_action( 'bp_before_container' ) ?>
    <div class="container">


