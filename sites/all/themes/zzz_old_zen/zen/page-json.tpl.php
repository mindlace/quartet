<?php
if($messages) {
  $content = $messages.$content;
}
echo drupal_to_js($content);
?>