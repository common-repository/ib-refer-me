$ = (jQuery);
(jQuery)(document).ready(function(){
    (jQuery)('.table').DataTable();
})

$(document).ready(function(){
	$('ul.ib-ref-tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.ib-ref-tabs li').removeClass('current');
		$('.ref-tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})
})

// Copy link script
function withJquery(){
    console.time('time1');
	var temp = $("<input>");
    $("body").append(temp);
    temp.val($('.copy-text').text()).select();
    document.execCommand("copy");
    temp.remove();
    console.timeEnd('time1');
}
function withJqueryCF(){
    console.time('time1');
	var temp = $("<input>");
    $("body").append(temp);
    temp.val($('.copy-text-cf').text()).select();
    document.execCommand("copy");
    temp.remove();
    console.timeEnd('time1');
}