<?php
// $Id: profile_fields_pane.tpl.php,v 1.1.2.1 2008/10/29 21:48:53 merlinofchaos Exp $
/**
 * @file
 * Display profile fields.
 *
 * @todo Need definition of what variables are available here.
 */
?>
<?php if (is_array($vars)): ?>
  <?php  foreach ($vars as $class => $field): ?>
    <dl class="profile-category">
      <dt class="profile-<?php print $class; ?>"><?php print $field['title']; ?></dt>
      <dd class="profile-<?php print $class; ?>"><?php print $field['value']; ?></dd>
    </dl>
  <?php endforeach; ?>
<?php endif; ?>
