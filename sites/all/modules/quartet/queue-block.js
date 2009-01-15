$(document).ready( function() { 
  $(document).everyTime(3000, null, getStatus, 0, true);
  $(document).everyTime(6000, null, loadPending, 0, false);
  $('#pending-melodies').change(function () { $(this).fadeOut(); $(this).fadeIn(); });
});

function getStatus() {
  if ($(document.body).hasClass('logged-in')) {
    $.getJSON('/quartet/queue/status', null, updateStatus);
  }
}

function loadPending() {
  $('#pending-melodies').load('/quartet/pending-melodies');
}

var anid = -1;
function updateStatus(data, textStatus) {
  var qpos = data[0]; // == position in queue
  anid = data[1]; // the nid of the melody
  if ( qpos == -1 ) {
    startPlaying();
  }
}

