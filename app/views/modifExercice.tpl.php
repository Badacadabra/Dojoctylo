<div id="noir">
  <section id="formulaireModifExercice" class="pop-up">
    <form method="post" action="/pratiquer/custom/gerer/validerModif">
      <h3>Modification d'un exercice</h3>
      <fieldset>
        <input type="hidden" name="idExercice" value="<%= idExercice %>">
        <input type="text" name="infosExercice" placeholder="Source..." value="<%= infosExercice %>">
        <div class="erreursFormulaires"></div>
        <textarea name="contenuExercice" placeholder="Contenu..."><%= contenuExercice %></textarea>
        <div class="erreursFormulaires"></div>
        <input type="radio" name="difficulteExercice" id="radioFacile" value="facile" <% if (difficulteExercice === "facile") "checked"; ?>>
        <label for="radioFacile"><span></span>Facile</label>
        <input type="radio" name="difficulteExercice" id="radioMoyen" value="moyen" <% if (difficulteExercice === "moyen") "checked"; ?>>
        <label for="radioMoyen"><span></span>Moyen</label>
        <input type="radio" name="difficulteExercice" id="radioDifficile" value="difficile" <% if (difficulteExercice === "difficile") "checked"; ?>>
        <label for="radioDifficile"><span></span>Difficile</label>
        <div class="erreursFormulaires"></div>
        <input type="submit" value="Valider">
      </fieldset>
    </form>
  </section>
</div>
