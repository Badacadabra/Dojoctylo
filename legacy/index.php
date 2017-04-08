<?php

session_start();

use BaptisteVannesson\Membre\Membre;
use BaptisteVannesson\Membre\MembreBd;
use BaptisteVannesson\Profil\Profil;
use BaptisteVannesson\Profil\ProfilBd;
use BaptisteVannesson\Profil\ProfilHtml;
use BaptisteVannesson\Recompenses\Recompense;
use BaptisteVannesson\Recompenses\RecompenseBd;
use BaptisteVannesson\Authentification\Connexion;
use BaptisteVannesson\Authentification\Inscription;
use BaptisteVannesson\Exercices\ExerciceHtml;
use BaptisteVannesson\Exercices\Test;
use BaptisteVannesson\Exercices\TestBd;
use BaptisteVannesson\Exercices\TextePerso;
use BaptisteVannesson\Exercices\TextePersoBd;
use BaptisteVannesson\Exercices\TextePersoHtml;
use BaptisteVannesson\Classement\ClassementHtml;
use BaptisteVannesson\Classement\ClassementBd;
use BaptisteVannesson\Utils\Bd\ConnexionBd;
use BaptisteVannesson\Utils\Chiffrement\ChiffrementMdp;
use BaptisteVannesson\Utils\Nettoyage\NettoyeurManager;

require_once "php/config/Autoloader.class.php";
require_once "php/config/config.php";
require_once "php/lib/password.php";

// Autoload des classes
$autoloader = new Autoloader();

$squelette = "ui/templates/squelette.tpl.php";
$titre = "";
$script = "";
$contenu = "";
$auth = Connexion::getInstance();

if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = "accueil";
}

// Déconnexion de l'utilisateur
if (isset($_GET['a']) && $_GET['a'] == 'quitter') {
    $auth->quitter();
}

// L'utilisateur est-il connecté ?
if ($auth->estActive()) {
    $authInfos = Connexion::afficherInfosConnexion();
} else {
    $authInfos = "<a href=\"index.php?p=authentification\">Connexion / Inscription</a>\n";
}

