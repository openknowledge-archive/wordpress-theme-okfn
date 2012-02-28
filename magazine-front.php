<?php
  /*
  Template Name: Magazine Front
   */

// We could filter by tag, or anything...
#$post_filter_main =  'posts_per_page=1&tag=featured_main';
$post_filter_main =  'posts_per_page=1&offset=0';
$post_filters =  array('posts_per_page=1&offset=1',
    'posts_per_page=1&offset=2',
    'posts_per_page=1&offset=3',
    'posts_per_page=1&offset=4');

function first_n_words($in, $n) {
    $out = $in;
    $a = explode(' ', $in);
    if (count($a) > $n) {
        array_splice($a, $n);
        $out = implode(' ',$a) . '...';
    }
    return $out;
}

add_filter('body_class','browser_body_class');

function browser_body_class($classes = '') {
    array_push($classes,"magazine");
    return $classes;
}


function dump_post($post) {
    echo '<div style="border: 1px solid #ccc"><ul>';
    echo '<li>author = ' . bp_core_get_userlink( $post->post_author );
    echo '<li>date = '; printf( __( '%1$s <span>in %2$s</span>', 'buddypress' ), get_the_date(), get_the_category_list( ', ' ) );
    echo '<li>permalink = ';  the_permalink(); 
    echo '<li>title = <a href="'; the_permalink(); echo '" rel="bookmark" title="' . _e( 'Permanent Link to', 'buddypress' ) . ' ' . the_title_attribute() . '">'; the_title(); echo '</a>';
    echo '<li>snippet = ';
    $content = get_the_content( __( 'Read the rest of this entry &rarr;', 'buddypress' ) ) ;
    $tagless = strip_tags($content, '<br><p><b><i><strong><em><a>');
    echo $snippet;
    echo '</ul></div>';
}
function print_post($post, $is_featured) {
    $post_class = $is_featured ? 'featured' : 'preview';
    // Extract the first img src from the post body
    $regex = '/magazine.image\s*=\s*"?([^"\s->]*)/';
    preg_match($regex, get_the_content(), $matches);
    $post_img = 'http://farm7.staticflickr.com/6081/6122893997_9e6c24fa36_z.jpg';
    if (count($matches)) $post_img = $matches[1];
    echo '<div class="box post '.$post_class.'">';
    echo '<div class="padder"> <a class="image" href="#" style="background-image:url('.$post_img.');"></a>';
    echo '<div class="text">';
    echo '<h2><a href="'.get_permalink().'"rel="bookmark">'; the_title(); echo '</a></h2>';
    echo '<span class="entry-meta">'; 
    printf( __( '%1$s <span>in %2$s</span>', 'buddypress' ), get_the_date(), get_the_category_list( ', ' ) );
    echo 'by ' . bp_core_get_userlink( $post->post_author );
    echo '</span>';
    echo the_excerpt();
    echo '</div>';
    echo '<a href="#" class="btn btn-info">Full Post</a> </div>';
    echo '<h3 class="ribbon">Featured</h3>';
    echo '</div>';
}
?>


<?php get_header() ?>

    <div id="content">
        <div class="padder">

        <?php do_action( 'bp_before_blog_home' ) ?>

        <?php do_action( 'template_notices' ) ?>

        <div class="page" id="blog-latest" role="main">
<?php 

query_posts( $post_filter_main );
the_post();
print_post($post, true);

foreach ($post_filters as $filter) {
    query_posts( $filter );
    the_post();
    print_post($post, false);
}
?>
        </div>

        <?php do_action( 'bp_after_blog_home' ) ?>

        </div><!-- .padder -->
    </div><!-- #content -->

    <?php get_sidebar() ?>

<?php get_footer() ?>
