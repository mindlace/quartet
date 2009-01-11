$(document).ready( function() { $(document).everyTime(3000, null, getQueue, 0, true); });

function getQueue() {
  if ($(document.body).hasClass('logged-in')) {
    getStatus();
  } else {
    var qsi = 'queue-sign-in'
    var cat = '<span id="'+qsi+'">You must <a href="/user" target="main4tet">log in</a> or '+
              '<a href="/user/register" target="main4tet">sign up</a> to join the queue.</span>'
    changeAction(qsi,cat);
    loadPending();
  } 
}
last_checked = 0;
function loadPending() {
  $('#pending-melodies').fadeOut();
  $('#pending-melodies').load('/quartet/pending-melodies');
  $('#pending-melodies').fadeIn();
  d = new Date();
  last_checked = d.getTime();
}

function changeAction(inner_id, newinsides) {
  if ($('#'+inner_id).length == 0) {
    $('#available-action').fadeOut('slow', function() {
      $(this).html(newinsides).fadeIn('slow');
    });
   $('#pending-melodies').load('/quartet/pending-melodies');
  }
}

var last_position = 10000;

var igo = 0;
edit_pg = '';

function getStatus() {
  $.getJSON('/quartet/queue/status', null, updateStatus);
}


function updateStatus(data, textStatus) {
  var qpos = data[0]; // == qpos in queue
  if ( data[1] != -10) {
    edit_pg = '/node/'+data[1]+'/edit'
  }
  if ( qpos == 1000) {
    var qjl = 'queue-join-link';
    changeAction(qjl, '<a href="/quartet/queue/join" id="'+qjl+'">Drücke hier um das Quartet zu spielen - Join Queue</a>');
    $('#'+qjl).click(function () {$(this).fadeOut();});
  }
  if ( ( qpos < 999) & ( qpos > 4) ) {
    var qcp = 'queue-current-position';  
    if ($('#'+qcp).length == 0) {
      $('#available-action').fadeOut('slow', function() {
        $(this).html('<span id="'+qcp+'">You are ' +
              '<span id="queue-position-number">#' +
              (qpos +1) +
              '</span> in the queue</span>').fadeIn('slow')
      });
    }
  }
    
  if (qpos < last_position) {
    $('#queue-position-number').fadeOut('fast',function() { $(this).html('# '+(qpos + 1)).fadeIn('fast').fadeOut('fast', function() {$(this).fadeIn('fast') } ) } ); 
    last_position = qpos;
    loadPending();
  }
  if (qpos == -1) { igo = true; }
  if ( igo ) {
    $(document).ready( function () {
      if (document.location.href.match(edit_pg) == edit_pg) {
        var qnp = 'queue-now-playing';
        if ($('#'+qnp).length == 0) {
          $(document).ready( function() {
            startPlaying();
            changeAction(qnp,'<span id="'+qnp+'>It is your turn!</span>');
          });
        }
        
      } else {
        if (document.href.match('thanks-for-the-melodies') == null) {
          document.location.href = edit_pg;
        } else {
          igo = false;
        }
      }
    });
    return;
  }
  if ( qpos < 4 ) {
    $(top).ready( function () {
      var wanna = '';
      if (document.location.href.match(edit_pg) == null) {
        $('#wanna-practice').fadeIn();
        wanna='<a id="wanna-practice" href="'+edit_pg+'" target="main4tet">Want to practice?</a>' 
      } else {
        if ($('#wanna-practice').length != 0) {
          $('#wanna-practice').fadeOut();
        }
      }
      var sid = 'queue-turn-soon';
      changeAction(sid,'<span id="'+sid+'">Your turn is coming soon! '+wanna+'</span>' );
      $('#wanna-practice').click(function () {$(this).fadeOut();});
    });
  }
  d = new Date()
  if (d.getTime() - last_checked > 30000) {
    loadPending();
  }
}
