<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title><?php print $title; ?></title>
  <?php print $scripts; ?>
</head>
<frameset cols="*, 480" framespacing="0" frameborder="no">
<frame src="/node" name="main4tet" id="main4tet" title="Quartet Site" frameborder="0">
  <frameset rows="360, *">
    <frame src="/video.html" name="video4tet" id="video4tet" title="Quartet Video Feed" 
      scrolling="No" noresize="noresize" frameborder="0">
    <frame src="/quartet/queue" name="queue4tet" id="queue4tet" 
      scrolling="No" noresize="noresize" title="Performers Queue" frameborder="0">
  </frameset>
</frameset>  
  <noframes>
  </noframes>
</html>

