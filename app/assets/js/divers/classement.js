$( document ).ready(function() {

    // Effet au survol des lignes du classement
    $( "tr" ).on("mouseover", function() {
        $( this ).children().each(function() {
            if ($( this ).prop("tagName") !== "TH") {
                $( this ).css({"background-color":"#E18681", "cursor":"pointer"});
                $( this ).click(function() {
                    var profil = $( this ).parent().children().eq(1).children().first().attr( "href" );
                    $( location ).attr('href', profil);
                });
            }
        });
    });

    // Rétablissement du style par défaut
    $( "tr" ).on("mouseout", function() {
        $( this ).children().each(function() {
            if ($( this ).prop("tagName") !== "TH") {
                $( this ).css("background-color", "#E6E2A5");
            }
        });
    });

});

