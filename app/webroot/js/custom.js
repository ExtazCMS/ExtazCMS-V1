$(document).ready(function(){
	$('.happy-hour-close').on('click', function(){
		$('.happy-hour').hide();
	});
	var target = $('.server-ip');
    $(target).on('click', function(){
        $("body").append("<input type='text' id='temp' style='position:absolute;opacity:0;'>");
        $("#temp").val($(target).text()).select();
        document.execCommand("copy");
        $("#temp").remove();
        humane.log("<i class='fa fa-check'></i> IP du serveur copiée dans le presse papier !", { timeout: 2000, clickToClose: true, addnCls: 'humane-flatty-success' });
    });
});