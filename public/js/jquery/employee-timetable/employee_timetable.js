var holidays=null;
var enable_saturdays=null;
var enable_sundays=null;
var dayIDs = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
var start_hour,end_hour, current_date, id_event,schedule,is_checkbox,projects, tasks,week=null;
var json_hours=[{}];
var lastsel2;
var mydata2 = [ {id_timetable:"",id_project:"",project_code:"",id_project_task:"",task_code:"",attendance_label:"",attendance_type:"",description:"",monday:"",tuesday:"",wendsday:"",thursday:"",friday:"",saturday:"",sunday:"",hours:"",status:"Borrador"}];
$(document).ready(function() {


    $("#projects").hide();
    schedule=check_schedule($("#schedule_type").val());
    $("#projects_tr, #tasks_tr").val("0");
    $("#projects_tr, #tasks_tr, #description_tr, #create").hide();

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
        maxDate:"+"+addDays+"d",
        beforeShowDay: disableTheseDays,
        onSelect: function(date, inst){
            date_var=$("#datepicker").datepicker("getDate");
            if(week !=date_var.getWeek()){
                week=date_var.getWeek();
                $("#rowed5").GridUnload();
                createTimetable(getDateRangeOfWeek(date_var.getWeek()));
            }
        }
    });

    $("#new").click(function(){
        jQuery("#rowed5").jqGrid('editGridRow',"new",{
            height:280,
            reloadAfterSubmit:false
        });
    });

    $( "#datepicker" ).datepicker( "option",$.datepicker.regional[ "es" ] );



// page is now ready, initialize the calendar...

});

