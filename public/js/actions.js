var TimeOut = {
    seconds : 1200,
    initialize : function(){
        setTimeout( this.timeOut ,this.seconds*1000);
    },
    timeOut : function(){
         currentLinkToConfirm = baseUrl+"/auth/logout/";
         var message = "La sesión actual a caducado.\n<br/> ¿Desea iniciar una nueva sesión?";
         return confirm(message,function(){
            window.location.href = currentLinkToConfirm;
         }); 
    }
}

$(document).ready( function()
{
	/**
	 * Botones de Regresar
	 */
	$('.back').click(function(){
		window.history.back();
	});
	
	/**
	 * Crea los Tooltips
	 */
	$('.tip').tooltip({
		showURL: false
	});
	
	$('.code').css({cursor : 'pointer'}).click(function(){ $(this).children('.source').slideToggle() }).children('.source').hide();
	
	resizeWindow();
	$("a.confirm").live('click',function(){
		currentLinkToConfirm = $(this).attr('href');
		var title = $(this).attr('title');
		if(title == '')
		  var message = "¿Está seguro que desea realizar esta acción?";
		else
		  var message = "¿Está seguro que desea\n<br/>"+title+'?';
		return confirm(message,function(){
			window.location.href = currentLinkToConfirm;
		});
	});

	$('input[type="button"]').click(function(){
		if($(this).val() == 'Cancelar'){
			window.history.back();
		}
	});
	
	runDatePickers();
	$(".automaticZipCode").keydown( function(evt){ return automaticZipCode.init(this,evt); });
	$(".automaticFiscalZipCode").keydown( function(evt){ return automaticFiscalZipCode.init(this,evt); });
	$(".automaticCurp").keydown( function(evt){ return automaticCurp.init(this,evt); });
	$('#tabs, #tabEntries').tabs();

    $('div.ok, div.error, div.alert, div.warning, div.notice, div.note').live('click', function(){ 
		$(this).fadeOut('fast',function(){ $(this).remove() }); 
	});

    $("#accordion").accordion({
	    header: "h3",
	    alwaysOpen : false,
	    animated : '',
	    autoHeight : true,
	    fillSpace : true,
	    collapsible: true,
	    active : $('#'+readCookie('accordionMenu')),
	    icons: {
	        header: 'ui-icon-plus',
	        headerSelected: 'ui-icon-minus'
	    },
	    change : function(event, ui){
	        createCookie('accordionMenu',ui.newHeader.attr('id'),30);
	    }
	});
	
    // valida todos los formularios que tengan clase .validate
	$(".validate").validate({
		submitHandler :  function(form){
			if ($(form).hasClass('ajaxForm')) {
				$(form).find('input[type=text]').addClass('ac_loading');
				$(form).ajaxSubmit({
					success: ajaxForm.callback,
					resetForm: true,
					error: ajaxGeneric.errorCallback
				});
			}
			else 
				form.submit();
		}
	});

	$('.inlineEditor').click( function(){
        inlineEditor.init($(this));
        return false;
    });
	TimeOut.initialize();
});

ajaxForm = { callback : function(e)
{
	$('.ac_loading').removeClass('ac_loading');
	var needOdd = $('#ajaxList tr:last-child').hasClass('odd') ? false : true;
	$('#ajaxList').append(e);
	if(needOdd)
		$('#ajaxList tr:last-child').addClass('odd');
}}


ajaxGeneric = { errorCallback : function(e) { $('#contentPanel').prepend('<div class=error>'+e.responseText+'</div>'); }}

$(window).bind('resize', resizeWindow);

function runDatePickers(){ $(".datePicker").datepicker({ changeFirstDay :false ,yearRange :'-80:+5', showAnim :'', dateFormat :'dd-mm-yy',mandatory:true,showMonthAfterYear:true}); }

