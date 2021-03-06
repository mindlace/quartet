<?php
// $Id: template.theme-registry.inc,v 1.8 2008/12/15 11:38:13 johnalbin Exp $

/**
 * @file
 * Contains infrequently used theme registry build functions.
 */

/**
 * Implements HOOK_theme().
 *
 * We are simply using this hook as a convenient time to do some related work.
 */
function _zen_theme(&$existing, $type, $theme, $path) {
  // Compute the conditional stylesheets.
  if (!module_exists('conditional_styles')) {
    include_once './' . drupal_get_path('theme', 'zen') . '/template.conditional-styles.inc';
    // _conditional_styles_theme() only needs to be run once.
    if ($theme == 'zen') {
      _conditional_styles_theme($existing, $type, $theme, $path);
    }
  }

  // Since we are rebuilding the theme registry and the theme settings' default
  // values may have changed, make sure they are saved in the database properly.
  zen_theme_get_default_settings($theme);

  // If we are auto-rebuilding the theme registry, warn about feature.
  if (theme_get_setting('zen_rebuild_registry') && $theme == $GLOBALS['theme']) {
    drupal_set_message(t('The theme registry has been rebuilt. <a href="!link">Turn off</a> this feature on production websites.', array('!link' => base_path() . 'admin/build/themes/settings/' . $GLOBALS['theme'])), 'warning');
  }

  // Return nothing.
  return array();
}

/**
 * Return the theme settings' default values from the .info and save them into the database.
 *
 * @param $theme
 *   The name of theme.
 */
function zen_theme_get_default_settings($theme) {
  $themes = list_themes();

  // Get the default values from the .info file.
  $defaults = !empty($themes[$theme]->info['settings']) ? $themes[$theme]->info['settings'] : array();

  if (!empty($defaults)) {
    // Get the theme settings saved in the database.
    $settings = theme_get_settings($theme);
    // Don't save the toggle_node_info_ variables.
    if (module_exists('node')) {
      foreach (node_get_types() as $type => $name) {
        unset($settings['toggle_node_info_' . $type]);
      }
    }
    // Save default theme settings.
    variable_set(
      str_replace('/', '_', 'theme_' . $theme . '_settings'),
      array_merge($defaults, $settings)
    );
    // If the active theme has been loaded, force refresh of Drupal internals.
    if (!empty($GLOBALS['theme_key'])) {
      theme_get_setting('', TRUE);
    }
  }

  // Return the default settings.
  return $defaults;
}
