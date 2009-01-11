<?php

require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

function make_random_melody($note_range=32,$duration=8,$max_tempo=4.0) {
  $num_notes = rand(1, $duration * $max_tempo);
  $notes = array();
  for ($i=1; $i < $num_notes; $i++) {
     $interval=rand(1, $duration * 1000);
     $note=rand(1,$note_range);
     $notes[] = "t" . $interval . "n" . $note . "e1";
  }
  sort($notes);
  return "cmd=melody&".implode("&",$notes);
}

function make_random_username($length = 8)
{

  $username = "";

  // define possible characters
  $possible = "0123456789bcdfghjkmnpqrstvwxyz"; 
    
  $i = 0; 
    
  // add random characters to $password until $length is reached
  while ($i < $length) { 

    // pick a random character from the possible ones
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
        
    // we don't want this character if it's already in the password
    if (!strstr($username, $char)) { 
      $username .= $char;
      $i++;
    }

  }

  // done!
  return 'fake'.$username;

}

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

$now=time();
$current_melody_ctime = variable_get('current_melody_ctime', $now);
$current_melody = variable_get('current_melody',null);
$seconds_ago= $now - $current_melody_ctime;
$time_to_compose = rand(8,60);
//print "last melody set $seconds_ago<br />";
//print "random melody: $random_melody<br />";
//print "current melody: $current_melody<br />";
if ( !$current_melody || $seconds_ago > $time_to_compose ) {
  $current_melody = 'i='.make_random_username().'&'.make_random_melody();
  variable_set('current_melody',$current_melody);
  variable_set('current_melody_ctime',$now);
}
$r = views_get_view_result('nowplaying',null);
print 'i=user&cmd=melody&events=10&'.$r[0]->node_data_field_melody_field_melody_value;


?>