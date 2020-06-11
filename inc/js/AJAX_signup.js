import * as core from './core.js'
import PNotify from '/libs/node_modules/pnotify/dist/es/PNotify.js';

// Az alábbi részt automatikusan végrehajtja, amint betöltött
$(document).ready(function () {
    function tryRegister(e)
    {
        // Megakadályozom az alapértelmezett esemény végrehajtását, FORM elküldésekor frissülne az oldal, ez most nem kell.
        e.preventDefault();

        // A hibalistákat külön eltárolom, így könnyebb ráhivatkozni.
        let basicList = $("#basicList");            // Alapértelmezett lista, ide kerülne minden Sikeres bejelentkezés, Nincs ilyen felhasználó és ehhez hasonló hibaüzenet
        let userList = $("#userList");              // A felhasználónévhez kapcsolódó hibaüzenetek helye, Hibás formátum
        let lastnameList = $("#lastnameList");      // A vezetéknévhez kapcsolódó hibaüzenetek helye
        let firstnameList = $("#firstnameList");    // A keresztnévhez kapcsolódó hibaüzenetek helye
        let addressList = $("#addressList");        // Az E-mail címhez kapcsolódó hibaüzenetek helye
        let passList = $("#passList");              // A jelszóhoz kapcsolódó hibaüzenetek helye
        let confirmList = $("#confirmList");        // A jelszó megerősítéséhez kapcsolódó hibaüzenetek helye

        // Hibaüzenet listák a megfelelő mezőhöz
        let userDrop = $("#userDrop");
        let lastnameDrop = $("#lastnameDrop");
        let firstnameDrop = $("#firstnameDrop");
        let addressDrop = $("#addressDrop");
        let passDrop = $("#passDrop");
        let confirmDrop = $("#confirmDrop");

        // Mindig kiürítem a listákat, hogy a korábbi üzenetek ne maradjanak bent.
        userList.empty();
        lastnameList.empty();
        firstnameList.empty();
        addressList.empty();
        passList.empty();
        confirmList.empty();

        // AJAX hívás
        $.ajax({
            url: core.host + core.signup,
            'type': 'POST',
            'processData': false,
            'contentType': 'application/json',
            'data': JSON.stringify({address:$("#address").val(), user:$("#user").val(), lastname:$("#lastname").val(), firstname:$("#firstname").val(), pass:$("#pass").val(), confirm:$("#confirm").val()}),

            // Ha sikeresen lefut (eléri a fájlt)
            success: function(response)
            {
                // Ha a signupStatus == true, sikeresen regisztrált így be van jelentkezve -> Kiírom az üzenetet.
                if (response.signupStatus)
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
                }
                // Ha a signupStatus == false, nem sikerült a regisztráció, kiírom a megfelelő helyre az üzeneteket.
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

                    // Ha az felhasználónév hibalista nem üres kiírom a tartalmát
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

                    // Ha a vezetéknév hibalista nem üres kiírom a tartalmát
                    if (!(response.msg.lastname.length  === 0))
                    {
                        $("#lastname").addClass("hiba");
                        lastnameDrop.removeClass("rejtett");
                        for (let msg of response.msg.lastname)
                        {
                            lastnameList.append("<li>" + msg + "</li>");
                        }
                    }
                    else
                    {
                        $("#lastname").removeClass("hiba");
                        lastnameDrop.addClass("rejtett");
                    }

                    // Ha a keresztnév hibalista nem üres kiírom a tartalmát
                    if (!(response.msg.firstname.length  === 0))
                    {
                        $("#firstname").addClass("hiba");
                        firstnameDrop.removeClass("rejtett");
                        for (let msg of response.msg.firstname)
                        {
                            firstnameList.append("<li>" + msg + "</li>");
                        }
                    }
                    else
                    {
                        $("#firstname").removeClass("hiba");
                        firstnameDrop.addClass("rejtett");
                    }

                    // Ha az E-mail cím hibalista nem üres kiírom a tartalmát
                    if (!(response.msg.address.length  === 0))
                    {
                        $("#address").addClass("hiba");
                        addressDrop.removeClass("rejtett");
                        for (let msg of response.msg.address)
                        {
                            addressList.append("<li>" + msg + "</li>");
                        }
                    }
                    else
                    {
                        $("#address").removeClass("hiba");
                        addressDrop.addClass("rejtett");
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

                    // Ha a jelszó megerősítése hibalista nem üres kiírom a tartalmát
                    if (!(response.msg.confirm.length  === 0))
                    {
                        $("#confirm").addClass("hiba");
                        confirmDrop.removeClass("rejtett");
                        for (let msg of response.msg.confirm)
                        {
                            confirmList.append("<li>" + msg + "</li>");
                        }
                    }
                    else
                    {
                        $("#confirm").removeClass("hiba");
                        confirmDrop.addClass("rejtett");
                    }

                    // Osztály kapcsolók (dizájnhoz kell, hogy megfelelően jelenjen meg)
                    $(".info").off().on("click", function (){
                        $(this).children().toggleClass("up down");
                    });
                    $("#userDrop").off().on("click", function (){
                        $("#userList").toggleClass("rejtett");
                    });
                    $("#lastnameDrop").off().on("click", function (){
                        $("#lastnameList").toggleClass("rejtett");
                    });
                    $("#firstnameDrop").off().on("click", function (){
                        $("#firstnameList").toggleClass("rejtett");
                    });
                    $("#addressDrop").off().on("click", function (){
                        $("#addressList").toggleClass("rejtett");
                    });
                    $("#passDrop").off().on("click", function (){
                        $("#passList").toggleClass("rejtett");
                    });
                    $("#confirmDrop").off().on("click", function (){
                        $("#confirmList").toggleClass("rejtett");
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
    
    $("#signupForm").submit(tryRegister);
});
