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
		define( 'HEADER_IMAGE_WIDTH',  apply_filters( 'bp_dtheme_header_image_width',  60 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'bp_dtheme_header_image_height', 60  ) );


 // Theme options
    $themename = "OKFN Master Theme";
    $shortname = "okfn";
    $options = array (

		array(    "type" => "open"),
		
		array("name" => "Carousel Style",
        "id" => $shortname."_carosel",
        "type" => "radio",
        "desc" => "Change layout style of Bootstrap carousel",
        "options" => array("default" => "Default", "text-right" => "Text on Right"),
        "std" => "default"),
				
		array(    "type" => "close"),
		
		
		array(    "type" => "open"),
		
		array("name" => "Colour Scheme",
        "id" => $shortname."_colours",
        "type" => "radio",
        "desc" => "Change the colours of the nav bar, buttons etc",
        "options" => array("default" => "OKFN (Black and green)", "blue" => "CKAN (blue)"),
        "std" => "default"),
				
		array(    "type" => "close"),
		
		
		array(    "type" => "open"),
		
		array(  "name" => "Disable BuddyPress Bar?",
        "desc" => "Check this box if you would like to HIDE the BuddyPress bar at the top of this site.",
        "id" => $shortname."_buddypress_disable",
        "type" => "checkbox",
        "std" => "false"),

		array(    "type" => "close"),
		
		
		array(    "type" => "open"),
		
		array(  "name" => "Make my logo bigger!",
        "desc" => "Check this box to increase font size of site title. Useful when you have a short title. Only works when BuddyPress bar is disabled",
        "id" => $shortname."_large_title",
        "type" => "checkbox",
        "std" => "false"),

		array(    "type" => "close")

);

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
    
?>
<div class="wrap">
<h2><?php echo $themename; ?> settings</h2>

<form method="post">



<?php foreach ($options as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		?>
        <table width="100%" border="0" style="background-color:#ECECEC; padding:10px;">
		
        
        
		<?php break;
		
		case "close":
		?>
		
        </table><br />
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0" style="background-color:#dceefc; padding:5px 10px;"><tr>
        	<td colspan="3"><h3><?php echo $value['name']; ?></h3></td>
        </tr>
                
        
		<?php break;

		case 'text':
		?>
        
        <tr>
            <th scope="row" width="25%" align="left"><?php echo $value['name']; ?></th>
            <td><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
            </td>
            <td><em><?php echo $value['desc']; ?></em></td>
        </tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <th scope="row" width="25%" align="left"><?php echo $value['name']; ?></th>
            <td><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?></textarea>
            </td>
            <td><em><?php echo $value['desc']; ?></em></td>
        </tr>
		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <th scope="row" width="25%" align="left"><?php echo $value['name']; ?></th>
            <td><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select>
            </td>
            <td><em><?php echo $value['desc']; ?></em></td>
        </tr>

		<?php
        break;
            
		case "checkbox":
		?>
          <tr>
            <th scope="row" width="25%" align="left"><?php echo $value['name']; ?></th>
            <td><? if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
            </td>
            <td><em><?php echo $value['desc']; ?></em></td>
         </tr>
            
        <?php 		break;
				
				case "radio":?>
        <tr>
          <th scope="row" width="25%" align="left"><?php echo $value['name']; ?></th>
          <td>
						<? foreach ($value['options'] as $option_value => $option_text) {
							$checked = ' ';
							if (get_option($value['id']) == $option_value) {
									$checked = ' checked="checked" ';
							}
							else if (get_option($value['id']) === FALSE && $value['std'] == $option_value){
									$checked = ' checked="checked" ';
							}
							else {
									$checked = ' ';
							}
							echo '<div style="margin-bottom:5px;"><input type="radio" style="margin-right:10px;" name="'.$value['id'].'" value="'.
									$option_value.'" '.$checked."/>".$option_text."</div>";
					} ?>
      	</td>
          <td><em><?php echo $value['desc']; ?></em></td>
        </tr>
			  <?php break;
	
} 
}
?>

<!--</table>-->

<span class="submit" style="float:left; margin-right:10px; padding:0px;">
<input name="save" type="submit" value="Save changes" class="button-primary" />    
<input type="hidden" name="action" value="save" />
</span>
</form>
<form method="post">
<span class="submit" style="float:left; padding:0px;">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</span>
</form>

<?php
}

add_action('admin_menu', 'mytheme_add_admin'); ?>
<?php
if ( function_exists('register_sidebar') )
	register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '',
        'after_title' => '',
    ));


?>