automaticFill = (function() 
{	
	return{
	    justChange : ['mexicoState','genre'],
	    url : '/address/get-json-by-zip-code',
	    length : 5,
	    currentInstance : null,
	    vacio : {  settlement :'',  district :"",  state :"",  city :"",  country :"" },
	    target : {},
	    init : function(e,evt)
	    {
	    	automaticFill.currentInstance = this;
			if(evt.keyCode == 13)
	        {
				if($(e).val().length == 0)
	              this.responseCallback(this.vacio);
				if($(e).val().length < this.length)
	              return false;
		        $.getJSON(baseUrl + this.url, { value :$(e).val() }, this.responseCallback);
		        return false;
	        }
			return true;
	    },
	    responseCallback : function(object)
	    {
	    	var e = automaticFill.currentInstance;
	    	for(i in e.target){
	    		if(object[i]){
	    			object[e.target[i]] = object[i];
	    			delete object[i];
	    		}
	    	}
	    	for(attr in object){
	    		if($.inArray(attr,automaticFill.justChange ) != -1)
	    			$('#'+attr).val(object[attr]);
	    		else if($.isArray(object[attr]))
	    			automaticFill.fillCombo(attr, object[attr]);
	            else
	            	automaticFill.fillInput(attr, unescape(object[attr]));
	        }
	    },
	    fillCombo : function(object, items)
	    {
	        var newObject = $('<select>');
	        for(i = 0; i < items.length; i++)
	        {
	            newObject.append('<option value="' + unescape(items[i]) + '">' + unescape(items[i]) + '</option>').attr('id', object).attr('name', object);
	        }
	        $('#' + object).replaceWith(newObject);
	    },
	    fillInput : function(object, value)
	    {
	        var readonly = (value != '') ? true : false;
	        if(readonly)
	            $('#' + object).replaceWith($('<input>').attr('id', object).attr('name', object).attr('readonly', 'readonly').val(value));
	        else
	            $('#' + object).replaceWith($('<input>').attr('id', object).attr('name', object).val(value));
	    }
	}
})();
automaticZipCode = automaticFill;
automaticCurp = (function()
{
	parent = jQuery.extend(true, {}, automaticFill);
	parent.url = '/person/get-json-by-curp/';
	parent.lenght = 13;
	parent.vacio = { name : '' , middleName : '', lastName : '' }
	return parent;
})();
automaticFiscalZipCode = (function()
{
	//parent = eval(uneval(automaticFill));
	parent = jQuery.extend(true, {}, automaticFill);
	parent.target = { district : 'fiscalDistrict', settlement : 'fiscalSettlement', city : 'fiscalCity' , mexicoState : 'fiscalMexicoState' }
	return parent;
})();


inlineEditor = (function()
{
    return {
        label :null,
        value :null,
        url :null,
        trigger :null,
        input :null,
        holder :null,
        locked : false,
        init : function(e)
        {
    		if(!this.checkLock()) return false;
            this.trigger = e;
			this.label = e;
            this.value = $('#' + e.attr('id').replace('inlineEditor_', '').replace('Label','') + 'Value');
            this.url = $('#' + e.attr('id').replace('inlineEditor_', '').replace('Label','') + 'URL');
            this.holder = e.parent();
            this.label.hide();
            this.trigger.hide();
            if($('#' + this.value.attr('id') + '_').length == 0)
                $(this.holder).append($('<input>').val(this.value.val()).attr('id', this.value.attr('id') + '_'));
            else
            {
                $('#' + this.value.attr('id') + '_').val(this.value.val());
                $('#' + this.value.attr('id') + '_').show();
            }
            this.input = $('#' + this.value.attr('id') + '_');
            this.input.focus().select().change( function(){ inlineEditor.set()}).blur(function(){ inlineEditor.close() });
            
            $(document).keyup( function(event){
                if(event.keyCode == 27) alert(inlineEditor);
            });
            
        },
        checkLock : function()
        {
        	if(this.locked == true)
        		return false;
        	else
        		this.locked = true;
        	return true;
        },
        set : function()
        {
            $.ajax({
            	type : 'GET',
            	data : { value :this.input.val()},
            	url : this.url.val(),
            	dataType : 'json',
            	success : function(data){
                    inlineEditor.checkResponse(data);
                },
                error : ajaxGeneric.errorCallback
            });
            this.label.text(this.input.val());
            this.value.val(this.input.val());
            this.close();
        },
        close : function ()
        {
            this.label.show();
            this.input.hide();
            this.trigger.show();
            this.locked = false;
        },
        checkResponse : function(data)
        {
            if(data.code != 200)
            {
            	this.label.text(data.newValue);
                $('#contentPanel').prepend('<div class=error>'+data.message+'</div>');
            }else
                this.label.text(data.newValue);
            this.locked = false;
        }
    }
})();
