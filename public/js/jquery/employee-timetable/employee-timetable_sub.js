var holidays=null;
var enable_saturdays=null;
var enable_sundays=null;
var dayIDs = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
var start_hour,end_hour, current_date, id_event,schedule;
var json_hours=[{}];
$(document).ready(function() {
    schedule=check_schedule($("#schedule_type").val());
    $("#projects_tr, #tasks_tr").val("0");
    $("#projects_tr, #tasks_tr, #description_tr, #create").hide();
    $("#overlay").overlay({
        closeOnClick:true
    });
    $("#overlay_task").overlay({
        closeOnClick:true
    });
    $("#calendar").hide();
    enable_saturdays=true;
    enable_sundays=false;
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    var addDays=lastDayOfMonth(y, m)-d;

    $("#project_type").change(function(){
        if($(this).val()=="0")
            $("#projects_tr, #tasks_tr, #description_tr, #create").hide();
        else{
            $("#projects_tr, #tasks_tr, #description_tr, #create").hide();
            get_projects($(this).val());
        }
    });

    $("#projects").change(function(){
        get_tasks($("#project_type").val(),$(this).val());
    });

    $("#tasks").change(function(){
        //alert();
        if($(this).val()=="0" || $(this).val()=="")
            $("#create, #description_tr").hide();
        else
            $("#create, #description_tr").show();
    });

    $("#create").click(function(){
        create_timetable_hour(current_date);
    });

    $("#delete").click(function(){
        delete_timetable_hour(id_event);
    });

    $("#release").click(function(){
        release_timetable_hour(id_event);
    });

    holidays=
    {
        "2010":

        {
            "11":["2","15","18"],
            "12":["24","31"]
        },
        "2011":{
            "1":["1","5"]
        }
    };

    $( "#datepicker" ).datepicker({
        numberOfMonths: 2,
        maxDate:0,
        beforeShowDay: disableTheseDays,
        onSelect: function(date, inst){
            date_var=$("#datepicker").datepicker("getDate");
            $("#calendar").show();
            $("#calendar").fullCalendar("changeView","agendaDay");
            calendar.fullCalendar("gotoDate",date_var.getFullYear(),date_var.getMonth(),date_var.getDate());
        }
    });
    $( "#datepicker" ).datepicker( "option",$.datepicker.regional[ "es" ] );


    //$( "#datepicker" ).datepicker();

    // page is now ready, initialize the calendar...

    var calendar=$('#calendar').fullCalendar({
        events:"../timetable-hour/get-hours",
        slotMinutes:60,
        theme:true,
        firstDay:1,
        allDayDefault:false,
        allDayText:"Liberar Día",
        selectable: true,
        editable: true,
        firstHour:0,
        minTime:0,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'agendaWeek,agendaDay'
        },
        dayClick: function(date, allDay, jsEvent, view) {
            if(allDay){
                var end_date=new Date(date);
                var hours=0;
                end_date.setHours(23, 59, 0, 0);
                json_hours={};
                //alert(date);
                $('#calendar').fullCalendar('clientEvents', function(event) {
                    if(Date.parse(event.start)>=Date.parse(date) && Date.parse(event.start)<=Date.parse(end_date)) {
                        hours=hours+parseInt(event.hours);
                        if(event.status==1)
                            make_json_released_hours(event);
                    }
                });
                //alert(hours);
                if(!jQuery.isEmptyObject(json_hours) && hours>schedule){
                    var ok=confirm("Se liberará la planilla. Recuerda que una vez liberada esta no podrá ser modificada");
                    if(ok)release_timetable();
                }else{
                    if(jQuery.isEmptyObject(json_hours))
                        alert("No hay horas en borrador para ser liberadas");
                    else if(hours<schedule)
                        alert("No se pueden liberar planillas con menos horas del horario asignado");
                }
            }
        },
        eventClick: function(calEvent, jsEvent, view) {

            //            alert('Event: ' + calEvent.title);
            //            alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
            //            alert('View: ' + view.name);

            // change the border color just for fun
            if(calEvent.status==1){
                id_event=calEvent.id;
                $("#task_label").html(calEvent.title+"-"+calEvent.id);
                $("#overlay_task").overlay().load();
            }

        },
        select: function(start, end, allDay) {
            //alert(start+"-"+end);
            if(!allDay){
                var events=calendar.fullCalendar("clientEvents");
                $.each(events,function(){
                    if((dateWithin(this.start,this.end,start)||dateWithin(this.start,this.end,end)) || (dateWithin(start,end,this.start)||dateWithin(start,end,this.end))){
                        alert("No se pueden traslapar actividades");
                        calendar.fullCalendar('unselect');
                    }
                });
                if(isWithinMonthAndEnable(start) && !isHoliday(start)){
                    start_hour=start;
                    end_hour=end;
                    //new Date().
                    current_date=start.getFullYear()+"-"+(start.getMonth()+1)+"-"+start.getDate()+" "+start.getHours()+":00:00";
                    if(Date.parse(start)==Date.parse(end))
                        $("#hours").html("<h3>Horario: "+start.getHours()+":00</h3>");
                    else
                        $("#hours").html("<h3>Horario: "+start.getHours()+":00 a "+end.getHours()+":00</h3>");
                    $("#overlay").overlay().load();
                }
                else
                    alert("El día esta deshabilitado para registro");
                    calendar.fullCalendar('unselect');
            }
            else
                calendar.fullCalendar( 'unselect' );
        },
        eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
            if(event.status==1){
                if(isWithinMonthAndEnable(event.start) && !isHoliday(event.start)){
                    var events=calendar.fullCalendar("clientEvents");
                    start_hour=event.start;
                    end_hour=event.end;
                    //new Date().
                    current_date=event.start.getFullYear()+"-"+(event.start.getMonth()+1)+"-"+event.start.getDate()+" "+event.start.getHours()+":00:00";
                    //alert(event.start);
                    if(check_hours(events, event)){
                        update_timetable_hour(event, revertFunc);
                    }else
                        revertFunc();

                }else{
                    alert("El día esta deshabilitado para registro");
                    revertFunc();
                }
            }else
                revertFunc();
        },
        eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
            if(event.status==1){
                if(isWithinMonthAndEnable(event.start) && !isHoliday(event.start)){
                    var events=calendar.fullCalendar("clientEvents");
                    start_hour=event.start;
                    end_hour=event.end;
                    //new Date().
                    current_date=event.start.getFullYear()+"-"+(event.start.getMonth()+1)+"-"+event.start.getDate()+" "+event.start.getHours()+":00:00";
                    //alert(event.start);
                    if(check_hours(events, event)){
                        update_timetable_hour(event, revertFunc);
                    }
                    else
                        revertFunc();
                }
                else{
                    alert("El día esta deshabilitado para registro");
                    revertFunc();
                }
            }else
                revertFunc();
        },
        viewDisplay: function(view) {
            var current_day = $('#calendar').fullCalendar('getDate');
            var cMonth = current_day.getMonth()+1;
            var cYear = current_day.getFullYear();
            //alert(Date.parse(current_day.toLocaleDateString())+"+"+Date.parse(new Date().toLocaleDateString()));
            if(view.name=="agendaWeek" && (current_day.getWeek()>new Date().getWeek())){
                $('#calendar').fullCalendar('prev');
                alert("Lo siento... No puedes registrar horas en días adelante del actual.");
            }else if(view.name=="agendaDay" && (Date.parse(current_day.toLocaleDateString())>Date.parse(new Date()))){
                //alert(current_day);
            $('#calendar').fullCalendar('prev');
                alert("Lo siento... No puedes registrar horas en días adelante del actual.");
            }
//            $('td .fc-state-default').css('background','#FFFFFF');
//
//            if($('.fc-not-today').hasClass("fc-sat")||$('.fc-not-today').hasClass("fc-sun")){
//                $('.fc-not-today').removeClass("holiday_day").addClass("ui-state-default");
//            }
           // validateSatAndSun();
//            if(holidays[cYear][cMonth])
//                $.each(holidays[cYear][cMonth], function(i, val){
//                    $('.fc-day-number').each(function(){
//                        lDay = parseInt($(this).text());
//                        //check if it is another month date
//                        if(!$(this).parents('td').hasClass('fc-other-month') && lDay==val)
//                            $(this).parent('td').addClass("holiday_day").removeClass("ui-state-default");
//                    });
//                });
//            if(view.name=="agendaDay"){
//                $('th.agendaDay').each(function(){
//                    if(isHoliday($(this).attr("id"))){
//                        //alert("hola");
//                        $('div.fc-agenda-bg tr.fc-first:only-child td').removeClass("ui-state-default").addClass("holiday_day");
//                    }else{
//
//                }
//                });
//            }
//            if(view.name=="agendaWeek"){
//                //alert("hola");
//                $('th.agendaDay').each(function(){
//                    if(isHoliday($(this).attr("id"))){
//                        var dayDate=new Date($(this).attr("id"));
//                        var day=dayDate.getDay();
//                        //alert('td.fc-'+dayIDs[day]);
//                        $('td.fc-'+dayIDs[day]).removeClass("ui-state-default").addClass("holiday_day");
//                    }
//                });
//            }

        }

    })
});


