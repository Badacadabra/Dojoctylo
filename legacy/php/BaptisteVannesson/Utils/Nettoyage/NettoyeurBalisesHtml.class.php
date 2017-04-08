<?php
namespace BaptisteVannesson\Utils\Nettoyage;

/**
 * Nettoyeur de balises HTML
 *
 * @class  NettoyeurBalisesHtml
 * @author Baptiste Vannesson <21411850@etu.unicaen.fr>
 * @date   2015
 */

class NettoyeurBalisesHtml
{
    /**
     * Nettoyer les balises HTML dans un tableau passé en paramètre
     *
     * @param  array $tableau Tableau à traiter.
     * @return array
     */
    public static function nettoyer(& $tableau)
    {
        $data = array();
        foreach ($tableau as $cle => $valeur) {
            if ($cle != "descriptionProfil") { // Champs classiques
                $data[$cle] = strip_tags($valeur);
            } else { // CKEditor
                $data[$cle] = $tableau[$cle];
            }
        }
        return $data;
    }
}
