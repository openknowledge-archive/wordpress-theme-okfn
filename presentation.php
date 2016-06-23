<?php
/*
Template Name: Presentation 
 */
 
// shortcode

// theme options
global $options;
foreach ($options as $value) {
  if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] ); }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=680, user-scalable=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/shower.css"/>
  <?php if ($okfn_colours == "school") {?>
  <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/shower-school.css"/>
  <?php } else {?> 
  <link rel="stylesheet" href="<?php echo get_bloginfo('stylesheet_directory'); ?>/css/shower-okf.css"/>
  <?php }?>
  
  <?php if ($okfn_colours == "blue") : ?>
    <link rel="shortcut icon" href="http://assets.okfn.org/p/ckan/img/ckan.ico" />
  <?php elseif ($okfn_colours == "white" || $okfn_colours == "turquoise") : ?>
    <link rel="shortcut icon" href="http://assets.okfn.org/p/okfn/img/grey-favicon.ico" />
  <?php elseif ($okfn_colours == "school") : ?>
    <link rel="shortcut icon" href="http://assets.okfn.org/p/schoolofdata/img/favicon.ico" />
  <?php else: ?>
    <link rel="shortcut icon" href="http://assets.okfn.org/p/okfn/img/favicon.ico" />
  <?php endif; ?>
</head>
<body class="list">
	<!--
		Debug class on <body> enables
		cyan grid on slides
		-->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<header class="caption">
		<h1><?php the_title(); ?></h1>
		<?php
			if (get_post_meta($post->ID,'description')) {
				echo '<p class="description">' . get_post_meta($post->ID,'description', true) . '</p>';
				}
		?>
	</header>
		

    <?php the_content(); ?>
  <?php endwhile; endif; ?>
		<div class="badge">
      <div>
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
        
        <a title="<?php _ex( 'Home', 'Home page banner link title', 'buddypress' ); ?>" 
            class="brand" 
            href="<?php echo home_url(); ?>">
            
          <?php
            // Check for header image
            $header_image = get_header_image();
            if ( ! empty( $header_image ) && $okfn_logo_icon == "false" ) :
          ?>
            <img src="<?php header_image(); ?>" alt="logo" />
          <?php elseif ($okfn_logo_icon == "false") : ?>
            <img src="http://assets.okfn.org/web/images/header-logox2.png" alt="logo"/>
          <?php endif; ?>
      
          <?php if ( $okfn_logo_text == "false" ) : ?>
            <?php bp_site_name(); ?>
          <?php endif; ?>
        </a>
      </div>
    </div>
	<!--
		To hide progress bar from entire presentation
		just remove “progress” element.
		-->
	<div class="progress"><div></div></div>
	<script type="text/javascript" src="<?php echo bloginfo('stylesheet_directory'); ?>/include/shower.min.js"></script>
</body>
</html>