function dateWithin(beginDate,endDate,checkDate) {
    var b,e,c;
    b = Date.parse(beginDate);
    e = Date.parse(endDate);
    c = Date.parse(checkDate);
    //alert(b+"+"+c+"+"+e);
    if((c < e && c > b)) {
        return true;
    }
    return false;

}
function isWithinMonthAndEnable(dayDate){
    var day=dayDate.getDay();
    var month=dayDate.getMonth();
    var current_day = $('#calendar').fullCalendar('getDate');
    var view = $('#calendar').fullCalendar('getView');
    if(Date.parse(dayDate.toLocaleDateString())>Date.parse(new Date().toLocaleDateString())){
        return false;
    }
    if(view.name=="month")
        if(current_day.getMonth()!=month)
            return false;
    //alert(day+"-"+enable_saturdays);
    if(day<=5 && day>0)
        return true;
    else{
        if((enable_sundays && day==0))
            return true;
        else if((enable_saturdays && day==6))
            return true;
        else
            return false;
    }
}
function isHoliday(dayDate){
    dayDate=new Date(dayDate);
    var day=dayDate.getDate();
    var month=dayDate.getMonth()+1;
    var year=dayDate.getFullYear();
    var result=false;
    //alert(year);
    if(holidays[year] && holidays[year][month]){
        $.each(holidays[year][month], function(i, val){
            //alert(val+" "+day);
            if(val==day){
                result=true;
                return false;
            }
        });
    }
    return result;
}

