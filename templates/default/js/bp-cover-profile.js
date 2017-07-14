var $j = jQuery.noConflict();



(function($){
var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");
	$('a[data-modal-id]').click(function(e) {
		e.preventDefault();
		el = $(this);
    $("body").append(appendthis);
    $(".modal-overlay").fadeTo(500, 0.7);
    //$(".js-modalbox").fadeIn(500);
		var modalBox = $(this).attr('data-modal-id');
		$('#'+modalBox).fadeIn($(this).data());		
	});   
$(".js-modal-close, .modal-overlay").click(function() {
    $(".modal-box, .modal-overlay").fadeOut(500, function() {
        $(".modal-overlay").remove();
    }); 
});
 $(window).resize(function() {
    $(".modal-box").css({
        top: ($(window).height() - $(".modal-box").outerHeight()) / 2,
        left: ($(window).width() - $(".modal-box").outerWidth()) / 2
    });
});
 
$(window).resize();


// override standard drag and drop behavior
$("#uploadcover").click(function(){
        $(this).next().trigger('click');
    });
$("#uploadavatar").click(function(){
        $(this).next().trigger('click');
    });
    // show buttons at image rollover
    $('.profile-user-photo-container').mouseover(function() {
        $('#profile-image-upload-buttons').fadeIn("slow");
    })

    // show buttons also at buttons rollover (better: prevent the mouseleave event)
    $('#profile-image-upload-buttons').mouseover(function() {
        $('#profile-image-upload-buttons').fadeIn("slow");
    })

    // hide buttons at image mouse leave
    $('.profile-user-photo-container').mouseleave(function() {
        $('#profile-image-upload-buttons').hide();
    })
	
    // show buttons at image rollover
    $('.panel .panel-profile-header').mouseover(function() {
        $('#banner-image-upload-buttons').fadeIn("slow");
    })
 

    // hide buttons at image mouse leave
    $('.panel .panel-profile-header').mouseleave(function() {
        $('#banner-image-upload-buttons').hide();
    })
	
	
})(jQuery);

