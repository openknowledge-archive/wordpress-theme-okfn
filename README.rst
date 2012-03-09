=================
OKFN Master Theme
=================
This is a child theme of the BuddyPress bp-default theme. 
http://codex.buddypress.org/theme-development/building-a-buddypress-child-theme/

We override::

  header.php
  footer.php
  single.php
  style.css

And additionally provide function hooks in::

  functions.php

...and that's it! Wordpress' output is modified via callbacks in functions.php. We structure the page in header/footer but aim to use the parent theme's templates in all other cases. Wordpress always provides a more robust override mechanism.

Magazine Mode
-------------

To create a magazine frontpage for your blog, create a page and choose 'Magazine' as its Template (on the right hand side).

Magazine mode will display:

* The latest blogpost with the category "Featured" at the top.
* The latest four blogposts which aren't that one beneath it.

The algorithm which displays a picture looks for "magazine.image" in the blogpost. Just add a HTML comment to your blog post:

  <!-- magazine.image = http://flickr.com/my/magazine/image.jpg -->

There is a simple algorithm to choose which category is displayed on the ribbon. This file decides which category will be chosen first:

https://github.com/okfn/wordpress-theme-okfn/blob/master/category-priority.php

To use YARPP to display Related Posts as magazine entries on the post view page, open up the YARPP widget settings.

* Disable "Automatically display related posts"
* Select "Display using a custom template file" (yarpp-template-magazine.php)
