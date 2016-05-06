jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	"date-eu-pre": function ( date ) {
		date = date.replace(" ", "");
		var eu_date, year;
		 
		if (date == '') {
			return 0;
		}
 
		if (date.indexOf('.') > 0) {
			/*date a, format dd.mn.(yyyy) ; (year is optional)*/
			eu_date = date.split('.');
		} else {
			/*date a, format dd/mn/(yyyy) ; (year is optional)*/
			eu_date = date.split('/');
		}
 
		/*year (optional)*/
		if (eu_date[2]) {
			year = eu_date[2];
		} else {
			year = 0;
		}
 
		/*month*/
		var month = eu_date[1];
		if (month.length == 1) {
			month = 0+month;
		}
 
		/*day*/
		var day = eu_date[0];
		if (day.length == 1) {
			day = 0+day;
		}
 
		return (year + month + day) * 1;
	},
 
	"date-eu-asc": function ( a, b ) {
		return ((a < b) ? -1 : ((a > b) ? 1 : 0));
	},
 
	"date-eu-desc": function ( a, b ) {
		return ((a < b) ? 1 : ((a > b) ? -1 : 0));
	}
} );

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	"date-euro-pre": function ( a ) {
		if ($.trim(a) != '') {
			var frDatea = $.trim(a).split(' ');
			var frTimea = frDatea[1].split(':');
			var frDatea2 = frDatea[0].split('.');
			var x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + frTimea[0] + frTimea[1] + frTimea[2]) * 1;
		} else {
			var x = 10000000000000; // = l'an 1000 ...
		}
		 
		return x;
	},
 
	"date-euro-asc": function ( a, b ) {
		return a - b;
	},
 
	"date-euro-desc": function ( a, b ) {
		return b - a;
	}
} );

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	"date-euro-short-pre": function ( a ) {

		// tidy up date
		a = a.replace("Uhr", "").replace("-", "").replace(" ", "");
		a = a.trim();
		a = a.concat(":00");

		if ($.trim(a) != '') {
			var frDatea = $.trim(a).split(' ');
			var frTimea = frDatea[1].split(':');
			var frDatea2 = frDatea[0].split('.');
			var x = (frDatea2[2] + frDatea2[1] + frDatea2[0] + frTimea[0] + frTimea[1] + frTimea[2]) * 1;
		} else {
			var x = 10000000000000; // = l'an 1000 ...
		}
		 
		return x;
	},
 
	"date-euro-short-asc": function ( a, b ) {
		return a - b;
	},
 
	"date-euro-short-desc": function ( a, b ) {
		return b - a;
	}
} );

jQuery.extend( jQuery.fn.dataTableExt.oSort, {
	"form-input-pre": function ( a ) {
		a = $(a).find('input[type="submit"]').prop('value');

		if(a == undefined)
		{
			a = '-';
		}

		return a;
	},
 
	"form-input-asc": function ( a, b ) {
		return ((a < b) ? -1 : ((a > b) ? 1 : 0));
	},
 
	"form-input-desc": function ( a, b ) {
		return ((a < b) ? 1 : ((a > b) ? -1 : 0));
	}
} );