import * as core from './core.js';
import PNotify from '/libs/node_modules/pnotify/dist/es/PNotify.js';
import AJAXCall from './AJAX_Call.js';

$(document).ready(function () {
    let azonosito = null;
    let felhasznalo_azonosito = $('#menuProfile').attr('data-content');

    latestProjects();
    // AJAX hívásra töltés animáció
    $(document).on({
        ajaxStart: function() {
            $("#betoltes-container").fadeIn(300);　
        },
         ajaxStop: function() {
            $("#betoltes-container").fadeOut(300);
        },
    });

    function noResult(response)
    {
        if (typeof response.msg.basic != 'undefined')
        {
            infoMsg(response.msg.basic);
        }
        else
        {
            infoMsg(response.msg);
        }
    }

    function activityCount(){
        let count = $('#todoList>li').length;

        if (count == 0)
        {
            $('#remains').addClass('rejtett');
            $('#none_remains').removeClass('rejtett');
        }
        else
        {
            $('#none_remains').addClass('rejtett');
            $('#remains').removeClass('rejtett');
            $('#count').html(count);
        }
    }

    function getActivity()
    {
        function isResultAC(response)
        {
            $('#item_name').val('');
            $('#todoList').empty();
            $('#doneList').empty();

            response["data"].forEach(function(result)
            {
                let priorDef = 'priorDef';
                let priorImp = 'priorImp rejtett';

                if (result['priority'] != 0)
                {
                    priorDef = 'priorDef rejtett';
                    priorImp = 'priorImp';
                }

                // TODO: Szépíteni ezt a részt
                let string = '<li data-content="'+ result["ID"] +'"><div class="form-check"><label class="form-check-label item"><input class="checkbox" type="checkbox"> <span class="name">'+ result["name"] +'</span></div><div class="edit"><span class="prior"><div class="'+ priorDef +'"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M17.246 4.042c-3.36 0-3.436-2.895-7.337-2.895-2.108 0-4.075.98-4.909 1.694v-2.841h-2v24h2v-9.073c1.184-.819 2.979-1.681 4.923-1.681 3.684 0 4.201 2.754 7.484 2.754 2.122 0 3.593-1.359 3.593-1.359v-12.028s-1.621 1.429-3.754 1.429zm1.754 9.544c-.4.207-.959.414-1.593.414-.972 0-1.498-.363-2.371-.964-1.096-.755-2.596-1.79-5.113-1.79-1.979 0-3.71.679-4.923 1.339v-7.488c1.019-.902 2.865-1.949 4.909-1.949 1.333 0 1.894.439 2.741 1.103.966.756 2.288 1.792 4.596 1.792.627 0 1.215-.086 1.754-.223v7.766z"/></svg></div><div class="'+priorImp+'"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M4 24h-2v-24h2v24zm18-21.387s-1.621 1.43-3.754 1.43c-3.36 0-3.436-2.895-7.337-2.895-2.108 0-4.075.98-4.909 1.694v12.085c1.184-.819 2.979-1.681 4.923-1.681 3.684 0 4.201 2.754 7.484 2.754 2.122 0 3.593-1.359 3.593-1.359v-12.028z"/></svg></div></span><span class="clear"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"><path d="M9 19c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm4 0c0 .552-.448 1-1 1s-1-.448-1-1v-10c0-.552.448-1 1-1s1 .448 1 1v10zm5-17v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.315c0 .901.73 2 1.631 2h5.712zm-3 4v16h-14v-16h-2v18h18v-18h-2z"/></svg></span></div></li>';

                if (result['complete'] == 1)
                {
                    $('#doneList').append('<li><span>'+ result['name'] +'</span></li>');
                }
                else
                {
                    $('#todoList').append(string);
                }
            });

            // Megszámolom hány tevékenység van, majd kiírom a megfelelő helyre
            activityCount();
        }

        AJAXCall(core.useraction, 'POST', {action:"getActivity", projectID:azonosito}, noResult, isResultAC, errorMsg);
    }

    function completeActivity(tevekenyseg_azonosito)
    {
        function isResult(response)
        {
            successMsg(response.msg);

            activityCount();
        }

        AJAXCall(core.useraction, 'POST', {action:"completeActivity", activityID:tevekenyseg_azonosito}, noResult, isResult, errorMsg);
    }

    function toggleActivityPriority(tevekenyseg_azonosito)
    {
        function isResult(response)
        {
            successMsg(response.msg);

            //activityCount();
        }

        AJAXCall(core.useraction, 'POST', {action:"togglePriority", activityID:tevekenyseg_azonosito}, noResult, isResult, errorMsg);
    }

    function removeActivity(tevekenyseg_azonosito)
    {
        function isResult(response)
        {
            successMsg(response.msg);

            activityCount();
        }

        AJAXCall(core.useraction, 'POST', {action:"removeActivity", activityID:tevekenyseg_azonosito}, noResult, isResult, errorMsg);
    }

    /* SIDEBAR MENÜPONTOK */
    // Oldalsávon menüelemek kattintásakor beállítom az oldal címét
    $('.hivatkozas').on('click', function() {
        $('.components li.active').removeClass('active');

        $(this).parent().addClass('active');

        document.title = 'ToDo | ' + $(this).attr('title');
    });

    // Áttekintés menüpont
    $('#menuOverview').on('click', function() {
        $('#overviewContainer').removeClass('rejtett');
        $('#calendarView').addClass('rejtett');
		$('#calendarView').empty();
        $('#calendarView').html('<div id="calendarContainer" class="fc fc-ltr fc-unthemed"></div>');
        $('#columns').html('');
        $('#latestColumns').html('');

        latestProjects();
    });


    // Fontos menüpont
    $('#menuImportant').on('click', function() {
        alert('Fejlesztés alatt! Work in progress!');
    });

    // Értesítés menüpont
    function notificationCount()
    {
        function isResult(response)
        {
            $('#notificationBody').html('');
            $('#notificationBody').html('<ul class="list-group" id="requestList"></ul>');

            let incoming = null;
            let incomingRequestFrom = null;
            response['data'].forEach(function(result)
            {
                incoming += 1;

                incomingRequestFrom = `
                <li class="list-group-item"><a href="Profile/${result.ID}">${result.name}</a>${core.Languages[document.documentElement.lang]["incoming"]}
                <button type="button" class="btn btn-danger delete float-right" data-content="${result.ID}">&#10006</button>
                <button type="button" class="btn btn-primary confirm float-right" data-content="${result.ID}">&#10004;</button>
                </li>
                `;
                $('#requestList').append(incomingRequestFrom);
            });

            $('#notificationBadge').html(incoming);
        }
        function noResultFS(response)
        {
            // Nincs bejövő jelölése
            $('#notificationBadge').html('');
            $('#notificationBody').html(core.Languages[document.documentElement.lang]["noIncoming"]);
        }

        AJAXCall(core.useraction, 'POST', {action:"incomingRequest"}, noResultFS, isResult, errorMsg);
    }

    notificationCount();

    $('#menuNotification').on('click', function() {
        $('#notificationModal').modal('show');
    });

    // Naptár menüpont
    $('#menuCalendar').on('click', function() {
        // Ha már van naptár akkor kitörlöm. Minden egyes kattintásnál új naptárat hozott létre, valamint egy nap kiválasztásánál annyiszor írta ki a címet ahány naptár volt.
        if (typeof(calendar) !== 'undefined')
        {
            calendar.destroy();
        }
        // Ez sem segített, rákerestem bug-trackerben, de nem találtam erre megoldást.
        window.mobilecheck = function() {
            var check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
          };
		  
        // Fullcalendar Render funkciója úgy írtam meg hogy ha nincs saját projektje akkor dobjon egy értesítést.
        function renderCalendar(events)
        {
            // Törlöm a tartalmát, minden kattintásnál létrehoz egy új naptárat | A projekteket is törlöm mivel a naptárat szeretném látni
            $('#overviewContainer').addClass('rejtett');
			$('#calendarView').removeClass('rejtett');
			$('#calendarView').empty();
            $('#calendarView').html('<div id="calendarContainer" class="fc fc-ltr fc-unthemed"></div>');
            $('#columns').html('');

            let calendar = new FullCalendar.Calendar(document.getElementById('calendarContainer'), {
                plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                },
                defaultView: window.mobilecheck() ? "listMonth" : "dayGridMonth",
                locale: document.documentElement.lang,
                navLinks: true,
                editable: false,
                eventLimit: true,
                events: {events},
                dateClick: function(e) {
                    //console.log("Napra kattintott: " + e.dateStr);
                }
            });

            calendar.render();
        }

        function noResultCA(response)
        {
            renderCalendar(null);

            if (typeof response.msg.basic !== 'undefined')
            {
                
                infoMsg(response.msg.basic);
            }
            else
            {
                infoMsg(response.msg);
            }
        }

        // Amennyiben van találat
        function isResult(response)
        {
            renderCalendar(response.events);
        }

        AJAXCall(core.useraction, 'POST', {action:'events'}, noResultCA, isResult, errorMsg);
    });

    // Összes projekt menüpont
    $('#menuProjects').on('click', function() {

        // Amennyiben van találat
        function isResult(response)
        {
            // Törlöm a tartalmát, mivel hozzáfűzöm a projekteket. Ha egymás után 2x kattint rá a gombra akkor kétszer szerepelne minden.
            $('#overviewContainer').addClass('rejtett');
            $('#calendarView').addClass('rejtett');
			$('#calendarView').empty();
            $('#calendarView').html('<div id="calendarContainer" class="fc fc-ltr fc-unthemed"></div>');
            $('#columns').html('');

            response["data"].forEach(function(result)
            {
                let create = core.timeSince(new Date(result['createtime']));
                let project = `
                <div class="project">
                    <div class="card mb-3">
                            <div class="card-header ${result.color}">
                            ${result.name} <span class="szerkeszt" data-content="${result.ID}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M18.363 8.464l1.433 1.431-12.67 12.669-7.125 1.436 1.439-7.127 12.665-12.668 1.431 1.431-12.255 12.224-.726 3.584 3.584-.723 12.224-12.257zm-.056-8.464l-2.815 2.817 5.691 5.692 2.817-2.821-5.693-5.688zm-12.318 18.718l11.313-11.316-.705-.707-11.313 11.314.705.709z"/></svg>

                            </span>
                            </div>

                            <div class="card-body">
                            <p class="card-text">${result.info}</p>
                            <p class="card-text rejtett">${result.activity}</p>
                            </div>

                            <div class="card-footer">
                            <div class="text-right">${create}</div>
                            </div>
                    </div>
                </div>
                `;

                // Hozzáfűzöm a projektet
                $('#columns').append(project);
            });
        }

        AJAXCall(core.useraction, 'POST', {action:'projects'}, noResult, isResult, errorMsg);
    });

    // Új projekt menüpont
    $('#menuNewProject').on('click', function() {
        // Előző értékek törlése
        $('#projectName').val('');
        $('#projectInfo').val('');
        
        // Modal mutatása
        $('#newProjectModal').modal('show');

        // Automatikusan kijelölöm a beviteli mezőt, azért kell a delay mert a Modal animáció miatt nem lehet egyből meghívni rajta a focus függvényt.
        setTimeout(function (){
            $('#projectName').focus();
        }, 500);
    });

    $('#newProjectForm').submit(function(e) {
        // Megakadályozom a form elküldését, nem kell frissíteni az oldalt
        e.preventDefault();

    });

    $('#newProjectButton').on('click', function(e) {
        e.preventDefault();

        function isResult(response)
        {
            successMsg(response.msg);
            $('#menuOverview').trigger('click');
            $('#newProjectModal').modal('hide');
        }

        if ($('#projectInfo').val().length > 100)
        {
            infoMsg(core.Languages[document.documentElement.lang]["infoTooLong"]);
        }
        else
        {
            AJAXCall(core.useraction, 'POST', {action:"newProject", projectName:$("#projectName").val(), projectInfo:$("#projectInfo").val(), projectColor:$("#colorSelect").val()}, noResult, isResult, errorMsg);
        }
    });

    $('#newActivityForm').submit(function(e) {
        e.preventDefault();

        $('#dateSettings').addClass('rejtett');
        function isResult(response)
        {
            successMsg(response.msg);
            $('#dateSettings').addClass('rejtett');
            
            getActivity();
        }

        let start = new Date($('#startDate').val());
        let deadline   = new Date($('#deadline').val());
        let dateDiff  = new Date(deadline - start);
        let days  = dateDiff/1000/60/60/24;
  
        if (days < 0){
            infoMsg(core.Languages[document.documentElement.lang]["negativeTime"]);
        }
        else
        {
            AJAXCall(core.useraction, 'POST', {action:"newActivity", activityName:$('#item_name').val(), start:$('#startDate').val(), deadline:$('#deadline').val(), projectID:azonosito}, noResult, isResult, errorMsg);
        }
    });

    $('#newActivityFormKieg').on('click', function(e) {
        e.preventDefault();

        function isResult(response)
        {
            successMsg(response.msg);
            
            getActivity();
        }

        let start = new Date($('#startDate').val());
        let deadline   = new Date($('#deadline').val());
        let dateDiff  = new Date(deadline - start);
        let days  = dateDiff/1000/60/60/24;
  
        if (days < 0){
            infoMsg(core.Languages[document.documentElement.lang]["negativeTime"]);
        }
        else
        {
            AJAXCall(core.useraction, 'POST', {action:"newActivity", activityName:$('#item_name').val(), start:$('#startDate').val(), deadline:$('#deadline').val(), projectID:azonosito}, noResult, isResult, errorMsg);
        }
    });
    /* SIDEBAR MENÜPONTOK VÉGE */

    /* NAVBAR MENÜPONTOK */
    $('#menuSearch').on('click', function(e){
        // Mivel ez az ikon egy hivatkozás <a> megakadályozom az alapértelmezett esemény lefutását, ami frissítené az oldalt
        e.preventDefault();

        // Előző értékek törlése
        $('#name').val('');
        $('#results').html('');

        // Modal mutatása
        $('#searchModal').modal('show');

        // Késleltetés hozzáadása a focushoz, hogy ne kelljen belekattintatni a szövegmezőbe
        setTimeout(function (){
          $('#name').focus();
        }, 500);
    });

    $('#searchForm').submit(function(e) {
        // Megakadályozom a form elküldését, nem kell frissíteni az oldalt
        e.preventDefault();
        $('#results').html('');
        $('#results').append('<ul class="list-group" id="resultList"></ul>');

        function noResultSE(response)
        {
            $('#resultList').html(
                `<li class="list-group-item">
                    ${response.msg.basic}
                </li>`
            );
        }
        function isResult(response)
        {
            let image = null;

            response['data'].forEach(function(result)
            {
                if (result['img'] == null)
                {
                    image = "default.png";
                }
                else
                {
                    image = result['img'];
                }

                let user = `
                    <li class="list-group-item">
                        <button type="button" class="btn btn-primary request float-right" data-content="${result.ID}">${core.Languages[document.documentElement.lang]["invite"]}</button>
                            <img class="border img-rounded mb-2" src="${core.host}/inc/img/avatars/${image}" width="100px" height="100px"/>
                            <a href="Profile/${result.ID}" class="list-group-item list-group-item-action mb-2">${result.lastname} ${result.firstname}</a>
                    </li>
                `;

                if (result.ID == felhasznalo_azonosito)
                {
                    user = `
                    <li class="list-group-item">
                            <img class="border img-rounded mb-2" src="${core.host}/inc/img/avatars/${image}" width="100px" height="100px"/>
                            <a href="Profile/${result.ID}" class="list-group-item list-group-item-action mb-2">${result.lastname} ${result.firstname}</a>
                    </li>
                `;
                }
                
                $("#resultList").append(user);
            });
        }

        AJAXCall(core.useraction, 'POST', {action:"search", name:$("#name").val()}, noResultSE, isResult, errorMsg);

        function isResultAF(response)
        {
            $('#resultList li').each(function() {
                let user = $(this).children('.request').attr('data-content');

                areFriends(user, $(this));
            });

            function areFriends(user, elem)
            {
                response['data'].forEach(function(result)
                {
                    if (result['user'] == user)
                    {
                        elem.children('.request').text(core.Languages[document.documentElement.lang]["areFriends"]);
                        elem.children('.request').attr('disabled', true);
                        elem.children('.request').attr('data-content', null);
                    }
                });
            }
        }

        function noResultAF(response){

        }

        AJAXCall(core.useraction, 'POST', {action:"getFriends"}, noResultAF, isResultAF, errorMsg);

        function isResultFS(response)
        {

            // Végig kell mennem a resultlisten
            $('#resultList li').each(function() {
                let user_y = $(this).children('.request').attr('data-content');

                isSent(user_y, $(this));
            });
            
            function isSent(user_y, elem)
            {
                response['data'].forEach(function(result)
                {
                    if (result['user_y'] == user_y)
                    {
                        elem.children('.request').text(core.Languages[document.documentElement.lang]["sent"]);
                        elem.children('.request').attr('disabled', true);
                        elem.children('.request').attr('data-content', null);
                    }
                });
            }
        }
        function noResultFS(response)
        {
            // Nincs kimenő felkérés
        }

        AJAXCall(core.useraction, 'POST', {action:"outgoingRequest"}, noResultFS, isResultFS, errorMsg);
    });

    $(document).on('click', '.request', function (e) {
        e.preventDefault();

        let user_y = $(this).attr('data-content');
        let elem = $(this);
        
        function isResult(response)
        {
            //PNotify.success(response.msg);

            elem.text(core.Languages[document.documentElement.lang]["sent"]);
            elem.attr('disabled', true);
        }

        AJAXCall(core.useraction, 'POST', {action:"request", user_y:user_y}, noResult, isResult, errorMsg);
    });

    $(document).on('click', '.confirm', function (e) {
        e.preventDefault();

        let fs_ID = $(this).attr('data-content');
        let elem = $(this);
        
        function isResult(response)
        {
            successMsg(response.msg);

            elem.parents('li').empty();
            notificationCount();
        }

        AJAXCall(core.useraction, 'POST', {action:"confirmRequest", fsID:fs_ID}, noResult, isResult, errorMsg);
    });

    $(document).on('click', '.delete', function (e) {
        e.preventDefault();

        let fs_ID = $(this).attr('data-content');
        let elem = $(this);
        
        function isResult(response)
        {
            successMsg(response.msg);

            elem.parents('li').empty();
            notificationCount();
        }

        AJAXCall(core.useraction, 'POST', {action:"deleteRequest", fsID:fs_ID}, noResult, isResult, errorMsg);
    });

    // Profilom menüpont
    $('#menuProfile').on('click', function() {
        window.location.href = core.host + '/Profile/' + felhasznalo_azonosito;
    });
    /* NAVBAR MENÜPONTOK VÉGE */

    /* TARTALOM MENÜPONT */
    function latestProjects()
    {
		$('#chartView').html('');
        $('#chartView').empty();
		
		$('#chartView').html('<canvas id="myChart"></canvas>');
		
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [core.Languages[document.documentElement.lang]["ownProjects"], core.Languages[document.documentElement.lang]["sharedWithMe"], core.Languages[document.documentElement.lang]["inProgressActivity"], core.Languages[document.documentElement.lang]["doneActivity"]],
                datasets: [{
                    label: core.Languages[document.documentElement.lang]["count"],
                    data: [Math.floor((Math.random() * 100) + 1), Math.floor((Math.random() * 100) + 1), Math.floor((Math.random() * 100) + 1), Math.floor((Math.random() * 100) + 1)],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Amennyiben van találat
        function isResult(response)
        {
            response["data"].forEach(function(result)
            {
                let create = core.timeSince(new Date(result["createtime"]));
                let project = `
                <div class="project">
                    <div class="card mb-3">
                            <div class="card-header ${result.color}">
                            
                            ${result.name} <span class="szerkeszt" data-content="${result.ID}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M18.363 8.464l1.433 1.431-12.67 12.669-7.125 1.436 1.439-7.127 12.665-12.668 1.431 1.431-12.255 12.224-.726 3.584 3.584-.723 12.224-12.257zm-.056-8.464l-2.815 2.817 5.691 5.692 2.817-2.821-5.693-5.688zm-12.318 18.718l11.313-11.316-.705-.707-11.313 11.314.705.709z"/></svg>

                            </span>
                            </div>

                            <div class="card-body">
                            <p class="card-text">${result.info}</p>
                            <p class="card-text rejtett">${result.activity}</p>
                            </div>

                            <div class="card-footer">
                            <div class="text-right">${create}</div>
                            </div>
                    </div>
                </div>
                `;

                // Hozzáfűzöm a projektet
                $('#latestColumns').append(project);
            });
        }

        AJAXCall(core.useraction, 'POST', {action:'latestProjects'}, noResult, isResult, errorMsg);
    }

    // A $('.szerkeszt').on('click') valamiért nem működött
    $(document).on('click', '.szerkeszt', function () {
        // Törlöm a mezők értékét, ha esetleg valami beragadt volna
        $('#projectViewForm')[0].reset();
        $('#newActivityForm')[0].reset();
        $('#todoList').empty();
        $('#doneList').empty();

        $('#dateSettings').addClass('rejtett');
        $('#remains').addClass('rejtett');
        $('#count').html('');
        $('#none_remains').removeClass('rejtett');

        // Dátum mezők beállítása
        // JQuerys megoldást nem találtam
        document.getElementById('startDate').valueAsDate = new Date();

        // A határidő alapértelmezetten 1 hét
        var date = new Date();
        date.setDate(date.getDate() + 7);
        document.getElementById('deadline').valueAsDate = date;

        // Globális változóban eltárolom a projekt azonosítóját
        azonosito = $(this).attr('data-content');

        function isResult(response)
        {
            response["data"].forEach(function(result)
            {
                if (result["ID"] == azonosito)
                {
                    $('#projectNameView').html(result['name']);
                    if (!(result['info'] == null | result['info'] == undefined | result['info'] == ''))
                    {
                        $('#projectInfoView').val(result['info']);
                    }
                    
                    $('#create').html(result['createtime']);
                }
            });
        }

        AJAXCall(core.useraction, 'POST', {action:'projects'}, noResult, isResult, errorMsg);

        getActivity();

        // Modal megjelenítése
        $('#projectView').modal('show');

        // Kijelölöm a szövegmezőt
        setTimeout(function (){
            $('#item_name').focus();
        }, 500);
    });

    $('#projectViewForm').submit(function(e) {
        e.preventDefault();

        $('#dateSettings').addClass('rejtett');
        function isResult(response)
        {
            successMsg(response.msg);

            $('#dateSettings').addClass('rejtett');
            
            // Eddig szerintem ez a legcsúnyább rész amit írtam, de működik :D Ha nem tudtam volna így kicserélni
            // a leírást a projekt listában akkor az egész listát újra kellett volna tölteni
            $('#columns').find('*[data-content="'+ azonosito +'"]').parents('.card').children('.card-body').find('.card-text:first').text($("#projectInfoView").val());

            $('#latestColumns').find('*[data-content="'+ azonosito +'"]').parents('.card').children('.card-body').find('.card-text:first').text($("#projectInfoView").val());
        }

        if ($('#projectInfoView').val().length > 100)
        {
            infoMsg(core.Languages[document.documentElement.lang]["infoTooLong"]);
        }
        else
        {
            AJAXCall(core.useraction, 'POST', {action:"editProjectInfo", projectID:azonosito, projectInfo:$("#projectInfoView").val()}, noResult, isResult, errorMsg);
        }
    });

    /* TARTALOM MENÜPONT VÉGE */

    /* EGYÉB APRÓSÁGOK */
    $(document).on('click', '.item', function ()
    {
        let item = $(this).children().eq(1).text();
        
        let tevekenyseg_azonosito = $(this).parents('li').attr('data-content');

        completeActivity(tevekenyseg_azonosito);

        $(this).parents('li').remove();
        $('#doneList').append('<li><span>'+ item +'</span></li>');
    });

    $('#item_name').keyup(function(e) {
        e.preventDefault();

        if ($(this).val().length > 2)
        {
            $('#dateSettings').removeClass('rejtett');
        }
        else {
            $('#dateSettings').addClass('rejtett');
        }
    });

    $(document).on('click', '.prior', function () {
        // Prioritás állítás
        $(this).children(".priorDef").toggleClass('rejtett');
        $(this).children(".priorImp").toggleClass('rejtett');

        let tevekenyseg_azonosito = $(this).parents('li').attr('data-content');
        toggleActivityPriority(tevekenyseg_azonosito);
    });

    $(document).on('click', '.clear', function () {
        // Törölje a feladatot
        let tevekenyseg_azonosito = $(this).parents('li').attr('data-content');

        let result = confirm(core.Languages[document.documentElement.lang]["Confirm"]);

        if (result)
        {
            removeActivity(tevekenyseg_azonosito);
            // A listából is törlöm
            $(this).parents("li").remove();
        }
        else 
        {
            // Nem csinálok semmit
        }
    });

    $('#colorSelect').on('change', function() {
        $("#bemutato").removeClass();
        $("#bemutato").addClass("card");

        $("#bemutato").addClass(this.value);
      });

    /* DOCUMENT.READY VÉGE */
});

// PNotify üzenet
function successMsg(msg)
{
    PNotify.success({
        text: msg,
        addClass: 'nonblock',
        delay: 2000,
    });
}
function errorMsg(msg)
{
    PNotify.error({
        text: msg,
        addClass: 'nonblock',
        delay: 2000,
    });
}
function infoMsg(msg)
{
    PNotify.info({
        text: msg,
        addClass: 'nonblock',
        delay: 2000,
    });
}