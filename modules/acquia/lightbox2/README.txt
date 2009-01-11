CONTENTS OF THIS FILE
----------------------

  * Introduction
  * Installation
  * Adding Lightbox Functionality to your Images
    - No Grouping
    - With Grouping
    - Slideshow
    - Video
    - HTML Content Support
    - Inline Content Support
    - Turning the Image Caption into a Link
  * Keyboard Shortcuts
  * Known Issues
    - Lightbox Lite in IE
    - Keyboard Shortcuts in Opera


INTRODUCTION
------------
Maintainers:
  Mark Ashmead (http://drupal.org/user/52392)
  Stella Power (http://drupal.org/user/66894)

Documentation: http://drupal.org/node/144469

Licensed under the GNU/GPL License
Based on Lightbox v2.03.3 by Lokesh Dhakar
<http://www.huddletogether.com/projects/lightbox2/>

Originally written to make use of the Prototype framework, and Script.acalo.us,
now altered to use jQuery.

Permission has been granted to Mark Ashmead & other Drupal Lightbox2 module
maintainers to distribute the original lightbox.js via Drupal.org under this
license scheme.  This file has been subsequently modified to make use of jQuery
instead of prototype / script.acalo.us.

This module enables the use of lightbox2 which places images above your
current page, not within. This frees you from the constraints of the layout,
particularly column widths.

This module will include the lightbox CSS and JS files in your Drupal
Installation without the need to edit the theme. The module comes with a
Lightbox2 Lite option which does not use the jQuery libraries; it is therefore
less likely to conflict with anything else.


INSTALLATION
------------
1. Copy lightbox2 folder to modules directory.
2. At admin/build/modules enable the lightbox2 module.
3. Enable permissions at admin/user/permissions.
4. Configure the module at admin/settings/lightbox2.
5. Modify your image links to open in a lightbox where necessary, see "Adding
   Lightbox Functionality to your Images' section below.


ADDING LIGHTBOX FUNCTIONALITY TO YOUR IMAGES
--------------------------------------------
No Grouping
===========
Add rel="lightbox" attribute to any link tag to activate the lightbox.
For example:
<a href="images/image-1.jpg" rel="lightbox">image #1</a>
<a href="images/image-1.jpg" rel="lightbox[][my caption]">image #1</a>

Optional: To show a caption either use the title attribute or put in the second
set of [] of the rel attribute.

With Grouping
==============
If you have a set of related images that you would like to group, follow step
one but additionally include a group name between square brackets in the rel
attribute. For example:

<a href="images/image-1.jpg" rel="lightbox[roadtrip]">image #1</a>
<a href="images/image-2.jpg" rel="lightbox[roadtrip][caption 2]">image #2</a>
<a href="images/image-3.jpg" rel="lightbox[roadtrip][caption 3]">image #3</a>

No limits to the number of image sets per page or how many images are allowed
in each set. Go nuts!

If you have a set of images that you would like to group together in a
lightbox, but only wish for one of these images to be visible on your page, you
can assign the "lightbox_hide_image" class to hide the additional images.  For
example:

<a href="images/image-1.jpg" rel="lightbox[roadtrip]">image #1</a>
<a href="images/image-2.jpg" rel="lightbox[roadtrip]" class="lightbox_hide_image">image #2</a>
<a href="images/image-3.jpg" rel="lightbox[roadtrip]" class="lightbox_hide_image">image #3</a>

Slideshow
=========
This is very similar to the grouping functionality described above.  The only
difference is that "rel" attribute should be set to "lightshow" instead of
"lightbox".  Using the same example as above, we could launch the images in a
slideshow by doing:

<a href="images/image-1.jpg" rel="lightshow[roadtrip]">image #1</a>
<a href="images/image-2.jpg" rel="lightshow[roadtrip][caption 2]">image #2</a>
<a href="images/image-3.jpg" rel="lightshow[roadtrip][caption 3]">image #3</a>

Video
=====
It's possible to show video content in the lightbox.  In this case the "rel"
attribute should be set to "lightvideo".  It's not possible to group
videos but it is possible to control the size of the lightbox by setting the
'width' and 'height' properties.  The properties can be configured like
"lightvideo[width:300px; height: 200px;]" and
"lightvideo[width:300px; height: 200px;][my caption]".  The properties should
all be of the format "property: value;" - note the closing semi-colon.  If no
properties are set, then the default width and height of 400px will be used.
See below for more detailed examples.

Basic example:
<a href="http://video.google.com/videoplay?docid=1811233136844420765"
rel="lightvideo">Google video example - default size</a>

Basic example with caption:
<a href="http://video.google.com/videoplay?docid=1811233136844420765"
rel="lightvideo[][my caption]">Google video example - default size</a>

Controlling lightbox size example:
<a href="http://video.google.com/videoplay?docid=1811233136844420765"
rel="lightvideo[width:400px; height:300px;][my caption]">Google video example - custom
size</a>

Supported Video Formats
asx, wmv, mov and swf videos should all be supported.  A number of video
providers are also supported, for example YouTube and Google Video. For full
details on how to integrate these with lightbox, please see the online
documentation.

HTML Content Support
====================
It's possible to show webpage content in the lightbox, using iframes.  In this
case the "rel" attribute should be set to "lightframe".  Again it's possible to
group the content, (e.g. "lightframe[search]") but in addition to that, it's
possible to control some of the iframe properties.  It's possible to set the
'width', 'height' and 'scrolling' properties of the iframe.  The properties are
separated from the group name by a '|', for example
"lightframe[search|width:100px;]" and
"lightframe[search|width:100px;][my caption]".  If no grouping is being used,
then the '|' is still used and the format would be "lightframe[|width:100px;]".
The properties should all be of the format "property: value;" - note the closing
semi-colon.  If no iframe properties are set, then the default width and height
of 400px will be used. See below for more detailed examples.

Basic example:
<a href="http://www.google.com" rel="lightframe">Search google</a>

Basic example with caption:
<a href="http://www.google.com" rel="lightframe[][my caption]">Search google</a>

Grouped example:
<a href="http://www.google.com" rel="lightframe[search]">Search google</a>
<a href="http://www.yahoo.com" rel="lightframe[search]">Search yahoo</a>

Controlling iframe property example:
<a href="http://www.google.com" rel="lightframe[|width:400px; height:300px; scrolling: auto;]">Search google</a>

Controlling iframe property when grouped example:
<a href="http://www.google.com" rel="lightframe[search|width:400px; height:300px; scrolling: auto;][Search Google]">Search google</a>
<a href="http://www.yahoo.com" rel="lightframe[search|width:400px; height:300px;][Search Yahoo]">Search yahoo</a>

Inline Content Support
=======================
It's possible to show HTML snippets in the lightbox, that is on the same domain.
In this case the "rel" attribute should be set to "lightmodal".  Again it's
possible to group the content, (e.g. "lightmodal[search]") but in addition to
that, it's possible to control some of the inline / modal properties.  It's
possible to set the 'width', 'height' and 'scrolling' properties of the inline
content.  The properties are separated from the group name by a '|', for example
"lightmodal[search|width:100px;]" and
"lightmodal[search|width:100px;][my caption]".  If no grouping is being used,
then the '|' is still used and the format would be "lightmodal[|width:100px;]".
The properties should all be of the format "property: value;" - note the closing
semi-colon.  If no properties are set, then the default width and height of
400px will be used. See below for more detailed examples.

Basic example:
<a href="search.php" rel="lightmodal">Search</a>

Basic example with caption:
<a href="search.php" rel="lightmodal[][my caption]">Search</a>

Grouped example:
<a href="search.php" rel="lightmodal[search]">Search</a>
<a href="search.php?status=1" rel="lightmodal[search][published]">Search published content</a>

Controlling modal property example:
<a href="search.php" rel="lightmodal[|width:400px; height:300px; scrolling: auto;]">Search</a>

Controlling modal property when grouped example:
<a href="search.php" rel="lightmodal[search|width:400px; height:300px; scrolling: auto;]">Search</a>
<a href="search.php?status=1" rel="lightmodal[search|width:400px; height:300px;][Search published]">Search published content</a>
<a href="search.php?status=0" rel="lightmodal[search|width:400px; height:300px;][Search Unpublished]">Search unpublished content</a>


Turning the Image Caption into a Link
=====================================
If you wish to turn the caption into a link, format your caption in the
following way:

<a href="images/image-1.jpg" rel="lightbox[][&lt;a href=\"http://www.yourlink.com\"&gt;Clicky Visit Link&lt;/a&gt;'>image #1</a>

Note, the < and > characters have been changed to their HTML entities, and the "
have been escaped.


KEYBOARD SHORTCUTS
------------------
Not all of the keyboard shortcuts work in the Opera browser, for example 'z' for
toggling the zoom and 'spacebar' for toggling play / pause in slideshows.  This
can be overcome by updating your shortcut settings in the Opera preferences
editor.

Close : x, o, c, ESC
Previous Image : p, Left Arrow
Next Image : n, Right Arrow
Toggle Zoom : z (not available in slideshow)
Toggle Play / Pause : Spacebar (slideshow only)


KNOWN ISSUES
------------

Lightbox Lite in IE
--------------------
There is an issue with Lightbox Lite in IE browsers but only for sites where
Drupal is installed in a subdirectory.  In such instances, the overlay.png image
can not be found.  To overcome this issue you will need to edit the
lightbox2/css/lightbox_lite.css file and change the path to this image.  By
default the line is set to:

filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="../images/overlay.png", sizingMethod="scale");

You will need to change the image path on this line to be the full path, e.g.

filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="/sites/all/modules/lightbox2/images/overlay.png", sizingMethod="scale");

See http://drupal.org/node/185866 for more details.

Keyboard Shortcuts in Opera
---------------------------
Not all of the keyboard shortcuts work in the Opera browser, for example 'z' for
toggling the zoom and 'spacebar' for toggling play / pause in slideshows.  This
can be overcome by updating your shortcut settings in the Opera preferences
editor.
