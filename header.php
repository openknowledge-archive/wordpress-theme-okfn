<!DOCTYPE HTML>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
  <head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
    <?php

    /* Force our chosen version of jquery */
    wp_deregister_script('jquery');
    wp_register_script('jquery', '//code.jquery.com/jquery-1.7.2.min.js');

    ?>
    <title>
      <?php

      wp_title('|', true, 'right');
      bloginfo('name');

      ?>
      <?php

      global $options;
      foreach ($options as $value) {
        if (get_option($value['id']) === FALSE) {
          $$value['id'] = $value['std'];
        } else {
          $$value['id'] = get_option($value['id']);
        }
      }
      if ($okfn_tagline_title == "true" && get_bloginfo('description')) :

        ?>
        - <?php echo bloginfo('description'); ?>
      <?php endif; ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <?php if (get_bloginfo('description')) : ?>
        <meta name="description" content="<?php echo bloginfo('description'); ?>" />
      <?php endif; ?>
      <?php do_action('bp_head') ?>

      <link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />

      <?php

      if (is_singular() && bp_is_blog_page() && get_option('thread_comments')):
        wp_enqueue_script('comment-reply');
      endif;

      wp_head();

      if ($okfn_flags_sprite == "true") :

        wp_enqueue_style('flags16', '//cloud.github.com/downloads/lafeber/world-flags-sprite/flags16.css');
        wp_enqueue_style('flags32', '//cloud.github.com/downloads/lafeber/world-flags-sprite/flags32.css');
      endif;

      wp_enqueue_style('wordpress-theme-okfn', get_stylesheet_uri(), array(), filemtime(get_stylesheet_directory() . '/style.css'));

      ?>

      <!-- Theme Settings -->
      <?php

      if ($okfn_subheader == "true") :
        wp_enqueue_style('okfn-sub-header', get_stylesheet_directory_uri() . '/css/sub-header.css', array(), '1');
      endif;

      if ($okfn_colours == "blue") :
        wp_enqueue_style('okfn-blue', get_stylesheet_directory_uri() . '/css/blue.css', array(), '1.1.1');
      elseif ($okfn_colours == "grey") :
        wp_enqueue_style('okfn-grey', get_stylesheet_directory_uri() . '/css/grey.css', array(), '1.1.2');
      elseif ($okfn_colours == "white") :
        wp_enqueue_style('okfn-white', get_stylesheet_directory_uri() . '/css/white.css', array(), '1.1.0');
      elseif ($okfn_colours == "turquoise") :
        wp_enqueue_style('okfn-turquoise', get_stylesheet_directory_uri() . '/css/turquoise.css', array(), '1.1.0');
      elseif ($okfn_colours == "school") :
        wp_enqueue_style('okfn-school', get_stylesheet_directory_uri() . '/css/school.css', array(), '1.1.2');
      endif;

      ?>

      <style type="text/css">
