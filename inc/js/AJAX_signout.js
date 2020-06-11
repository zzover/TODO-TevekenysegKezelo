import * as core from './core.js'
import PNotify from '/libs/node_modules/pnotify/dist/es/PNotify.js';

// Az alábbi részt automatikusan végrehajtja, amint betöltött
$(document).ready(function () {

    function tryLogout(e)
    {
        // Megakadályozom az alapértelmezett esemény végrehajtását, FORM elküldésekor frissülne az oldal, ez most nem kell.
        e.preventDefault();

        // AJAX hívás
        $.ajax({
            url: core.host + core.signin,
            'type': 'DELETE',
            'processData': false,
            'contentType': 'application/json',

            // Ha sikeresen lefut (eléri a fájlt)
            success: function(response)
            {
                // Ha a signinStatus == false, kijelentkezett -> Frissítem az oldalt.
                if (!response.signinStatus)
                {
                    window.location.replace(core.host);
                }
                else
                {
                    console.log(response);
                }
            },

            // Ha az AJAX kérés nem tudott lefutni, pl. rossz hivatkozás van megadva megjelenítek egy hibaüzenetet
            error: function()
            {
                PNotify.error({
                    text: core.Languages[document.documentElement.lang]["AJAXError"],
                    addClass: 'nonblock',
                    delay: 2000,
                });
            }
        });
    }

    // A kijelentkezés gomb megnyomására meghívja a tryLogout függvényt.
    $("#logoutButton").on("click", tryLogout);
});
