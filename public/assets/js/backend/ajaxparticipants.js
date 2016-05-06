$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //edit form style - popup or inline
    //$.fn.editable.defaults.mode = 'inline';
    //$('.comment').editable({
    //    type: 'text',
    //    url:'startschuss-karriere.de/organizer/profile/add-comment',
    //    title: 'Edit Status',
    //    placement: 'top',
    //    send:'always',
    //    ajaxOptions: {
    //        dataType: 'json'
    //    }
    //});


	$('#datatable form.add-participant, #datatable form.remove-participant, #datatable form.add-interview-tag, #datatable form.remove-interview-tag').submit(function(e){
		e.preventDefault();

		var form = $(this),
			btn = $(this).find('input'),
			url = $(this).attr('action');

        $.post(url, function(data) {
            var data = JSON.parse(data);

            btn.fadeOut('slow').promise().done(function() {
                btn.prop('value', data.text).fadeIn('slow');
            });

            form.attr('action', data.url);
        });

	});


	$('#datatable form.add-comment').submit(function(e) {
        e.preventDefault();

        var form = $(this).closest('form'),
            url = form.attr('action'),
            formData = form.serialize();

        $.ajax({
            url: url,
            data: formData,
            type: 'POST',
            success: function(data) {
                console.log(form);
                console.log(form.closest('input-group'));
                console.log(form.closest('input-group').find('input'));
                form.find('input').hide();
                form.find('.comment').text(data).fadeIn();
            }
        });
    });

		//var comment = $(this).parent().find('.comment'),
		//	text = comment.text(),
         //   url =
		//	input = $('<div class="input-group"><input class="form-control input-sm" type="text" value="' + text + '" />							<span class="input-group-btn"><button class="btn btn-default btn-sm" type="submit"><span class="glyphicon glyphicon-ok"></span></button></span></div>');
        //
        //
        //
		//$(this).hide();
		//comment.hide().after(input);
	//});
});
