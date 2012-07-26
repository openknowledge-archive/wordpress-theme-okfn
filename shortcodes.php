<?php
/*********************************************************************************************
* Name:        Pseudo Sidebar
* Author:      Sam Smith
* Description: Use to insert a sidebar into a single column page
* Example:     [pseudocontent] ...Left Content... [/pseudocontent]
               [pseudosidebar] ...Right Content... [/pseudosidebar]
**********************************************************************************************/

function pseudocontent_shortcode( $atts, $content = null ) {
   return '<style type="text/css">#content {width: 100%;} #content #sidebar h5 {margin-top:0px;}</style>
<article style="display: inline-block; width: 680px;">' .do_shortcode($content).  '</article>';
} 
add_shortcode( 'pseudocontent', 'pseudocontent_shortcode' );

function pseudosidebar_shortcode( $atts, $content = null ) {
   return '<div id="sidebar" role="complementary" style="margin-top:-56px;">' . $content . '</div>';
} 
add_shortcode( 'pseudosidebar', 'pseudosidebar_shortcode' );



/*********************************************************************************************
* Name:        Carousel
* Author:      Sam Smith
* Description: Use to insert a Bootstrap carousel
* Example:     [carousel]
               [slide img="http://slide1.jpg" class="active"]
							 [slide img="http://slide2.jpg" caption="Caption Two"]
							 [slide img="http://slide3.jpg" heading="Heading Three" caption="Caption Three"]
							 [/carousel]
**********************************************************************************************/

function carousel_shortcode( $atts, $content = null ) {
	
   return '<div id="myCarousel" class="carousel"><div class="carousel-inner">' .do_shortcode($content). '</div><a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a><a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a></div>';
} 
add_shortcode( 'carousel', 'carousel_shortcode' );

function carousel_slide_shortcode( $atts ) {  
	extract( shortcode_atts( array(
			'img' => 'http://farm8.staticflickr.com/7174/6554801385_83acdc501d_o_d.png',
			'caption' => '',
			'class' => '',
			'heading' => '',
		), $atts ) );
		
		if(!empty($caption) && !empty($heading) ){
			return '<div class="item ' .$class. '"><img src="' .$img. '">
								<div class="carousel-caption">
									<h2>' .$heading. '</h2>
									' .$caption. '
								</div>
							</div>'; 
		}
		else if (!empty($caption)) {
			//return '<div class="item ' .$class. '" style="background-image:url('.$img.')"><img src="' .$img. '">
			return '<div class="item ' .$class. '"><img src="' .$img. '">
								<div class="carousel-caption">
									' .$caption. '
								</div>
							</div>'; 
		}
		else {
			return '<div class="item ' .$class. '"><img src="' .$img. '">
			        </div>'; 
		}
}  
add_shortcode('slide', 'carousel_slide_shortcode');  


/*********************************************************************************************
* Name:        ZCarousel
* Author:      Tom Rees
* Description: Use to insert a zcarousel (http://zephod.github.com/jquery.zcarousel)
* Example:     [zcarousel]
               [zslide img="http://slide1.jpg" ] Caption here [/zslide]
							 [zslide img="http://slide2.jpg" ] Another caption here [/zslide]
							 [zslide img="http://slide3.jpg" ] Also here [/zslide]
							 [/zcarousel]
**********************************************************************************************/

function zcarousel_shortcode( $atts, $content = null ) {
   return '<div id="zcarousel" style="width: 940px; height: 250px; "></div><script>var data=[];' .do_shortcode($content). 'jQuery("#zcarousel").zcarousel(data);</script>';
} 
add_shortcode( 'zcarousel', 'zcarousel_shortcode' );

function zcarousel_slide_shortcode( $atts, $content = null ) {  
	extract( shortcode_atts( array(
			'img' => 'http://farm8.staticflickr.com/7174/6554801385_83acdc501d_o_d.png',
		), $atts ) );
  return 'data.push({"url":"' .$img. '","caption":"' .$content. '"});';
}  
add_shortcode('zslide', 'zcarousel_slide_shortcode');  


/*********************************************************************************************
* Name:        Hide Page Title
* Author:      Sam Smith
* Description: Use to hide the page title
**********************************************************************************************/

function notitle_shortcode( $atts ){
 return '<style type="text/css"> .pagetitle { display: none; } </style>';
}
add_shortcode( 'notitle', 'notitle_shortcode' );


/*********************************************************************************************
* Name:        Full Width
* Author:      Sam Smith
* Description: Force content div to be 100% wide
**********************************************************************************************/

function fullwidth_shortcode( $atts ){
 return '<script>$("#content").addClass("fullwidth");</script>';
}
add_shortcode( 'fullwidth', 'fullwidth_shortcode' );


/*********************************************************************************************
* Name:        BS Columns
* Author:      Sam Smith
* Description: Divide single column. Span is a number of the 12 Bootstrap columns.
* Example:     [row]
                 [column span="6"]
							     Left Column
							   [/column]
							   [column span="6"]
							     Right Column
							   [/column]
							 [/row]
**********************************************************************************************/

function row_shortcode( $atts, $content = null ) {
   return '<div class="row" style="width:960px;">' .do_shortcode($content). '</div>';
} 
add_shortcode( 'row', 'row_shortcode' );

