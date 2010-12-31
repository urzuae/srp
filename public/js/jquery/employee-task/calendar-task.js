var daysStatus2 = days_status_2;
var daysStatus3 = days_status_3;
var daysStatus4 = days_status_4;
var daysStatus1 = days_status_1;
var projects = projects;
var week=null;
$(document).ready(function(){
	enable_saturdays=true;
    enable_sundays=false;
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    createCalendar();
});

function createCalendar(){
	$( "#datepicker" ).datepicker({
        numberOfMonths: 2,
        beforeShowDay: disableTheseDays,
        onSelect: function(date, inst){
            date_var=$("#datepicker").datepicker("getDate");
            if(week !=date_var.getWeek()){
                week=date_var.getWeek();
                $("#list").GridUnload();
                createGrid(getDateRangeOfWeek(date_var.getWeek()));
            }
        }
    });
    $( "#datepicker" ).datepicker( "option",$.datepicker.regional[ "es" ] );
}

function disableTheseDays(date) {
    var m = date.getMonth(), d = date.getDay(), y = date.getFullYear();
    	if(isDaysStatus2(date)) {
    		return [true,"released"];
    	}else if(isDaysStatus3(date)) {
    		return [true,"rejected"];
    	}else if(isDaysStatus4(date)) {
    		return [true,"approved"];
    	}else if(isDaysStatus1(date)) {
    		return [true,"draft"];
        }else if(!enable_sundays && d==0){
            return [true, "blocked"];
        }else if(!enable_saturdays && d==6)
            return [true, "odd"];
    return [true];
}

function isDaysStatus2(dayDate){
    dayDate=new Date(dayDate);
    var day=dayDate.getDate();
    var month=dayDate.getMonth()+1;
    var year=dayDate.getFullYear();
    var result=false;
    if(daysStatus2[year] != undefined && daysStatus2[year][month] != undefined){
        $.each(daysStatus2[year][month], function(i, val){
            if(val==day){
                result=true;
                return false;
            }
        });
    }
    return result;
}

function isDaysStatus3(dayDate){
    dayDate=new Date(dayDate);
    var day=dayDate.getDate();
    var month=dayDate.getMonth()+1;
    var year=dayDate.getFullYear();
    var result=false;
    if(daysStatus3[year] != undefined && daysStatus3[year][month] != undefined){
        $.each(daysStatus3[year][month], function(i, val){
            if(val==day){
                result=true;
                return false;
            }
        });
    }
    return result;
}

function isDaysStatus4(dayDate){
    dayDate=new Date(dayDate);
    var day=dayDate.getDate();
    var month=dayDate.getMonth()+1;
    var year=dayDate.getFullYear();
    var result=false;
    if(daysStatus4[year] != undefined && daysStatus4[year][month] != undefined){
        $.each(daysStatus4[year][month], function(i, val){
            if(val==day){
                result=true;
                return false;
            }
        });
    }
    return result;
}

function isDaysStatus1(dayDate){
    dayDate=new Date(dayDate);
    var day=dayDate.getDate();
    var month=dayDate.getMonth()+1;
    var year=dayDate.getFullYear();
    var result=false;
    if(daysStatus1[year] != undefined && daysStatus1[year][month] != undefined){
        $.each(daysStatus1[year][month], function(i, val){
            if(val==day){
                result=true;
                return false;
            }
        });
    }
    return result;
}

/*function send(dateText, objDatepicker){	
		$("#mensaje").html("<input type='hidden' name='date' name='date' name='date' value='" + dateText + "'></input>");
		$('#date').change(			
			$.ajax({
					data : { projects : projects , dayDate : dateText },
					url : baseUrl +'/employee-task/find/',
					dataType : 'text',
					success : function(data)
					{			
						$('#aList').empty();
						$('#aList').append(data);
					}
			})
		);				
		$('#list').show();
}*/

function send(dateText, objDatepicker){
	$("#list").GridUnload();
	createGrid(dateText);		
}

