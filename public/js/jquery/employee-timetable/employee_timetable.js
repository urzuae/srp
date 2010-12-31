var holidays=null;
var enable_saturdays=null;
var enable_sundays=null;
var dayIDs = {"monday":true,"tuesday":true,"wednesday":true,"thursday":true,"friday":true,"saturday":true,"sunday":true};
var schedule,is_checkbox,projects, tasks,id_project_task,week,hours=null;
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

    holidays=
    {
        "2010":

        {
            "11":["2","15","18"],
            "12":["24","30","31"]
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

    $( "#datepicker" ).datepicker( "option",$.datepicker.regional[ "es" ] );

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
                       // alert(JSON.stringify(myjson.hours));
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
                    {type: 'change', 
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
            editable: dayIDs.monday,
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
                    $('#rowed5').jqGrid('editRow',id,true,'','','','',alternSave,'','');
                    buildProjects(id,data);
                    keydown();
                }else if(edit_mode(id) && lastsel2==id){
                    id_project_task=$("#"+id+"_task_code option:selected").attr("id");
                    //alert(id_project_task);
                    $("#rowed5").jqGrid('saveRow', lastsel2, false, 'clientArray');
                    $('#rowed5').jqGrid('restoreRow',id);
                    $("#rowed5").jqGrid("setRowData", id,{id_project_task:id_project_task});
                    sumHours();
                }else if(id && id!==lastsel2){
                    data=$("#rowed5").jqGrid("getRowData", id);
                    id_project_task=$("#"+lastsel2+"_task_code option:selected").attr("id");
                    //alert(id_project_task);
                    $("#rowed5").jqGrid('saveRow', lastsel2, false, 'clientArray');
                    $('#rowed5').jqGrid('restoreRow',lastsel2);
                    $("#rowed5").jqGrid("setRowData", id,{id_project_task:id_project_task});
                     sumHours();
                    $('#rowed5').jqGrid('editRow',id,true,'','','','',alternSave,'','');
                    buildProjects(id,data);
                   keydown();
                    lastsel2=id;
                }
            }else if(is_checkbox){
                id_project_task=$("#"+id+"_task_code option:selected").attr("id");
                $('#rowed5').jqGrid('setSelection',id, false);
                $("#rowed5").jqGrid('saveRow', id, false, 'clientArray');
                $('#rowed5').jqGrid('restoreRow',id);
                $("#rowed5").jqGrid("setRowData", id,{id_project_task:id_project_task});
                sumHours();
            }


        },
        beforeSelectRow:function(id,e){
            type=$(e.originalEvent.target).attr("type");
            if(e.originalEvent.target.id!="" && type=="checkbox")
                is_checkbox=true;
            else
                is_checkbox=false;

            return true;
        },onSelectAll:function(ids, status){
            restoreAll();
            $("#rowed5").jqGrid("resetSelection");
            if(status)
                $("#cb_rowed5").attr("checked","checked");
            else
                $("#cb_rowed5").attr("checked","");
            var i=0;
            for(var a=1; a<ids.length; a++){
                index=parseInt(ids[a]);
                //alert(index);
                data=$("#rowed5").jqGrid("getRowData", index);
                if(status)
                    if(data.status=="Borrador")
                        $('#rowed5').jqGrid('setSelection',ids[a], false);
            }
            
        }
        ,gridComplete:
        function()
        {
            var ids = $("#rowed5").getDataIDs();
            
            if(ids.length>0){
                //alert(ids.length);
                for(var i=0;i<ids.length;i++)
                {
                    var data=$("#rowed5").getRowData (ids[i]);
                    if(data.status=="Liberada"){
                        $("tr[id='"+ids[i]+"']").addClass("not-editable-row");
                        $("tr[id='"+ids[i]+"']").find("input[type='checkbox']").attr("disabled","disabled");
                        
                    }
                    $("#rowed5").setCell(ids[i],"monday",'','',{editable:false});
                }
            }
            else
                $("#cargando").hide();
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
            restoreAll();
            selected_rows=mygrid.getGridParam("selarrrow");
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
            restoreAll();
            selected_rows=mygrid.getGridParam("selarrrow");
            duplicateRows(selected_rows);
        },
        position:"last"
    }).navSeparatorAdd("#pager",{
        sepclass:"ui-separator",
        sepcontent: ''
    })
    .navButtonAdd('#pager',{
        caption:"Copiar Periodo",
        onClickButton: function(){
        },
        position:"last"
    }).navSeparatorAdd("#pager",{
        sepclass:"ui-separator",
        sepcontent: ''
    })
    .navButtonAdd('#pager',{
        caption:"Guardar",
        onClickButton: function(){
            restoreAll();
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
            restoreAll();
            release_timetable();
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

function check_schedule(schedule){
    switch (schedule){
        case "TS":
            return 50;
            break;
        case "MT":
            return 25;
            break;
        case "RP":
            return 40;
            break;
        default:
            return 40;
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

function customProject(value, column){
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
    if(!rows)
        alert("No se han seleccinado horas.");
    else if(!jQuery.isEmptyObject(rows)){
        $.ajax({
            method:"POST",
            url:"../timetable/save-timetable",
            data:{
                rows_local:$.toJSON(rows.local),rows_db:$.toJSON(rows.db), beginning:date.beginning
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
        alert("Existen errores en las horas seleccionadas.");
}

function release_timetable(){
    rows=make_json_request(true);
    date=getDateRangeOfWeek(week);
    alert(hours);
    if(!rows)
        alert("No se han seleccinado horas.");
    else if(hours>=schedule){
        if(!jQuery.isEmptyObject(rows)){
            $.ajax({
                method:"POST",
                url:"../timetable/release-timetable",
                dataType:"json",
                data:{
                    rows_local:$.toJSON(rows.local),
                    rows_db:$.toJSON(rows.db),
                    beginning:date.beginning
                    },
                success:function(response){
                    if(response.ok){
                        alert("La planilla ha sido liberada");
                        $("#rowed5").trigger("reloadGrid");
                    }else if(response.error)
                        alert(response.error);
                }
            });
        }else
            alert("Existen errores en las horas seleccionadas.");
    }else
        alert("La horas a liberar son menores a las horas de la semana.");
}

function deleteRows(rows_local){
    rows=make_json_request();
    date=getDateRangeOfWeek(week);
    if(!rows)
        alert("No se han seleccinado horas.");
    else if(!jQuery.isEmptyObject(rows.db)){
        $.ajax({
            method:"POST",
            url:"../timetable/delete-timetable",
            data:{
                rows_db:$.toJSON(rows.db)
            },
            dataType:"json",
            success:function(response){
                if(response.ok){
                    for(var i=0; i<rows_local.length; i++){
                        index=parseInt(rows_local[i]);
                        //var data=$("#rowed5").getRowData (index);
                        $("#rowed5").jqGrid("delRowData",index);
                    }
                    $("#rowed5").jqGrid("resetSelection");
                    alert("Las horas elegidas han sido borradas");
                    //$("#rowed5").trigger("reloadGrid");
                }else if(response.error)
                    alert(response.error);
            }
        });
    }else
        alert("Existen errores en las horas seleccionadas.");
}
function duplicateRows(rows){
     for(var i=0; i<rows.length; i++){
         index=parseInt(rows[i]);
         var data=$("#rowed5").getRowData (index);
         if(data.id_project && data.id_project_task){
            data.id_timeable="";
            data.status="Borrador";
            ids=$("#rowed5").jqGrid('getDataIDs');
            index=parseInt(ids[$("#rowed5").jqGrid('getDataIDs').length-1])+parseInt(1);
            $("#rowed5").jqGrid("addRowData",index,data);
         }
     }
}

function countHours(){
    var hours=0;
    $("input[id*='day']").each(function(){
       hours+=($(this).val())?parseInt($(this).val()):0;
    });
    return hours;
}

function alternSave(rowid, result){
    if(!result){
        id_project_task="";
    }else
        $("#rowed5").jqGrid("setRowData", rowid,{id_project_task:id_project_task});
    sumHours();
}

function restoreAll(){
    if(edit_mode(lastsel2)){
        id_project_task=$("#"+lastsel2+"_task_code option:selected").attr("id");
        //alert(id_project_task);
        $("#rowed5").jqGrid('saveRow', lastsel2, false, 'clientArray');
        $('#rowed5').jqGrid('restoreRow',lastsel2);
        $("#rowed5").jqGrid("setRowData", lastsel2,{
            id_project_task:id_project_task
        });
        sumHours();
    }
}

function buildProjects(id,data){    
    $("#"+id+"_project_code").html("");
    $("#"+id+"_project_code").html($("#projects").html());
    $("#"+id+"_project_code").bind("change",{},function(event, task){
        get_tasks($(this).find("option:selected").attr("id"),id,task);
    });
    if(data.project_code){
        $("#"+id+"_project_code").val(data.project_code);
        $("#"+id+"_project_code").trigger("change",[data.task_code]);
    }
}

function make_json_request(count){
    var json_o={};
    var json_db={};
    var i=0;
    hours=0;
    var ids=$("#rowed5").jqGrid('getGridParam','selarrrow');
    if(ids.length){
        for(i=0;i<ids.length;i++){
            data=$("#rowed5").getRowData (ids[i]);
            //alert(JSON.stringify(data));
            if(data.hours && data.hours>0 && data.status=="Borrador"){
                if(count)
                    hours+=parseInt(data.hours);
                data.id_project=$("#projects option[value='"+data.project_code+"']").attr("id");
                if(!data.id_timetable)
                    json_o[i]=data;
                else
                    json_db[i]=data;
            }else
                return {}
        }
        return {local:json_o,db:json_db};
    }
    else{
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

function keydown(){
    $("input[id*='_']").bind("keydown",function(){
       id_project_task=$("select[id*='_task_code'] option:selected").attr("id");
    });
}