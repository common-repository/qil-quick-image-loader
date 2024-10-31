=== QIL - Quick Image Loader ===
Contributors: bitpixels
Tags: images, loading, requests
Requires at least: 5.2
Tested up to: 5.2
Requires PHP: 7.2
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
== Description ==
 
QIL - Quick Image Loader, helps reduce page load times by reducing the number of requests.
The plugin encodes all images on post save in base64, reducing the number of requests for posts / pages.
 
== Installation ==
 
This section describes how to install the plugin and get it working.
 
e.g.
 
1. Upload `QIL.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. When you save a post it will automatically convert images into base64.
 
== Frequently Asked Questions ==
 
= How do i stop images being converted into base64 & revert back to normal image loading? =
 
To revert back to normal image loading just disable the plugin, all post that used QIL will still contain base64 images.
 
== Screenshots ==
 
* No Screenshots

== Changelog ==
 
= 1.0 =
* Stable Initial Release
 
== Upgrade Notice ==
 
= 1.0 =
* Stable Initial Release *
