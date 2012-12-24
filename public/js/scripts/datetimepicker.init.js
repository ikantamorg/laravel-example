(function($) {

	$(function(){
		$('.use-datetimepicker').datetimepicker({
			dateFormat: 'dd-mm-yy',
			timeFormat: 'h:mm tt',
			ampm: true
		});
	});

	$(function(){
		$('.picktime').timepicker({
			timeFormat: 'h:mm tt',
			ampm: true
		});
	});

	$(function(){
		$('.pickdate').datepicker({
			dateFormat: 'dd-mm-yy',
		});
	});
}) (jQuery);
