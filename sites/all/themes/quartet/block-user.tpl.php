<?php
// $Id: block-user.tpl.php
?>
<div class="<?php print "block block-$block->module" ?>" id="<?php print "block-$block->module-$block->delta"; ?>">
	<?php print $block->subject ?>
	<div class="content"><div class="mini-menu"><?php print $block->content ?></div></div>
</div>