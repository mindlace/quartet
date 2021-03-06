<?php
// $Id: uid.inc,v 1.4.2.2 2008/10/22 19:23:13 sdboyer Exp $


/**
 * @file arguments/uid.inc
 *
 * Plugin to provide an argument handler for a user id
 */
function panels_uid_panels_arguments() {
  $args['uid'] = array(
    'title' => t("User ID"),
    // keyword to use for %substitution
    'keyword' => 'user',
    'description' => t('Creates a user object from the argument.'),
    'context' => 'panels_uid_context',
    'settings form' => 'panels_uid_settings_form',
    'settings form submit' => 'panels_uid_settings_form_submit',
    'displays' => 'panels_uid_displays',
    'choose display' => 'panels_uid_choose_display',
    'native path' => 'user/%user_uid_optional',
    'load function' => 'user_uid_optional',
  );
  return $args;
}

/**
 * Discover if this argument gives us the user we crave.
 */
function panels_uid_context($arg = NULL, $conf = NULL, $empty = FALSE) {
  // If unset it wants a generic, unfilled context.
  if ($empty) {
    return panels_context_create_empty('user');
  }

  // FIXME: The code designed to handle a numeric id for loading is probably
  // pretty much cruft by now, and SHOULD be removed pending some more thorough
  // testing & thinking.
  if (!is_numeric($arg)) {
    if (is_object($arg) && !empty($arg->uid)) {
      return panels_context_create('user', $arg);
    }
    else return PANELS_ARG_IS_BAD;
  }

  // FIXME: Pertaining to the above note; we should never make it this far
  // anymore in D6.
  $user = user_load(array('uid' => $arg));
  if (!$user) {
    return PANELS_ARG_IS_BAD;
  }

  return panels_context_create('user', $user);
}

/**
 * Settings form for the argument
 */
function panels_uid_settings_form($conf) {
  // Doing different displays based upon role is hard because roles are not
  // 1:1 like type/vocabulary are for node and term.
}

/**
 * There appears to be a bit of a bug with the way we're handling forms; it causes
 * 'checkboxes' to get invalid values added to them when empty. This takes care
 * of that.
 */
function panels_uid_settings_form_submit(&$values) {
}

/**
 * What additional displays does this argument provide?
 */
function panels_uid_displays($conf, $id) {
  return array();
}

/**
 * Based upon the settings and the context, choose which display to use.
 */
function panels_uid_choose_display($conf, $context) {
}
