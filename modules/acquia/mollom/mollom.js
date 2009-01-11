// $Id: mollom.js,v 1.2.2.3 2008/08/19 15:42:30 dries Exp $

Drupal.behaviors.mollom = function() {
  // Add onclick.event handlers for CAPTCHA links:
  $('a#audio-captcha').click(getAudioCaptcha);
  $('a#image-captcha').click(getImageCaptcha);
}

function getAudioCaptcha() {
  // Extract the Mollom session ID from the form:
  var mollomSessionId = $("input#edit-session-id").val();

  // Retrieve an audio CAPTCHA:
  var data = $.get(Drupal.settings.basePath + 'mollom/captcha/audio/' + mollomSessionId,
    function(data) {
     // When data is successfully loaded, replace
     // contents of captcha-div with an audio CAPTCHA:
     $('div#captcha').html(data);

     // Add an onclick-event handler for the new link:
     $('a#image-captcha').click(getImageCaptcha);
   });
   return false;
}

function getImageCaptcha() {
  // Extract the Mollom session ID from the form:
  var mollomSessionId = $('input#edit-session-id').val();

  // Retrieve an image CAPTCHA:
  var data = $.get(Drupal.settings.basePath + 'mollom/captcha/image/' + mollomSessionId,
    function(data) {
     // When data is successfully loaded, replace
     // contents of captcha-div with an image CAPTCHA:
     $('div#captcha').html(data);

     // Add an onclick-event handler for the new link:
     $('a#audio-captcha').click(getAudioCaptcha);
   });
   return false;
}