<?php if ($okfn_tall_header == "true") : ?>
          @media (min-width: 980px) {
            .navbar{
              max-height: 65px;
            }
            .navbar .brand {
              line-height: 65px;
            }
            .navbar .brand img {
              margin-top:15px;
              height:35px;
            }
            .navbar .nav > li > a {
              padding-top:24px;
              padding-bottom:22px;
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
<?php endif; ?>
<?php if ($okfn_large_title == "true" && $okfn_tall_header == "true") : ?>
          .navbar .brand {font-size: 36px; letter-spacing:-1px; text-indent:-5px; line-height: 62px;}
<?php endif; ?>
<?php if ($okfn_logo_font == "ubuntu") : ?>
          @import url(//fonts.googleapis.com/css?family=Ubuntu);
          .navbar .brand {font-family: 'Ubuntu', sans-serif; font-weight:400;}
<?php endif; ?>
<?php if ($okfn_subheader == "true" && !is_front_page()) : ?>
          .navbar-inner {border-bottom:none;}
<?php endif; ?>
<?php if ($okfn_buddypress_disable == "true") : ?>
          #wpadminbar {display:none; }
          html {margin-top: 0px !important;}
<?php endif; ?>
      </style>

      <?php

      if (!empty($okfn_favicon)) {
        $favicon_url = $okfn_favicon;
      } elseif ($okfn_colours == "blue") {
        $favicon_url = '//assets.okfn.org/p/ckan/img/ckan.ico';
      } elseif ($okfn_colours == "white" || $okfn_colours == "turquoise") {
        $favicon_url = '//assets.okfn.org/p/okfn/img/grey-favicon.ico';
      } elseif ($okfn_colours == "school") {
        $favicon_url = '//assets.okfn.org/p/schoolofdata/img/favicon.ico';
      } else {
        $favicon_url = '//assets.okfn.org/p/okfn/img/favicon.ico';
      }

      ?>
      <link rel="shortcut icon" href="<?php echo $favicon_url; ?>" />

      <script type="text/javascript">
        var Okfn = Okfn || {};
        // Make this variable available to Javascript
        Okfn.theme_directory = '<?php echo get_stylesheet_directory_uri(); ?>';
      </script>

      <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->

      <?php if (!empty($okfn_facebook_username)) : ?>
        <meta property="og:type" content="article" />
        <meta property="article:publisher" content="https://www.facebook.com/<?php echo $okfn_facebook_username ?>" />
      <?php endif; ?>

  </head>

  <body <?php body_class() ?> id="bp-default">
    <?php

    /* Javascript includes */
    do_action('bp_before_header')

    ?>
    <?php

    if (!empty($okfn_corner_ribbon_text) && $okfn_corner_ribbon == "true") {
      echo '
      <a class="corner ribbon" href="' . stripslashes($okfn_corner_ribbon_link) . '" >
        ' . stripslashes($okfn_corner_ribbon_text) . '
      </a>';
    }

    ?>

    <?php if ($okfn_okf_ribbon !== "true") : ?>
      <?php do_action('okf_panel'); ?>
    <?php endif; ?>
    <?php

    if ($okfn_mailinglist_bar_location == "header" && is_front_page()) {
      include('mailing-bar.php');
    }

    ?>
    <header<?php if ($okfn_subheader == "true"): ?> class="has-subheader"<?php endif; ?>>
      <div class="navbar<?php if ($okfn_colours == "default") : ?> navbar-inverse<?php endif; ?>">
        <div class="navbar-inner">
          <div class="container">

            <?php if ($okfn_okf_ribbon !== "true"): ?>
              <?php do_action('okf_ribbon'); ?>
            <?php endif; ?>

            <?php if (!empty($okfn_header_textarea) && $okfn_header_text == "true") : ?>
              <div class="header-text"<?php if ($okfn_header_text_align == "left") : ?> style="float:left; padding-left:0px; padding-right:5px;"<?php endif; ?>>
                <?php echo stripslashes($okfn_header_textarea); ?>
              </div>
            <?php endif; ?>
            <?php if (!empty($okfn_header_textarea2) && $okfn_header_text2 == "true") : ?>
              <div class="header-text"<?php if ($okfn_header_text_align2 == "left") : ?> style="float:left; padding-left:0px; padding-right:5px;"<?php endif; ?>>
                <?php echo stripslashes($okfn_header_textarea2); ?>
              </div>
            <?php endif; ?>
            <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar collapsed">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            <a title="<?php _ex('Home', 'Home page banner link title', 'buddypress'); ?>"
               class="brand"
               href="<?php echo home_url(); ?>">

              <?php

              // Check for header image
              $header_image = get_header_image();
              if (!empty($header_image) && $okfn_logo_icon == "false") :

                ?>
                <img src="<?php header_image(); ?>" alt="logo" />
              <?php elseif ($okfn_logo_icon == "false") : ?>
                <img src="//assets.okfn.org/web/images/header-logox2.png" alt="logo"/>
              <?php endif; ?>

              <?php if ($okfn_logo_text == "false") : ?>
                <?php bp_site_name(); ?>
              <?php endif; ?>
            </a>

            <?php if ($okfn_tagline_location == "header" && get_bloginfo('description')) : ?>
              <span class="sub-brand">
                <?php echo bloginfo('description'); ?>
              </span>
            <?php endif; ?>

            <nav class="nav-collapse collapse">
              <?php if (($okfn_header_search == "true") && ($okfn_subheader_search == "false")) : ?>
                <div class="header-search">
                  <a>Search</a>
                  <div class="search-bar">
                    <?php do_action('bp_before_blog_search_form') ?>
                    <form role="search" method="get" id="searchform" action="<?php echo home_url() ?>/">
                      <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="Search" />
                      <input type="submit" id="searchsubmit" value="<?php _e('Search', 'buddypress') ?>" />
                      <?php do_action('bp_blog_search_form') ?>
                    </form>
                    <?php do_action('bp_after_blog_search_form') ?>
                  </div>
                </div>
              <?php endif; ?>
              <?php if (($okfn_twitter_link == "true") or ( $okfn_facebook_link == "true")) : ?>
                <div class="social-links">
                  <?php if (!empty($okfn_twitter_username) && $okfn_twitter_link == "true" && $okfn_twitter_location != "footer") : ?>
                    <a class="twitter" href="https://twitter.com/<?php echo $okfn_twitter_username ?>">twitter</a>
                  <?php endif; ?>
                  <?php if (!empty($okfn_facebook_username) && $okfn_facebook_link == "true" && $okfn_facebook_location != "footer") : ?>
                    <a class="facebook" href="https://www.facebook.com/<?php echo $okfn_facebook_username ?>">facebook</a>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              <?php

              wp_nav_menu(array(
                'container' => false,
                'menu_class' => 'nav',
                'menu_id' => 'nav',
                'theme_location' => 'primary',
                'fallback_cb' => 'okfn_fallback_nav_menu'));

              ?>
            </nav>
            <!-- Disabled until I've got separate images and confirmed link addresses -->
          </div>
        </div>

      </div>

      <form action="<?php echo bp_search_form_action() ?>" method="post" class="search-form" role="search">
        <label for="search-terms" class="accessibly-hidden"><?php _e('Search for:', 'buddypress'); ?></label>
        <input type="text" id="search-terms" name="search-terms" value="<?php echo isset($_REQUEST['s']) ? esc_attr($_REQUEST['s']) : ''; ?>" />

        <?php echo bp_search_form_type_select() ?>

        <input type="submit" name="search-submit" id="search-submit" value="<?php _e('Search', 'buddypress') ?>" />
        <?php wp_nonce_field('bp_search_form') ?>
      </form><!-- #search-form -->
      <?php do_action('bp_search_login_bar') ?>
      <?php do_action('bp_header') ?>

      <div class="sub-header">
        <div class="container">
          <div class="row">
            <div class="span8">
              <?php

              //function_exists() — Return TRUE if the given function has been defined.
              //code by BOUTROS ABICHEDID. Adding breadcrumb trail to the WordPress theme.
              if (function_exists('wp_bac_breadcrumb') && $okfn_subheader == "true") {
                wp_bac_breadcrumb();
              }

              ?>
            </div>
            <div class="span4">
              <?php if ($okfn_subheader == "true" && $okfn_subheader_search == "true" && !is_front_page()) : ?>
                <div class="search-bar">
                  <?php do_action('bp_before_blog_search_form') ?>
                  <form role="search" method="get" id="searchform" action="<?php echo home_url() ?>/">
                    <input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="Search" />
                    <input type="submit" id="searchsubmit" value="<?php _e('Search', 'buddypress') ?>" />
                    <?php do_action('bp_blog_search_form') ?>
                  </form>
                  <?php do_action('bp_after_blog_search_form') ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

    </header>
    <?php do_action('bp_after_header') ?>



    <?php

    global $options;
    foreach ($options as $value) {
      if (array_key_exists('id', $value)) {
        if (get_option($value['id']) === FALSE) {
          if (array_key_exists('std', $value)) {
            $$value['id'] = $value['std'] or NULL;
          }
        } else {
          $$value['id'] = get_option($value['id']);
        }
      }
    }
    if ($okfn_tagline_location == "default" && get_bloginfo('description')) :

      ?>
      <h2 id="site-description"></h2>
      <div class="container">
        <div class="strapline">
          <div class="inner">
            <?php echo bloginfo('description'); ?>
          </div><!-- /inner     -->
        </div><!-- /strapline -->
      </div><!-- /container -->
    <?php elseif ($okfn_tagline_location == "home" && get_bloginfo('description') && is_front_page()) : ?>
      <div class="container">
        <div class="strapline">
          <div class="inner">
            <?php echo bloginfo('description'); ?>
          </div><!-- /inner     -->
        </div><!-- /strapline -->
      </div><!-- /container -->
    <?php endif; ?>

    <?php do_action('bp_before_container') ?>
    <div class="container">

