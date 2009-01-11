$(document).ready(function() {
  $('#edit-field-melody-0-value-wrapper').hide();
  $('#edit-submit').hide();
  $('#edit-preview').hide();
  $('#edit-delete').hide();
  $('#edit-field-played-value-wrapper').hide();
  $('.tabs').hide();
  var mypiano = new SWFObject("/sites/all/modules/quartet/piano.swf","apiano","400","400","9.0.0.0","#ffffff");
  mypiano.addParam('play','true');
  mypiano.addParam('allowScriptAccess','always');
  mypiano.addParam('wmode','transparent');
  mypiano.write('pkeys');
  $('#pkeys').ready( function() { $('#apiano').ready( function() { $('#apiano').focus(); }); } );
  });
  
var already_playing = false
function startPlaying() { 
  $('#pkeys').ready( function() {
    if (!already_playing) {
      already_playing = true;
      $('#apiano').ready( function() {
        window.top.focus();
        $('#apiano').focus(); 
        document.getElementById('apiano').goHome();
      }); 
    
    }
  });
}
function jsFunc(melody) {
  document.getElementById('edit-field-melody-0-value').value = melody
  $('#node-form').submit();
}