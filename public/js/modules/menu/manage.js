$(document).ready( function()
{
	
	$('.child').hide();
	$('.parentMenu').click(function(){
	    $('.childOf'+($(this).attr('id').replace('parent_',''))).toggle();
	}).css({ cursor : 'pointer' });
	$('.moveItem').click(createFromList).css({ cursor : 'pointer' });
	$('#name').keydown(sendNewItem);
	$('.ajaxedLink').live('click',removeItem);
	$('.liveName').live('keydown',addName);
	countParents();
});





var countParents = function(){
  $('.parentMenu').each(function(){
    $(this).parent().next().next().text('('+$('.childOf'+$(this).attr('id').replace('parent_','')).length+')');
  });
}

var removeItem = function(){
	var tmp = $(this).parent();
	tmp.addClass('ac_loading');
	$.ajax({
		url : $(this).attr('href'),
		success : function(){
			tmp.remove();
		}
	});
	return false;
}

var sendNewItem = function(e){
	if(e.keyCode == 13){
		
		SelectedParentValue = $("input[@name='parentRadio']:checked").val();
		if(!SelectedParentValue)
		{
		    $('.error').remove();
			$('#menuPreview').effect("highlight", {}, 500).append('<div class=error>Seleccione un item</div>');
			return false;
		}		
		$('#name').addClass('ac_loading');
		var theData = (SelectedParentValue > 0) ? { name : $('#name').val(), idParent : SelectedParentValue } : { name : $('#name').val() } ; 
		$.ajax({
			data : theData,
		    url : baseUrl +'/menu/add-entry/',
		    dataType : 'json',
		    success : function(e){
				if(SelectedParentValue > 0)
					$('#childs_'+SelectedParentValue).append(getNewItem(e.id,$('#name').val()));
				else
					$('#menuPreview').append(getNewItem(e.id,$('#name').val()));
				
				$('#name').removeClass('ac_loading').val('').focus();
			}
		});
	}
} 

var addName = function(e){
	if(e.keyCode == 13){
		var tmp = $(this);
		var tmpName = $(this).val();
		tmp.addClass('ac_loading');
		$.ajax({
			data : { name : tmpName, idAction : SelectedAction , idParent : SelectedParentValue },
		    url : baseUrl +'/menu/add-entry/',
		    dataType : 'json',
		    success : function(e){
				  $('#childs_'+SelectedParentValue).append(getNewItem(e.id,tmpName));
				  tmp.parent().parent().remove();
				  countParents();
			}
		});
	}
}

var createFromList = function(){
	
	SelectedParentValue = $("input[@name='parentRadio']:checked").val();
	if(!SelectedParentValue)
	{
	    $('.error').remove();
		$('#menuPreview').effect("highlight", {}, 500).append('<div class=error>Seleccione un item</div>');
		return false;
	}
	$(this).parent().append('<input type=text class=liveName>');
	SelectedAction = $(this).attr('id').replace('add_child_','');
}

var SelectedParentValue = 0;
var SelectedAction = 0;

var getNewItem = function(id,txt)
{
	return $('<li id=item_'+id+'>').append('<input type=radio name=parentRadio id=rd_'+id+' value='+id+'>').append($('<a href="'+baseUrl+'/menu/remove-entry/id/'+id+'">').addClass('ajaxedLink').append('<img src="'+baseUrl+'/images/template/icons/cross.png">')).append(txt)
}
