(function ($) {
	$.SortableGridView = function (options) {
		var defaultOptions = {
			id: 'sortable-grid-view',
			action: 'sortItem',
			sortingPromptText: 'Loading...',
			sortingFailText: 'Fail to sort',
			csrfTokenName: '',
			csrfToken: '',
		};

		$.extend({}, defaultOptions, options);

		$('body').append('<div class="modal fade" id="' + options.id + '-sorting-modal" tabindex="-1" role="dialog"><div class="modal-dialog"><div class="modal-content"><div class="modal-body">' + options.sortingPromptText + '</div></div></div></div>');

		var regex = /items\[\]\_(\d+)/;

		$('#' + options.id + ' .sortable-grid-view tbody').sortable({
			update : function () {
				// $('#' + options.id + '-sorting-modal').modal('show');
				$('.grid-view').css('pointerEvents', 'none').fadeTo(100, .5);
				serial = $('#' + options.id + ' .sortable-grid-view tbody').sortable('toArray', {attribute:'id'});

				var length = serial.length;
				var currentRecordNo = 0;
				var successRecordNo = 0;
				var data = '';

				if(length > 0){
					for(var i=0; i<length; i++){
						var itemID = regex.exec(serial[i]);
						data = data + 'items[' + i + ']=' + itemID[1] + '&';
						currentRecordNo++;

						if(currentRecordNo == 500 || i == (length-1)){
							data =  data + options.csrfTokenName + '=' + options.csrfToken;

							(function(currentRecordNo){
								$.ajax({
									'url': options.action,
									'type': 'post',
									'data': data,
									success: function(data){
										checkSuccess(currentRecordNo);
									},
									error: function(data){
										// $('#' + options.id + '-sorting-modal').modal('hide');
										$('.grid-view').css('pointerEvents', 'auto').fadeTo(100, 1);
										alert(options.sortingFailText);
									}
								});
							})(currentRecordNo);

							currentRecordNo = 0;
							data = '';
						}
					}
				}

				function checkSuccess(count){
					successRecordNo += count;

					if(successRecordNo >= length){
						// $('#' + options.id + '-sorting-modal').modal('hide');
						$('.grid-view').css('pointerEvents', 'auto').fadeTo(100, 1);
					}
				}
			},
		});
	};
})(jQuery);