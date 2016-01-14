


$(document).ready(function() {
		$('#switcher h3').hover(function(){
		$(this).addClass('hover');
	}, function(){
		$(this).removeClass('hover');
	});
		var toggleSwitcher=function(event){
			if(!$(event.target).is('button')){
				$('#switcher button').toggleClass('hidden');
		}
	};
	$('#switcher').bind('click',toggleSwitcher);

	$('#switcher').click();

	var setBodyClass=function(className){
		$('body').removeClass().addClass(className);

		$('#switcher button').removeClass('selected');
		$('#switcher-' + className).addClass('selected');

		$('#switcher').unbind('click', toggleSwitcher);
		if(className=='default'){
			$('#switcher').bind('click',toggleSwitcher);
		}
	};

	$('#switcher-default').addClass('selected');


	var triggers={
		D: 'default',
		N: 'narrow',
		L: 'large',
		R: 'red'
	};

	$('#switcher').click(function(event){
		if($(event.target).is('button')){
		var bodyClass=event.target.id.split('-')[1];
		setBodyClass(bodyClass);
	}
});
	$(document).keyup(function(event){
		var key=String.fromCharCode(event.keyCode);
		if(key in triggers){
			setBodyClass(triggers[key]);
		}
	});
});

