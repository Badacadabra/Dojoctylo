$( document ).ready(function() {
    $( "section#tchat" ).hide();
    // On active ou désactive le tchat quand l'utilisateur clique sur le bouton
    var tchatActif = false;
    $( "button#activerTchat" ).click(function() {
        
        var socket = io.connect("http://localhost:3000");
        var pseudo = $( "#pseudo" ).val();
        
        // Si le tchat n'est pas actif, on l'active
        if (!tchatActif) {
            tchatActif = true;
            $( "section#tchat" ).fadeIn();
    
            // Gestion du tchat
            function chat(room) {
                socket.emit("nouveau_client_" + room, pseudo);
                
                socket.on("nouveau_client_" + room, function(message) {
                    $( "#tchat #discussion" ).prepend( "<p class=\"entreeTchat\">" + message + "</p>" );
                });
                
                socket.on("message_" + room, function(message) {
                    $( "#tchat #discussion" ).prepend( "<p>" + message + "</p>" );
                });
                
                $(function() {
                    $( "#tchat #envoyer" ).click(function () {
                        var message = $( "#tchat #message" ).val();
                        socket.emit( "message_" + room, message );
                        $( "#tchat #message" ).val( "" ).focus();
                    });
                });
            }
                
            // Tchat privé
            if (window.location.search.indexOf("m=prive") > -1) {
                chat("prive");
            }
            // Tchat public
            if (window.location.search.indexOf("m=public") > -1) {
                chat("public");
            }
            
            $( "section#tchat" ).draggable({ scroll: false });
            $( "#tchat #message" ).focus();
            
            // Hack pour avoir une scrollbar fonctionnelle dans le tchat
            var insertListener = function(event) {
                if (event.animationName == "nodeInserted") {
                    if ($( "div#discussion p" ).length == 10) {
                        $( "div#discussion" ).mCustomScrollbar({ 
                            theme: "dojoctylo"
                        });
                    }
                    if ($( "div#discussion p" ).length > 10) {
                        $( "div#discussion" ).mCustomScrollbar( "update" );
                        $( "div#discussion p" ).detach().prependTo( "#mCSB_2_container" );
                    }
                }
            }
            document.addEventListener("animationstart", insertListener, false); // standard + firefox
            document.addEventListener("MSAnimationStart", insertListener, false); // IE
            document.addEventListener("webkitAnimationStart", insertListener, false); // Chrome + Safari
        } else {
            // Sinon c'est que le tchat est actif, donc on le désactive
            tchatActif = false;
            $( "section#tchat" ).fadeOut();
            socket.on("deconnexion_prive", function(message) {
                $( "#tchat #discussion" ).prepend( "<p class=\"entreeTchat\">" + message + "</p>" );
            });
            socket.on("deconnexion_public", function(message) {
                $( "#tchat #discussion" ).prepend( "<p class=\"entreeTchat\">" + message + "</p>" );
            });
        }

    });
    
});
