$(document).ready(function(){
$('div.poem-stanza').addClass('highlight');



$('#switcher button').click(function(){
	switch(this.id){
		case 'switcher-chng':
		$('#fred').removeClass('wd');
		$('.poem-stanza').removeClass('aRed');
		$('body').addClass('chng');
		break;
		case 'switcher-wd':
		$('#fred').addClass('wd');
		$('body').removeClass('chng');
		$('.poem-stanza').removeClass('aRed');
		break;
		case 'switcher-aRed':
		$('.poem-stanza').addClass('aRed');
		$('body').removeClass('chng');
		$('#fred').removeClass('wd');
		break;
		case 'switcher-default':
		$('body').removeClass('chng');
		$('#fred').removeClass('wd');
		$('.poem-stanza').removeClass('aRed');
		break;

	}
});




$('#switcher_aRed').hover(function(){
	$(this).addClass('hoverClass');
}, function(){
	$(this).removeClass('hoverClass');
});

$('a[href$=".pdf"]').addClass('picLink');



var $firstStanza=$('div.poem-stanza').eq(0);
var $secondStanza=$('div.poem-stanza').eq(1);
$firstStanza.hide();
$secondStanza.hide();
$('a.more').click(function(){
	if($firstStanza.is(':hidden')){
		$firstStanza.fadeIn('slow');
		$(this).text('hide stanza');
	}
	else{
		$firstStanza.fadeOut('slow');
		$(this).text('show stanza');
	}
	return false;
});
$('a.more2').click(function(){
	if($secondStanza.is(':hidden')){
		$secondStanza.fadeIn('slow');
		$(this).text('hide stanza');
	}
	else{
		$secondStanza.fadeOut('slow');
		$(this).text('show stanza');
	}
	return false;
});








});