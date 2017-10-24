function bfAlert(msg, title) { 

	var title = (typeof title === 'undefined') ? "Message" : title; 
	
	jQuery("#bf_error_dialog").html(msg); 
	jQuery( "#bf_error_dialog" ).dialog(
	{ modal: true, 
	  buttons: [{  text: 'OK', click: function() { jQuery( this ).dialog( "close" ); } }], 
      dialogClass: 'boxful-dialog',
      resizable: false,
      minHeight: 0,
      //open: function(){jQuery('.ui-widget-overlay').bind('click',function(){jQuery('#bf_error_dialog').dialog('close');})},
      open: function(event, ui) {jQuery("body").css({ overflow: 'hidden' });jQuery('body').bind('touchmove', function(e){e.preventDefault()});},
	  close: function(event, ui) {jQuery("body").css({ overflow: 'inherit' });jQuery('body').unbind('touchmove');},
      width: 400
	});
} 

function bfBlock(msg, title) { 

	var title = (typeof title === 'undefined') ? "Message" : title; 
	
	jQuery("#bf_error_dialog").html(msg); 
	jQuery( "#bf_error_dialog" ).dialog(
	{ modal: true,
	  buttons: [{  text: 'BACK', click: function() { window.history.back(); } }], 
	  dialogClass: 'boxful-dialog boxful-block',
	  resizable: false,
	  open: function(event, ui) {jQuery("body").css({ overflow: 'hidden' });jQuery('body').bind('touchmove', function(e){e.preventDefault()});},
	  close: function(event, ui) {jQuery("body").css({ overflow: 'inherit' });jQuery('body').unbind('touchmove');},
	  title: title,
	  closeOnEscape: false	  
	});
} 

function checkAvailableDate(date, template, location){
	var string = jQuery.datepicker.formatDate('yy-mm-dd', date);

	if(template == 0){
		if( dayoffs.indexOf(string) != -1 ){
			return [false];
		}else if( tsFullDates.indexOf(string) != -1 ){
			return [false, 'full'];
		}
	}else if(template == 7){
		if( dayoffsXL.indexOf(string) != -1 ){
			return [false];
		}else if( tsFullDatesXL.indexOf(string) != -1 ){
			return [false, 'full'];
		}else if( overSqftLimitDate.indexOf(string) != -1 ){
			return [false, 'full'];
		}
	}

	if(location == "TC"){
		return [date.getDay() != 0 && date.getDay() != 1 && date.getDay() != 3 && date.getDay() != 5];
	}else{
		return [true];
	}
}



