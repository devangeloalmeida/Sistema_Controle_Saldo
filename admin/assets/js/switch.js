// JavaScript Document
$('[id^="btnO"]').click(function() {
    var notchecked = $('input[type="radio"][name="menucolor"]').not(':checked');
    $('.navbar.'+notchecked.val()).toggleClass('navbar-default navbar-inverse');
    notchecked.prop("checked", true);
    $(this).parent().find('a').each(function() {
        if($(this).attr('id') == 'btnOn'){
            $(this).toggleClass('active btn-success btn-default');
        } else {
            $(this).toggleClass('active btn-danger btn-default');
        }
        
    });
    doChange(notchecked);
});

$('input[type="radio"][name="menucolor"]').change(function() {
        doChange(this);
});

function doChange(object){
    if($(object).val() == "navbar-default"){
        $('#btnOn').removeClass('active');
        $('#btnOn .glyphicon-ok').css('opacity','0');
        $('#btnOff .glyphicon-remove').css('opacity','1');
        $('#btnOff').focus();
    }
    if($(object).val() == "navbar-inverse"){
        $('#btnOff').removeClass('active');
        $('#btnOff .glyphicon-remove').css('opacity','0');
        $('#btnOn .glyphicon-ok').css('opacity','1');
        $('#btnOn').focus();
    }
}