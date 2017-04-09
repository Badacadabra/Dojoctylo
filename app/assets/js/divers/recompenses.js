function description(selecteurCss, position, chaine, ancre) {
  $( "#corps #recompenses ul li:" + selecteurCss + " ul li" ).mouseover(function() {
    $( "section#corps section#recompenses h3" ).eq(position).text( $( this ).find( "p" ).text() ).css("color", "#D0112B");
  });

  $( "#corps #recompenses ul li:" + selecteurCss + " ul li" ).mouseout(function() {
    $( "section#corps section#recompenses h3" ).eq(position).text( chaine ).css("color", "white");
  });

  $( "#corps #recompenses ul li:" + selecteurCss + " ul li" ).click(function() {
    $('html,body').animate({scrollTop: $( ancre ).offset().top}, 300);
  });
}

$( document ).ready(function() {
    // Débutant
    description("first-of-type", 0, "Débutant", "#debutant");
    // Entraînement
    description("nth-of-type(2)", 1, "Entraînement", "#entrainement");
    // Vitesse
    description("nth-of-type(3)", 2, "Vitesse", "#vitesse");
    // Compétition
    description("nth-of-type(4)", 3, "Compétition", "#competition");
    // Prestige
    description("last-of-type", 4, "Prestige", "#prestige");
});

