// Gallery

$('.image-link').magnificPopup({
	
	type: 'image',
	closeBtnInside: true,
	mainClass: 'mfp-with-zoom mfp-img-mobile',

	gallery: {
	  enabled: false 
	}
  
});

		
$(document).ready(function(){

    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
        }
        else
        {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }
    });
    
    if ($(".filter-button").removeClass("active")) {
		
		$(this).removeClass("active");
		}
		$(this).addClass("active");

});