// Switch principal gérant l'affichage de chaque page avec les actions associées
switch ($page) {
    case "accueil":
        $titre = "Dojoctylo : le site qui va faire de vous un ninja du clavier !";
        $contenu = file_get_contents("fragments/informations/index.frg.html");
        // Attribution d'une récompense si le membre est connecté depuis au moins une heure (Sushi)
        if ($auth->estActive()) {
            $maintenant = time();
            $debutSession = $_SESSION['started'];
            $dureeSession = $maintenant - $debutSession;
            if ($dureeSession > 3600
                && $auth->estActive()
                && !RecompenseBd::recompenseAttribuee($auth->getId(), Recompense::ID_SUSHI)
            ) {
                RecompenseBd::attributionRecompense($auth->getId(), Recompense::ID_SUSHI);
            }
        }
        break;
    case "affronter":
        $titre = "Affrontez d'autres ninjactylos dans le cadre de compétitions | Dojoctylo";
        $contenu = file_get_contents("fragments/informations/affronter.frg.html");
        // Gestion des modes de compétition
        $modes = array("solo", "prive", "public");
        if (isset($_GET['m']) && in_array($_GET['m'], $modes)) {
            $page = $_GET['p'];
            $mode = $_GET['m'];
            if ($auth->estActive()) {
                $pseudo = $auth->getPseudo();
            } else {
                $pseudo = "";
            }
            $titre = "Prêt(e) pour des compétitions entre ninjas du clavier ? | Dojoctylo";
            $contenu = ExerciceHtml::chargerInterface($page, $mode, $pseudo);
            $script = ExerciceHtml::chargerScript($page, $mode);
            // Si l'utilisateur a terminé un test, on sauvegarde son score
            if ($auth->estActive() && isset($_POST) && !empty($_POST)) {
                $vitesse = (int) $_POST['vitesse'];
                $precision = (int) $_POST['precision'];
                $idMembre = (int) $auth->getId();
                $test = new Test("", $vitesse, $precision, "", $idMembre);
                TestBd::enregistrer($test);
                // Attribution éventuelle d'une récompense pour la vitesse
                // Karatéka
                if ($vitesse >= 50
                    && !RecompenseBd::recompenseAttribuee($idMembre, Recompense::ID_KARATEKA)
                ) {
                    RecompenseBd::attributionRecompense($idMembre, Recompense::ID_KARATEKA);
                    $recompense = RecompenseBd::infosRecompense(Recompense::ID_KARATEKA);
                }
                // Espion
                if ($vitesse >= 70
                    && !RecompenseBd::recompenseAttribuee($idMembre, Recompense::ID_ESPION)
                ) {
                    RecompenseBd::attributionRecompense($idMembre, Recompense::ID_ESPION);
                    $recompense = RecompenseBd::infosRecompense(Recompense::ID_ESPION);
                }
                // Guerrier
                if ($vitesse >= 90
                    && !RecompenseBd::recompenseAttribuee($idMembre, Recompense::ID_GUERRIER)
                ) {
                    RecompenseBd::attributionRecompense($idMembre, Recompense::ID_GUERRIER);
                    $recompense = RecompenseBd::infosRecompense(Recompense::ID_GUERRIER);
                }
                // Assassin
                if ($vitesse >= 110
                    && !RecompenseBd::recompenseAttribuee($idMembre, Recompense::ID_ASSASSIN)
                ) {
                    RecompenseBd::attributionRecompense($idMembre, Recompense::ID_ASSASSIN);
                    $recompense = RecompenseBd::infosRecompense(Recompense::ID_ASSASSIN);
                }
                // Légende
                if ($vitesse >= 130
                    && !RecompenseBd::recompenseAttribuee($idMembre, Recompense::ID_LEGENDE)
                ) {
                    RecompenseBd::attributionRecompense($idMembre, Recompense::ID_LEGENDE);
                    $recompense = RecompenseBd::infosRecompense(Recompense::ID_LEGENDE);
                }
            }
        }
        // Si l'utilisateur veut faire des compétitions (hors test), il doit se connecter
        if (!$auth->estActive() && isset($_GET['m']) && (($_GET['m'] == "prive") || ($_GET['m'] == "public"))) {
                $contenu .= "<div class=\"pop-up\">\n";
                $contenu .= "   <p>Vous devez vous connecter !</p>\n";
                $contenu .= "   <button id=\"oui\">OK</button>\n";
                $contenu .= "   <button id=\"non\">Plus tard</button>\n";
                $contenu .= "</div>\n";
                $contenu .= "<div id=\"fondu\"></div>\n";
        }
        break;
    case "apprendre":
        // Affichage par défaut pour le choix du contenu à consulter
        $titre = "Apprenez à taper au clavier avec Maître Taipingu | Dojoctylo";
        $contenu = file_get_contents("fragments/informations/apprendre.frg.html");
        // Quel type de contenu l'utilisateur choisit-il de consulter ?
        if (isset($_GET['m'])) {
            $modeApprentissage = $_GET['m'];
            switch ($modeApprentissage) {
                case "conseils":
                    $titre = "Les conseils sacrés du dojo pour bien taper au clavier | Dojoctylo";
                    $contenu = file_get_contents("fragments/informations/conseils.frg.html");
                    break;
                case "tutoriels":
                    // Affichage par défaut pour le choix du tuto
                    $titre = "Choisissez un tuto et voyez comment bien taper au clavier | Dojoctylo";
                    $contenu = file_get_contents("fragments/informations/tutoriels.frg.html");
                    // Si l'utilisateur veut lire un tuto...
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                        switch ($id) {
                            case 1:
                                $titre = "Découverte des lettres avec dix doigts | Tutoriels | Dojoctylo";
                                $contenu = file_get_contents("fragments/informations/tutoriel-1.frg.html");
                                // Attribution d'une récompense pour la première lecture d'un tuto de base (Bol vide)
                                if ($auth->estActive() && !RecompenseBd::recompenseAttribuee($auth->getId(), Recompense::ID_BOLVIDE)) {
                                    RecompenseBd::attributionRecompense($auth->getId(), Recompense::ID_BOLVIDE);
                                }
                                break;
                            case 2:
                                $titre = "Utilisation des touches modificatrices | Tutoriels | Dojoctylo";
                                $contenu = file_get_contents("fragments/informations/tutoriel-2.frg.html");
                                break;
                            case 3:
                                $titre = "Saisie de caractères typographiques complexes | Tutoriels | Dojoctylo";
                                $contenu = file_get_contents("fragments/informations/tutoriel-3.frg.html");
                                break;
                        }
                    }
                    break;
                case "ergonomie":
                    $titre = "Quelques claviers ergonomiques pour une frappe confort | Dojoctylo";
                    $script = file_get_contents("fragments/scripts/ergonomie.frg.html");
                    $contenu = file_get_contents("fragments/informations/ergonomie.frg.html");
                    break;
            }
        }
        break;
    case "authentification":
        $titre = "Se connecter ou s'inscrire | Dojoctylo";
        $erreur = "";
        $popup = "";
        $script = file_get_contents("fragments/scripts/authentification.frg.html");
        if (isset($_GET['a'])) {
            $action = $_GET['a'];
            // Connexion
            if ($action == "connexion") {
                if (isset($_POST['loginConnexion']) && !empty($_POST['loginConnexion'])) {
                    $login = $_POST['loginConnexion'];
                } else {
                    $login = "";
                    // $erreur = "Champ obligatoire";
                }
                if (isset($_POST['mdpConnexion']) && !empty($_POST['mdpConnexion'])) {
                    $mdp = $_POST['mdpConnexion'];
                } else {
                    $mdp = "";
                    // $erreur = "Champ obligatoire";
                }
                $verif = $auth->verifierAuthentification($login, $mdp);
                if ($verif) {
                    // On commence par stocker le timestamp du début de la connexion en session
                    if (!isset($_SESSION['started'])) {
                        $_SESSION['started'] = time();
                    }
                    $authInfos = Connexion::afficherInfosConnexion();
                    header('Location: index.php?p=profil&u=' . strtolower($auth->getPseudo()) . '&id=' . $auth->getId());
                    // Attribution d'une récompense pour la première connexion (Bambou)
                    if (!RecompenseBd::recompenseAttribuee($auth->getId(), Recompense::ID_BAMBOU)) {
                        RecompenseBd::attributionRecompense($auth->getId(), Recompense::ID_BAMBOU);
                    }
                } else {
                    $erreur = Connexion::afficherErreurConnexion();
                }
            }
            // Inscription
            if ($action == "inscription") {
                $inscription = new Inscription();
                $nettoyeur = new NettoyeurManager();
                $nettoyeur->ajouter('BaptisteVannesson\Utils\Nettoyage\NettoyeurBalisesHtml');
                $nettoyeur->ajouter('BaptisteVannesson\Utils\Nettoyage\NettoyeurEspacesVides');
                $data = $nettoyeur->nettoyer($_POST);
                $validation = $inscription->validationFormulaire($data);
                if ($validation) {
                    $membre = new Membre("",
                                        $data['pseudoInscription'],
                                        $data['mailInscription'],
                                        $data['mdpInscription'],
                                        "",
                                        "",
                                        0,
                                        0,
                                        0
                                        );
                    $inscription->envoiMail($membre);
                    $mdp = ChiffrementMdp::chiffrer($data['mdpInscription']);
                    $membre->setMotDePasse($mdp);
                    $inscription->insertionBd($membre);
                    header('Location: index.php?p=authentification');
                }
            }
            // Quitter
            if ($action == "quitter") {
                $popup .= "<div class=\"pop-up\">\n";
                $popup .= "   <p>À bientôt, au cœur du Dojo !</p>\n";
                $popup .= "   <button id=\"ok\">OK</button>\n";
                $popup .= "</div>\n";
                $popup .= "<div id=\"fondu\"></div>\n";
            }
        }
        $contenu = Connexion::chargerTemplate($erreur, $popup);
        break;
    case "classement":
        $titre = "Le classement ultime pour les ninjas du clavier | Dojoctylo";
        $script = file_get_contents("fragments/scripts/classement.frg.html");
        // Gestion du mode d'affichage (jour, semaine, mois, année, global)
        if (isset($_GET['m'])) {
            $modeAffichage = $_GET['m'];
        } else {
            $modeAffichage = "jour";
        }
        switch ($modeAffichage) {
            case "jour":
                $reqDate = ' WHERE date = CURDATE() ';
                break;
            case "semaine":
                $reqDate = ' WHERE WEEK(date, 1) = WEEK(CURDATE(), 1) '; // La semaine commence lundi
                break;
            case "mois":
                $reqDate = ' WHERE MONTH(date) = MONTH(CURDATE()) ';
                break;
            case "annee":
                $reqDate = ' WHERE YEAR(date) = YEAR(CURDATE()) ';
                break;
            case "global":
                $reqDate = ' ';
                break;
        }
        $membresRapides = ClassementBd::classementVitesse($reqDate);
        $membresActifs = ClassementBd::classementActivite($reqDate);
        $classementVitesse = "";
        $classementActivite = "";
        if (isset($membresRapides) && !empty($membresRapides)) {
            // On construit ici le tableau du classement ayant trait à la vitesse
            foreach ($membresRapides as $cle => $membreRapide) {
                $id = $membreRapide['id'];
                $pseudo = strtolower($membreRapide['pseudo']);
                $vitesse = $membreRapide['scoreVitesse'];
                $url = "index.php?p=profil&amp;u={$pseudo}&amp;id={$id}";
                $rang = $cle+1;
                $classementVitesse .= "<tr><td>{$rang}</td><td><a href=\"{$url}\">{$pseudo}</a></td><td>{$vitesse}</td></tr>\n";
            }
        }
        if (isset($membresActifs) && !empty($membresActifs)) {
            // On construit ici le tableau du classement ayant trait à l'activité
            foreach ($membresActifs as $cle => $membreActif) {
                $activite = $membreActif['nbTests'];
                if ($activite != 0) {
                    $id = $membreActif['id'];
                    $pseudo = strtolower($membreActif['pseudo']);
                    $url = "index.php?p=profil&amp;u={$pseudo}&amp;id={$id}";
                    $rang = $cle+1;
                    $classementActivite .= "<tr><td>{$rang}</td><td><a href=\"{$url}\">{$pseudo}</a></td><td>{$activite}</td></tr>\n";
                }
            }
        }
        $contenu = ClassementHtml::chargerTemplate($classementVitesse, $classementActivite);
        break;
    case "faq":
        $titre = "Foire aux questions | Dojoctylo";
        $contenu = file_get_contents("fragments/informations/faq.frg.html");
        break;
    case "mentions-legales":
        $titre = "Mentions légales | Dojoctylo";
        $contenu = file_get_contents("fragments/informations/mentions-legales.frg.html");
        break;
    case "plan-du-site":
        $titre = "Plan du site | Dojoctylo";
        $contenu = file_get_contents("fragments/informations/plan-du-site.frg.html");
        break;
    case "pratiquer":
        // Affichage par défaut pour le choix du mode de pratique
        $titre = "Pratiquez encore et toujours pour devenir un ninjactylo | Dojoctylo";
        $contenu = file_get_contents("fragments/informations/pratiquer.frg.html");
        $modes = array("bases", "digrammes", "trigrammes", "mots", "phrases", "nombres", "textes", "code", "custom");
        // Quel est le mode de pratique choisi par l'utilisateur ?
        if (isset($_GET['m']) && in_array($_GET['m'], $modes)) {
            $page = $_GET['p'];
            $mode = $_GET['m'];
            $titre = "Augmentez votre vitesse et votre précision avec des exercices | Dojoctylo";
            $contenu = ExerciceHtml::chargerInterface($page, $mode);
            $script = ExerciceHtml::chargerScript($page, $mode);
            // Attribution d'une récompense pour la pratique d'un premier exercice de base (Soupe miso)
            if ($auth->estActive() && !RecompenseBd::recompenseAttribuee($auth->getId(), Recompense::ID_SOUPEMISO)) {
                RecompenseBd::attributionRecompense($auth->getId(), Recompense::ID_SOUPEMISO);
            }
            // Gestion du mode sur-mesure
            if ($auth->estActive() && $_GET['m'] == "custom") {
                // Si l'utilisateur veut ajouter du contenu personnalisé
                if (isset($_GET['a']) && $_GET['a'] == "ajouter") {
                    // Nettoyage particulier à prévoir...
                    $textePerso = new TextePerso(
                        "",
                        $_POST['infosExercice'],
                        $_POST['contenuExercice'],
                        $_POST['difficulteExercice']
                    );
                    TextePersoBd::enregistrer($textePerso, $auth->getId());
                }
                // Si l'utilisateur veut gérer ses contenus ajoutés
                if (isset($_GET['s']) && $_GET['s'] == "gerer") {
                    $textesPerso = TextePersoBd::lireListeTextes();
                    $contenu = TextePersoHtml::afficherListe($textesPerso);
                    $script = file_get_contents("fragments/scripts/gestionExercices.frg.html");
                    // Si l'utilisateur veut modifier un contenu...
                    if (isset($_GET['a']) && $_GET['a'] == "modifier" && isset($_GET['id'])) {
                        $script = file_get_contents("fragments/scripts/modifExercice.frg.html");
                        $texte = TextePersoBd::lireTexte($_GET['id']);
                        $idExercice = $texte->getId();
                        $infosExercice = $texte->getInfos();
                        $contenuExercice = $texte->getContenu();
                        $difficulteExercice = $texte->getDifficulte();
                        $formulaire = TextePersoHtml::chargerFormulaire($idExercice, $infosExercice, $contenuExercice, $difficulteExercice);
                        $contenu = $formulaire;
                    }
                    // Enregistrement des modifications en base de données
                    if (isset($_GET['a']) && $_GET['a'] == "validerModif") {
                        $textePerso = new TextePerso(
                            $_POST['idExercice'],
                            $_POST['infosExercice'],
                            $_POST['contenuExercice'],
                            $_POST['difficulteExercice']
                        );
                        TextePersoBd::modifier($textePerso);
                        header("Location: index.php?p=pratiquer&m=custom&s=gerer");
                    }
                    // Si l'utilisateur veut supprimer un contenu
                    if (isset($_GET['a']) && $_GET['a'] == "supprimer") {
                        TextePersoBd::supprimer($_GET['id']);
                    }
                }
            }
            // Si l'utilisateur tente d'accéder au mode sur-mesure sans être connecté, il faut lui afficher un message
            if (!$auth->estActive() && $_GET['m'] == "custom") {
                $contenu .= "<div class=\"pop-up\">\n";
                $contenu .= "   <p>Vous devez vous connecter !</p>\n";
                $contenu .= "   <button id=\"oui\">OK</button>\n";
                $contenu .= "   <button id=\"non\">Plus tard</button>\n";
                $contenu .= "</div>\n";
                $contenu .= "<div id=\"fondu\"></div>\n";
            }
        }
        // Gestion des récompenses relatives à l'entraînement, quel que soit le mode
        if ($auth->estActive() && isset($_POST['secondesEcoulees']) && !empty($_POST['secondesEcoulees'])) {
            // Synchronisation avec la base de données après chaque exercice
            $tempsExercice = (int) $_POST['secondesEcoulees'];
            $membre = MembreBd::infosMembre($auth->getId());
            $tempsEntrainement = (int) $membre->getTempsEntrainement();
            $tempsTotalEntrainement = $tempsExercice + $tempsEntrainement;
            MembreBd::setTempsEntrainement($tempsTotalEntrainement, $auth->getId());
            // Attribution conditionnelle des récompenses
            $tempsTotalEntrainement /= 3600; // conversion des secondes en heures
            // Nunchaku
            if ($tempsTotalEntrainement >= 6
                && !RecompenseBd::recompenseAttribuee($auth->getId(), Recompense::ID_NUNCHAKU)
            ) {
                RecompenseBd::attributionRecompense($auth->getId(), Recompense::ID_NUNCHAKU);
            }
            // Shuriken
            if ($tempsTotalEntrainement >= 12
                && !RecompenseBd::recompenseAttribuee($auth->getId(), Recompense::ID_SHURIKEN)
            ) {
                RecompenseBd::attributionRecompense($auth->getId(), Recompense::ID_SHURIKEN);
            }
            // Tantô
            if ($tempsTotalEntrainement >= 24
                && !RecompenseBd::recompenseAttribuee($auth->getId(), Recompense::ID_TANTO)
            ) {
                RecompenseBd::attributionRecompense($auth->getId(), Recompense::ID_TANTO);
            }
            // Saï
            if ($tempsTotalEntrainement >= 48
                && !RecompenseBd::recompenseAttribuee($auth->getId(), Recompense::ID_SAI)
            ) {
                RecompenseBd::attributionRecompense($auth->getId(), Recompense::ID_SAI);
            }
            // Katana
            if ($tempsTotalEntrainement >= 72
                && !RecompenseBd::recompenseAttribuee($auth->getId(), Recompense::ID_KATANA)
            ) {
                RecompenseBd::attributionRecompense($auth->getId(), Recompense::ID_KATANA);
            }
        }
        break;
    case "profil":
        $script = file_get_contents("fragments/scripts/profil.frg.html");
        // Si l'utilisateur est connecté et qu'il veut accéder à son propre profil...
        if ($auth->estActive() && isset($_GET['u']) && $_GET['u'] == strtolower($auth->getPseudo())) {
            $titre = $auth->getPseudo() . " | Dojoctylo";
            $gravatar = Profil::requeteGravatar($auth);
            $messagePhoto = "Modifier ma photo";
            $recompenses = ProfilBd::listeRecompenses($auth);
            $scores = ProfilBd::derniersScores($auth);
            $boutonModif = "<button type=\"button\" id=\"modifProfil\" >Modifier mes informations</button>";
            $nbTests = ProfilBd::nombreTests($auth);
            $meilleurScore = ProfilBd::meilleurScore($auth);
            $id = $_GET['id'];
            $membre = MembreBd::infosMembre($id);
            // Conversion du format de la date d'inscription (YYYY-mm-dd vers dd/mm/YYYY)
            $dateMySql = new \DateTime($membre->getDateInscription());
            $dateInscription = $dateMySql->format('d/m/Y');
            // Conversion du temps d'entrainement
            $tempsEntrainement = $membre->getTempsEntrainement(); // secondes
            $heuresEntrainement = floor($tempsEntrainement / 3600);
            $minutesEntrainement = floor(($tempsEntrainement - ($heuresEntrainement * 3600)) / 60);
            $secondesEntrainement = $tempsEntrainement - ($heuresEntrainement * 3600) - ($minutesEntrainement * 60);
            $tempsEntrainement = (string) $heuresEntrainement . ":" . $minutesEntrainement . ":" . $secondesEntrainement;
            $nbFilleuls = $membre->getNbFilleuls();
            if (isset($_GET['a'])) {
                $action = $_GET['a'];
                // Si l'utilisateur souhaite modifier son profil...
                if ($action == "modifier") {
                    // On commence par nettoyer la saisie de l'utilisateur
                    $nettoyeur = new NettoyeurManager();
                    $nettoyeur->ajouter('BaptisteVannesson\Utils\Nettoyage\NettoyeurBalisesHtml');
                    $nettoyeur->ajouter('BaptisteVannesson\Utils\Nettoyage\NettoyeurEspacesVides');
                    $data = $nettoyeur->nettoyer($_POST);
                    // On vérifie que chaque champ du formulaire est valide, et on met à jour $_SESSION si c'est OK
                    if (isset($data['pseudoProfil']) && !empty($data['pseudoProfil'])) {
                        $pseudo = $data['pseudoProfil'];
                        $doublon = ProfilBd::pseudoExistant($pseudo);
                        if (!$doublon) {
                            $auth->setPseudo($pseudo);
                            $auth->synchroniser();
                        }
                    }
                    if (isset($data['mailProfil']) && !empty($data['mailProfil'])) {
                        $mail = $data['mailProfil'];
                        $doublon = ProfilBd::mailExistant($mail);
                        if (!$doublon) {
                            $auth->setMail($mail);
                            $auth->synchroniser();
                        }
                    }
                    if (isset($data['mdpProfil']) && !empty($data['mdpProfil'])) {
                        $mdp = $data['mdpProfil'];
                        $mdp = ChiffrementMdp::chiffrer($mdp);
                        $auth->setMotDePasse($mdp);
                        $auth->synchroniser();
                    }
                    if (isset($data['descriptionProfil']) && !empty($data['descriptionProfil'])) {
                        $description = $data['descriptionProfil'];
                        $auth->setDescription($description);
                        $auth->synchroniser();
                    }
                    ProfilBd::modifierInfos($auth);
                    // Attribution d'une récompense pour la première modification du profil (Bonsaï)
                    if (!RecompenseBd::recompenseAttribuee($auth->getId(), Recompense::ID_BONSAI)) {
                        RecompenseBd::attributionRecompense($auth->getId(), Recompense::ID_BONSAI);
                    }
                }
            }
            // Chargement du profil (infos, photo, scores, récompenses, ...)
            $contenu = ProfilHtml::chargerTemplate(
                $auth,
                $gravatar,
                $messagePhoto,
                $recompenses,
                $boutonModif,
                $dateInscription,
                $tempsEntrainement,
                $nbTests,
                $nbFilleuls,
                $meilleurScore
            );
            $vitesse = Profil::lireVitesse($scores);
            $precision = Profil::lirePrecision($scores);
            $script .= ProfilHtml::afficherScores($vitesse, $precision);
        } else { // L'utilisateur (connecté ou non) veut consulter le profil d'un tiers
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $membre = MembreBd::infosMembre($id);
                $titre = $membre->getPseudo() . " | Dojoctylo";
                $gravatar = Profil::requeteGravatar($membre);
                $messagePhoto = "";
                $recompenses = ProfilBd::listeRecompenses($membre);
                $scores = ProfilBd::derniersScores($membre);
                $boutonModif = "";
                $nbTests = ProfilBd::nombreTests($membre);
                $meilleurScore = ProfilBd::meilleurScore($membre);
                // Conversion du format de la date d'inscription (YYYY-mm-dd vers dd/mm/YYYY)
                $dateMySql = new \DateTime($membre->getDateInscription());
                $dateInscription = $dateMySql->format('d/m/Y');
                // Conversion du temps d'entrainement
                $tempsEntrainement = $membre->getTempsEntrainement(); // secondes
                $heuresEntrainement = floor($tempsEntrainement / 3600);
                $minutesEntrainement = floor(($tempsEntrainement - ($heuresEntrainement * 3600)) / 60);
                $secondesEntrainement = $tempsEntrainement - ($heuresEntrainement * 3600) - ($minutesEntrainement * 60);
                $tempsEntrainement = (string) $heuresEntrainement . ":" . $minutesEntrainement . ":" . $secondesEntrainement;
                $nbFilleuls = $membre->getNbFilleuls();
                // Chargement du profil (infos, photo, scores, récompenses, ...)
                $contenu = ProfilHtml::chargerTemplate(
                    $membre,
                    $gravatar,
                    $messagePhoto,
                    $recompenses,
                    $boutonModif,
                    $dateInscription,
                    $tempsEntrainement,
                    $nbTests,
                    $nbFilleuls,
                    $meilleurScore
                );
                $vitesse = Profil::lireVitesse($scores);
                $precision = Profil::lirePrecision($scores);
                $script .= ProfilHtml::afficherScores($vitesse, $precision);
            }
        }
        break;
    case "recompenses":
        $titre = "Vos efforts au sein du dojo méritent des récompenses | Dojoctylo";
        $script = file_get_contents("fragments/scripts/recompenses.frg.html");
        $contenu = file_get_contents("fragments/informations/recompenses.frg.html");
        break;
    default:
        $titre = "Oups ! Page non trouvée | Dojoctylo";
        $contenu = file_get_contents("fragments/informations/erreur.frg.html");
        break;
}

ob_start();
    require_once($squelette);
    $html = ob_get_contents();
ob_end_clean();

echo $html;
