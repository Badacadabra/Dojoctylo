$( document ).ready(function() {
    
  $( ".pop-up" ).hide();
  $( ".supprimer" ).click(function( e ) {

      var lien = $( this );
        
      e.preventDefault();
      $( "#fondu" ).fadeIn();
      $( ".pop-up" ).fadeIn();
        
      $( "button#oui" ).click(function() {
        window.location.href = lien.attr( "href" );
      });
      $( "button#non" ).click(function() {
        $( "#fondu" ).fadeOut();
        $( ".pop-up" ).fadeOut();
      });
        
  });
    
});

