<?php
namespace BaptisteVannesson\Profil;

class ProfilHtml
{
    public static function afficherScores($vitesse, $precision)
    {
        $html = "<script>\n";
        $html .= "$( document ).ready(function() {\n";
        $html .= "   var options = {\n";
        $html .= "        series: {\n";
        $html .= "            lines: { show: true },\n";
        $html .= "            points: { show: true }\n";
        $html .= "        },\n";
        $html .= "        grid: { hoverable: true, clickable: true },\n";
        $html .= "        legend: { backgroundOpacity: 0.5, position: \"se\" }\n";
        $html .= "    };\n";
        $html .= "    $.plot($( \"#placeholder\" ), [\n";
        $html .= "        { label: \"Vitesse (MPM)\", data: [ [1, {$vitesse[9]}], [2, {$vitesse[8]}], [3, {$vitesse[7]}], [4, {$vitesse[6]}], [5, {$vitesse[5]}], [6, {$vitesse[4]}], [7, {$vitesse[3]}], [8, {$vitesse[2]}], [9, {$vitesse[1]}], [10, {$vitesse[0]}] ] },\n";
        $html .= "        { label: \"Précision (%)\", data: [ [1, {$precision[9]}], [2, {$precision[8]}], [3, {$precision[7]}], [4, {$precision[6]}], [5, {$precision[5]}], [6, {$precision[4]}], [7, {$precision[3]}], [8, {$precision[2]}], [9, {$precision[1]}], [10, {$precision[0]}] ] },\n";
        $html .= "    ], options);\n";
        $html .= "var previousPoint = null;";
        $html .= "$(\"#placeholder\").bind(\"plothover\", function (event, pos, item) {";
        $html .= "    if (item) {";
        $html .= "        if (previousPoint != item.dataIndex) {";
        $html .= "            previousPoint = item.dataIndex;";
        $html .= "            $(\"#tooltip\").remove();";
        $html .= "            var y = item.datapoint[1].toFixed(0);";
        $html .= "            showTooltip(item.pageX, item.pageY, y);";
        $html .= "        }";
        $html .= "    } else {";
        $html .= "        $(\"#tooltip\").remove();";
        $html .= "        previousPoint = null;";
        $html .= "    }";
        $html .= "});";
        $html .= "});\n";
        $html .= "function showTooltip(x, y, contents) {";
        $html .= "    $( '<div id=\"tooltip\">' + contents + '</div>' ).css({";
        $html .= "        position: 'absolute',";
        $html .= "        display: 'none',";
        $html .= "        top: y + 5,";
        $html .= "        left: x + 5,";
        $html .= "        border: '2px solid black',";
        $html .= "        padding: '5px',";
        $html .= "        'font-size': 'x-large',";
        $html .= "        'background-color': '#F2F2F2'";
        $html .= "    }).appendTo( 'body' ).fadeIn( 200 );";
        $html .= "}";
        $html .= "</script>\n";

        return $html;
    }

