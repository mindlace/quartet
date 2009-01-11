<?php
//Utility functions

function views_get_view_result($viewname, $args) {
  $view = views_get_view($viewname);
  if (is_object($view)) {
    if (is_array($args)) {
       $view->set_arguments($args);
    }
    $view->execute();
    return $view->result;
  }
  else {
    return t('View %viewname not found.', array('%viewname' => $viewname));
  }
}