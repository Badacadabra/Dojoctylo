$( document ).ready(function(){
    // On cache la popup quand l'utilisateur charge le profil
    $( "section#formulaireProfil" ).hide();
    // On révèle la popup quand l'utilisateur veut modifier son profil
    $( "button#modifProfil" ).click(function(){
        $( "div#placeholder" ).fadeOut();
        $( "section#formulaireProfil" ).addClass( "pop-up" );
        $( "#fondu" ).fadeIn();
        $( "section#formulaireProfil" ).fadeIn();
        $( "html, body" ).animate( { scrollTop: 0 }, 300 );
    });
    // On cache la popup quand l'utilisateur clique sur la croix ou valide sa saisie
    $( "button#croix" ).click(function(){
        $( "div#placeholder" ).fadeIn();
        $( "#fondu" ).fadeOut();
        $( "section#formulaireProfil" ).effect( "explode", 700 );
    }); // La validation est gérée par validForm.js
});
