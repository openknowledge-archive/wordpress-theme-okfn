<?php
/* 
 * Register a series of DOM-manipulating filters.
 */
add_filter('bp_sidebar_login_form', 'filter_login_form');
add_filter('wp_nav_menu', 'filter_nav_menu'); 
add_filter('comment_form', 'filter_comment_form'); 

/*
 * Use the simple_html_dom library to perform 
 * easy manipulations on wordpress' output.
 */
include('simple_html_dom.php');

/*
 * Disable the parent theme's stylesheets. We work from scratch.
 */
if ( !function_exists( 'bp_dtheme_enqueue_styles' ) ) :
    function bp_dtheme_enqueue_styles() {}
endif;

/*
 * Modify the DOM to enable bootstrap dropdown menus.
 */
function filter_nav_menu( $header ) {

  $header = str_get_html($header);
  foreach ($header->find('li') as $li) {
    // "current-menu-item" is marked as "active" for bootstra
    if (stristr($li->class, "current-menu-item")) {
      $li->class .= " active";
    }
    // Any <li> containing a <ul> gets a special class
    $isDropdown = count($li->find('ul')) > 0;
    if ($isDropdown) {
      $li->class.=" dropdown";
      $tag = 'data-dropdown';
      $li->$tag = "dropdown";
      $li->find('a',0)->class.=" dropdown-toggle";
      $li->find('ul',0)->class.=" dropdown-menu";
    }
  }

  return $header;
}

function filter_login_form() {
  // Add a gorgeous Bootstrap button
  echo '<input type="submit" class="btn primary" name="wp-submit" id="sidebar-wp-submit-custom" value="Log In" tabindex="100" />';
  // Hide the ugly existing button
  echo '<style type="text/css">#sidebar-wp-submit { display: none; }</style>';
}
function filter_comment_form() {
  // Add a gorgeous Bootstrap button
  echo '<input name="submit" type="submit" id="submit-custom" class="btn primary" value="Post Comment" />';
  // Hide the ugly existing button
  echo '<style type="text/css">input[type="submit"]#submit { display: none; }</style>';
}
							

function filter_buttons_primary($widget) {
  // Add 'class="btn"'
  $widget = preg_replace('/(type="submit")/i', '$1 class="btn primary"', $widget);
  return $widget;
}

function test($a) {
  echo "<br><br><hr><pre style=\"background: #fcf;\">".htmlspecialchars($a)."</pre><hr><br><br>";
}

/* Taken from buddypress:functions.php.bp_dtheme_main_nav */
function okfn_fallback_nav_menu( $args ) {
	global $bp;

	$pages_args = array(
		'depth'      => 0,
		'echo'       => false,
		'exclude'    => '',
		'title_li'   => ''
	);
	$menu = wp_page_menu( $pages_args );
	$menu = str_replace( array( '<div class="menu"><ul>', '</ul></div>' ), array( '<ul id="nav" class="nav">', '</ul><!-- #nav -->' ), $menu );
	echo $menu;

	do_action( 'bp_nav_items' );
}


?>
