Drupal.behaviors.field_title_paragr = {
  attach: function (context, settings) {
	$( "#detach" ).click(function() {
		$( ".field--name-field-video" ).detach();
	});
  }
};

	
//Attach
Drupal.behaviors.newpar = {
  	attach: function (context, settings) {
	$("#attach", context).click(function() {
    	$( ".field--name-field-video", context ).append('<p>Some content for appended</p>');
	});
  }
};