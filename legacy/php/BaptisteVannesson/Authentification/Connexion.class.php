<?php
namespace BaptisteVannesson\Authentification;

use BaptisteVannesson\Utils\Bd\ConnexionBd;
use BaptisteVannesson\Utils\Chiffrement\ChiffrementMdp;

class Connexion
{
    protected static $auth = null;
    protected $infosAuthentification;

    /**
     * Constructeur privé (Singleton)
     */
    private function __construct()
    {
        if (isset($_SESSION['infosAuthentification'])) {
            $this->infosAuthentification = $_SESSION['infosAuthentification'];
        } else {
            $this->infosAuthentification = array();
        }
    }

    /**
    * Méthode pour accéder à l'unique instance de la classe.
    *
    * @return L'instance du singleton
    */
    public static function getInstance()
    {
        if (null === self::$auth) {
            self::$auth = new self();
        }
        return self::$auth;
    }

    public static function chargerTemplate($erreurFormulaire, $popup)
    {
        $template = "ui/templates/authentification.tpl.php";
        $erreur = $erreurFormulaire;

        ob_start();
            require_once($template);
            $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

    public function verifierAuthentification($login, $mdp)
    {
        if (!empty($login) && !empty($mdp)) {
            $connexion = ConnexionBd::getInstance()->getConnexion();
            $requete = 'SELECT * FROM Membre WHERE pseudo = :login OR mail = :login';
            $stmt = $connexion->prepare($requete);
            $stmt->bindValue(':login', $login);
            $stmt->execute();
            // Y a-t-il des résultats (login et mot de passe) ? Si oui, on récupère tout et on met ça dans le tableau $this->infosAuthentification
            $data = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (isset($data) && ChiffrementMdp::mdpValide($mdp, $data['motDePasse'])) {
                $this->infosAuthentification = $data;
                $this->synchroniser();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
    * Méthode afficherInformationsConnexion
    * Affiche les informations de connexion et le lien quitter
    */
    public static function afficherInfosConnexion()
    {
        $auth = self::getInstance();
        $authInfos = "<a href=\"index.php?p=authentification&amp;a=quitter\">| Déconnexion</a>";
        $authInfos .= "<a href=\"index.php?p=profil&amp;u=" . strtolower($auth->getPseudo()) . "&amp;id=" . $auth->getId() . "\">| Mon profil</a>\n";
        return $authInfos;
    }

    public static function afficherErreurConnexion()
    {
        $erreur = "Connexion refusée";
        return $erreur;
    }

    /**
     * L'utilisateur est-il connecté ?
     *
     * @return bool
     */
    public function estActive()
    {
        return !empty($this->infosAuthentification);
    }

    /**
    * Quitter : vider les infos de session et synchroniser
    */
    public function quitter()
    {
        $this->infosAuthentification = array();
        $this->synchroniser();
    }

    /**
    * Synchronisation des infos de $this->infosAuthentification avec $_SESSION
    * Méthode à changer si on utilise un autre système pour conserver les infos
    */
    public function synchroniser()
    {
        $_SESSION['infosAuthentification'] = $this->infosAuthentification;
    }

    /**
     * Accesseur pour les informations d'authentification
     */
    public function getInfosAuthentification()
    {
        return $this->infosAuthentification;
    }

    /**
    * Mutateur pour les informations d'authentification
    */
    public function setInfosAuthentification($infosAuthentification)
    {
        $this->infosAuthentification = $infosAuthentification;
    }

    /**
    * Accesseur pour l'id du membre
    */
    public function getId()
    {
        return $this->infosAuthentification['id'];
    }

    /**
    * Accesseur pour le pseudo du membre
    */
    public function getPseudo()
    {
        return $this->infosAuthentification['pseudo'];
    }

    /**
    * Mutateur pour le pseudo du membre
    */
    public function setPseudo($pseudo)
    {
        $this->infosAuthentification['pseudo'] = $pseudo;
    }

    /**
    * Accesseur pour le mail du membre
    */
    public function getMail()
    {
        return $this->infosAuthentification['mail'];
    }

    /**
    * Mutateur pour le mail du membre
    */
    public function setMail($mail)
    {
        $this->infosAuthentification['mail'] = $mail;
    }

    /**
    * Accesseur pour le mot de passe du membre
    */
    public function getMotDePasse()
    {
        return $this->infosAuthentification['motDePasse'];
    }

    /**
    * Mutateur pour le mot de passe du membre
    */
    public function setMotDePasse($mdp)
    {
        $this->infosAuthentification['motDePasse'] = $mdp;
    }

    /**
    * Accesseur pour la description du membre
    */
    public function getDescription()
    {
        return isset($this->infosAuthentification['description']) ? $this->infosAuthentification['description'] : '';
    }

    /**
    * Mutateur pour la description du membre
    */
    public function setDescription($description)
    {
        $this->infosAuthentification['description'] = $description;
    }

    /**
    * Accesseur pour la date d'inscription du membre
    */
    public function getDateInscription()
    {
        return $this->infosAuthentification['dateInscription'];
    }

    /**
    * Accesseur pour le temps de connexion du membre
    */
    public function getNbConnexions()
    {
        return $this->infosAuthentification['nbConnexions'];
    }

    /**
    * Mutateur pour le temps de connexion du membre
    */
    public function setNbConnexions($nbConnexions)
    {
        $this->infosAuthentification['nbConnexions'] = $nbConnexions;
    }

    /**
    * Accesseur pour le temps d'entrainement du membre
    */
    public function getTempsEntrainement()
    {
        return $this->infosAuthentification['tempsEntrainement'];
    }

    /**
    * Mutateur pour le temps d'entrainement du membre
    */
    public function setTempsEntrainement($tempsEntrainement)
    {
        $this->infosAuthentification['tempsEntrainement'] = $tempsEntrainement;
    }

    /**
    * Accesseur pour le nombre de filleuls du membre
    */
    public function getNbFilleuls()
    {
        return $this->infosAuthentification['nbFilleuls'];
    }

    /**
    * Mutateur pour le nombre de filleuls du membre
    */
    public function setNbFilleuls($nbFilleuls)
    {
        $this->infosAuthentification['nbFilleuls'] = $nbFilleuls;
    }
}
