/* ================================================== */
/* ================== Variables ==================== */
/* ================================================ */

var id = 0;
var nbSaisiesOk = 0;
var nbErreurs = 0;
var nbCorrections = 0;
var caractereSaisi;
var scrollPosition = 0;
var nomFichierSuivant;
var nomFichierActuel;
var timerIntervalle;
var timerActif = false;
var secondes = 60;
var mode;
var contenus = [
                "javascript/dactylographie/contenus/test/0",
                "javascript/dactylographie/contenus/test/1",
                "javascript/dactylographie/contenus/test/2"
                ];

/* ================================================== */
/* ================== Événements =================== */
/* ================================================ */

$( document ).ready(function() {

    // Gestion du mode de compétition
    mode = $.urlParam('m');

    if ($.urlParam('p') == "affronter") {
        $( "#difficulte" ).hide();
    }

    // Initialisation du module

    selectionAleatoire();
    chargementContenu();

    $( "#performance #temps" ).html( secondes );

    // Gestion centrale du formulaire de saisie
    $( "#zone-saisie" ).bind("input", function() {
        // Lancement conditionnel du timer
        if (!timerActif) {
            timer();
            timerActif = true;
        }
        // Gestion de tout ce qui ne concerne pas la correction
        if (caractereSaisi != 'retour' && caractereSaisi != 'entree') {
           var caractereATaper = $( "#" + id ).text();
            if ($( this ).val().charAt(id) == caractereATaper) { // Saisie OK
                nbSaisiesOk++;
                $( "#" + id ).removeClass( "next" );
                $( "#" + id ).addClass( "valide" );
                $( "#a-taper" ).css( "border-color", "white" );
            } else { // Faute de frappe
                nbErreurs++;
                $( "#" + id ).removeClass( "next" );
                $( "#" + id ).addClass( "invalide" );
                $( "#a-taper" ).css( "border-color", "#D0112B" );
            }
            id++;
            $( "#" + id ).addClass( "next" );
        }
        // On efface toutes les traces de saisie si l'utilisateur vide le champ
        if ($( "#zone-saisie" ).val() == "") {
            clearStyle();
        }
    });

    // Gestion de la correction et des raccourcis clavier
    $( "#zone-saisie" ).keydown(function(event) {
        switch (event.which) {
            case 8: // Touche retour
                if (timerActif) {
                    caractereSaisi = 'retour';
                    nbCorrections++;
                    $( "#" + id ).removeClass( "next" );
                    if (id > 0) {
                       id--;
                    }
                    $( "#" + id ).addClass( "next" );
                    $( "#" + id ).removeClass( "invalide" );
                    $( "#" + id ).removeClass( "valide" );
                }
                break;
            case 13: // Touche entrée
                if (timerActif) {
                    caractereSaisi = 'entree';
                    if (scrollPosition == 0) scrollPosition = scrollPosition + 34;
                    else scrollPosition = scrollPosition + 24;
                    $( "#a-taper" ).animate({scrollTop: scrollPosition}, 100);
                    id++;
                    $( "#" + id ).addClass( "next" );
                }
                break;
            case 33: // Touche « page up »
                scrollPosition = 0;
                $( "#a-taper" ).animate({scrollTop: scrollPosition}, 100);
                break;
            case 34: // Touche « page down »
                scrollPosition = scrollPosition + $( "#a-taper" ).height();
                $( "#a-taper" ).animate({scrollTop: scrollPosition}, 100);
                break;
            default:
                caractereSaisi = '';
        }
    });

    // Gestion du bouton de rafraîchissement
    $( "#refresh" ).click(function() {
        clearTimer();
        selectionAleatoire();
        chargementContenu();
        $( "#performance #temps" ).html( secondes );
    });

});

/* ================================================== */
/* =============== Fonctions diverses ============== */
/* ================================================ */

