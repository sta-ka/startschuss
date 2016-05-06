function tabs(pages)
{
	pages.addClass('dyn-tabs');
	pages.first().show();
	var tabNavigation = $('<ul id="tabs" />').insertBefore(pages.first());
	
	pages.each(function() {
		var listElement = $('<li />');
		var label = $(this).data('title');
		
		listElement.text(label);
		tabNavigation.append(listElement);
	});
	
	var items = tabNavigation.find('li');
	items.first().addClass('current');
	
	items.on('click', function() {
		items.removeClass('current');
		$(this).addClass('current');
		pages.hide();
		pages.eq($(this).index()).fadeIn();
	});
	
}

$(document).ready(function() {
	tabs($('div.tabs'))
} );