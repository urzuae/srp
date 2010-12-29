var noHolidays = no_holidays;
var holidays = holidays_j;
var idEmployee = idEmployee;
$(document).ready(function(){
	enable_saturdays=true;
    enable_sundays=false;
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    createCalendar();
});



function prueba(dateText, objDatepicker){
	confirm ("¿Deseas invertir el estado de la fecha? " + dateText, function(){
		$("#mensaje").html("<input type='hidden' name='modifyDate' name='modifyDate' name='modifyDate' value='" + dateText + "'></input>");
		$('#modifyDate').change(
			$.ajax({
					data : { idEmployee : idEmployee , dayDate : dateText },
					url : baseUrl +'/calendar-day/modify/',
					dataType:"json",
					success:function(response){
						noHolidays=response.noHolidays;
						holidays=response.holidays;
						$("#datepicker").datepicker("destroy");
						createCalendar();
					}
			})
		);
		
	});	
}


function isNoHoliday(dayDate){
    dayDate=new Date(dayDate);
    var day=dayDate.getDate();
    var month=dayDate.getMonth()+1;
    var year=dayDate.getFullYear();
    var result=false;
    if(noHolidays[year] != undefined && noHolidays[year][month] != undefined){
        $.each(noHolidays[year][month], function(i, val){
            if(val==day){
                result=true;
                return false;
            }
        });
    }
    return result;
}


function isHoliday(dayDate){
    dayDate=new Date(dayDate);
    var day=dayDate.getDate();
    var month=dayDate.getMonth()+1;
    var year=dayDate.getFullYear();
    var result=false;
    if(holidays[year] != undefined && holidays[year][month] != undefined){
        $.each(holidays[year][month], function(i, val){
            if(val==day){
                result=true;
                return false;
            }
        });
    }
    return result;
}

function lastDayOfMonth(Year, Month)
{
    return(new Date((new Date(Year, Month,1))-1)).getDate();
}

function createCalendar(){
	$( "#datepicker" ).datepicker({
        numberOfMonths: 2,
        beforeShowDay: disableTheseDays,
        onSelect: prueba
    });
    $( "#datepicker" ).datepicker( "option",$.datepicker.regional[ "es" ] );
}

function disableTheseDays(date) {
    var m = date.getMonth(), d = date.getDay(), y = date.getFullYear();
    	if(isNoHoliday(date)) {
    		return [true,"ui-state-active-noholiday"];
    	}else if(isHoliday(date)) {
    		return [true,"blocked"];
        }else if(!enable_sundays && d==0){
            return [true, "blocked"];
        }else if(!enable_saturdays && d==6)
            return [true, "ui-state-active-holiday"];
    return [true];
}