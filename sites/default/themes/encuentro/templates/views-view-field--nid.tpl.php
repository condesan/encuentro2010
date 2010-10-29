<?php
// $Id: views-view-field.tpl.php,v 1.1 2008/05/16 22:22:32 merlinofchaos Exp $
 /**
  * This template is used to print a single field in a view. It is not
  * actually used in default Views, as this is registered as a theme
  * function which has better performance. For single overrides, the
  * template is perfectly okay.
  *
  * Variables available:
  * - $view: The view object
  * - $field: The field handler object that can process the input
  * - $row: The raw SQL result that can be used
  * - $output: The processed output that will normally be used.
  *
  * When fetching output from the $row, this construct should be used:
  * $data = $row->{$field->field_alias}
  *
  * The above will guarantee that you'll always get the correct data,
  * regardless of any changes in the aliasing that might happen if
  * the view is modified.
  */
?>
<?php 

$node = node_load($output);
$filepath = file_create_url($node->field_imagen['und'][0]['uri']);

#print base_path() . "sites/all/libraries/phpThumb/phpThumb.php?src=" . $filepath ."&height=200";

#Include the Transform.php file
require_once( 'Image/Transform.php' );

#Create new Image Transform object
#(Auto selects the "driver")
$img = Image_Transform::factory();

#Load an image file
$img->load($filepath);

#Scale the image, keeping aspect ratio, to 200px
$img->scaleByX( 200 );

#Save to a new file
$img->save(base_path() . 'sites/default/files/' . $node->field_imagen['und'][0]['filename'] .'_200.jpg');

?>
