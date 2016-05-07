<div id="noir">
    <section id="formulaireModifExercice" class="pop-up">
        <form method="post" action="index.php?p=pratiquer&amp;m=custom&amp;s=gerer&amp;a=validerModif">
            <h3>Modification d'un exercice</h3>
            <fieldset>
                <input type="hidden" name="idExercice" value="<?php echo $idExercice; ?>" />
                <input type="text" name="infosExercice" placeholder="Source..." value="<?php echo $infosExercice; ?>" />
                    <div class="erreursFormulaires"></div>
                <textarea name="contenuExercice" placeholder="Contenu..."><?php echo $contenuExercice; ?></textarea>
                    <div class="erreursFormulaires"></div>
                <input type="radio" name="difficulteExercice" id="radioFacile" value="facile" <?php if ($difficulteExercice == "facile") echo "checked"; ?> />
                <label for="radioFacile"><span></span>Facile</label>
                <input type="radio" name="difficulteExercice" id="radioMoyen" value="moyen" <?php if ($difficulteExercice == "moyen") echo "checked"; ?> />
                <label for="radioMoyen"><span></span>Moyen</label>
                <input type="radio" name="difficulteExercice" id="radioDifficile" value="difficile" <?php if ($difficulteExercice == "difficile") echo "checked"; ?> />
                <label for="radioDifficile"><span></span>Difficile</label>
                    <div class="erreursFormulaires"></div>
                <input type="submit" value="Valider" />
            </fieldset>
        </form>
    </section>
</div>
