<div id="wrapper" class="bambou">
    <section id="classement" class="padding">
        <div class="bandeau">
            <h2>Classement</h2>
            <div id="periodes-classement">
                <ul>
                    <li><a href="index.php?p=classement&amp;m=jour">Jour</a></li>
                    <li><a href="index.php?p=classement&amp;m=semaine">Semaine</a></li>
                    <li><a href="index.php?p=classement&amp;m=mois">Mois</a></li>
                    <li><a href="index.php?p=classement&amp;m=annee">Année</a></li>
                    <li><a href="index.php?p=classement&amp;m=global">Global</a></li>
                </ul>
            </div>
        </div>
        <div id="tableaux-classement">
            <table>
                <caption>Membres les plus rapides</caption>
                <tr>
                    <th>Rang</th>
                    <th>Membre</th>
                    <th>Vitesse (MPM)</th>
                </tr>
                <?php echo $classementVitesse; ?>
            </table>
            <table>
                <caption>Membres les plus actifs</caption>
                <tr>
                    <th>Rang</th>
                    <th>Membre</th>
                    <th>Nombre de tests</th>
                </tr>
                <?php echo $classementActivite; ?>
            </table>
        </div>
    </section>
</div>
