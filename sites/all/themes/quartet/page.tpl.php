<?php
// $Id: page.tpl.php,v 1.25 2008/01/24 09:42:53 goba Exp $
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
<head>
  <title><?php print $head_title ?></title>
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts ?>
</head>

<body bgcolor="#333">

<div class="hide"><a href="#content" title="<?php print t('Skip navigation') ?>." accesskey="2"><?php print t('Skip navigation') ?></a>.</div>

<table id="heading-top" summary="Navigation elements." border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td id="home" width="276px">
    </td>
    <td id="middle-heading" width="auto">
    </td>
    <td class="right-heading" width="232px" align="right" valign="middle">
    </td>
  </tr>
</table>

<table id="secondary-menu" summary="Navigation elements." border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
		<td class="signin"><div><?php print $header ?></div></td>
    <td class="secondary-links" width="50%"  align="right" valign="middle">
      <?php print theme('links', $secondary_links, array('class' => 'links', 'id' => 'subnavlist')) ?>
    </td>
  </tr>
</table>

<table id="content" border="0" cellpadding="15" cellspacing="0" width="100%">
  <tr>
    <?php if ($left != ""): ?>
    <td id="sidebar-left">
      <?php print $left ?>
    </td>
    <?php endif; ?>

    <td valign="top">
      <?php if ($mission != ""): ?>
      <div id="mission"><?php print $mission ?></div>
      <?php endif; ?>

      <div id="main">
        <?php if ($title != ""): ?>
          <?php print $breadcrumb ?>
          <h1 class="title"><?php print $title ?></h1>

          <?php if ($tabs != ""): ?>
            <div class="tabs"><?php print $tabs ?></div>
          <?php endif; ?>

        <?php endif; ?>

        <?php if ($show_messages && $messages != ""): ?>
          <?php print $messages ?>
        <?php endif; ?>

        <?php if ($help != ""): ?>
            <div id="help"><?php print $help ?></div>
        <?php endif; ?>

      <!-- start main content -->
      <?php print $content; ?>
      <?php print $feed_icons; ?>
      <!-- end main content -->

      </div><!-- main -->
    </td>
    <?php if ($right != ""): ?>
    <td id="sidebar-right">
      <?php print $right ?>
    </td>
    <?php endif; ?>
  </tr>
</table>

<table id="footer-menu" summary="Navigation elements." border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td align="center" valign="middle">
		<?php if ($footer_message || $footer) : ?>
		<div id="footer-message">
		    <p><?php print $footer_message . $footer;?></p>
		</div>
		<?php endif; ?>
    </td>
  </tr>
</table>

<?php print $closure;?>
</body>
</html>
