<?php 

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	"accepted"       => "<strong>:attribute</strong> muss akzeptiert werden.",
	"active_url"     => "<strong>:attribute</strong> ist keine gültige URL.",
	"after"          => "<strong>:attribute</strong> muss in der Zukunft liegen.",
	"alpha"          => "<strong>:attribute</strong> darf nur Buchstaben beinhalten.",
	"alpha_dash"     => "<strong>:attribute</strong> enthält ungültige Zeichen.",
	"alpha_dot"    	 => "<strong>:attribute</strong> ist nicht gültig.",
	"alpha_num"      => "<strong>:attribute</strong> darf nur aus Buchstaben und Nummern bestehen.",
	"array"          => "<strong>:attribute</strong> muss ausgewählte Elemente haben.",
	"before"         => "<strong>:attribute</strong> muss ein Datum vor dem :date sein.",
	"between"        => [
		"numeric" => "<strong>:attribute</strong> muss zwischen :min und :max liegen.",
		"file"    => "<strong>:attribute</strong> muss zwischen :min und :max Kilobytes groß sein.",
		"string"  => "<strong>:attribute</strong> muss zwischen :min und :max Zeichen lang sein.",
	],
	"confirmed"      => "<strong>:attribute</strong> stimmt nicht mit der Bestätigung überein.",
	"count"          => "<strong>:attribute</strong> muss genau :count ausgewählte Elemente haben.",
	"countbetween"   => "<strong>:attribute</strong> muss zwischen :min und :max ausgewählte Elemente haben.",
	"countmax"       => "<strong>:attribute</strong> muss weniger als :max ausgewählte Elemente haben.",
	"countmin"       => "<strong>:attribute</strong> muss mindestens :min ausgewählte Elemente haben.",
	"different"      => "<strong>:attribute</strong> und :other müssen verschieden sein.",
	"email"          => "<strong>:attribute</strong> ist keine gültige E-Mail-Adresse.",
	"exists"         => "<strong>:attribute</strong> enthält einen ungültigen Wert.",
	"image"          => "<strong>:attribute</strong> muss ein Bild sein.",
	"in"             => "Der gewählte Wert für <strong>:attribute</strong> ist ungültig.",
	"integer"        => "<strong>:attribute</strong> muss eine ganze Zahl sein.",
	"ip"             => "<strong>:attribute</strong> muss eine gültige IP-Adresse sein.",
	"match"          => "<strong>:attribute</strong> hat ein ungültiges Format.",
	"max"            => [
		"numeric" => "<strong>:attribute</strong> muss kleiner als :max sein.",
		"file"    => "<strong>:attribute</strong> muss kleiner als :max Kilobytes groß sein.",
		"string"  => "<strong>:attribute</strong> muss kürzer als :max Zeichen sein.",
	],
	"mimes"          => "<strong>:attribute</strong> muss den Dateityp :values haben.",
	"min"            => [
		"numeric" => "<strong>:attribute</strong> muss größer als :min sein.",
		"file"    => "<strong>:attribute</strong> muss größer als :min Kilobytes groß sein.",
		"string"  => "<strong>:attribute</strong> muss länger als :min Zeichen sein.",
	],
	"not_in"         => "Der gewählte Wert für <strong>:attribute</strong> ist ungültig.",
	"numeric"        => "<strong>:attribute</strong> muss eine Zahl sein.",
	"required"       => "<strong>:attribute</strong> muss ausgefüllt sein.",
	"same"           => "<strong>:attribute</strong> und :other müssen übereinstimmen.",
	"size"           => [
		"numeric" => "<strong>:attribute</strong> muss gleich :size sein.",
		"file"    => "<strong>:attribute</strong> muss :size Kilobyte groß sein.",
		"string"  => "<strong>:attribute</strong> muss :size Zeichen lang sein.",
	],
	"unique"         => "<strong>:attribute</strong> ist schon vergeben.",
	"url"            => "Das Format von <strong>:attribute</strong> ist ungültig.",

	"date"			 => "<strong>:attribute</strong> existiert nicht.",
	"date_format"	 => "<strong>:attribute</strong> ist ungültig (Beispiel: 26.01.2015).",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	*/


	'custom' => [
		"logo"	=> [
			"required"  => "Keine <strong>Datei</strong> ausgewählt.",
			"image" 	=> "Hochzuladende <strong>Datei</strong> muss ein Bild sein."
		],
		"username"	=> [
			"exists"  	=> "<strong>Login</strong> konnte nicht gefunden werden."
		],
		"newpassword" => [
			"same"  	=> "<strong>Neues Passwort</strong> stimmt nicht mit der Bestätigung überein.",
		],
		"month_start" => [
			"numeric" 	=> "<strong>Startmonat</strong> ist ungültig.", 
			"between" 	=> "<strong>Startmonat</strong> ist ungültig.", 
		],
		"month_end" => [
			"numeric" 	=> "<strong>Endmonat</strong> ist ungültig.", 
			"between" 	=> "<strong>Endmonat</strong> ist ungültig.", 
		],
		"year_start" => [
			"numeric" 	=> "<strong>Startjahr</strong> ist ungültig.", 
			"min" 		=> "<strong>Startjahr</strong> ist ungültig.", 
			"max" 		=> "<strong>Startjahr</strong> ist ungültig.", 
		],
		"year_end" => [
			"numeric" 	=> "<strong>Endjahr</strong> ist ungültig.", 
			"min" 		=> "<strong>Endjahr</strong> ist ungültig.", 
			"max" 		=> "<strong>Endjahr</strong> ist ungültig.", 
		],
		"valid_start_date" => [
			"required" 	=> "Das <strong>Enddatum</strong> liegt vor dem Startdatum.", 
		],
		"valid_end_date" => [
			"required" 	=> "Die Angaben zum <strong>Endzeitpunkt</strong> sind nicht gültig.", 
		],
		"valid_date" => [
			"required" 	=> "Das <strong>Datum</strong> ist nicht gültig.", 
		],
	],

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => [
		"username"			 		=> "Login",
		"email"				 		=> "E-Mail",
		"password"			 		=> "Passwort",
		"password_confirmation"		=> "Passwort-Bestätigung",
		"oldpassword"		 		=> "Altes Passwort",
		"newpassword"		 		=> "Neues Passwort",
		"group"				 		=> "Gruppe",

		"phone"						=> "Telefon",
		"birthday"					=> "Geburtstag",
		"photo"						=> "Foto",

		"contact"			        => "Ansprechpartner",
		"name"				        => "Name",
		"full_name"			        => "Name (Komplett)",
		"title"				        => "Titel",
		"slug"				        => "URL",
		"logo"				        => "Logo",
		"image"				        => "Bild",
		"organizer" 		        => "Veranstalter",
		"date"				        => "Datum",
		"start_date"		        => "Startdatum",
		"end_date"			        => "Enddatum",
		"url"				        => "URL",
		
		"subject"			        => "Betreff",
		"body"				        => "Nachricht",

		"website"			        => "Webseite",
		"keywords"			        => "Keywords",
		
		"meta_description"	 	    => "Beschreibung",
		"opening_hours"		 	    => "Öffnungszeiten",
		"opening_hours1"	 	    => "Öffnungszeiten",
		"opening_hours2"	 	    => "Öffnungszeiten",
		"specific_location1" 	    => "Veranstaltungsort",
		"specific_location2" 	    => "Veranstaltungsort",
		"specific_location3" 	    => "Veranstaltungsort",
		"admission"			 	    => "Eintritt",
		"location"			 	    => "Ort",
		"region"			 	    => "Region",
		"region_id"			 	    => "Region",
		"profile"			 	    => "Profil",
		"program"			 	    => "Programm",
		"application_deadline"	    => "Bewerbungsschluss",

		"featured"			        => "Prominent",
		"interviews"		        => "Einzelgespräche",

		"requirements"		        => "Anforderungen",
		"description"		        => "Beschreibung",

		"cover_letter"		        => "Anschreiben",
		"comment"			        => "Kommentar",

		"hour"				        => "Stunde",
		"minute"			        => "Minute",

		"company"			        => "Unternehmen",
		"industry"			        => "Branche",
		"job_description"	        => "Beschreibung",

		"university"		        => "Hochschule",
		"branch_of_study"	        => "Fachrichtung",
		"key_aspects"		        => "Schwerpunkte",

	],

];