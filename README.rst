=========================
Wordpress OKFN v2.0 Theme
=========================
This is a child theme of the BuddyPress bp-default theme. 
http://codex.buddypress.org/theme-development/building-a-buddypress-child-theme/

We override::

  header.php
  footer.php
  style.css

And additionally provide function hooks in::

  functions.php

...and that's it! Wordpress' output is modified via callbacks in functions.php. We structure the page in header/footer but aim to use the parent theme's templates in all other cases. Wordpress always provides a more robust override mechanism.

Usage
-----
To modify the page style, open up the .less files and hack around. Run::

  lessc okfn.less

... to recompile the core CSS file and commit your changes to the page. See css/README.markdown for further details.


