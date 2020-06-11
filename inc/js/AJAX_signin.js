import * as core from './core.js';
import PNotify from '/libs/node_modules/pnotify/dist/es/PNotify.js';

// Az alábbi részt automatikusan végrehajtja, amint betöltött
$(document).ready(function () {

    function tryLogin(e)
    {
        // Megakadályozom az alapértelmezett esemény végrehajtását, FORM elküldésekor frissülne az oldal, ez most nem kell.
        e.preventDefault();
        
        // A hibalistákat külön eltárolom, így könnyebb ráhivatkozni.
        let basicList = $("#basicList");        // Alapértelmezett lista, ide kerülne minden Sikeres bejelentkezés, Nincs ilyen felhasználó és ehhez hasonló hibaüzenet
        let userList = $("#userList");          // A felhasználónévhez kapcsolódó hibaüzenetek helye, Hibás formátum
        let passList = $("#passList");          // A jelszóhoz kapcsolódó hibaüzenetek helye
        let userDrop = $("#userDrop");          // A felhasználónévhez kapcsolódó hibaüzenetek megjelenítéséhez szükséges nyíl
        let passDrop = $("#passDrop");          // A jelszóhoz kapcsolódó hibaüzenetek megjelenítéséhez szükséges nyíl

        userList.empty();                       // Mindig kiürítem a listákat, hogy a korábbi üzenetek ne maradjanak bent.
        passList.empty();

        // AJAX hívás
        $.ajax({
            url: core.host + core.signin,
            'type': 'POST',
            'processData': false,
            'contentType': 'application/json',
            'data': JSON.stringify({user:$("#user").val(), pass:$("#pass").val()}),

            // Ha sikeresen lefut (eléri a fájlt)
            success: function(response)
            {
                // Ha a signinStatus == true, akkor be van jelentkezve -> Kiírom az üzenetet.
                if (response.signinStatus)
                {
                    basicList.empty();
                    PNotify.success(response.msg);
                    
                    // Majd frissítem a "szülő" oldalt és bezárom a jelenlegit
                    try {
                        window.opener.location.reload();
                        window.close();
                    }
                    catch (e)
                    {
                        // Amennyiben nem a gombot használta bejelentkezésre, hanem elnavigált a linkre akkor frissítem az oldalt.
                        window.setTimeout(location.reload(), 2000);
                        window.setTimeout(basicList.html("<a href='"+ core.host + "'>Frissítés | Refresh</a>"), 5000);
                    }
                
                // Ha a signinStatus == false, nem sikerült a bejelentkezés, kiírom a megfelelő helyre az üzeneteket.
                }
                else
                {
                    basicList.empty();
                    
                    // Ha az alap hibalista nem üres kiírom a tartalmát
                    if (!(response.msg.basic.length  === 0))
                    {
                        for (let msg of response.msg.basic)
                        {
                            basicList.append("<li>" + msg + "</li>");
                        }
                    }
                    else
                    {

                    }

                    // Ha a felhasználónév hibalista nem üres kiírom a tartalmát
                    if (!(response.msg.user.length  === 0))
                    {
                        $("#user").addClass("hiba");
                        userDrop.removeClass("rejtett");
                        for (let msg of response.msg.user)
                        {
                            userList.append("<li>" + msg + "</li>");
                        }
                    }
                    else
                    {
                        $("#user").removeClass("hiba");
                        userDrop.addClass("rejtett");
                    }

                    // Ha a jelszó hibalista nem üres kiírom a tartalmát
                    if (!(response.msg.pass.length  === 0))
                    {
                        $("#pass").addClass("hiba");
                        passDrop.removeClass("rejtett");
                        for (let msg of response.msg.pass)
                        {
                            passList.append("<li>" + msg + "</li>");
                        }
                    }
                    else
                    {
                        $("#pass").removeClass("hiba");
                        passDrop.addClass("rejtett");
                    }

                    // Osztály kapcsolók (dizájnhoz kell, hogy megfelelően jelenjen meg)
                    $(".info").off().on("click", function (){
                        $(this).children().toggleClass("up down");
                    });
                    $("#userDrop").off().on("click", function (){
                        $("#userList").toggleClass("rejtett");
                    });
                    $("#passDrop").off().on("click", function (){
                        $("#passList").toggleClass("rejtett");
                    });
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

    // A FORM elküldésekor meghívja a tryLogin függvényt.
    $("#signinForm").submit(tryLogin);
});
