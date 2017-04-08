/* ================================================== */
/* ================ Cœur du script ================= */
/* ================================================ */

$( document ).ready(function() {
    // Connexion
    $( "section#login form" ).submit(function(event) {
        champsVides("login", event);
        formulaireValide("login", event);
    });

    // Inscription
    $( "section#signup form" ).submit(function(event) {
        champsVides("signup", event);
        validerMailInscription(event);
        validerMotDePasseInscription(event);
        formulaireValide("signup", event);
    });
});

/* ================================================== */
/* ============= Fonctions génériques ============== */
/* ================================================ */

function champsVides(idSection, event) {
    event.preventDefault();
    var elements = $( "section#" + idSection + " form" ).children();
    var erreur;
    // On boucle dans les enfants du formulaire sollicité (le dernier enfant est exclu puisqu'il s'agit du bouton de soumission).
    for (var i = 0; i < elements.length-1; i++) {
        // Si on tombe sur une div réservée à l'affichage des erreurs, on ignore.
        if (elements.eq(i).hasClass( "erreursFormulaires" )) {
            continue;
        }
        // Si la valeur du champ (input) rencontré est vide, on applique un style à ce champ et on ajoute un message d'erreur dans la div qui suit.
        if (elements.eq(i).val() == "") {
            erreur = true;
           elements.eq(i).css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
           elements.eq(i+1).text( "Champ obligatoire" );
        } else {
            erreur = false;
            elements.eq(i).css({ "background-color":"white", "border-color":"white" });
            elements.eq(i+1).text( "" );
        }
    }
    return erreur;
}

function validerMailInscription(event) {
    event.preventDefault();
    var elements = $( "section#signup form" ).children();
    var erreur;
    // On boucle dans les enfants du formulaire sollicité (le dernier enfant est exclu puisqu'il s'agit du bouton de soumission).
    for (var i = 0; i < elements.length-1; i++) {
        // Une fois qu'on tombe sur le champ e-mail, on regarde s'il est correct.
        if (elements.eq(i).hasClass( "mail" )) {
            var chaine = elements.eq(i).val();
            var regex = /[a-zA-Z0-9_\.\+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-\.]+/;
            var resultat = regex.test(chaine);
            // Si l'utilisateur entre un mail incorrect, on lui notifie avec un message clair.
            // Si le champ est vide, c'est le message de la fonction « champsVides» qui sera affiché.
            if (!resultat && elements.eq(i).val() != "") {
                erreur = true;
                elements.eq(i).css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
                elements.eq(i+1).text( "E-Mail invalide" );
            } else {
                erreur = false;
                elements.eq(i).css({ "background-color":"white", "border-color":"white" });
                elements.eq(i+1).text( "" );
            }
        }
    }
    return erreur;
}

function validerMotDePasseInscription(event) {
    event.preventDefault();
    var element = $( "section#signup form input[type='password']" );
    var erreur;
    if (element.val().length < 8 && element.val() != "") {
        erreur = true;
        element.css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
        element.next().text( "Trop court ! 8 caractères minimum !" );
    } else {
        erreur = false;
        element.css({ "background-color":"white", "border-color":"white" });
        element.next().text( "" );
    }
    return erreur;
}

function formulaireValide(idSection, event) {
    if (!champsVides(idSection, event)
        && !validerMailInscription(event)
        && !validerMotDePasseInscription(event)
    ) {
        $( "section#" + idSection + " form" ).unbind('submit').submit();
    }
}
