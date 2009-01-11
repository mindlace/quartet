<?php
// $Id$

/**
 * @file views-view.tpl.php
 * Main view template
 *
 * Variables available:
 * - $header: The view header
 * - $footer: The view footer
 * - $rows: The results of the view query, if any
 * - $empty: The empty text to display if the view is empty
 * - $pager: The pager next/prev links to display, if any
 * - $exposed: Exposed widget form/info to display
 * - $feed_icon: Feed icon to display, if any
 * - $more: A link to view more, if any
 * - $admin_links: A rendered list of administrative links
 * - $admin_links_raw: A list of administrative links suitable for theme('links')
 *
 * @ingroup views_templates
 */
?>
<div class="view view-<?php print $css_name; ?> view-id-<?php print $name; ?> view-display-id-<?php print $display_id; ?>">

  <?php if ($rows): ?>
    <div class="view-content">
      <?php print $rows; ?>
    </div>

</div> <?php // class view ?>
