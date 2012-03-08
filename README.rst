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

Usage
-----
To modify the page style, open up the .less files and hack around. Run::

  cd css/
  lessc okfn.less > okfn.css

... to recompile the core CSS file and commit your changes to the page. See css/README.markdown for further details.

Note that we use a fork of Twitter Bootstrap as the basis for our CSS. It 99% matches the vanilla version, with occasional shims to make BuddyPress render nicely.

Changes
-------

To alter the priority of categories on the magazine front page (eg. if you want "Open Economics" to be selected over "Our Work") change the order entries in ``category-priority.php``. 