function createGrid(dayWeek){

	$('#list').jqGrid({
            pgbuttons:false,
            pginput:false,
            pgtext:false,
		datatype: function(postdata){
			jQuery.ajax({
	            url: baseUrl +'/timetable/get-employees-timetables',
	            dataType:"json",
	            data:{projects : projects , dayDate : dayWeek.beginning},
	            complete: function(jsondata,stat){
	                if(stat=="success") {
	                    var thegrid = jQuery("#list")[0];
	                    var myjson = eval("("+jsondata.responseText+")");
	                    thegrid.addJSONData(myjson);
	                    if(!jQuery.isEmptyObject(myjson)){	                        
	                    }
	                }
	            }
			});
		}, 
		height: "100%",
		colNames:['idTimetable','Empleado', 'Semana', 'Presencia/Ausencia', 'Proyecto', 'Tarea', 'L','M', 'M', 'J', 'V', 'S', 'D', 'Total Hrs', 'Origen'],
		colModel:[
                           {name:'id_timetable',index:'id_timetable',hidden:true},
		           {name:'employee_name',index:'employee_name', width:200},
		           {name:'week',index:'week', width:150},
		           {name:'attendance_label',index:'attendance_label', width:200},
		           {name:'project_code',index:'project_code', width:250},
		           {name:'task_code',index:'task_code', width:250},
		           {name:'monday',index:'m', width:20, align:"center"},
		           {name:'tuesday',index:'tu', width:20, align:"center"},
		           {name:'wednesday',index:'w', width:20, align:"center"},
		           {name:'thursday',index:'th', width:20, align:"center"},
		           {name:'friday',index:'f', width:20, align:"center"},
		           {name:'saturday',index:'sa', width:20, align:"center"},
		           {name:'sunday',index:'su', width:20, align:"center"},
		           {name:'sumHour',index:'sumHour', width:80,align:"center"},
		           {name:'origen',index:'origen', width:60,align:"center"}],
		multiselect: true, 
		pager: '#pager', 
		caption: 'Listado de Tareas'
	});

        $("#list")
    .navGrid('#pager',{
        edit:false,
        add:false,
        del:false,
        search:false,
        refresh:false
    })
    .navButtonAdd('#pager',{
        caption:"Aprobar",
        onClickButton: function(){
            approveTimetables();
        },
        position:"last"
    }).navSeparatorAdd("#pager",{
        sepclass:"ui-separator",
        sepcontent: ''
    })
    .navButtonAdd('#pager',{
        caption:"Rechazar",
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
        caption:"Devolver",
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
        caption:"Transferir a sustituto",
        onClickButton: function(){
        },
        position:"last"
    });
	/*$("#list").jqGrid('navGrid','#pager', 
			{}, //options 
			{height:280,reloadAfterSubmit:false}, // edit options 
			{height:280,reloadAfterSubmit:false}, // add options 
			{reloadAfterSubmit:false}, // del options 
			{} // search options 
		); 
	$('#list')
	.navButtonAdd('#pager',{
        caption:"Aprobar",
        position:"last"
    }).navSeparatorAdd("#pager",{
        sepclass:"ui-separator",
        sepcontent: ''
    })
	.navButtonAdd('#pager',{
        caption:"Rechazar",
        position:"last"
    });*/
}

function approveTimetables(){
    rows=make_json_request(true);
    if(!rows)
        alert("No se han seleccinado horas.");
    else  if(!jQuery.isEmptyObject(rows)){
            $.ajax({
                method:"POST",
                url:"../timetable/approve-timetable",
                dataType:"json",
                data:{rows_db:$.toJSON(rows)},
                success:function(response){
                    if(response.ok){
                        alert("La planilla ha sido aprobada");
                        $("#list").trigger("reloadGrid");
                    }else if(response.error)
                        alert(response.error);
                }
            });
        }else
            alert("Existen errores en las horas seleccionadas.");
}


function make_json_request(count){
    var json_o={};
    var i=0;
    hours=0;
    var ids=$("#list").jqGrid('getGridParam','selarrrow');
    if(ids.length){
        for(i=0;i<ids.length;i++){
            data=$("#list").getRowData (ids[i]);
            json_o[i]=data.id_timetable;
        }
        return json_o;
    }
    else{
        return null;
    }
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