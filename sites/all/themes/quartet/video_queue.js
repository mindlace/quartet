base = ''
function initializeQueue(responseText, textStatus, XMLHttpRequest) {
  $('a').attr('target','mainFrame');
  $('#pending-melodies').slideDown('slow');
}

$(document).ready(function() {  
    $('#pending-melodies').load(base+'/pending-melodies', null, initializeQueue);
});

function getStatus(data, textStatus) {
  position = data[0] // == position in queue
  node_id = data[1] // == node Id of melody
  if (position > 999 ) {
    $('#pending-melodies').append('<a href="'+base+'/node/add/melody" target="mainFrame">Join Queue</a>');
  } 
  if ( (position < 999) & (index > 4) ) {
    $('#pending-melodies').append('You are #'+toString(index +1)+' in the queue');
  }
  edit_pg = '/node/'+data[1].toString()+'/edit';
  if (position == -1) {
    if (parent.mainFrame.location.href.match(edit_pg) == edit_pg) {
      startPlaying();
    } else {
      parent.mainFrame.location.href = base + '/'+edit_pg ;
    }
  }
  if (index < 4 ) {
    $('#pending-melodies').prepend('Your turn is coming soon! <a href="'+base+'/'+edit_pg+'" target="mainFrame">Want to practice?</a>');
  }
}

$(document).ready(function() {
  if ( $('.logged-in').length ) {
    $.getJSON('/queue-position',null,getStatus);
  }
});