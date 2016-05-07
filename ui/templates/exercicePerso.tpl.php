<div id="noir">
    <button type="button" id="ajoutExercice" title="Ajouter un exercice">
        <img src="images/charte-graphique/plus-vert.png" alt="Ajouter un exercice" />
    </button>
    <a href="index.php?p=pratiquer&amp;m=custom&amp;s=gerer" id="gererExercices" title="Gérer mes exercices">
        <img src="images/charte-graphique/edit.png" alt="Gérer mes exercices" />
    </a>
    <section id="exercice" class="padding">
        <h2><?php echo $mode; ?></h2>
        <div id="loader"><img src="images/charte-graphique/ajax-loader.gif" alt="Chargement" /></div>
        <div id="source"></div>
        <div id="a-taper"></div>
        <div id="dactylo">
            <textarea id="zone-saisie" autofocus></textarea>
            <button type="button" id="refresh"><img src="images/charte-graphique/favicon.png" alt="Rafraîchir" /></button>
        </div>
        <div id="performance">
            <span id="temps"></span>
            <span id="vitesse"></span>
            <span id="precision"></span>
        </div>
        <div id="difficulte">
            <button type="button" id="facile">Facile</button>
            <button type="button" id="moyen">Moyen</button>
            <button type="button" id="difficile">Difficile</button>
        </div>
    </section>
    <section id="formulaireAjoutExercice">
        <form method="post" action="index.php?p=pratiquer&amp;m=custom&amp;a=ajouter">
            <button id="croix" title="Fermer" type="button"><img src="images/charte-graphique/croix-rouge.png" alt="Fermer" /></button>
            <h3>Ajout d'exercice</h3>
            <fieldset>
                <input type="text" name="infosExercice" placeholder="Source..." />
                    <div class="erreursFormulaires"></div>
                <textarea name="contenuExercice" placeholder="Contenu..."></textarea>
                    <div class="erreursFormulaires"></div>
                <input type="radio" name="difficulteExercice" id="radioFacile" value="facile" />
                <label for="radioFacile"><span></span>Facile</label>
                <input type="radio" name="difficulteExercice" id="radioMoyen" value="moyen" />
                <label for="radioMoyen"><span></span>Moyen</label>
                <input type="radio" name="difficulteExercice" id="radioDifficile" value="difficile" />
                <label for="radioDifficile"><span></span>Difficile</label>
                    <div class="erreursFormulaires"></div>
                <input type="submit" value="Valider" />
            </fieldset>
        </form>
    </section>
</div>
