<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title><?php echo $titre; ?></title>
        <meta name="author" content="Baptiste Vannesson" />
        <link rel="shortcut icon" type="image/png" href="images/charte-graphique/favicon.png" />
        <link rel="stylesheet" href="ui/css/large.css" media="screen" />
        <link rel="stylesheet" href="ui/css/medium.css" media="screen and (max-width: 1023px)" />
        <link rel="stylesheet" href="ui/css/small.css" media="screen and (max-width: 599px)" />
        <link rel="stylesheet" href="javascript/jquery-ui-1.11.4/jquery-ui.min.css" />
        <link rel="stylesheet" href="javascript/custom-scrollbar/jquery.mCustomScrollbar.min.css" />
        <!-- Scripts globaux -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="javascript/jquery-ui-1.11.4/jquery-ui.min.js"></script>
        <script src="javascript/jquery-ui-1.11.4/custom/tooltip.js"></script>
        <script src="javascript/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
        <script>
            $( document ).ready(function() {
                $( "body" ).mCustomScrollbar({ 
                    theme: "dojoctylo",
                    autoExpandScrollbar: true
                });
            });
        </script>
        <!-- Scripts additionnels -->
        <?php echo $script; ?>
    </head>
    <body>
        <header>
            <a href="index.php" title="Accueil" id="logo">
                <img src="images/charte-graphique/clavier.png" alt="Clavier" />
            </a>
            <h1>Dojoctylo</h1>
            <div id="liensHeader">
                <?php echo $authInfos; ?>
            </div>
        </header>
        <nav id="top-menu">
            <div class="paper"></div>
            <ul>
                <li><a href="index.php?p=apprendre">Apprendre</a></li>
                <li><a href="index.php?p=pratiquer">Pratiquer</a></li>
                <li><a href="index.php?p=affronter">Affronter</a></li>
            </ul>
            <div class="paper"></div>
        </nav>
        <section id="corps">
            <?php echo $contenu; ?>
        </section>
        <footer>
            <ul>
                <li><a href="index.php?p=mentions-legales">Mentions légales</a></li>
                <li><a href="index.php?p=faq">FAQ</a></li>
                <li><a href="mailto:21411850@etu.unicaen.fr">Contact</a></li>
                <li><a href="index.php?p=plan-du-site">Plan du site</a></li>
                <li><a href="index.php?p=classement&amp;m=jour">Classement</a></li>
            </ul>
            <ul>
                <li><a href="https://www.facebook.com/" title="Facebook"><img src="images/charte-graphique/icons_golden_64x64/facebook_64.png" alt="Facebook" /></a></li>
                <li><a href="https://twitter.com/" title="Twitter"><img src="images/charte-graphique/icons_golden_64x64/twitter_64.png" alt="Twitter" /></a></li>
                <li><a href="mailto:" title="E-mail"><img src="images/charte-graphique/icons_golden_64x64/mail-1_64.png" alt="E-mail" /></a></li>
            </ul>
        </footer>
    </body>
</html>
