//Hook into ajax request
$(document).ajaxSend(function(event, request, settings) {
	$('#loading-indicator').fadeIn(100);
});

$(document).ajaxComplete(function(event, request, settings) {
	$('#loading-indicator').fadeOut(100);
});

$(document).ready(function(){
	$(".editlink").on("click", function(e){
		e.preventDefault();
		var dataset = $(this).prev(".datainfo");
		var savebtn = $(this).next(".savebtn");
		var theid   = dataset.attr("id");
		var newid   = theid+"-form";
		var currval = dataset.text();

		dataset.empty();

		$('<input type="text" name="'+newid+'" id="'+newid+'" value="'+currval+'" class="hlite">').appendTo(dataset);

		$(this).css("display", "none");
		savebtn.css("display", "block");
	});
	$(".savebtn").on("click", function(e){
		e.preventDefault();
		var elink   = $(this).prev(".editlink");
		var dataset = elink.prev(".datainfo");
		var newid   = dataset.attr("id");

		var cinput  = "#"+newid+"-form";
		var einput  = $(cinput);
		var newval  = einput.attr("value");

		$(this).css("display", "none");
		einput.remove();
		dataset.html(newval);

		elink.css("display", "block");
	});
});

jQuery.fn.reset = function(){
	$(this).each(function(){
		this.reset();
	});
}

function showMessage(data, errDiv){
	messages = $.parseJSON(data);

	$.each(messages, function(index, value){
		strMsg = '<div class="alert alert-danger">' + value + '</div>';
	});

	$(errDiv).empty().append(strMsg);
}

function showSuccessMsg(data, containDiv){
	strMsg = '<div class="alert alert-success">' + data + '</div>';
	$(containDiv).empty().append(strMsg);
}

function showFailMsg(data, containDiv){
	strMsg = '<div class="alert alert-danger">' + data + '</div>';
	$(containDiv).empty().append(strMsg);
}
