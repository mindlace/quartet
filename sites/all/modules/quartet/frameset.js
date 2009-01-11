$(document).ready( function () {
  $(self.queue4tet).ready( function () {
    $(self.queue4tet.document).everyTime( 1000, null, self.queue4tet.queueUpdate, true );
  });
});