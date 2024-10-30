$ = (jQuery);
$(document).ready(function(){
    // Ajax code for Referral Form
    $('#Referral_form').on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: "POST",
            // url: window.location.origin+'/wp-admin/admin-ajax.php',
            url: ajax_object.ajaxurl,
            data:{
                action: "ib_action",
                name: $("input[name=name]").val(),
                email: $("input[name=email]").val()
            },
            success: function(response){
                // Popup script in referral form
                $('#popup-referral').show();
                e.preventDefault();
                
                $('#popup-referral .modal-body').text("You already have a referral link. Here is your referral link: ");
                $('#popup-referral .modal-body').append('<a href="'+response+'" class="referral-link" target="_blank">'+response+'</a>');
                
                var appendthis = ("<div class='modal-overlay js-modal-close'></div>");
        		$("body").append(appendthis);
        		$(".modal-overlay").fadeTo(500, 0.7);
        		var modalBox = $(this).attr('data-modal-id');
        		$("#" + modalBox).fadeIn($(this).data());
                
                // Popup close script		
            	$(".js-modal-close, .modal-overlay").click(function() {
            		$(".modal-box, .modal-overlay").fadeOut(500, function() {
            			$(".modal-overlay").remove();
            		});
            	});
            	
            	// Popup box resizing script
            	$(window).resize(function() {
            		$(".modal-box").css({
            			top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
            			left: ($(window).width() - $(".modal-box").outerWidth()) / 2
            		});
            	});
            	$(window).resize();
            }
        });
    });
    
    // Ajax code for Contact Form
    $('#ib-ref-form').on('submit', function(e){
        e.preventDefault();
        
        var valid;
		valid = validateContact();
		if (valid) {
            $.ajax({
                type: "POST",
                url: ajax_object.ajaxurl,
                data:{
                    action: "ib_contact_action",
                    name: $("input[name=name]").val(),
                    email: $("input[name=email]").val(),
                    subject: $("input[name=subject]").val(),
                    message: $("textarea[name=message]").val(),
                    referral_id: $("input[name=referral_id]").val()
                },
                success: function(response){
                    console.log(response);
                    $("#mail-status").html(response);
                }
            });
		}
    });
    
});

// Validation of Contact Form
function validateContact() {
	var valid = true;
	$(".demoInputBox").css('background-color', '');
	$(".info").html('');

	if (!$("#name").val()) {
		$("#name-info").html("Name is required");
		$("#name").css('background-color', '#FFFFDF');
		valid = false;
	}
	if (!$("#email").val()) {
		$("#email-info").html("Email is required");
		$("#email").css('background-color', '#FFFFDF');
		valid = false;
	}
	if (!$("#email").val().match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/)) {
		$("#email-info").html("Email is invalid");
		$("#email").css('background-color', '#FFFFDF');
		valid = false;
	}
	if (!$("#subject").val()) {
		$("#subject-info").html("Subject is required");
		$("#subject").css('background-color', '#FFFFDF');
		valid = false;
	}
	if (!$("#message").val()) {
		$("#message-info").html("Message is required");
		$("#message").css('background-color', '#FFFFDF');
		valid = false;
	}

	return valid;
}

// Copy link script
function withJquery(){
    console.time('time1');
	var temp = $("<input>");
    $("body").append(temp);
    temp.val($('.referral-link').text()).select();
    document.execCommand("copy");
    temp.remove();
    console.timeEnd('time1');
}

// Link updating After form submission
const myTimeoutRF = setTimeout(myReferrerRF, 15000);
function myReferrerRF() {
    var x=document.URL; 
    if(x.includes("?referral_id")){
        window.history.pushState("object or string", "Title", window.location.href.split("?")[0]);
    }
}

