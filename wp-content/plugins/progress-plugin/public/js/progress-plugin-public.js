(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	
	$ = jQuery;


	$(document).ready(function(){
		$('.twt_btn').click(function(){
			var element = $(this);
			element.prop('disabled', true);
			var per = $(this).attr('data-percentage');
			var width = ($('.twt_bar').width() / $('.twt_progress').width()) * 100;
			var plus = parseFloat(per) + parseFloat(width);
			if (plus > 100){
				plus = 100;
			}
			$('.twt_bar').css('width', plus+'%');
			if($('.twt_bar').length < 1){
				plus = (100 / 7);
			}
			$('input[name="twt_progress"]').val(plus);
			var id = $(this).attr('id');
			var progress = $('input[name="twt_progress"]').val();
			var ajax_url = $('#ajax_url').val();
			$.ajax({
				type : "get",
				url :  ajax_url,
				data : {id:id, progress:progress, action:'progress_ajax_call_action'},
				success:function(response){
					var response_array = JSON.parse(response);
					var status = response_array['status'];
					var progress = response_array['progress'];
					element.prop('disabled', status);
					$('input[name="twt_progress"]').val(response_array['progress']);
				},
				error:function(err){

				}

			})
		})
		

	})

})( jQuery );
