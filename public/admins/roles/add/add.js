$(function (){
	$('.checkbox-wrapper') .on('click',function (){
		$(this).parents('.card').find('.checkbox-childrent').prop('checked', $(this).prop('checked'))
	});
	$('.checkall') .on('click', function () {
		$(this).parents().find('.checkbox-childrent').prop('checked', $(this) . prop('checked'));
		$(this).parents().find('.checkbox-wrapper').prop('checked', $(this) . prop('checked'));
	})
});

