var noHolidays = no_holidays;
var holidays = holidays_j;
$(document).ready(function(){
	enable_saturdays=true;
    enable_sundays=false;
    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();

    $( "#datepicker" ).datepicker({
        numberOfMonths: 2,
        //maxDate:0,
        beforeShowDay: disableTheseDays
    });
    $( "#datepicker" ).datepicker( "option",$.datepicker.regional[ "es" ] );

});


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

function disableTheseDays(date) {
    var m = date.getMonth(), d = date.getDay(), y = date.getFullYear();
    	if(isNoHoliday(date)) {
    		return [true,"ui-state-active-noholiday"];
    	}else if(isHoliday(date)) {
    		return [true,"blocked"];
        }else if(!enable_sundays && d==0){
            return [true, "blocked"];
        }else if(!enable_saturdays && d==6)
            return [true, "odd"];
    return [true];
}
