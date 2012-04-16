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
<article style="display: inline-block; width: 680px;">' . $content . '</article>';
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
 return '<style type="text/css"> #content { width: 100%; } </style>';
}
add_shortcode( 'fullwidth', 'fullwidth_shortcode' );


/*********************************************************************************************
* Name:        Clear
* Author:      Sam Smith
* Description: Clear floats
**********************************************************************************************/

function clear_shortcode( $atts ){
 return '<br style="clear:both;" />';
}
add_shortcode( 'clear', 'clear_shortcode' );

?>
