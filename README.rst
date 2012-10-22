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
  shortcodes.php

...and that's it! Wordpress' output is modified via callbacks in functions.php. We structure the page in header/footer but aim to use the parent theme's templates in all other cases. Wordpress always provides a more robust override mechanism.


Supported Shortcode
-------------------

**Carousel**

To add a carousel to your page can be as simple as:: 

  [carousel]  
  [slide img="http://slide1.jpg" class="active"]  
  [slide img="http://slide2.jpg"]  
  [/carousel]  

Please note that one of the slides must have ``class="active"`` applied to it, this will be the first slide that is displayed.

Other supported attributes are ``heading`` and ``caption``. For example, to add a caption to a slide you would enter it as follows:::

  [carousel]  
  [slide img="http://slide1.jpg" class="active"]  
  [slide img="http://slide2.jpg" caption="My caption for slide two"]  
  [/carousel]  
	
	
**Static Banner**

If you only want a single banner image, use the below::

  [banner bg="http://domain.com/bg-image.jpg"]
  Banner text here.
  [/banner]


**Pseudo Sidebar**

If you are using the 'One column, no sidebar' template to hide the default sidebar, you can mimic the default layout like so:::

  [pseudocontent] My main content [/pseudocontent]  
  [pseudosidebar] My sidebar content [/pseudosidebar]  

**Image Caption**

Wrap an image and its caption in a border

::

  [caption width="450" caption="My caption"]  
  <img src="http://image.jpg" alt="" width="450" />  
  [/caption]  


**Hide Page Title**

Use to hide the page title

::

  [notitle] 
	

**Full Width**

Force content div to be 100% wide

::

  [fullwidth] 
	
	
**BS Columns**

Divide single column. Span is a number of the 12 Bootstrap columns

::

  [row]
  [column span="6"]
  Left Column Content
  [/column]
  [column span="6"]
  Right Column Content
  [/column]
  [/row] 
	
	
**Clear**

Clear floats

::

  [clear] 
	

**Accordions**

Use ``class="in"`` to have the accordion open by default

::

  [accordion heading="Heading One" class="in"] content [/accordion]
  [accordion heading="Heading Two"] content [/accordion]


**RSS Ticker**

Show scrolling previews from an RSS feed::

  [rss feed="http://planet.okfn.org/feed" type="ticker"]



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