// Chargement d'un nouveau contenu
function chargementContenu() {
    // Gestion visuelle du chargement pour l'utilisateur
    $( "#loader" ).show();
    $( "#source" ).hide();
    // Requête Ajax
    $( "#a-taper" ).load(nomFichierSuivant, function() {
        nomFichierActuel = nomFichierSuivant;
        $( "#loader" ).hide();
        $( "#source" ).fadeIn();
        $( "#source" ).html( $( "#a-taper" ).find( "#infos" ).html() );
        // Formatage du texte à la volée
        var texteASaisir = $( this ).find( "p" ).text();
        texteASaisir = texteASaisir.replace(/’/g, "'");
        // Injection de balises autour de chaque caractère du contenu pour pouvoir tout manipuler
        $( this ).html( "<span id=\"0\">" + texteASaisir.charAt(0) + "</span>");
        for (var i = 1; i < texteASaisir.length-1; i++) {
            if (texteASaisir.charAt(i) == "\n") {
                $( this ).append( "<br id=\"" + i + "\" />");
            } else {
                $( this ).append( "<span id=\"" + i + "\">" + texteASaisir.charAt(i) + "</span>");
            }
        }
        // Ajustements ergonomiques pour l'utilisateur
        clearStyle();
        clearScroll();
        clearPerformance();
        $( "#" + id ).addClass( "next" );
        $( "#zone-saisie" ).focus();
        $( "#zone-saisie" ).prop("readonly", false);
    });
}

// Sélection d'un contenu au hasard
function selectionAleatoire() {
    var nbAleatoire = Math.floor(Math.random() * contenus.length);
    nomFichierSuivant = contenus[nbAleatoire];
    while (nomFichierSuivant == nomFichierActuel) {
        nbAleatoire = Math.floor(Math.random() * contenus.length);
        nomFichierSuivant = contenus[nbAleatoire];
    }
}

// Compte à rebours d'une minute
function timer() {
    timerIntervalle = setInterval(function() {
        if (secondes > 0) {
            secondes--;
        }
        if (secondes == 0) {
            clearTimer();
            $( "#zone-saisie" ).prop( "readonly", true );
            $( "#a-taper" ).css( "opacity", "0.5" );
            // Score : vitesse
            var vitesse = Math.round(nbSaisiesOk / 5);
            $( "#performance #vitesse" ).text( "Vitesse : " + vitesse + " MPM" ).fadeIn();
            // Score : précision
            var precision = Math.round((nbSaisiesOk / (id + nbCorrections)) * 100);
            $( "#performance #precision" ).text( "Précision : " + precision + " %" ).fadeIn();
            // Soumission du score
            $.post( "index.php?p=affronter&m=solo", { vitesse: vitesse, precision: precision } );
        }
        $( "#performance #temps" ).html( secondes );
    }, 1000);
}

// Réinitialisation de l'interface
function clearStyle() {
    $( "#performance #vitesse" ).hide();
    $( "#performance #precision" ).hide();
    $( "#zone-saisie" ).val( "" );
    $( "#a-taper" ).css({ "opacity":"1", "border-color":"white" });
    for (var i = 0; i < id+1; i++) {
        $( "#" + i).removeClass( "valide" );
        $( "#" + i).removeClass( "invalide" );
        $( "#" + i).removeClass( "next" );
        $( "#0" ).addClass( "next" );
    }
    id = 0;
}

// Réinitialisation du scroll
function clearScroll() {
    scrollPosition = 0;
    $( "#a-taper" ).animate({scrollTop: scrollPosition}, 100);
}

// Réinitialisation du timer
function clearTimer() {
    clearInterval(timerIntervalle);
    timerActif = false;
    secondes = 60;
}

// Réinitialisation des performances
function clearPerformance() {
    nbSaisiesOk = 0;
    nbErreurs = 0;
    nbCorrections = 0;
    $( "#performance #vitesse" ).text( "" );
    $( "#performance #precision" ).text( "" );
}

// Récupération du mode d'entraînement dans l'URL
$.urlParam = function(name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results == null) {
       return null;
    }
    else {
       return results[1] || 0;
    }
}
