<?php
/**
 * Plugin Name:       QIL - Quick Image Loader
 * Plugin URI:        https://bitpixels.com/plugins/QIL
 * Description:       QIL encodes images in base64 to load faster.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Bitpixels
 * Author URI:        https://bitpixels.co.uk/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */
/*
QIL is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
QIL is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with QIL. If not, see https://bitpixels.co.uk/web_development/qil-quick-image-loader-wordpress-plugin/.
*/

$QIL_debug = false;

function QIL_activate(){

}

function QIL_deactivate(){

}

function QIL_uninstall(){

}

function QIL_base64_encode_image($image){
$base64 = false;
$data = file_get_contents($image);
$imgext = end(explode(".", $image));
if($data !== false){
$base64 = 'data:image/'.$imgext.';base64, '.base64_encode($data);
}
return $base64;
}

function QIL_base64_encode_images($content){
$html = new DOMDocument();
libxml_use_internal_errors(true);
libxml_clear_errors();
$html->loadHTML($content);
$tmpImages = $html->getElementsByTagName("img");

if($QIL_debug && count($tmpImages) <= 0){
error_log("no images found");
}
$imageIndex = [];
foreach($tmpImages as $image){
$src = $image->getAttribute("src");
$base64 = QIL_base64_encode_image($src);
$newImage = $html->createElement('img');
foreach($image->attributes as $attr){
$name = $attr->nodeName;
$value = $attr->nodeValue;
$newImage->setAttribute($name, $value);
}
$newImage->setAttribute("src", $base64);
$image->parentNode->replaceChild($newImage, $image);
}

return $html->saveHTML();
}

function QIL_optimize_post($post_id){

if( $parent_id = wp_is_post_revision( $post_id ) ){
    $post_id = $parent_id;
}
    remove_action( 'save_post', 'QIL_optimize_post');
    $post = get_post($post_id);
    $post_content = QIL_base64_encode_images($post->post_content);
    wp_update_post(array('ID' => $post_id, 'post_content' => $post_content));
}


register_activation_hook( __FILE__, 'QIL_activate' );

register_deactivation_hook( __FILE__, 'QIL_deactivate' );

register_uninstall_hook( __FILE__, 'QIL_uninstall' );

add_action( 'save_post', 'QIL_optimize_post');
?>
