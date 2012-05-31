<?php

/* Make OKFN theme available for translation.
 * Translations can be added to the /languages/ directory.
 */
	//load_theme_textdomain( 'okfn', TEMPLATEPATH.'/languages' );
	load_child_theme_textdomain( 'okfn', get_stylesheet_directory() . '/languages' );
  load_child_theme_textdomain('buddypress', get_stylesheet_directory() .'/languages/bp-languages' );
	
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
    echo '<a href="'.get_permalink().'" class="btn btn-info">'.__("Full Post", "okfn").'</a> </div>';
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


		array(    "name" => "General Styling",
        "type" => "title"),
				
		array(    "type" => "open"),
		
		array("name" => "Colour Scheme",
        "id" => $shortname."_colours",
        "type" => "radio",
        "desc" => "Change the colours of the nav bar, buttons etc",
        "options" => array("default" => "Black (Default)", "grey" => "Grey (OKFN)", "blue" => "Blue (CKAN)"),
        "std" => "default"),
				
		array(    "type" => "close"),
		
		
		array(    "type" => "open"),
		
		array("name" => "Tagline Location",
        "id" => $shortname."_tagline_location",
        "type" => "radio",
        "desc" => "Where would you like the tagline to appear on the page?",
        "options" => array("default" => "Top of page", "header" => "In the header", "hide" => "Nowhere"),
        "std" => "default"),
				
		array(    "type" => "close"),
		
		
		array(    "name" => "TopBar",
        "type" => "title"),
		
		array(    "type" => "open"),
		
		array(  "name" => "ShareThis",
        "desc" => "Check this box to enable ShareThis in the TopBar.",
        "id" => $shortname."_sharethis",
        "type" => "checkbox",
        "std" => "false"),
		
		array(    "name" => "Publisher ID",
        "desc" => "If you have a ShareThis account, enter your publisher ID here.",
        "id" => $shortname."_sharethis_id",
        "std" => "",
        "type" => "text"),
				
		array(  "type" => "close"),
		
		array(    "type" => "open"),
		
		array(  "name" => "Disable TopBar?",
        "desc" => "Check this box if you would like to HIDE the BuddyPress bar at the top of this site.",
        "id" => $shortname."_buddypress_disable",
        "type" => "checkbox",
        "std" => "false"),

		array(    "type" => "close"),


		array(    "name" => "Header",
        "type" => "title"),
				
		array(    "type" => "open"),
		
		array(  "name" => "Make my logo bigger!",
        "desc" => "Check this box to increase font size of site title. Useful when you have a short title. Only works when BuddyPress bar is disabled.",
        "id" => $shortname."_large_title",
        "type" => "checkbox",
        "std" => "false"),

		array(    "type" => "close"),
		
		array(    "type" => "open"),
		
		array("name" => "Logo Font",
        "id" => $shortname."_logo_font",
        "type" => "radio",
        "desc" => "Font for header logo text",
        "options" => array("default" => "Open Sans", "ubuntu" => "Ubuntu"),
        "std" => "default"),
				
		array(    "type" => "close"),
		
		array(    "type" => "open"),
		
		array(  "name" => "Hide Logo Icon?",
        "desc" => "Check this box if you would like to HIDE the logo image.",
        "id" => $shortname."_logo_icon",
        "type" => "checkbox",
        "std" => "false"),

		array(    "type" => "close"),
		
		array(    "type" => "open"),
		
		array(  "name" => "Hide Logo Text?",
        "desc" => "Check this box if you would like to HIDE the logo text.",
        "id" => $shortname."_logo_text",
        "type" => "checkbox",
        "std" => "false"),

		array(    "type" => "close"),
		
		array(    "type" => "open"),
		
		array(  "name" => "Custom Header Text",
        "desc" => "Check this box to enable custom header text.",
        "id" => $shortname."_header_text",
        "type" => "checkbox",
        "std" => "false"),
		
		array(  "name" => "Header Text",
        "desc" => "Text or html to display in header.",
        "id" => $shortname."_header_textarea",
        "type" => "textarea"),
				
		array("name" => "Align",
        "id" => $shortname."_header_text_align",
        "type" => "radio",
        "desc" => "Which side of the header would you like this to appear?",
        "options" => array("left" => "Left", "right" => "Right"),
        "std" => "right"),
				
		array(  "type" => "close"),
		
		
		array(    "name" => "Sub-Header",
        "type" => "title"),
		
		array(    "type" => "open"),
		
		array(  "name" => "Sub-header Bar?",
        "desc" => "Check this box to display a bar below the header, inclusing breadcrumbs.",
        "id" => $shortname."_subheader",
        "type" => "checkbox",
        "std" => "false"),

		
		array(  "name" => "Search in Sub-header?",
        "desc" => "Check this box to display add a search field to the sub-header bar.",
        "id" => $shortname."_subheader_search",
        "type" => "checkbox",
        "std" => "false"),

		array(    "type" => "close"),
		
		
		array(    "name" => "Misc",
        "type" => "title"),
				
		array(    "type" => "open"),
		
		array("name" => "Carousel Style",
        "id" => $shortname."_carosel",
        "type" => "radio",
        "desc" => "Change layout style of Bootstrap carousel",
        "options" => array("default" => "Default", "text-right" => "Text on Right"),
        "std" => "default"),
				
		array(    "type" => "close"),
		
		array(    "type" => "open"),
		
		array(  "name" => "Tagline in meta title?",
        "desc" => "Check this box to append site title with tagline in the meta title tag.",
        "id" => $shortname."_tagline_title",
        "type" => "checkbox",
        "std" => "false"),

		array(    "type" => "close"),
		
		
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

    add_theme_page($themename." Options", "".$themename." Options", 'switch_themes', basename(__FILE__), 'mytheme_admin');

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
        <table width="100%" border="0" style="background-color:#FFFFFF; padding:10px; border-bottom:solid 1px #ECECEC;">
		
        
        
		<?php break;
		
		case "close":
		?>
		
        </table>
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0" style="background-color:#ECECEC; padding:0px 10px;"><tr>
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
        
        <?php $input = get_settings( $value['id'] ); $output = stripslashes ($input); ?>
				<tr>
          <th scope="row" width="25%" align="left"><?php echo $value['name']; ?></th>
          <td><textarea name="<?php echo $value['id']; ?>" cols="70" rows="5"><?php if ( get_settings( $value['id'] ) != "") { echo $output; } else { echo $value['std']; } ?></textarea></td>
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




