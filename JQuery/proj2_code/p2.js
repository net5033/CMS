$(document).ready(function(){
	$('#ex_list a').attr({
		rel: 'external',
		title: function(){
			return 'Learn more about ' + $(this).text() + ' at Wikipedia.';
		},
		id: function(index, oldValue){
			return 'wikilink-' + index;
		}
	});

	$('<a href="#top">Back To Top</a><br/><br/>').appendTo('div.info');
	$('<a id="top"></a>').prependTo('body');




	
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

	

});