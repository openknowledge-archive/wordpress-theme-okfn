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
function choose_best_category( $categories) {
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

function echo_magazine_post($post, $is_featured) {
    $post_class = $is_featured ? 'featured' : 'preview';
    $post_category = choose_best_category( array( get_the_category()) );
    // Extract the first img src from the post body
    $regex = '/magazine.image\s*=\s*"?([^"\s]*)/';
    preg_match($regex, get_the_content(), $matches);
    $post_img = 'http://assets.okfn.org/web/images/blog-placeholder.png';
    if (count($matches)) $post_img = $matches[1];
    echo '<div class="box post '.$post_class.'">';
    echo '<div class="padder"> <a class="image" href="'.get_permalink().'" style="background-image:url('.$post_img.');"></a>';
    echo '<div class="text">';
    echo '<h2><a href="'.get_permalink().'"rel="bookmark">'; the_title(); echo '</a></h2>';
    echo '<span class="entry-meta"> Posted on '; 
    printf( __( '%1$s <span>in %2$s</span>', 'buddypress' ), get_the_date(), get_the_category_list( ', ' ) );
    echo 'by ' . bp_core_get_userlink( $post->post_author );
    echo '</span>';
    echo the_excerpt();
    echo '</div>';
    echo '<a href="'.get_permalink().'" class="btn btn-info">Full Post</a> </div>';
    echo '<h3 class="ribbon">';
    echo $post_category;
    echo '</h3>';
    echo '</div>';
}


 // The height and width of your custom header. You can hook into the theme's own filters to change these values.
 // Add a filter to bp_dtheme_header_image_width and bp_dtheme_header_image_height to change these values.
		define( 'HEADER_IMAGE_WIDTH',  apply_filters( 'bp_dtheme_header_image_width',  30 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'bp_dtheme_header_image_height', 30  ) );

?>
