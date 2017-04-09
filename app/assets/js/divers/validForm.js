$( document ).ready(function() {

     ///////////////
    // Connexion //
   ///////////////

    $( "section#login form" ).submit(function(event) {

        // Validation de l'identifiant
        var pseudo = $( this ).children().eq(0);
        if (pseudo.val() == "") {
            event.preventDefault();
            pseudo.css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
            pseudo.next().text( "Champ obligatoire" );
        } else {
            pseudo.css({ "background-color":"white", "border-color":"white" });
            pseudo.next().text( "" );
        }

        // Validation du mot de passe
        var mdp = $( this ).children().eq(2);
        if (mdp.val() == "") {
            event.preventDefault();
            mdp.css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
            mdp.next().text( "Champ obligatoire" );
        } else {
            mdp.css({ "background-color":"white", "border-color":"white" });
            mdp.next().text( "" );
        }
    });

     /////////////////
    // Inscription //
   /////////////////

    $( "section#signup form" ).submit(function(event) {
        var regexPseudo = /^[a-zA-Z0-9_]{3,20}$/;
        var regexMail = /[a-zA-Z0-9_\.\+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-\.]+/;
        var regexMdp = /.{8,}/;

        // Validation du pseudo
        var pseudo = $( this ).children().eq(0);
        if (pseudo.val() == "") {
            event.preventDefault();
            pseudo.css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
            pseudo.next().text( "Champ obligatoire" );
        } else if (!regexPseudo.test(pseudo.val())) {
            event.preventDefault();
            pseudo.css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
            pseudo.next().text( "Pseudo invalide" );
        } else {
            pseudo.css({ "background-color":"white", "border-color":"white" });
            pseudo.next().text( "" );
        }

        // Validation de l'adresse e-mail
        var mail = $( this ).children().eq(2);
        if (mail.val() == "") {
            event.preventDefault();
            mail.css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
            mail.next().text( "Champ obligatoire" );
        } else if (!regexMail.test(mail.val())) {
            event.preventDefault();
            mail.css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
            mail.next().text( "E-Mail invalide" );
        } else {
            mail.css({ "background-color":"white", "border-color":"white" });
            mail.next().text( "" );
        }

        // Validation du mot de passe
        var mdp = $( this ).children().eq(4);
        if (mdp.val() == "") {
            event.preventDefault();
            mdp.css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
            mdp.next().text( "Champ obligatoire" );
        } else if (!regexMdp.test(mdp.val())) {
            event.preventDefault();
            mdp.css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
            mdp.next().text( "Trop court ! 8 caractères minimum !" );
        } else {
            mdp.css({ "background-color":"white", "border-color":"white" });
            mdp.next().text( "" );
        }

    });

     ////////////////////////////
    // Modification du profil //
   ////////////////////////////

    $( "section#formulaireProfil form" ).submit(function(event) {
        var regexPseudo = /^[a-zA-Z0-9_]{3,20}$/;
        var regexMail = /[a-zA-Z0-9_\.\+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-\.]+/;
        var regexMdp = /.{8,}/;

        // Validation du pseudo
        var pseudo = $( "fieldset" ).children().eq(0);
        if (pseudo.val() != "" && !regexPseudo.test(pseudo.val())) {
            event.preventDefault();
            pseudo.css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
            pseudo.next().text( "Pseudo invalide" );
        } else {
            pseudo.css({ "background-color":"white", "border-color":"white" });
            pseudo.next().text( "" );
        }

        // Validation de l'adresse e-mail
        var mail = $( "fieldset" ).children().eq(2);
        if (mail.val() != "" && !regexMail.test(mail.val())) {
            event.preventDefault();
            mail.css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
            mail.next().text( "E-Mail invalide" );
        } else {
            mail.css({ "background-color":"white", "border-color":"white" });
            mail.next().text( "" );
        }

        // Validation du mot de passe
        var mdp = $( "fieldset" ).children().eq(4);
        if (mdp.val() != "" && !regexMdp.test(mdp.val())) {
            event.preventDefault();
            mdp.css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
            mdp.next().text( "Trop court ! 8 caractères minimum !" );
        } else {
            mdp.css({ "background-color":"white", "border-color":"white" });
            mdp.next().text( "" );
        }

        // Validation de la description (CKEditor)
        var description = CKEDITOR.instances.descriptionProfil;
        if (description.getData() == "") {
            event.preventDefault();
            $( "#erreurCkeditor" ).text( "Veuillez entrer une description ou fermez la pop-up." );
        } else if (description.getData().length > 3000) {
            event.preventDefault();
            $( "#erreurCkeditor" ).text( "Votre description est trop longue (> 3000 caractères, HTML inclus)." );
        } else {
            $( "#erreurCkeditor" ).text( "" );
        }

    });

     //////////////////////
    // Ajout d'exercice //
   //////////////////////

    $( "section#formulaireAjoutExercice form" ).submit(function(event) {

        // Validation des informations (source)
        var infos = $( "fieldset" ).children().eq(0);
        if (infos.val() == "") {
            event.preventDefault();
            infos.css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
            infos.next().text( "Champ obligatoire" );
        } else {
            infos.css({ "background-color":"white", "border-color":"white" });
            infos.next().text( "" );
        }

        // Validation du contenu
        var contenu = $( "fieldset" ).children().eq(2);
        if (infos.val() == "") {
            event.preventDefault();
            contenu.css({ "background-color":"#F3ABAF", "border-color":"#CB1D2E" });
            contenu.next().text( "Champ obligatoire" );
        } else {
            contenu.css({ "background-color":"white", "border-color":"white" });
            contenu.next().text( "" );
        }

        // Validation du mode de difficulté (facile, moyen, difficile)
        var difficulte = $( "fieldset input[type='radio']:checked" );
        if (difficulte.length == 0) {
            $( "fieldset .erreursFormulaires:nth-of-type(2)" ).css( "margin-bottom", "15px" );
            $( "fieldset label" ).last().next().css( "display", "inline" );
            $( "fieldset label" ).last().next().text( "Champ obligatoire" );
        } else {
            $( "fieldset label" ).last().next().text( "" );
        }

    });

});
