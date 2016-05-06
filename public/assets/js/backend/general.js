$(document).ready(function() {

	tinymce.init({
		language : "de", // change language here
		mode : "exact",
		elements : "profile, program, body, description, requirements",
		theme : "modern",
		menubar : false,
		statusbar : false,
		toolbar: "undo redo | styleselect | bold italic underline | bullist numlist",
		style_formats:[
		{
			title: "Headers",
			items: [
				{title: "Header 1", format: "h3"},
				{title: "Header 2", format: "h4"}
			]
		}],
		extended_valid_elements : "-p", 
	});

	$('a[href*="delete"]').on('click', function(){
		var answer = confirm('Ausgewählten Datensatz löschen?')

		return answer;
	})

	// hide upload area
	$('#logo, #image, #photo').hide();

    $('#browse-file').on('click', function () {
        $('#logo, #image, #photo').click();

        return false;
    });

	$('#logo, #image, #photo').change(function() {
		var filename = $('#logo, #image, #photo').val().split('\\').pop();
		
		$('#filename').html('Ausgewählte Datei: ' + '<i>' + filename + '</i>');
	});    
} );