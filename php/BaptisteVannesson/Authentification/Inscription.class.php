<?php
namespace BaptisteVannesson\Authentification;

use BaptisteVannesson\Utils\Bd\ConnexionBd;

class Inscription
{
    public function validationFormulaire($data)
    {
        if (isset($data['pseudoInscription']) && !empty($data['pseudoInscription'])
            && isset($data['mailInscription']) && !empty($data['mailInscription'])
            && isset($data['mdpInscription']) && !empty($data['mdpInscription'])
        ) {
            return true;
        } else {
            return false;
        }
    }

    public function insertionBd($membre)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'INSERT INTO Membre (pseudo,
                                        mail,
                                        motDePasse,
                                        description,
                                        dateInscription,
                                        nbConnexions,
                                        tempsEntrainement,
                                        nbFilleuls
                                        )
                                        VALUES (:pseudo,
                                                :mail,
                                                :motDePasse,
                                                :description,
                                                CURDATE(),
                                                :nbConnexions,
                                                :tempsEntrainement,
                                                :nbFilleuls
                                                )';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':pseudo', $membre->getPseudo());
        $stmt->bindValue(':mail', $membre->getMail());
        $stmt->bindValue(':motDePasse', $membre->getMotDePasse());
        $stmt->bindValue(':description', $membre->getDescription());
        $stmt->bindValue(':nbConnexions', $membre->getNbConnexions());
        $stmt->bindValue(':tempsEntrainement', $membre->getTempsEntrainement());
        $stmt->bindValue(':nbFilleuls', $membre->getNbFilleuls());
        $stmt->execute();
    }

    public function envoiMail($membre)
    {
         // Destinataire
         $to = $membre->getMail();

         // Sujet
         $subject = 'Bienvenue sur Dojoctylo, ' . $membre->getPseudo() . ' !';

         // Message
         $message = '
         <html>
          <head>
           <title>Inscription sur Dojoctylo</title>
          </head>
          <body>
           <p>Bonjour,</p>
           <p>Vous venez de vous inscrire sur Dojoctylo. Merci et bienvenue à vous, humble ninjactylo ! :D</p>
           <p>Pour rappel, voici vos identifiants :</p>
           <ul>
            <li>Pseudo : ' . $membre->getPseudo() . '</li>
            <li>Mot de passe : ' . $membre->getMotDePasse() . '</li>
           </ul>
           <p>Si vous n\'êtes pas à l\'origine de cette inscription, veuillez contacter le <a href="mailto:baptiste.vannesson@gmail.com">webmaster</a>.</p>
           <p>@ bientôt sur <a href="https://21411850.users.info.unicaen.fr/dojoctylo/site">Dojoctylo</a> !</p>
          </body>
         </html>
         ';

         // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
         $headers  = 'MIME-Version: 1.0' . "\r\n";
         $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

         // En-têtes additionnels
         $headers .= 'To: ' . $membre->getPseudo() . ' <' . $membre->getMail() . '>' . "\r\n";
         $headers .= 'From: Dojoctylo <test@test.com>' . "\r\n";

         // Envoi
         mail($to, $subject, $message, $headers);
    }
}
