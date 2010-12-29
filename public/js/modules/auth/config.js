$(document).ready( function()
{
	$('.ajaxed').click(checkBoxChange).change(checkBoxChange);
	$('.masterChecker').click(function(){
		$('.childOf'+$(this).attr('id').replace('parent_','')+'ar').attr('checked','checked').change();
	}).css('cursor','pointer');
	$('.masterUnchecker').click(function(){
		$('.childOf'+$(this).attr('id').replace('parent_','')+'ar:checked').removeAttr('checked').change();
	}).css('cursor','pointer');
	
	$('#progressbar').progressbar({ value : 59 });
	
});

checkBoxChange = function(){
	var newValue = this.checked ? 1 : 0;
	var parts = $(this).attr('id').split('_'); 
	$.ajax({
		data : { value : newValue, idAccessRole : parts[2] , idAction : parts[1] },
	    url : baseUrl +'/auth/set-permission/'
	});
}