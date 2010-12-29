var daysStatus2 = days_status_2;
var daysStatus3 = days_status_3;
var daysStatus4 = days_status_4;
var daysStatus1 = days_status_1;
var projects = projects;
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
        onSelect: send
    });
    $( "#datepicker" ).datepicker( "option",$.datepicker.regional[ "es" ] );
    $('#list').hide();
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
	//alert("hola");
	createGrid(dateText);		
}

function createGrid(dateText){
	$('#list').jqGrid({ 
		datatype: function(postdata){
			jQuery.ajax({
	            url: baseUrl +'/employee-task/find/',
	            dataType:"json",
	            data:{projects : projects , dayDate : dateText},
	            complete: function(jsondata,stat){
	                if(stat=="success") {
	                    var thegrid = jQuery("#list")[0];
	                    var rows = eval("("+jsondata.responseText+")");
	                    //alert(JSON.stringify(myjson));
	                    if(!jQuery.isEmptyObject(rows)){
	                    	alert(JSON.stringify(rows));
	                        thegrid.addJSONData(rows);
	                    }
	                }
	            }
			});
		}, 
		height: "100%", 
		viewrecords: true, 
		colNames:['Empleado','Semana', 'Proyecto', 'L','M', 'M', 'J', 'V', 'S', 'D', 'Total Hrs'], 
		colModel:[ 
		           {name:'employeeName',index:'employeeName', width:90}, 
		           {name:'week',index:'week', width:100}, 
		           {name:'projectName',index:'projectName', width:80}, 
		           {name:'m',index:'m', width:20, align:"center"}, 
		           {name:'tu',index:'tu', width:20, align:"center"},
		           {name:'w',index:'w', width:20, align:"center"},
		           {name:'th',index:'th', width:20, align:"center"},
		           {name:'f',index:'f', width:20, align:"center"},
		           {name:'sa',index:'sa', width:20, align:"center"},
		           {name:'su',index:'su', width:20, align:"center"},
		           {name:'sumHour',index:'sumHour', width:80,align:"center"}], 
		multiselect: true, 
		pager: '#pager', 
		caption: 'Semana' 
	});
}