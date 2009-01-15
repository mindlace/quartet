var anid = 0;
$(document).ready(function () {
    $('#pkeys').ready( function() {
      var mypiano = new SWFObject("/sites/all/modules/quartet/piano.swf","apiano","480","400","9.0.0.0","#ffffff");
      mypiano.addParam('play','true');
      mypiano.addParam('allowScriptAccess','always');
      mypiano.addParam('wmode','transparent');
      mypiano.write('pkeys');
    });
    $('#join-the-queue').click( function () {
      $.getJSON('/quartet/queue/join', null, hideJoin);
    });
});

function hideJoin(data, textStatus) {
  anid = data;
  $('#join-the-queue').slideUp(400);
}
  
var already_playing = false;
function startPlaying() { 
  if (!already_playing) {
    already_playing = true;
    document.getElementById('apiano').goHome();
    console.log('called goHome');
    }
}

function jsFunc(melody) {
  here_is_your_melody(melody);
}

function here_is_your_melody(melody) {
  //melody_nid comes from the code embedded by piano_block or loadPiano
  editurl = '/quartet/'+ anid +'/'+ melody
  $('#happy-fun-message').hide().load(editurl).fadeIn();
}