function column_shortcode( $atts, $content = null ) {  
	extract( shortcode_atts( array(
			'span' => '12',
		), $atts ) );
		
		return '<div class="span'.$span.'">' .do_shortcode($content). '</div>'; 
		}

add_shortcode('column', 'column_shortcode'); 



/*********************************************************************************************
* Name:        Clear
* Author:      Sam Smith
* Description: Clear floats
**********************************************************************************************/

function clear_shortcode( $atts ){
 return '<br style="clear:both;" />';
}
add_shortcode( 'clear', 'clear_shortcode' );


/*********************************************************************************************
* Name:        Grid List
* Author:      Sam Smith
* Description: Use to present a list in a grid format
* Example:     [gl]
               [gli title="Title One" description="Description One"]
               [gli title="Title Two" description="Description Two"]
               [gli title="Title Three" description="Description Three" link="http://link.com"]
               [/gl]
**********************************************************************************************/

function gridlist_shortcode( $atts, $content = null ) {
	 extract( shortcode_atts( array(
			'columns' => '3',
		), $atts ) );
   return '<dl class="grid-list columns'.$columns.'">' .do_shortcode($content). '<br style="clear:both;" /></dl>';
} 
add_shortcode( 'gl', 'gridlist_shortcode' );

function gridlist_item_shortcode( $atts ) {  
	extract( shortcode_atts( array(
			'title' => '',
			'description' => '',
			'link' => '#',
			'icon' => '',
			'image' => '',
		), $atts ) );
		
		if (!empty($icon)) {
			return '<a href="'.$link.'" class="well"><dt><img src="'.$icon.'" alt="'.$title.'" class="icon"><div class="title">'.$title.'</div></dt>
							<dd style="clear:left;">' .$description. '</dd></a>'; 
		}
		else if (!empty($image)) {
			return '<a href="'.$link.'" class="well"><dt><span class="image"><img src="'.$image.'" alt="'.$title.'"></span><h3>'.$title.'</h3></dt>
							<dd style="clear:left;">' .$description. '</dd></a>'; 
		}
		else {
			return '<a href="'.$link.'" class="well"><dt>'.$title.'</dt>
							<dd>' .$description. '</dd></a>'; 
		}
}  
add_shortcode('gli', 'gridlist_item_shortcode');  


/*********************************************************************************************
* Name:        RSS
* Author:      http://www.kevinleary.net/display-rss-feeds-wordpress-shortcodes-simplepie-fetch_feed/
* Description: Re-usable RSS feed reader
* Example:     [rss size="10" feed="http://wordpress.org/news/feed/" date="true"]
**********************************************************************************************/

if( function_exists('base_rss_feed') && !function_exists('base_rss_shortcode') ) {
	function base_rss_shortcode($atts) {
		extract(shortcode_atts(array(
			'size' => '10',
			'feed' => 'http://wordpress.org/news/feed/',
			'date' => false,
		), $atts));
 
		$content = base_rss_feed($size, $feed, $date);
		return $content;
	}
	add_shortcode("rss", "base_rss_shortcode");
}


/*********************************************************************************************
* Name:        Accordion
* Author:      Sam Smith
* Description: Uses bootstrap-collapse.js
* Example:     [accordions]
               [accordion heading="Heading One" class="in"] tab content [/accordion]
               [accordion heading="Heading Two"] another content tab [/accordion]
               [/accordions]
**********************************************************************************************/

function accordions_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'class' => 'accordion',
		), $atts ) );
	 STATIC $id = 0;
	 $id++;
   return '<div id="accordion'. $id .'" class="'. $class .'">' .do_shortcode($content). '</div>';
} 
add_shortcode( 'accordions', 'accordions_shortcode' );

function accordion_shortcode( $atts, $content = null ) {  
	extract( shortcode_atts( array(
			'heading' => 'Please enter a heading attribute like [accordion heading="My Heading"]',
			'class' => '',
		), $atts ) );
		STATIC $collapse = 0;
	  $collapse++;
		return '<div class="accordion-group">
		         <div class="accordion-heading">
						   <a class="accordion-toggle" href="#collapse'.$collapse.'" data-toggle="collapse">
							   '. $heading .'
							</a>
						 </div>
						 <div id="collapse'.$collapse.'" class="accordion-body collapse '.$class.'">
						  <div class="accordion-inner">
							'.do_shortcode($content).'
							</div>
					  </div>
					</div>'; 
}  
add_shortcode('accordion', 'accordion_shortcode');  



/*********************************************************************************************
* Name:        Sticky Element
* Author:      Sam Smith
* Description: Switch element to fixed position, based on scrolling
**********************************************************************************************/

function fullwidth_shortcode( $atts ){
	extract( shortcode_atts( array(
			'scroll' => '65',
			'class' => 'subnav',
		), $atts ) );
 return "$(window).scroll(function(e){ 
  $el = $('.".$class."'); 
  if ($(this).scrollTop() > ".$scroll." && $el.css('position') != 'fixed'){ 
    $('.".$class."').css({'position': 'fixed', 'top': '0px'}); 
  } 
	if ($(this).scrollTop() < ".$scroll." && $el.css('position') == 'fixed') {
	  $('.".$class."').css({'position': 'absolute', 'top': '0px'});
	}
});";
}
add_shortcode( 'sticky', 'sticky_shortcode' );


?>
