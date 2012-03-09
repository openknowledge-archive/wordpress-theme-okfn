<?php /*
Magazine template for the YARPP engine
Author: Tom Rees
*/
if ($related_query->have_posts()) {
	echo '<h3>Related Posts</h3>';
	while ($related_query->have_posts()) { 
		$related_query->the_post(); 
		echo_magazine_post($post, false); 
	}
}
