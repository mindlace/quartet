<?
//$Id$
/**
 * @page
 * Override theme_() functions for the Quartet theme.
 */

//Overrides theme_links()
/**
 * Return a themed set of links.
 *
 * @param $links
 *   A keyed array of links to be themed.
 * @param $attributes
 *   A keyed array of attributes
 * @return
 *   A string containing an unordered list of links.
 */
function phptemplate_links($links, $attributes = array('class' => 'links')) {
  $output = '';

  if (count($links) > 0) {
    $output = '<ul'. drupal_attributes($attributes) .'>';

    $num_links = count($links);
    $i = 1;

    foreach ($links as $key => $link) {
      $class = $key;

      // Add first, last and active classes to the list of links to help out themers.
      if ($i == 1) {
        $class .= ' first';
      }
	  	// This is new, so we can add images to any of the first three links if needed
			if ($i == 2) {
				$class .= ' second';
			}
			if ($i == 3) {
				$class .= ' third';
			}
			//<--done, i only like three links.
      if ($i == $num_links) {
        $class .= ' last';
      }
      if (isset($link['href']) && ($link['href'] == $_GET['q'] || ($link['href'] == '<front>' && drupal_is_front_page()))) {
        $class .= ' active';
      }
      $output .= '<li class="'. $class .'">';

      if (isset($link['href'])) {
        // Pass in $link as $options, they share the same keys.
        $output .= l($link['title'], $link['href'], $link);
      }
      else if (!empty($link['title'])) {
        // Some links are actually not links, but we wrap these in <span> for adding title and class attributes
        if (empty($link['html'])) {
          $link['title'] = check_plain($link['title']);
        }
        $span_attributes = '';
        if (isset($link['attributes'])) {
          $span_attributes = drupal_attributes($link['attributes']);
        }
        $output .= '<span'. $span_attributes .'>'. $link['title'] .'</span>';
      }

      $i++;
      $output .= "</li>\n";
    }

    $output .= '</ul>';
  }

  return $output;
}

// Overrides theme_breadcrumb()
function phptemplate_breadcrumb($breadcrumb) {
	if (empty($breadcrumb)) return;
	$attr = array(
		'class' => 'breadcrumb-items' 
		);
		$crumbs = theme('item_list', $breadcrumb, null, 'ul', $attr);
  	return '<div class="breadcrumb">' .$crumbs . '</div>';
}