function validateSatAndSun(){
    if(!enable_sundays)
        $('td.fc-sun').addClass("holiday_day").removeClass("ui-state-default");
    else
        $('td.fc-sun').removeClass("holiday_day").addClass("ui-state-default");
    if(!enable_saturdays)
        $('td.fc-sat').addClass("holiday_day").removeClass("ui-state-default");
    else
        $('td.fc-sat').removeClass("holiday_day").addClass("ui-state-default");
}

function lastDayOfMonth(Year, Month)
{
    return(new Date((new Date(Year, Month,1))-1)).getDate();
}

function disableTheseDays(date) {
    var m = date.getMonth(), d = date.getDay(), y = date.getFullYear();
    if(isHoliday(date)) {
        return [true, "blocked"];
    }else if(!enable_sundays && d==0){
        return [true, "blocked"];
    }else if(!enable_saturdays && d==6)
        return [true, "blockes"];
    return [true];
}

function noWeekendsOrHolidays(date) {
    var noWeekend = jQuery.datepicker.noWeekends(date);
    return noWeekend[0] ? nationalDays(date) : noWeekend;
}

function get_projects(type){
    url=(type=="1")?"../specific-project/get-specifics-projects":"../department-project/get-departments-projects";
    $.ajax({
        method:"POST",
        url:url,
        dataType:"json",
        success:function(response){
            $("#projects").html("");
            $("#projects_tr").show();
            $("#projects").append("<option value='0' selected>Selecciona</option>");
            if(type==1)
                $.each(response, function(i, v){
                    $("#projects").append("<option value="+v.idProject+">"+v.projectName+"</option>");
                });
            else
            if(type==2)
                $.each(response, function(i, v){
                    $("#projects").append("<option value="+v.id_project+">"+v.department_name+"</option>");
                });
        }
    });
}

