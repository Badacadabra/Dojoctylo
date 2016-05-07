            <section id="login-signup" class="padding">
                <section id="login">
                    <h2>Connexion</h2>
                    <form method="post" action="index.php?p=authentification&amp;a=connexion">
                        <input type="text" placeholder="Votre pseudo ou e-mail" name="loginConnexion" class="mail" />
                            <div class="erreursFormulaires"></div>
                        <input type="password" placeholder="Votre mot de passe" name="mdpConnexion" />
                            <div class="erreursFormulaires"><?php echo $erreur; ?></div>
                        <input type="submit" value="Connexion" />
                    </form>
                </section>
                <img src="images/charte-graphique/ninjactylo.png" alt="Ninjactylo" />
                <section id="signup">
                    <h2>Inscription</h2>
                    <form method="post" action="index.php?p=authentification&amp;a=inscription">
                        <input type="text" placeholder="Votre pseudo" name="pseudoInscription" maxlength="20" />
                            <div class="erreursFormulaires"></div>
                        <input type="text" placeholder="Votre e-mail" name="mailInscription" class="mail" />
                            <div class="erreursFormulaires"></div>
                        <input type="password" placeholder="Votre mot de passe" name="mdpInscription" />
                            <div class="erreursFormulaires"></div>
                        <input type="submit" value="Inscription" />
                    </form>
                </section>
            </section>
            <?php echo $popup; ?>