/***********************************************************************
* @Author: Boutros AbiChedid
* @Date:   February 14, 2011
* @Copyright: Boutros AbiChedid (http://bacsoftwareconsulting.com/)
* @Licence: Feel free to use it and modify it to your needs but keep the
* Author's credit. This code is provided 'as is' without any warranties.
* @Function Name:  wp_bac_breadcrumb()
* @Version:  1.0 -- Tested up to WordPress version 3.1.2
* @Description: WordPress Breadcrumb navigation function. Adding a
* breadcrumb trail to the theme without a plugin.
* This code does not support multi-page split numbering, attachments,
* custom post types and custom taxonomies.
***********************************************************************/
 
function wp_bac_breadcrumb() {
    //Variable (symbol >> encoded) and can be styled separately.
    //Use >> for different level categories (parent >> child >> grandchild)
            $delimiter = '<span class="delimiter">/</span>';
    //Use bullets for same level categories ( parent . parent )
    $delimiter1 = '<span class="delimiter1"> &bull; </span>';
 
    //text link for the 'Home' page
            $main = 'Home';
    //Display only the first 30 characters of the post title.
            $maxLength= 30;
 
    //variable for archived year
    $arc_year = get_the_time('Y');
    //variable for archived month
    $arc_month = get_the_time('F');
    //variables for archived day number + full
    $arc_day = get_the_time('d');
    $arc_day_full = get_the_time('l'); 
 
    //variable for the URL for the Year
    $url_year = get_year_link($arc_year);
    //variable for the URL for the Month
    $url_month = get_month_link($arc_year,$arc_month);
 
    /*is_front_page(): If the front of the site is displayed, whether it is posts or a Page. This is true
    when the main blog page is being displayed and the 'Settings > Reading ->Front page displays'
    is set to "Your latest posts", or when 'Settings > Reading ->Front page displays' is set to
    "A static page" and the "Front Page" value is the current Page being displayed. In this case
    no need to add breadcrumb navigation. is_home() is a subset of is_front_page() */
 
    //Check if NOT the front page (whether your latest posts or a static page) is displayed. Then add breadcrumb trail.
    if (!is_front_page()) {
        //If Breadcrump exists, wrap it up in a div container for styling.
        //You need to define the breadcrumb class in CSS file.
        echo '<ul class="breadcrumb">';
 
        //global WordPress variable $post. Needed to display multi-page navigations.
        global $post, $cat;
        //A safe way of getting values for a named option from the options database table.
        $homeLink = get_option('home'); //same as: $homeLink = get_bloginfo('url');
        //If you don't like "You are here:", just remove it.
        echo '<li><a href="' . $homeLink . '">' . $main . '</a></li>' . $delimiter;   
 
        //Display breadcrumb for single post
        if (is_single()) { //check if any single post is being displayed.
            //Returns an array of objects, one object for each category assigned to the post.
            //This code does not work well (wrong delimiters) if a single post is listed
            //at the same time in a top category AND in a sub-category. But this is highly unlikely.
            $category = get_the_category();
            $num_cat = count($category); //counts the number of categories the post is listed in.
 
            //If you have a single post assigned to one category.
            //If you don't set a post to a category, WordPress will assign it a default category.
            if ($num_cat <=1)  //I put less or equal than 1 just in case the variable is not set (a catch all).
            {
                echo get_category_parents($category[0],  true,' ' . $delimiter . ' ');
                //Display the full post title.
                echo ' ' . get_the_title();
            }
            //then the post is listed in more than 1 category.
            else {
                //Put bullets between categories, since they are at the same level in the hierarchy.
                echo the_category( $delimiter1, multiple);
                    //Display partial post title, in order to save space.
                    if (strlen(get_the_title()) >= $maxLength) { //If the title is long, then don't display it all.
                        echo ' ' . $delimiter . trim(substr(get_the_title(), 0, $maxLength)) . ' ...';
                    }
                    else { //the title is short, display all post title.
                        echo ' ' . $delimiter . get_the_title();
                    }
            }
        }
        //Display breadcrumb for category and sub-category archive
        elseif (is_category()) { //Check if Category archive page is being displayed.
            //returns the category title for the current page.
            //If it is a subcategory, it will display the full path to the subcategory.
            //Returns the parent categories of the current category with links separated by '»'
            echo 'Archive Category: "' . get_category_parents($cat, true,' ' . $delimiter . ' ') . '"' ;
        }
        //Display breadcrumb for tag archive
        elseif ( is_tag() ) { //Check if a Tag archive page is being displayed.
            //returns the current tag title for the current page.
            echo 'Posts Tagged: "' . single_tag_title("", false) . '"';
        }
        //Display breadcrumb for calendar (day, month, year) archive
        elseif ( is_day()) { //Check if the page is a date (day) based archive page.
            echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . ' ';
            echo '<a href="' . $url_month . '">' . $arc_month . '</a> ' . $delimiter . $arc_day . ' (' . $arc_day_full . ')';
        }
        elseif ( is_month() ) {  //Check if the page is a date (month) based archive page.
            echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . $arc_month;
        }
        elseif ( is_year() ) {  //Check if the page is a date (year) based archive page.
            echo $arc_year;
        }
        //Display breadcrumb for search result page
        elseif ( is_search() ) {  //Check if search result page archive is being displayed.
            echo 'Search Results for: "' . get_search_query() . '"';
        }
        //Display breadcrumb for top-level pages (top-level menu)
        elseif ( is_page() && !$post->post_parent ) { //Check if this is a top Level page being displayed.
            echo get_the_title();
        }
        //Display breadcrumb trail for multi-level subpages (multi-level submenus)
        elseif ( is_page() && $post->post_parent ) {  //Check if this is a subpage (submenu) being displayed.
            //get the ancestor of the current page/post_id, with the numeric ID
            //of the current post as the argument.
            //get_post_ancestors() returns an indexed array containing the list of all the parent categories.
            $post_array = get_post_ancestors($post);
 
            //Sorts in descending order by key, since the array is from top category to bottom.
            krsort($post_array);
 
            //Loop through every post id which we pass as an argument to the get_post() function.
            //$post_ids contains a lot of info about the post, but we only need the title.
            foreach($post_array as $key=>$postid){
                //returns the object $post_ids
                $post_ids = get_post($postid);
                //returns the name of the currently created objects
                $title = $post_ids->post_title;
                //Create the permalink of $post_ids
                echo '<a href="' . get_permalink($post_ids) . '">' . $title . '</a>' . $delimiter;
            }
            the_title(); //returns the title of the current page.
        }
        //Display breadcrumb for author archive
        elseif ( is_author() ) {//Check if an Author archive page is being displayed.
            global $author;
            //returns the user's data, where it can be retrieved using member variables.
            $user_info = get_userdata($author);
            echo  'Archived Article(s) by Author: ' . $user_info->display_name ;
        }
        //Display breadcrumb for 404 Error
        elseif ( is_404() ) {//checks if 404 error is being displayed
            echo  'Error 404 - Not Found.';
        }
        else {
            //All other cases that I missed. No Breadcrumb trail.
        }
       echo '</ul>';
    }
}

include('shortcodes.php');

?>