function get_tasks(type,id_project){
    url=(type=="1")?"../specific-project-task/get-tasks":"../department-project-task/get-tasks";
    $.ajax({
        method:"POST",
        url:url,
        data:{
            id_project:id_project
        },
        dataType:"json",
        success:function(response){
            $("#tasks").html("");
            $("#tasks_tr").show();
            $("#tasks").append("<option value='0' selected>Selecciona</option>");
            $.each(response, function(i, v){
                $("#tasks").append("<option value="+v.idProjectTask+">"+v.taskCode+"</option>");
            });
        }
    });
}

function create_timetable_hour(date){
    calculate_hours();
    $.ajax({
        method:"POST",
        url:"../timetable-hour/create-hour",
        data:{
            id_task:$("#tasks").val(),
            id_project:$("#projects").val(),
            date:date,
            hours:hours,
            description:$("#description").val(),
            type:$("#project_type").val()
        },
        dataType:"json",
        success:function(response){
            if(response.ok){
                $("#calendar").fullCalendar('renderEvent',
                {
                    title: $("#tasks option:selected").text()+"-"+$("#projects option:selected").text(),
                    start: start_hour,
                    end: end_hour,
                    id:response.id,
                    status:1
                },
                true // make the event "stick"
                );
                $("#overlay").overlay().close();

            }else if(response.error)
                alert(response.error);
            $("#overlay").overlay().close();
        }
    });
}

function delete_timetable_hour(id){
    $.ajax({
        method:"POST",
        url:"../timetable-hour/delete-hour",
        data:{
            id_timetable_hour:id
        },
        dataType:"json",
        success:function(response){
            if(response.ok){
                $("#overlay_task").overlay().close();
                alert("Se ha eliminado la actividad");
                $("#calendar").fullCalendar('removeEvents',id);
            }else if(response.error)
                alert(response.error);
        }
    });
}

function getHours(){
    $.ajax({
        method:"POST",
        url:"../timetable-hour/get-hours",
        dataType:"json",
        success:function(response){
            if(response.ok){
                
            }else if(response.error)
                alert(response.error);
        }
    });
}

function check_hours(events, event){
    var is_ok=true;
    $.each(events,function(){
        if(dateWithin(this.start,this.end,event.start)||dateWithin(this.start,this.end,event.end) || (dateWithin(event.start,event.end,this.start) || dateWithin(event.start,event.end,this.end) || Date.parse(this.start)==Date.parse(event.start) || Date.parse(this.end)==Date.parse(event.end)) && this.id!=event.id){
            alert("No se pueden traslapar actividades");
            is_ok=false;
            return false;
        }
    });
    return is_ok;
}

function update_timetable_hour(event, revertFunc){
    calculate_hours();
    //alert(event.start);
    $.ajax({
        method:"POST",
        url:"../timetable-hour/update-hour",
        dataType:"json",
        data:{
            id:event.id,
            date:current_date,
            hours:hours
        },
        success:function(response){
            if(response.ok){

            }else if(response.error)
                alert(response.error);
        }
    });
}

function release_timetable_hour(id){
    //calculate_hours();
    //alert(event.start);
    $.ajax({
        method:"POST",
        url:"../timetable-hour/release-hour",
        dataType:"json",
        data:{
            id:id
        },
        success:function(response){
            if(response.ok){
                alert("La planilla ha sido liberada");
            }else if(response.error)
                alert(response.error);
        }
    });
}

function release_timetable(){
    //calculate_hours();
    //alert(event.start);
    $.ajax({
        method:"POST",
        url:"../timetable-hour/release-timetable",
        dataType:"json",
        data:{
            hours:JSON.stringify(json_hours)
        },
        success:function(response){
            if(response.ok){
                alert("La planilla ha sido liberada");
                $("#calendar").fullCalendar( 'refetchEvents' );
            }else if(response.error)
                alert(response.error);
        }
    });
}

function calculate_hours(){
    hours=null;
    if(start_hour==end_hour)
        hours=1;
    else
        hours=end_hour.getHours()-start_hour.getHours();
}

Date.prototype.getWeek = function() {
    var onejan = new Date(this.getFullYear(),0,1);
    return Math.ceil((((this - onejan) / 86400000) + onejan.getDay()+1)/7);
}

function make_json_released_hours(event){
    json_hours[event.id]={
        "id":event.id
    };
}

function check_schedule(schedule){
    switch (schedule){
        case "TS":
            return 10;
            break;
        case "MT":
            return 5;
            break;
        case "RP":
            return 8;
            break;
        default:
            return 8;
    }
}