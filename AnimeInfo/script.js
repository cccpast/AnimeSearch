(function() {
	
  'use strict';
  
	$(function() {
	  $('form').submit(function() {
	    $(this).find('#btn').attr('disabled', 'disabled').val('検索中');
	  });
	});

})();