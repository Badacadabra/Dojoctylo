            <div id="wrapper" class="bambou">
                <section id="gestionExercices" class="padding liste">
                    <div class="bandeau">
                        <h2>Vos exercices personnalisés</h2>
                        <p class="italique">&laquo; Voler de ses propres ailes est un premier pas vers l'accomplissement. &raquo; &mdash; <span class="gras">Maître Taipingu</span></p>
                    </div>
                    <ol>
                        <?php 
                            foreach ($textesPerso as $textePerso) {
                                echo "<li>\n";
                                echo "   " . $textePerso->getInfos() . "\n"; 
                                echo "    <a href=\"index.php?p=pratiquer&amp;m=custom&amp;s=gerer&amp;a=modifier&amp;id=" . $textePerso->getId() . "\"><img src=\"images/charte-graphique/edit.png\" alt=\"Modifier\" class=\"edit\" title=\"Modifier\" /></a>\n";
                                echo "    <a href=\"index.php?p=pratiquer&amp;m=custom&amp;s=gerer&amp;a=supprimer&amp;id=" . $textePerso->getId() . "\" class=\"supprimer\"><img src=\"images/charte-graphique/croix-rouge.png\" alt=\"Supprimer\" title=\"Supprimer\" /></a>\n";
                                echo "</li>\n";
                            } 
                        ?>
                    </ol>
                </section>
                <div class="pop-up">
                    <p>Voulez-vous vraiment supprimer cet exercice ?</p>
                    <button id="oui">Oui</button>
                    <button id="non">Non</button>
                </div>
                <div id="fondu"></div>
            </div>
