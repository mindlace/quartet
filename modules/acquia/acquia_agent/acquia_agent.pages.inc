<?php

/**
 * Menu callback for settings page.
 */
function acquia_agent_settings_page() {

  $identifier = acquia_agent_settings('acquia_identifier');
  $key = acquia_agent_settings('acquia_key');
  $change = FALSE;

  // Check $_POST so we don't send extra XML-RPC requests during form submission.
  if ($identifier && $key && empty($_POST)) {
    // Check our connection to the Acquia Network and validity of the crenditials.
    $acquia_network_address = acquia_agent_settings('acquia_network_address');
    if (acquia_agent_valid_credentials($identifier, $key, $acquia_network_address)) {
      drupal_set_message(t('You are successfully communicating with the Acquia Network. To change the subscription keys, click the %alter button.', array('%alter' => t('Alter settings'))), 'status', FALSE);
    }
    else {
      $error_message = acquia_agent_connection_error_message();
      drupal_set_message($error_message, 'error', FALSE);
      $change = TRUE;
    }
  }
  $link = '';
  $subscription = acquia_agent_settings('acquia_subscription_data');
  if ($subscription['active']) {
    $title = t("Subscription active. Click here to go to the Acquia Network");
    $link .= "<p>". l($title, $subscription['href']) ."</p>\n";
  }

  return $link . drupal_get_form('acquia_agent_settings_form', $change);
}

/**
 * Settings form menu callback.
 */
function acquia_agent_settings_form($form_state, $change = FALSE) {
  $identifier = acquia_agent_settings('acquia_identifier');
  $key = acquia_agent_settings('acquia_key');

  $change = $change || isset($form_state['change_settings']) || (empty($identifier) || empty($key));

  $form['acquia_identifier'] = array(
    '#type' => 'textfield',
    '#title' => t('Acquia subscription identifier'),
    '#default_value' => $identifier,
    '#disabled' => !$change,
    '#description' => t('Identifier of this website (a public key). Copy from your subscription for this site from the Acquia Network.'),
    '#required' => $change,
  );
  $form['acquia_key'] = array(
    '#type' => 'textfield',
    '#title' => t('Acquia subscription key'),
    '#default_value' => $key,
    '#access' => $change,
    '#description' => t('Key of this website (a private key). Copy from your subscription for this site from the Acquia Network.'),
    '#required' => $change,
  );
  $form['buttons']['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Save configuration'),
    '#validate' => array('acquia_agent_set_validate'),
    '#submit' => array('acquia_agent_set_submit'),
    '#access' => $change,
  );
  $form['buttons']['delete'] = array(
    '#type' => 'submit',
    '#value' => t('Delete subscription information '),
    '#submit' => array('acquia_agent_delete_submit'),
    '#access' => ($change && $identifier && $key),
  );
  $form['buttons']['change'] = array(
    '#type' => 'submit',
    '#value' => t('Alter settings'),
    '#submit' => array('acquia_agent_change_submit'),
    '#access' => !$change,
  );

  return $form;
}

/**
 * Validate acquia_agent_settings form submissions.
 */
function acquia_agent_set_validate($form, &$form_state) {
  foreach ($form_state['values'] as $key => $value) {
    $form_state['values'][$key] = trim($value);
  }
  $identifier = $form_state['values']['acquia_identifier'];
  $key = $form_state['values']['acquia_key'];
  // Don't make the XML-RPC call with empty hashes.
  if (!empty($identifier) && !empty($key)) {
    if (!acquia_agent_valid_credentials($identifier, $key)) {
      $error_message = acquia_agent_connection_error_message();
      form_error($form, $error_message);
    }
  }
}

/**
 * Save acquia_agent_settings form submissions.
 */
function acquia_agent_set_submit($form, &$form_state) {

  variable_set('acquia_key', $form_state['values']['acquia_key']);
  variable_set('acquia_identifier', $form_state['values']['acquia_identifier']);
  drupal_set_message(t('The Acquia configuration options have been saved.'));
  // Check subscription and send a heartbeat to Acquia Network via XML-RPC.
  // Our "supported" status gets updated locally via the return data.
  acquia_agent_check_subscription();

  cache_clear_all();
}

/**
 * Delete acquia_agent settings.
 */
function acquia_agent_delete_submit($form, &$form_state) {
  variable_del('acquia_key');
  variable_del('acquia_identifier');
  variable_del('acquia_network_address');
  variable_del('acquia_subscription_data');
  drupal_set_message(t('Your Acquia configuration has been deleted.'));
  cache_clear_all();
}


/**
 * Submit function for the "Change settings" button.
 */
function acquia_agent_change_submit($form, &$form_state) {
  $form_state['change_settings'] = TRUE;
  $form_state['rebuild'] = TRUE;
}

