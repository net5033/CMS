$(document).ready(function(){

var $text=$('div.container');
var defaultSize=$text.css('fontSize');
$('#fbuttons button').click(function(){
	var num=parseFloat($text.css('fontSize'));
	switch(this.id){
		case 'fbuttons-big':
		if(num<50){
			num*=1.4
		}
		break;
		case 'fbuttons-small':
		if(num>3){
			num/=1.4;
		}
		break;
		default:
		num=parseFloat(defaultSize);
	}
	$text.animate({fontSize: num+'px'}, 'slow');

});

function get_random_color() {
    	var letters = '0123456789ABCDEF'.split('');
    	var color = '#';
    	for (var i = 0; i < 6; i++ ) {
        color += letters[Math.round(Math.random() * 15)];
    	}
    	return color;
    	}

var $sec1=$('#s2-p2');
$('#changer1 button').click(function(){
	switch(this.id){
		case 'changer1-bold':
		$sec1.addClass('bold');
		break;
		case 'changer1-bgcol':
    	$sec1.css('background-color', get_random_color());
    	break;
    	default:
    	$sec1.removeClass('bold');
    	$sec1.css('background-color', '#FFFFFF');

		}
	});

var $sec2=$('#s2-p3');
$('#changer2 button').click(function(){
	switch(this.id){
		case 'changer2-bold':
		$sec2.addClass('bold');
		break;
		case 'changer2-bgcol':
    	$sec2.css('background-color', get_random_color());
    	break;
    	default:
    	$sec2.removeClass('bold');
    	$sec2.css('background-color', '#FFFFFF');

		}
	});

var $sec3=$('#s2-p4');
$('#changer3 button').click(function(){
	switch(this.id){
		case 'changer3-bold':
		$sec3.addClass('bold');
		break;
		case 'changer3-bgcol':
    	$sec3.css('background-color', get_random_color());
    	break;
    	default:
    	$sec3.removeClass('bold');
    	$sec3.css('background-color', '#FFFFFF');

		}
	});

var $sec4=$('#s2-p5');
$('#changer4 button').click(function(){
	switch(this.id){
		case 'changer4-bold':
		$sec4.addClass('bold');
		break;
		case 'changer4-bgcol':
    	$sec4.css('background-color', get_random_color());
    	break;
    	default:
    	$sec4.removeClass('bold');
    	$sec4.css('background-color', '#FFFFFF');

		}
	});

$('div.section-2 a[href*="wiki"]').attr({
	rel:'external',
	title: function(){
		return 'Learn more about ' + $(this).text() + ' at Wikipedia.';
	},
	id:function(index, oldValue){
		return 'wikilink-' + index;
	}
});

$('<a href="#top">Back To Top</a><br/><br/>').appendTo('div.subheading');
	$('<a id="top"></a>').prependTo('body');

$('span.pull-quote').each(function(index){
		var $parentParagraph=$(this).closest('p');
		$parentParagraph.css('position', 'relative');
		var $clonedCopy=$(this).clone();
		$clonedCopy
		.addClass('pulled')
		.find('span.drop')
		.html('&hellip;')
		.end()
		.text($clonedCopy.text())
		.insertBefore($parentParagraph)
		.addClass('rounded-top')
		.wrapInner('<div class="rounded-bottom"></div>')


	});

$('a.footnote').each(function(index){
		$(this)
		.after([
			'<a href="#footnote-',
			index+1,
			'" id="context-',
			index+1,
			'" class="context">',
			'<sup>',
			index+1,
			'</sup></a>'
			].join(''));
		
		 var $link=$(this).attr('href');
	
		$('#footer ol').append('<a href="' + $link + '"><li id="footnote-' + (index+1) +'">' + $link + '</li></a>');
	
	});

var $firstSection=$('div.subheading').eq(1);
var $secondSection=$('div.subheading').eq(3);
$firstSection.hide();
$secondSection.hide();
$('a.more').click(function(){
	if($firstSection.is(':hidden')){
	$firstSection.fadeIn('slow');
	$(this).text('Hide Section');
}
else{
	$firstSection.fadeOut('slow');
	$(this).text('Show Section');
}
return false;
});
$('a.more1').click(function(){
	if($secondSection.is(':hidden')){
	$secondSection.fadeIn('slow');
	$(this).text('Hide Section');
}
else{
	$secondSection.fadeOut('slow');
	$(this).text('Show Section');
}
return false;
});

});

