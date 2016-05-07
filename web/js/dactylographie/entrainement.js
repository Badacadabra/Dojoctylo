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
var nbCaracteres;
var timerIntervalle;
var timerActif = false;
var secondes = 0;
var contenus;
var nbContenus;
var mode;
var difficulte;

/* ================================================== */
/* ================== Événements =================== */
/* ================================================ */

$( document ).ready(function() {

    // Gestion du mode d'entraînement et de la difficulté
    mode = $.urlParam('m');
    difficulte = $.urlParam('d');

    $( "#difficulte #" + difficulte ).css({ "border":"solid 3px white", "text-shadow":"0 0 2px black" });

    // Gestion du nombre de contenus (fichiers) par mode et difficulté

    if (mode == "bases" && difficulte == "facile") nbContenus = 15;
    if (mode == "bases" && difficulte == "moyen") nbContenus = 15;
    if (mode == "bases" && difficulte == "difficile") nbContenus = 11;
    if (mode == "digrammes" && difficulte == "facile") nbContenus = 8;
    if (mode == "digrammes" && difficulte == "moyen") nbContenus = 8;
    if (mode == "digrammes" && difficulte == "difficile") nbContenus = 8;
    if (mode == "trigrammes" && difficulte == "facile") nbContenus = 2;
    if (mode == "trigrammes" && difficulte == "moyen") nbContenus = 2;
    if (mode == "trigrammes" && difficulte == "difficile") nbContenus = 2;
    if (mode == "mots" && difficulte == "facile") nbContenus = 3;
    if (mode == "mots" && difficulte == "moyen") nbContenus = 5;
    if (mode == "mots" && difficulte == "difficile") nbContenus = 2;
    if (mode == "phrases" && difficulte == "facile") nbContenus = 2;
    if (mode == "phrases" && difficulte == "moyen") nbContenus = 2;
    if (mode == "phrases" && difficulte == "difficile") nbContenus = 2;
    if (mode == "nombres" && difficulte == "facile") nbContenus = 5;
    if (mode == "nombres" && difficulte == "moyen") nbContenus = 4;
    if (mode == "nombres" && difficulte == "difficile") nbContenus = 2;
    if (mode == "textes" && difficulte == "facile") nbContenus = 2;
    if (mode == "textes" && difficulte == "moyen") nbContenus = 4;
    if (mode == "textes" && difficulte == "difficile") nbContenus = 2;
    if (mode == "code" && difficulte == "facile") nbContenus = 2;
    if (mode == "code" && difficulte == "moyen") nbContenus = 2;
    if (mode == "code" && difficulte == "difficile") nbContenus = 2;
    if (mode == "custom" && difficulte == "facile") nbContenus = 2;
    if (mode == "custom" && difficulte == "moyen") nbContenus = 2;
    if (mode == "custom" && difficulte == "difficile") nbContenus = 2;

    // Initialisation du module

    selectionAleatoire();
    chargementContenu();

    // Gestion centrale du formulaire de saisie
    $( "#zone-saisie" ).bind("input", function() {
        // Lancement conditionnel du timer
        if (!timerActif) {
            timer();
            timerActif = true;
        }
        // Arrêt conditionnel du timer (et donc de l'exercice)
        if (timerActif && id+1 == nbCaracteres) {
            resultats();
            clearTimer();
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
        selectionAleatoire();
        chargementContenu();
    });

    // Gestion des boutons pour la sélection de la difficulté
    $( "#difficulte button" ).click(function() {
        var niveau = $( this ).attr( 'id' );
        switch (niveau) {
            case "facile":
                window.location.href = 'index.php?p=pratiquer&m=' + mode + '&d=facile';
                break;
            case "moyen":
                window.location.href = 'index.php?p=pratiquer&m=' + mode + '&d=moyen';
                break;
            case "difficile":
                window.location.href = 'index.php?p=pratiquer&m=' + mode + '&d=difficile';
                break;
        }
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
        var texteASaisir = $( "#contenu" ).text();
        texteASaisir = texteASaisir.replace(/’/g, "'");
        nbCaracteres = texteASaisir.length;
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
    var nbAleatoire = Math.floor(Math.random() * nbContenus);
    nomFichierSuivant = "javascript/dactylographie/contenus/" + mode + "/" + difficulte + "/" + nbAleatoire;
    while (nomFichierSuivant == nomFichierActuel) {
        nbAleatoire = Math.floor(Math.random() * nbContenus);
        nomFichierSuivant = "javascript/dactylographie/contenus/" + mode + "/" + difficulte + "/" + nbAleatoire;
    }
}

// Compte à rebours d'une minute
function timer() {
    timerIntervalle = setInterval(function() {
        secondes++;
    }, 1000);
}

// Résultats en fin d'exercice
function resultats() {
    $( "#zone-saisie" ).prop( "readonly", true );
    $( "#a-taper" ).css( "opacity", "0.5" );
    // Score : vitesse
    var vitesse = Math.round(nbSaisiesOk / (5 * (secondes / 60)));
    $( "#performance #vitesse" ).text( "Vitesse : " + vitesse + " MPM" ).fadeIn();
    // Score : précision
    var precision = Math.round((nbSaisiesOk / (id + nbCorrections)) * 100);
    $( "#performance #precision" ).text( "Précision : " + precision + " %" ).fadeIn();
    // On envoie à PHP la valeur du timer pour l'attribution des récompenses relatives à l'entraînement
    $.post( "index.php?p=pratiquer", { secondesEcoulees: secondes } );
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
    secondes = 0;
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
