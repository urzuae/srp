/**
 * Lanza un dialogo con botones de Si y No.
 * @param {String} message
 * @param {Function} callback
 */
//function confirm(message, callback)
//{
//	$('#confirm').modal({
//		close:false,
//		position: ["20%",],
//		overlayId:'confirmModalOverlay',
//		containerId:'confirmModalContainer',
//		onShow: function (dialog) {
//			dialog.data.find('.message').append(message);
//			dialog.data.find('.yes').click(function () {
//				if ($.isFunction(callback)) {
//					callback.apply();
//				}
//				$.modal.close();
//			});
//		}
//	});
//	return false;
//}
var currentLinkToConfirm = '';


/**
 * Lanza un dialogo con botones de Si y No.
 * @param {String} message
 * @param {Function} callback
 */
//function alert(message)
//{
//	$('#dialog').modal({
//		close:false,
//		position: ["20%",],
//		overlayId:'dialogModalOverlay',
//		containerId:'dialogModalContainer',
//		onShow: function (dialog) {
//			dialog.data.find('.message').append(message);
//
//			dialog.data.find('.yes').click(function () {
//				$.modal.close();
//			});
//		}
//	});
//	return false;
//}
/*function alert(message)
{	
	$('#dialog').modal({
		close:false,
		position: ["20%",],
		overlayId:'dialogModalOverlay',
		containerId:'dialogModalContainer', 
		onShow: function (dialog) {
			dialog.data.find('.message').append(message);
			
			dialog.data.find('.yes').click(function () {
				$.modal.close();
			});
		}
	});
	return false;
}*/
var currentLinkToConfirm = '';

Date.prototype.getWeek = function() {
    var onejan = new Date(this.getFullYear(),0,1);
    return Math.ceil((((this - onejan) / 86400000) + onejan.getDay()+1)/7);
}

function moneyFormat(howmuch)
{
  var money = howmuch;
  var money2, sign;
  if (money == "" || money == undefined) return "$ 0.00";
  //-$ 555,555,555.55 kitar formato
  money = money.replace(/\$/g, "");
  money = money.replace(/ /g, "");
  money = money.replace(/,/g, "");
  money = money.replace(/[A-Z,a-z]/g, "");
  //-5555555.5555555 recibimos así
  if (money.charAt(0) == "-") //es negativo
  {
    money = money.substr(1); //kitar el signo
    sign = "-";
  }
  else
  sign = "";
  if (money.indexOf(".") >= 0) //tiene decimales
  {
    moneyDec = "" + (Math.round(parseFloat(money.substr(money.indexOf(".")))*100)/100); //redondear
    moneyDec = moneyDec.substr(1); //kitar el 0 inicial de 0.12
    if (moneyDec.length == 2) moneyDec += "0"; //le falta un 0
  }
  else
  {
    moneyDec = ".00";
  }
  var moneyInt;
  if (money.indexOf(".") == -1)
  moneyInt = money; //si no tiene decimales es un entero
  else
  moneyInt = money.substr(0, money.indexOf(".")); //espaciar enteros solamente
  var i = moneyInt.length; //empezar al final
  var moneyCommas = "";
  var comma = "";
  while (1)
  {
    //contar 3 para atras
    if (i - 3 >= 0)
    ss = moneyInt.substr(i - 3, 3);
    else
    ss = moneyInt.substr(0, i); //si es igual a 2 entonces desde el principio tomar 2
    moneyCommas = ss + comma + moneyCommas;
    i = i - 3;
    if (comma == "") comma = ","; //la primera vuelta no necesita comma
    if (i == 0 ) comma = ""; //si es el ultimo no necesita comma
    if (i < 0) break; //ya se paso
  }
  money2 = moneyCommas + moneyDec;
  money2 = sign + "$ " + money2;
  return money2;
}

function removeMoneyFormat(howmuch)
{
	//eliminar espacios, comas y simbolos de pesos
	var money = howmuch;
	money = money.replace(/\$/g, "");
    money = money.replace(/ /g, "");
    money = money.replace(/,/g, "");
    money = money.replace(/[A-Z,a-z]/g, "");
	
	return money;
}

function roundNumber(f, dec){
	return Math.round(f*Math.pow(10,dec))/Math.pow(10,dec)
}

/**
 * Funciones para las cookies
 */
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}


function resizeWindow()
{
	var windowHeight = getWindowHeight();	
	$("#content").get(0).style.height = (windowHeight -50) + "px";
	$("#contentPanel").get(0).style.height = (windowHeight - 116) + "px";
	if( windowHeight < 600  ){
	   $('html').css({overflow: 'auto'});
	}else{
	   $('html').css({overflow: 'hidden'});
	}
}

function getWindowHeight()
{
	var windowHeight=0;
	if (typeof(window.innerHeight)=='number') 
	{
		windowHeight = window.innerHeight;
	}else 
	{
		if (document.documentElement && document.documentElement.clientHeight) 
		{
			windowHeight = document.documentElement.clientHeight;
		}else 
		{
			if (document.body && document.body.clientHeight) 
			{
				windowHeight = document.body.clientHeight;
			}
		}
	}
	return windowHeight;
}

/**
 * Funcion que verifica que sea un rango de fechas
 * @param {String} dateStrIni
 * @param {String} dateStrEnd
 * @return boolean
 */
function isRange(dateStrIni, dateStrEnd)  
{  
	if(dateStrIni && dateStrEnd)
	{
		var date_end = dateStrEnd.split('-');    
		var xDay=date_end[2];  
		var xMonth= date_end[1];
		var xYear=date_end[0];

		var date_ini = dateStrIni.split('-');  
		var yDay=date_ini[2];  
		var yMonth= date_ini[1];
		var yYear=date_ini[0];
    
		if (xYear> yYear)  
		{  
			return true;  
		}  
		else  
		{  
			if (xYear == yYear)  
			{   
				if (xMonth> yMonth)  
				{  
					return true; 
				}  
				else  
				{   
					if (xMonth == yMonth)  
					{  
						if (xDay> yDay)  
							return true;   
						else  
							return false;  
					}  
					else  
						return false;  
				}  
			}  
			else  
				return false;  
		}
	}
} 


/**
 * Funcion que verifica que sea un rango de horas
 * @param {String} timeStrIni
 * @param {String} timeStrEnd
 * @return boolean
 */
function isRangeTime(timeStrIni, timeStrEnd)  
{  
	if(timeStrIni && timeStrEnd)
	{  
		var time_ini = timeStrIni.split(':');    
		var xMinute = parseInt(time_ini[1]);
		var xHour =  parseInt(time_ini[0]);
	
		var time_end = timeStrEnd.split(':');  
		var yMinute =  parseInt(time_end[1]);
		var yHour =  parseInt(time_end[0]);

	
		if (xHour > yHour)  
		{  
			return false;  
		}  
		else 
		{  
		    if (xHour == yHour)
			{
				if (xMinute >= yMinute)  
				{  
					return false; 
				}  
				else  
				{    
					return true;  
				}
			} 
			else
			{
				return true;
			}
		}    
		
	}
} 


