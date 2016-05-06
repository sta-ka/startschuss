function tabs(pages)
{
	[].forEach.call(pages, function(item) {
		item.classList.add('dyn-tabs'); // add class to all tabs
	}, false);

	pages[0].style.display = 'block'; // display first page

	// create ul element and insert it before the first page
	var ul = document.createElement('ul');
	var tabNavigation = document.querySelector('#event').insertBefore(ul, pages[0]);
	
	[].forEach.call(pages, function(page){

			var listElement = document.createElement('li');
			var label = page.getAttribute('data-title');

			listElement.innerHTML = label;

			tabNavigation.appendChild(listElement);

		}, false);
	
	var items = tabNavigation.getElementsByTagName('li');
	items[0].classList.add('current');

	[].forEach.call(items, function(item) {

		item.addEventListener('click', function() {

			[].forEach.call( items, function(item) {
				item.classList.remove('current');

				var index = getIndex(item);
				
				pages[index].style.display = 'none';

			}, false);

			var index = getIndex(item); // get index of node

			item.classList.add('current');
			fadeIn(pages[index]);

		}, false);
	});
    
}

function fadeIn(element) {

	var op = 0;  // initial opacity

	// display element, but set opacity to 0
	element.style.display = 'block';
	element.style.opacity = op;

	var timer = setInterval(function () {

		if (op >= 0.9) {
			clearInterval(timer);
			element.style.display = 'block';
		}

		element.style.opacity = op;
		element.style.filter = 'alpha(opacity=' + op * 100 + ')';
		op += 0.1;

	}, 70);
}

function getIndex(node) {
	
    var i = 0;

    while (node = node.previousSibling) {
        if (node.nodeType === 1) { ++i }
    }

    return i;
}

document.addEventListener('DOMContentLoaded', function() {
	tabs(document.querySelectorAll('div.tabs'));
});