    public static function chargerTemplate(
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
    ) {
        $template = "ui/templates/profil.tpl.php";

        // Initialisation des variables principales utilisées dans le template
        $pseudo = $auth->getPseudo();
        $description = $auth->getDescription();
        $action = "index.php?p=profil&amp;u=" . strtolower($auth->getPseudo()) . "&amp;id=" . $auth->getId() . "&amp;a=modifier";

        // Gestion des récompenses
        $imageBambou = "images/recompenses/coffre";
        $imageBonsai = "images/recompenses/coffre";
        $imageBolVide = "images/recompenses/coffre";
        $imageSoupeMiso = "images/recompenses/coffre";
        $imageSushi = "images/recompenses/coffre";
        $imageNunchaku = "images/recompenses/coffre";
        $imageShuriken = "images/recompenses/coffre";
        $imageTanto = "images/recompenses/coffre";
        $imageSai = "images/recompenses/coffre";
        $imageKatana = "images/recompenses/coffre";
        $imageKarateka = "images/recompenses/coffre";
        $imageEspion = "images/recompenses/coffre";
        $imageGuerrier = "images/recompenses/coffre";
        $imageAssassin = "images/recompenses/coffre";
        $imageLegende = "images/recompenses/coffre";
        $imageDefense = "images/recompenses/coffre";
        $imageDuel = "images/recompenses/coffre";
        $imageMelee = "images/recompenses/coffre";
        $imagePluieDeShurikens = "images/recompenses/coffre";
        $imageEquipe = "images/recompenses/coffre";
        $imageNinjaVolant = "images/recompenses/coffre";
        $imageReseauNinja = "images/recompenses/coffre";
        $imageNinjaSuperstar = "images/recompenses/coffre";
        $imageNinjaShaman = "images/recompenses/coffre";
        $imageMaitreDragon = "images/recompenses/coffre";

        $bambou = "???";
        $bonsai = "???";
        $bolVide = "???";
        $soupeMiso = "???";
        $sushi = "???";
        $nunchaku = "???";
        $shuriken = "???";
        $tanto = "???";
        $sai = "???";
        $katana = "???";
        $karateka = "???";
        $espion = "???";
        $guerrier = "???";
        $assassin = "???";
        $legende = "???";
        $defense = "???";
        $duel = "???";
        $melee = "???";
        $pluieDeShurikens = "???";
        $revolution = "???";
        $ninjaVolant = "???";
        $reseauNinja = "???";
        $superstar = "???";
        $shaman = "???";
        $maitreDragon = "???";

        foreach ($recompenses as $recompense) {
            switch($recompense->getId()) {
                case 1:
                    $imageBambou = $recompense->getUrlImage();
                    $bambou = $recompense->getNom();
                    break;
                case 2:
                    $imageBonsai = $recompense->getUrlImage();
                    $bonsai = $recompense->getNom();
                    break;
                case 3:
                    $imageBolVide = $recompense->getUrlImage();
                    $bolVide = $recompense->getNom();
                    break;
                case 4:
                    $imageSoupeMiso = $recompense->getUrlImage();
                    $soupeMiso = $recompense->getNom();
                    break;
                case 5:
                    $imageSushi = $recompense->getUrlImage();
                    $sushi = $recompense->getNom();
                    break;
                case 6:
                    $imageNunchaku = $recompense->getUrlImage();
                    $nunchaku = $recompense->getNom();
                    break;
                case 7:
                    $imageShuriken = $recompense->getUrlImage();
                    $shuriken = $recompense->getNom();
                    break;
                case 8:
                    $imageTanto = $recompense->getUrlImage();
                    $tanto = $recompense->getNom();
                    break;
                case 9:
                    $imageSai = $recompense->getUrlImage();
                    $sai = $recompense->getNom();
                    break;
                case 10:
                    $imageKatana = $recompense->getUrlImage();
                    $katana = $recompense->getNom();
                    break;
                case 11:
                    $imageKarateka = $recompense->getUrlImage();
                    $karateka = $recompense->getNom();
                    break;
                case 12:
                    $imageEspion = $recompense->getUrlImage();
                    $espion = $recompense->getNom();
                    break;
                case 13:
                    $imageGuerrier = $recompense->getUrlImage();
                    $guerrier = $recompense->getNom();
                    break;
                case 14:
                    $imageAssassin = $recompense->getUrlImage();
                    $assassin = $recompense->getNom();
                    break;
                case 15:
                    $imageLegende = $recompense->getUrlImage();
                    $legende = $recompense->getNom();
                    break;
                case 16:
                    $imageDefense = $recompense->getUrlImage();
                    $defense = $recompense->getNom();
                    break;
                case 17:
                    $imageDuel = $recompense->getUrlImage();
                    $duel = $recompense->getNom();
                    break;
                case 18:
                    $imageMelee = $recompense->getUrlImage();
                    $melee = $recompense->getNom();
                    break;
                case 19:
                    $imagePluieDeShurikens = $recompense->getUrlImage();
                    $pluieDeShurikens = $recompense->getNom();
                    break;
                case 20:
                    $imageEquipe = $recompense->getUrlImage();
                    $revolution = $recompense->getNom();
                    break;
                case 21:
                    $imageNinjaVolant = $recompense->getUrlImage();
                    $ninjaVolant = $recompense->getNom();
                    break;
                case 22:
                    $imageReseauNinja = $recompense->getUrlImage();
                    $reseauNinja = $recompense->getNom();
                    break;
                case 23:
                    $imageNinjaSuperstar = $recompense->getUrlImage();
                    $superstar = $recompense->getNom();
                    break;
                case 24:
                    $imageNinjaShaman = $recompense->getUrlImage();
                    $shaman = $recompense->getNom();
                    break;
                case 25:
                    $imageMaitreDragon = $recompense->getUrlImage();
                    $maitreDragon = $recompense->getNom();
                    break;
            }
        }

        // Chargement du template
        ob_start();
            require_once($template);
            $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
}
