<div id="noir">
    <section id="exercice" class="padding">
        <h2><?php echo $mode; ?></h2>
        <div id="top-container">
            <div id="loader"><img src="images/charte-graphique/ajax-loader.gif" alt="Chargement" /></div>
            <div id="source"></div>
        </div>
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
</div>