function createTimetable(dateRange){
    var mygrid=jQuery("#rowed5").jqGrid({
        datatype: function(postdata) {
            jQuery.ajax({
                url: "../project/get-projects",
                dataType:"json",
                data:{beginning:dateRange.beginning},
                complete: function(jsondata,stat){
                    if(stat=="success") {
                        var thegrid = jQuery("#rowed5")[0];
                        var myjson = eval("("+jsondata.responseText+")");
                        projects=myjson.projects;
                        //alert(JSON.stringify(myjson.hours));
                        if(!jQuery.isEmptyObject(myjson.hours)){
                            thegrid.addJSONData(myjson.hours);
                            sumHours();
                        }
                        else
                            addRow();
                        $("#projects").html("");
                        $("#projects").append("<option value=''></option>");
                        $.each(projects, function(i,val){
                            if(!val.department)
                                $("#projects").append("<option id='1_"+i+"' value='"+val+"'>"+val+"</option>");
                            else
                                $("#projects").append("<option id='2_"+i+"' value='"+val+"'>"+val.department+"</option>");
                        });
                    }
                }
            });
        },
        height: "100%",
        footerrow: true,
        pgbuttons:false,
        pginput:false,
        pgtext:false,
        multiselect:true,
        editurl:'clientArray',
        colNames:['id_timetable','id_project','Codigo-Proyecto','id_project_task','Actividad', 'Descripción','Ausencia/Presencia','attendance_type', 'L','M','M','J','V','S','D',"Total-Horas","Status"],
        colModel:[
        {
            name:'id_timetable',
            index:'id_timetable',
            hidden:true
        },
        {
            name:'id_project',
            index:'id_project',
            hidden:true
        },
        {
            name:'project_code',
            index:'project_code',
            width:150,
            sorttype:"int",
            edittype:"select",
            stype:"select",
            editable: true,
            editoptions:{
                value:"0:"
            },
            editrules:{
                custom:true,
                custom_func:customProject
            }
        }, {
            name:'id_project_task',
            index:'id_project_task',
            hidden:true
        },
         {
            name:'task_code',
            index:'task_code',
            width:150,
            editable: true,
            edittype:"select",
            editoptions:{
                value:"0:"
            },
            editrules:{
                custom:true,
                custom_func:customTask
            }
        }, {
            name:'description',
            index:'description',
            width:150,
            editable: true,
            edittype:"textarea",
            editoptions:{
                rows:"2",
                cols:"14",
                maxLength: "30"
            }
        },{
            name:'attendance_label',
            index:'attendance_label',
            width:150,
            edittype:"select",
            stype:"select",
            editable: true,
             editoptions:{
                value:":;1:Presencias reales;2:Permiso recuperable;3:Permiso no recuperable;4:Horas extras;5:Enfermedad < 4 días;6:Ausencias autorizadas",
                dataEvents: [
                    { type: 'change', 
                      fn: function(e) 
                          { 
                           $("#rowed5").jqGrid("setRowData",lastsel2,{attendance_type:$("select[id*='attendance_label']").val()});
                          } 
                    }
                ]
            }
        },{
            name:'attendance_type',
            index:'attendance_type',
            hidden:true
        },{
            name:'monday',
            index:'monday',
            width:25,
            sorttype:"int",
            editable: true,
            editoptions:{
                maxLength: 2,
                style:""
            },
            editrules:{
                number: true
            }
        }, {
            name:'tuesday',
            index:'tuesday',
            width:25,
            sorttype:"int",
            editable: true,
            editoptions:{
                maxLength: 2,
                style:""
            },
            editrules:{number: true}
        }, {
            name:'wednesday',
            index:'wednesday',
            width:25,
            sorttype:"int",
            editable: true,
            editoptions:{
                maxLength: 2,
                style:""
            },
            editrules:{number: true}
        }, {
            name:'thursday',
            index:'thursday',
            width:25,
            sorttype:"int",
            editable: true,
            editoptions:{
                maxLength: 2,
                style:""
            },
            editrules:{number: true}
        }, {
            name:'friday',
            index:'friday',
            width:25,
            sorttype:"int",
            editable: true,
            editoptions:{
                maxLength: 2,
                style:""
            },
            editrules:{number: true}
        }, {
            name:'saturday',
            index:'saturday',
            width:25,
            sorttype:"int",
            editable: true,
            editoptions:{
                maxLength: 2,
                style:""
            },
            editrules:{number: true}
        }, {
            name:'sunday',
            index:'sunday',
            width:25,
            sorttype:"int",
            editable: true,
            editoptions:{
                maxLength: 2,
                style:""
            },
            editrules:{number: true}
        }, {
            name:'hours',
            index:'hours',
            width:80,
            sorttype:"int",
            editable: false
        }, {
            name:'status',
            index:'status',
            width:100,
            sorttype:"int",
            editable: false
        }
        ],
        onSelectRow: function(id,status){

            $('#rowed5').jqGrid('setSelection',id, false);

            if(!is_checkbox){
                if(!edit_mode(id) && lastsel2==id){
                    data=$("#rowed5").jqGrid("getRowData", id);
                    $('#rowed5').jqGrid('editRow',id,true,'','','','',alternSave);
                    $("#"+id+"_project_code").html("");
                    $("#"+id+"_project_code").html($("#projects").html());
                    $("#"+id+"_project_code").bind("change",{},function(event, task){
                        get_tasks($(this).find("option:selected").attr("id"),id,task);
                    });
                    if(data.project_code){
                        $("#"+id+"_project_code").val(data.project_code);
                        $("#"+id+"_project_code").trigger("change",[data.task_code]);
                    }
                }else if(edit_mode(id) && lastsel2==id){
                    data=$("#rowed5").jqGrid("getRowData", id);
                    $("#rowed5").jqGrid("setRowData", id,{id_project_task:$("#"+id+"_task_code option:selected").attr("id")});
                    $("#rowed5").jqGrid('saveRow', lastsel2, false, 'clientArray');
                    $('#rowed5').jqGrid('restoreRow',id);
                    sumHours();
                }else if(id && id!==lastsel2){
                    data=$("#rowed5").jqGrid("getRowData", id);
                    $("#rowed5").jqGrid("setRowData", id,{id_project_task:$("#"+id+"_task_code option:selected").attr("id")});
                    $("#rowed5").jqGrid('saveRow', lastsel2, false, 'clientArray');
                    $('#rowed5').jqGrid('restoreRow',lastsel2);
                    sumHours();
                    $('#rowed5').jqGrid('editRow',id,true,'','','','',alternSave);
                    $("#"+id+"_project_code").html("");
                    $("#"+id+"_project_code").html($("#projects").html());
                    $("#"+id+"_project_code").bind("change",{},function(event, task){
                        get_tasks($(this).find("option:selected").attr("id"),id,task);
                    });
                    if(data.project_code){
                        $("#"+id+"_project_code").val(data.project_code);
                        $("#"+id+"_project_code").trigger("change",[data.task_code]);
                    }
                    lastsel2=id;
                }
            }else if(is_checkbox){
                $('#rowed5').jqGrid('setSelection',id, false);
                $("#rowed5").jqGrid('saveRow', id, false, 'clientArray');
                $('#rowed5').jqGrid('restoreRow',id);
                sumHours();
            }


        },
        beforeSelectRow:function(id,e){

            //alert($(e.originalEvent.target).attr("type"));
            type=$(e.originalEvent.target).attr("type");
            if(e.originalEvent.target.id!="" && type=="checkbox")
                is_checkbox=true;
            else
                is_checkbox=false;

            return true;
        },
        pager:'#pager',
        caption: "Horas registradas desde "+dateRange.label
    });


    $("#rowed5")
    .navGrid('#pager',{
        edit:false,
        add:false,
        del:false,
        search:false,
        refresh:false
    })
    .navButtonAdd('#pager',{
        caption:"Insertar Fila",
        onClickButton: function(){
            addRow();
        },
        position:"last"
    }).navSeparatorAdd("#pager",{
        sepclass:"ui-separator",
        sepcontent: ''
    })
    .navButtonAdd('#pager',{
        caption:"Eliminar Fila(s)",
        onClickButton: function(){
            selected_rows=mygrid.getGridParam("selarrrow");
            //alert(selected_rows);
            deleteRows(selected_rows);
        },
        position:"last"
    }).navSeparatorAdd("#pager",{
        sepclass:"ui-separator",
        sepcontent: ''
    })
    .navButtonAdd('#pager',{
        caption:"Duplicar Fila(s)",
        onClickButton: function(){
        //            $("#leads").GridUnload();
        //            getLeads(false, true);
        //pruebaList($("#leads").html());
        },
        position:"last"
    }).navSeparatorAdd("#pager",{
        sepclass:"ui-separator",
        sepcontent: ''
    })
    .navButtonAdd('#pager',{
        caption:"Copiar Periodo",
        onClickButton: function(){
        //            $("#leads").GridUnload();
        //            getLeads(false, true);
        //pruebaList($("#leads").html());
        },
        position:"last"
    }).navSeparatorAdd("#pager",{
        sepclass:"ui-separator",
        sepcontent: ''
    })
    .navButtonAdd('#pager',{
        caption:"Refrescar",
        onClickButton: function(){
        //            $("#leads").GridUnload();
        //            getLeads(false, true);
        //pruebaList($("#leads").html());
        },
        position:"last"
    }).navSeparatorAdd("#pager",{
        sepclass:"ui-separator",
        sepcontent: ''
    })
    .navButtonAdd('#pager',{
        caption:"Guardar",
        onClickButton: function(){
            saveRows();
        },
        position:"last"
    }).navSeparatorAdd("#pager",{
        sepclass:"ui-separator",
        sepcontent: ''
    })
    .navButtonAdd('#pager',{
        caption:"Liberar",
        onClickButton: function(){
        //            $("#leads").GridUnload();
        //            getLeads(false, true);
        //pruebaList($("#leads").html());
        },
        position:"last"
    });
    $( "#datepicker" ).datepicker();
}

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

