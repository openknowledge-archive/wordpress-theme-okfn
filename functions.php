<?php
/* 
 * Register a series of DOM-manipulating filters.
 */
add_filter('wp_nav_menu', 'filter_nav_menu'); 
add_filter('bp_before_account_details_fields', 'register_form_blurb'); 

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

/* Taken from buddypress:functions.php.bp_dtheme_main_nav. Used by header.php */
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

function register_form_blurb( $args ) {
  echo "<p>Community Membership is a way of &quot;opting in&quot; and publicly acknowledging a connnection with the Open Knowledge Foundation and support for its activities."
    ." It entails no specific obligations (nor confers specific rights!) and anyone may join.</p>"
    ."<p><a href=\"/governance/#community-membership\">Read more about Community Membership &raquo;</a></p>";
}

/* 
 * Choose the "best" category (ie. most 
 * important) category from multiple categories.
 *
 * This will be displayed on a post tab.
 */
function best_category( $categories) {
  // Cannot fathom why my array comes inside an array...
  $categories = $categories[0];
  include('category-priority.php');

  // Choose the first category I have in the priority list
  $first = null;
  foreach ($category_priority as $priority) {
    foreach ($categories as $category) {
      if ($priority == $category->name) 
        return $category->name;
    }
  }
  return $categories[0]->name;
  // I have no special categories. Just choose the first one.
  return '???';
};


?>
