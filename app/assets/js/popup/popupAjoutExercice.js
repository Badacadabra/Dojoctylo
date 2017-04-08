$( document ).ready(function(){
    // On cache la popup quand l'utilisateur charge un exercice sur-mesure
    $( "section#formulaireAjoutExercice" ).hide();
    // On révèle la popup quand l'utilisateur veut ajouter un exercice sur-mesure
    $( "button#ajoutExercice" ).click(function(){
        $( "section#formulaireAjoutExercice" ).addClass( "pop-up" );
        $( "#fondu" ).fadeIn();
        $( "section#formulaireAjoutExercice" ).slideDown();
        $( "html, body" ).animate( { scrollTop: 500 }, 700 );
    });
    // On cache la popup et on réinitialise les erreurs du formulaire quand l'utilisateur clique sur la croix
    $( "button#croix" ).click(function(){
        $( "#fondu" ).fadeOut();
        $( "section#formulaireAjoutExercice" ).slideUp();
        $( "input[type='text']" ).css( "background-color", "white" );
        $( "textarea" ).css( "background-color", "white" );
        $( "section#formulaireAjoutExercice .erreursFormulaires" ).each(function() {
            $( this ).text( "" );
        });
    }); // La validation est gérée par validForm.js
});