function get_projects(){

    $.ajax({
        method:"POST",
        url:"../project/get-projects",
        dataType:"json",
        success:function(response){

        }
    });
}

function get_tasks(id_project, id, task){
    $.ajax({
        method:"POST",
        url:"../project-task/get-tasks",
        data:{
            id_project:id_project
        },
        dataType:"json",
        success:function(tasks){
            $("#"+id+"_task_code").html("");
            $("#"+id+"_task_code").append("<option value=''></option>");
            if(!jQuery.isEmptyObject(tasks)){
                $.each(tasks, function(i,val){
                    $("#"+id+"_task_code").append("<option id='"+i+"' value='"+val.taskCode+"'>"+val.taskCode+"</option>");
                });
                $("#"+id+"_task_code").val(task);
            }
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

function edit_mode(row_id){
    var edited = "0";
    var ind = jQuery("#rowed5").getInd(row_id,true);
    if(ind != false){
        edited = $(ind).attr("editable");
    }

    if (edited === "1"){
        return true;
    } else{
        return false;
    }

}

function addRow(){
    ids=$("#rowed5").jqGrid('getDataIDs');
    index=parseInt(ids[$("#rowed5").jqGrid('getDataIDs').length-1])+parseInt(1);
    if(!isNaN(index))
        $("#rowed5").jqGrid("addRowData",index,mydata2[0]);
    else
        $("#rowed5").jqGrid("addRowData",0,mydata2[0]);
}

//function getRowData(id){
//    if(edit_mode(id)){
//        $('#rowed5').jqGrid('restoreRow',id);
//        data=$("#rowed5").jqGrid("getRowData", id);
//        $('#rowed5').jqGrid('editRow',id,true);
//        return data;
//    }
//    else
//        return $("#rowed5").jqGrid("getRowData", id);
//}

function customProject(value, column){
    //alert(column);
    if(value=="0" || value==undefined || value=="")
        return [false,"Por favor elige un proyecto"];
    else if(value!="0")
        return [true,""];
    return [false,"Por favor elige un proyecto"];
}

function customTask(value, column){
    //alert(value);
    if(value=="0" || value==undefined || value=="")
        return [false,"Por favor elige una actividad"];
    else if(value!="0")
        return [true,""];
    return [false,"Por favor elige una actividad"];
}

//function customDaysHours(value, column){
//    getRowData();
//}

function customDescription(value, column){
    if(value.length>=5 && value.length<=30)
        return[true,""];
    else
        return[false,"La descripciÛn debe ser mayor o igual a 5 caracteres y menor o igual a 30"];
}

function getDateRangeOfWeek(weekNo){
    var d1 = new Date();
    numOfdaysPastSinceLastMonday = eval(d1.getDay()- 1);
    d1.setDate(d1.getDate() - numOfdaysPastSinceLastMonday);
    var weekNoToday = d1.getWeek();
    var weeksInTheFuture = eval( weekNo - weekNoToday );
    d1.setDate(d1.getDate() + eval( 7 * weeksInTheFuture ));
    var rangeIsFrom =   d1.getDate()  +"/"  +  eval(d1.getMonth()+1)  + "/"  +   d1.getFullYear();
    d1.setDate(d1.getDate() + 6);
    var rangeIsTo = d1.getDate()  +"/"  +  eval(d1.getMonth()+1)  + "/"  +   d1.getFullYear() ;
    return {beginning:rangeIsFrom, label:rangeIsFrom + " hasta "+rangeIsTo};
}

function saveRows(){
    rows=make_json_request();
    date=getDateRangeOfWeek(week);
    if(!jQuery.isEmptyObject(rows)){
        $.ajax({
            method:"POST",
            url:"../timetable/save-timetable",
            data:{
                rows:$.toJSON(rows), beginning:date.beginning
            },
            dataType:"json",
            success:function(response){
                if(response.ok){
                    alert("Las horas elegidas han sido guardadas en borrador");
                    $("#rowed5").trigger("reloadGrid");
                }else if(response.error)
                    alert(response.error);
            }
        });
    }else
        alert("Existen errores en las horas seleccionadas");
}

function deleteRows(rows){
    for(var i=0; i<rows.length; i++){
        index=parseInt(rows[i]);
        var data=$("#rowed5").getRowData (index);
        if(!data.id_timetable)
            $("#rowed5").jqGrid("delRowData",index);
        else
            $.ajax({
                method:"POST",
                url:"../timetable-hour/delete-hour",
                data:{
                    id_timetable:id_timetable
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
    $("#rowed5").jqGrid("resetSelection");
    sumHours();
}

function countHours(){
    var hours=0;
    $("input[id*='day']").each(function(){
       hours+=($(this).val())?parseInt($(this).val()):0;
    });
    return hours;
}

function alternSave(rowid, result){
    sumHours();
}

function make_json_request(){
    var json_o={};
    var i=0;
    var ids=$("#rowed5").jqGrid('getGridParam','selarrrow');
    if(ids.length){
        for(i=0;i<ids.length;i++){
            data=$("#rowed5").getRowData (ids[i]);
            if(data.hours && data.hours>0 && data.status=="Borrador"){
                //alert($("#projects").find(":option[value='"+data.project_code+"']").attr("id"));
                data.id_project=$("#projects option[value='"+data.project_code+"']").attr("id");
                json_o[i]=data;
            }
        }
        return json_o;
    }
    else{
        alert("No se han seleccionado horas para liberar.");
        return null;
    }
}

function sumHours(){
    var ids = $("#rowed5").jqGrid("getDataIDs");
    //alert(ids);
    var days={"monday":"0","tuesday":"0","wednesday":"0","thursday":"0","friday":"0","saturday":"0","sunday":"0","hours":"0"};
    if(ids.length){
        for(var i=0;i<ids.length;i++)
        {
            var data=$("#rowed5").getRowData (ids[i]);
            var count=0;
            if(!isNaN(parseInt(data.monday)))
            {
                count+=parseInt(data.monday);
                days.monday=parseInt(data.monday)+parseInt(days.monday);
            }
            if(!isNaN(parseInt(data.tuesday)))
            {
                count+=parseInt(data.tuesday);
                days.tuesday=parseInt(data.tuesday)+parseInt(days.tuesday);
            }
            if(!isNaN(parseInt(data.wednesday)))
            {
                count+=parseInt(data.wednesday);
                days.wednesday=parseInt(data.wednesday)+parseInt(days.wednesday);
            }
            if(!isNaN(parseInt(data.thursday)))
            {
                count+=parseInt(data.thursday);
                days.thursday=parseInt(data.thursday)+parseInt(days.thursday);
            }
            if(!isNaN(parseInt(data.friday)))
            {
                count+=parseInt(data.friday);
                days.friday=parseInt(data.friday)+parseInt(days.friday);
            }
            if(!isNaN(parseInt(data.saturday)))
            {
                count+=parseInt(data.saturday);
                days.saturday=parseInt(data.saturday)+parseInt(days.saturday);
            }
            if(!isNaN(parseInt(data.sunday)))
            {
                count+=parseInt(data.sunday);
                days.sunday=parseInt(data.sunday)+parseInt(days.sunday);
            }
            $("#rowed5").jqGrid("setRowData", ids[i],{hours:count});
            //data=$("#rowed5").getRowData (ids[i]);
            if(!isNaN(parseInt(data.hours)))
            {
                days.hours=parseInt(count)+parseInt(days.hours);
            }

        }
    }
    $("#rowed5").jqGrid("footerData","set",{"monday":days.monday,"tuesday":days.tuesday,"wednesday":days.wednesday,"thursday":days.thursday,"friday":days.friday,"saturday":days.friday,"sunday":days.sunday,"hours":days.hours});
}