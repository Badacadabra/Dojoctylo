            <div id="wrapper" class="padding">
                <section id="profil">
                    <section id="infos">
                        <div id="presentation" class="contenu">
                            <h2><?php echo $pseudo; ?></h2>
                            <a href="https://fr.gravatar.com/" target="_blank">
                                <img src="<?php echo $gravatar; ?>" alt="<?php echo $pseudo; ?>" title="<?php echo $messagePhoto; ?>" />
                            </a>
                            <div><?php echo $description; ?></div>
                            <span><?php echo $boutonModif; ?></span>
                        </div>
                        <div id="compte-rendu" class="contenu">
                            <h3>Compte rendu d'activité</h3>
                            <p><span class="gras">Inscription</span><?php echo $dateInscription; ?></p>
                            <hr>
                            <p><span class="gras">Entraînement</span><?php echo $tempsEntrainement; ?></p>
                            <hr>
                            <p><span class="gras">Tests</span><?php echo $nbTests; ?></p>
                            <hr>
                            <p><span class="gras">Compétitions</span>N/A</p>
                            <hr>
                            <p><span class="gras">Amis</span>N/A</p>
                            <hr>
                            <p><span class="gras">Filleuls</span><?php echo $nbFilleuls; ?></p>
                            <hr>
                            <p><span class="gras">Record</span><?php echo $meilleurScore; ?> MPM</p>
                        </div>
                    </section>
                    <section id="formulaireProfil">
                        <form method="post" action="<?php echo $action; ?>">
                            <button id="croix" title="Fermer" type="button"><img src="images/charte-graphique/croix-rouge.png" alt="Fermer" /></button>
                            <h3>Modification du profil</h3>
                            <fieldset>
                                <input type="text" name="pseudoProfil" placeholder="Entrez votre nouveau pseudo (facultatif)" />
                                    <div class="erreursFormulaires"></div>
                                <input type="text" name="mailProfil" placeholder="Entrez votre nouvelle adresse e-mail (facultatif)" />
                                    <div class="erreursFormulaires"></div>
                                <input type="password" name="mdpProfil" placeholder="Entrez votre nouveau mot de passe (facultatif)" />
                                    <div class="erreursFormulaires"></div>
                                <textarea id="descriptionProfil" name="descriptionProfil" class="ckeditor" placeholder="Vous pouvez modifier votre description ici..." title="test"></textarea>
                                    <div id="erreurCkeditor" class="erreursFormulaires"></div>
                                <input type="submit" value="Valider" />
                            </fieldset>
                        </form>
                    </section>
                    <aside id="stats">
                        <section>
                            <h3>Mes derniers scores</h3>
                            <div id="placeholder"></div>
                        </section>
                        <section>
                            <h3>Mes récompenses &amp; distinctions</h3>
                            <div class="trophees">
                                <h4>Débutant</h4>
                                <img src="<?php echo $imageBambou; ?>" alt="<?php echo $bambou; ?>" title="<?php echo $bambou; ?>" />
                                <img src="<?php echo $imageBonsai; ?>" alt="<?php echo $bonsai; ?>" title="<?php echo $bonsai; ?>" />
                                <img src="<?php echo $imageBolVide; ?>" alt="<?php echo $bolVide; ?>" title="<?php echo $bolVide; ?>" />
                                <img src="<?php echo $imageSoupeMiso; ?>" alt="<?php echo $soupeMiso; ?>" title="<?php echo $soupeMiso; ?>" />
                                <img src="<?php echo $imageSushi; ?>" alt="<?php echo $sushi; ?>" title="<?php echo $sushi; ?>" />
                            </div>
                            <div class="trophees">
                                <h4>Entraînement</h4>
                                <img src="<?php echo $imageNunchaku; ?>" alt="<?php echo $nunchaku; ?>" title="<?php echo $nunchaku; ?>" />
                                <img src="<?php echo $imageShuriken; ?>" alt="<?php echo $shuriken; ?>" title="<?php echo $shuriken; ?>" />
                                <img src="<?php echo $imageTanto; ?>" alt="<?php echo $tanto; ?>" title="<?php echo $tanto; ?>" />
                                <img src="<?php echo $imageSai; ?>" alt="<?php echo $sai; ?>" title="<?php echo $sai; ?>" />
                                <img src="<?php echo $imageKatana; ?>" alt="<?php echo $katana; ?>" title="<?php echo $katana; ?>" />
                            </div>
                            <div class="trophees">
                                <h4>Vitesse</h4>
                                <img src="<?php echo $imageKarateka; ?>" alt="<?php echo $karateka; ?>" title="<?php echo $karateka; ?>" />
                                <img src="<?php echo $imageEspion; ?>" alt="<?php echo $espion; ?>" title="<?php echo $espion; ?>" />
                                <img src="<?php echo $imageGuerrier; ?>" alt="<?php echo $guerrier; ?>" title="<?php echo $guerrier; ?>" />
                                <img src="<?php echo $imageAssassin; ?>" alt="<?php echo $assassin; ?>" title="<?php echo $assassin; ?>" />
                                <img src="<?php echo $imageLegende; ?>" alt="<?php echo $legende; ?>" title="<?php echo $legende; ?>" />
                            </div>
                            <div class="trophees">
                                <h4>Compétition</h4>
                                <img src="<?php echo $imageDefense; ?>" alt="<?php echo $defense; ?>" title="<?php echo $defense; ?>" />
                                <img src="<?php echo $imageDuel; ?>" alt="<?php echo $duel; ?>" title="<?php echo $duel; ?>" />
                                <img src="<?php echo $imageMelee; ?>" alt="<?php echo $melee; ?>" title="<?php echo $melee; ?>" />
                                <img src="<?php echo $imagePluieDeShurikens; ?>" alt="<?php echo $pluieDeShurikens; ?>" title="<?php echo $pluieDeShurikens; ?>" />
                                <img src="<?php echo $imageEquipe; ?>" alt="<?php echo $revolution; ?>" title="<?php echo $revolution; ?>" />
                            </div>
                            <div class="trophees">
                                <h4>Prestige</h4>
                                <img src="<?php echo $imageNinjaVolant; ?>" alt="<?php echo $ninjaVolant; ?>" title="<?php echo $ninjaVolant; ?>" />
                                <img src="<?php echo $imageReseauNinja; ?>" alt="<?php echo $reseauNinja; ?>" title="<?php echo $reseauNinja; ?>" />
                                <img src="<?php echo $imageNinjaSuperstar; ?>" alt="<?php echo $superstar; ?>" title="<?php echo $superstar; ?>" />
                                <img src="<?php echo $imageNinjaShaman; ?>" alt="<?php echo $shaman; ?>" title="<?php echo $shaman; ?>" />
                                <img src="<?php echo $imageMaitreDragon; ?>" alt="<?php echo $maitreDragon; ?>" title="<?php echo $maitreDragon; ?>" />
                            </div>
                            <a href="index.php?p=recompenses">Description de toutes les récompenses et distinctions</a>
                        </section>
                    </aside>
                </section>
                <div id="fondu"></div>
            </div>
