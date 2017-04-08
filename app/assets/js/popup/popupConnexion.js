$( document ).ready(function() {
    $( "div#fondu" ).show();
    // L'utilisateur accepte de se connecter
    $( "button#oui" ).click(function() {
        window.location.href = "index.php?p=authentification";
    });
    // L'utilisateur refuse de se connecter
    $( "button#non" ).click(function() {
        // Si l'utilisateur accède directement à la page, il n'y a pas d'historique...
        if (history.length > 1) {
            history.back();
        } else {
            window.location.href = "index.php";
        }
    });
});
