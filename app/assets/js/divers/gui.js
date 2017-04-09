var gui = {
  init: function () {
    gui.scrollbar();
    gui.tooltip();
    gui.popup.init();
  },
  scrollbar: function () {
    $( "body" ).mCustomScrollbar({
      theme: "dojoctylo",
      autoExpandScrollbar: true
    });
  },
  tooltip: function () {
    $( document ).tooltip({
      position: {
        my: "center bottom-20",
        at: "center top",
        using: function( position, feedback ) {
          $( this ).css( position );
          $( "<div>" )
            .addClass( "arrow" )
            .addClass( feedback.vertical )
            .addClass( feedback.horizontal )
            .appendTo( this );
        }
      }
    });
  },
  popup: {
    init: function () {
      gui.popup.connexion();
      gui.popup.ajoutExercice();
      gui.popup.modifProfil();
      gui.popup.logout();
    },
    connexion: function () {
      $( "#fondu" ).show();
      // L'utilisateur accepte de se connecter
      $( "#oui" ).click(function() {
        window.location.href = "/authentification";
      });
      // L'utilisateur refuse de se connecter
      $( "#non" ).click(function() {
        // Si l'utilisateur accède directement à la page, il n'y a pas d'historique...
        if (history.length > 1) {
          history.back();
        } else {
          window.location.href = "/";
        }
      });
    },
    ajoutExercice: function () {
      // On cache la popup quand l'utilisateur charge un exercice sur-mesure
      $( "#formulaireAjoutExercice" ).hide();
      // On révèle la popup quand l'utilisateur veut ajouter un exercice sur-mesure
      $( "#ajoutExercice" ).click(function(){
        $( "#formulaireAjoutExercice" ).addClass( "pop-up" );
        $( "#fondu" ).fadeIn();
        $( "#formulaireAjoutExercice" ).slideDown();
        $( "html, body" ).animate( { scrollTop: 500 }, 700 );
      });
      // On cache la popup et on réinitialise les erreurs du formulaire quand l'utilisateur clique sur la croix
      $( "#croix" ).click(function(){
        $( "#fondu" ).fadeOut();
        $( "#formulaireAjoutExercice" ).slideUp();
        $( "input[type='text']" ).css( "background-color", "white" );
        $( "textarea" ).css( "background-color", "white" );
        $( "#formulaireAjoutExercice .erreursFormulaires" ).each(function() {
          $( this ).text( "" );
        });
      }); // La validation est gérée par validForm.js
    },
    modifProfil: function () {
      // On cache la popup quand l'utilisateur charge le profil
      $( "#formulaireProfil" ).hide();
      // On révèle la popup quand l'utilisateur veut modifier son profil
      $( "#modifProfil" ).click(function(){
        $( "#placeholder" ).fadeOut();
        $( "#formulaireProfil" ).addClass( "pop-up" );
        $( "#fondu" ).fadeIn();
        $( "#formulaireProfil" ).fadeIn();
        $( "html, body" ).animate( { scrollTop: 0 }, 300 );
      });
      // On cache la popup quand l'utilisateur clique sur la croix ou valide sa saisie
      $( "#croix" ).click(function(){
        $( "#placeholder" ).fadeIn();
        $( "#fondu" ).fadeOut();
        $( "#formulaireProfil" ).effect( "explode", 700 );
      }); // La validation est gérée par validForm.js
    },
    logout: function () {
      // Fermeture de la pop-up d'au revoir quand l'utilisateur se déconnecte
      $( "#fondu" ).fadeIn();
      $( "#ok" ).click(function() {
        $( "#fondu" ).fadeOut();
        $( ".pop-up" ).fadeOut();
      });
    }
  }
};

$( document ).ready(gui.init);
