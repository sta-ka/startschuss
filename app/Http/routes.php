<?php

/*
|--------------------------------------------------------------------------
| Routes: Open Area
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Frontend'], function()
{
	Route::get('/', ['as' => 'home' , 'uses' => 'EventsController@index']);

	Route::get('jobmessekalender', ['as' => 'messekalender' , 'uses' => 'EventsController@messekalender']);
	Route::get('jobmessen/{year}', ['uses' => 'EventsController@messearchiv'])
		->where('year', '2016');
	Route::get('jobmessen/{year}/{month}', ['as' => 'messearchiv' , 'uses' => 'EventsController@messearchiv'])
		->where('year', '2016')
		->where('month', '[a-z_äöüß]+');
	Route::get('jobmessen/{region}', ['as' => 'messen' , 'uses' => 'EventsController@messen'])
		->where('region', '[a-z_äöüß-]+');
	Route::get('jobmessen/in/{city}', ['as' => 'messenIn' , 'uses' => 'EventsController@messenIn'])
		->where('city', '[a-z_äöüß]+');
	Route::get('jobmesse/{slug}', ['as' => 'messe' , 'uses' => 'EventsController@messe'])
		->where('slug', '[A-z_äöüß\-\d]+');

	Route::get('jobmesse-eintragen', ['uses' => 'EventsController@neueMesse']);
	Route::post('jobmesse-eintragen', ['uses' => 'EventsController@messeEintragen']);

	Route::get('veranstalterdatenbank/{slug?}', ['as' => 'veranstalterdatenbank' , 'uses' => 'OrganizersController@veranstalterdatenbank'])
		->where('slug', '[A-z]');
	Route::get('veranstalter/{slug}', ['as' => 'veranstalter' , 'uses' => 'OrganizersController@veranstalter'])
		->where('slug', '[A-z_äöüß\-\d]+');

/*	Route::get('jobs', ['as' => 'jobs' , 'uses' => 'CareerController@jobs']);
	Route::get('job/{id}/{slug}', ['as' => 'job' , 'uses' => 'CareerController@job'])
		->where('id', '[\d]+')
		->where('slug', '[A-z_äöüß\-\d]+');
	Route::get('jobs/in/{city}', ['as' => 'jobsIn' , 'uses' => 'CareerController@jobsIn'])
		->where('city', '[a-z_äöüß]+');

	Route::get('unternehmen/{name}', ['as' => 'unternehmen' , 'uses' => 'CareerController@unternehmen'])
		->where('name', '[a-z_äöüß-]+');*/

	Route::get('karriereratgeber', ['as' => 'karriereratgeber' , 'uses' => 'CareerController@ratgeber']);
	Route::get('karriereratgeber/{slug}', ['as' => 'artikel' , 'uses' => 'CareerController@artikel'])
		->where('slug', '[A-z_äöüß\-\d]+');
});

/*
|--------------------------------------------------------------------------
| Routes: Misc
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'Frontend', 'middleware' => 'guest'], function()
{
	Route::get('login',  ['as' => 'login' , 'uses' => 'UsersController@login']);
	Route::post('login', ['uses' => 'UsersController@processLogin']);

	Route::get('registrieren',  ['as' => 'register' , 'uses' => 'UsersController@register']);
	Route::post('registrieren', ['uses' => 'UsersController@processRegistration']);


	Route::get('passwort-vergessen',  ['as' => 'passwort-vergessen' , 'uses' => 'UsersController@forgotPassword']);
	Route::post('passwort-vergessen', ['uses' => 'UsersController@processForgottenPassword']);

	Route::get('neues-passwort/{key}', ['as' => 'neues-passwort' , 'uses' => 'UsersController@newPassword'])
		->where('key', '[A-z=\d]+');

	Route::post('neues-passwort/{key}', ['uses' => 'UsersController@processNewPassword'])
		->where('key', '[A-z=\d]+');
});

Route::group(['namespace' => 'Frontend'], function()
{
	Route::get('konto-aktivieren/{key}', ['uses' => 'UsersController@activateAccount'])
		->where('key', '[A-z=\d]+');

	Route::get('kontakt',  ['as' => 'kontakt', 'uses' => 'UsersController@contact']);
	Route::post('kontakt', ['uses' => 'UsersController@sendContactMail']);

	Route::get('logout', ['as' => 'logout', 'uses' => 'UsersController@logout']);

	Route::get('impressum', ['as' => 'impressum' , 'uses' => 'MiscController@imprint']);

	Route::get('sitemap.xml', ['uses' => 'MiscController@showXMLSitemap']);

});


/*
|--------------------------------------------------------------------------
| Routes: Admin Area
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function()
{
	// Routes: admin/dashboard
	Route::get('admin/dashboard', 							'DashboardController@index');
	Route::get('admin/dashboard/requested-events', 			'DashboardController@requestedEvents');
	Route::get('admin/dashboard/logins', 					'DashboardController@logins');
	Route::get('admin/dashboard/login-attempts', 			'DashboardController@loginAttempts');
	Route::get('admin/dashboard/logged-data', 				'DashboardController@loggedData');
	Route::get('admin/dashboard/searches', 				    'DashboardController@searches');
	Route::get('admin/dashboard/revisions', 				'DashboardController@revisions');
	Route::get('admin/dashboard/user-revisions', 			'DashboardController@userRevisions');
	Route::get('admin/dashboard/event-revisions', 			'DashboardController@eventRevisions');
	Route::get('admin/dashboard/company-revisions', 		'DashboardController@companyRevisions');
	Route::get('admin/dashboard/organizer-revisions', 		'DashboardController@organizerRevisions');

	// Routes: admin/users
	Route::get('admin/users', 								'UsersController@index');
	Route::get('admin/users/{id}/show', 					'UsersController@show');
	Route::get('admin/users/new', 							'UsersController@newUser');
	Route::post('admin/users/create-user', 					'UsersController@createUser');
	Route::get('admin/users/{id}/edit', 					'UsersController@edit');
	Route::post('admin/users/{id}/update-user', 			'UsersController@updateUser');
	Route::get('admin/users/{id}/change-status', 			'UsersController@changeStatus');
	Route::get('admin/users/{id}/unsuspend', 				'UsersController@unsuspend');
	Route::get('admin/users/{id}/activate-user', 			'UsersController@activateUser');
	Route::get('admin/users/{id}/deactivate-user', 			'UsersController@deactivateUser');
	Route::get('admin/users/{id}/force-login', 				'UsersController@forceLogin');
	Route::get('admin/users/send-mail', 			        'UsersController@composeNewMail');
	Route::post('admin/users/send-mail', 			        'UsersController@sendNewMail');
	Route::get('admin/users/{id}/send-mail', 			    'UsersController@composeMail');
	Route::post('admin/users/{id}/send-mail', 				'UsersController@sendMail');
	Route::get('admin/users/{id}/send-activation-code', 	'UsersController@sendActivationCode');
	Route::get('admin/users/{id}/statistics', 				'UsersController@statistics');
	Route::get('admin/users/{id}/delete', 					'UsersController@delete');
	Route::get('admin/users/{id}/restore', 					'UsersController@restore');

	// Routes: admin/events
	Route::get('admin/events', 												'EventsController@index');
	Route::get('admin/events/{event_id}/show', 								'EventsController@show');
	Route::get('admin/events/new',          								'EventsController@newEvent');
	Route::get('admin/events/new/{event_id?}',								'EventsController@newEvent');
	Route::post('admin/events/create', 										'EventsController@createEvent');
	Route::get('admin/events/{event_id}/accept-request', 					'EventsController@acceptRequest');
	Route::post('admin/events/{event_id}/add-linkage', 						'EventsController@addLinkage');
	Route::get('admin/events/{event_id}/delete-linkage/', 					'EventsController@deleteLinkage');
	Route::get('admin/events/{event_id}/edit-general-data',					'EventsController@editGeneralData');
	Route::post('admin/events/{event_id}/update-general-data',				'EventsController@updateGeneralData');
	Route::get('admin/events/{event_id}/edit-profile',						'EventsController@editProfile');
	Route::post('admin/events/{event_id}/update-profile',					'EventsController@updateProfile');
	Route::get('admin/events/{event_id}/edit-program',						'EventsController@editProgram');
	Route::post('admin/events/{event_id}/update-program',					'EventsController@updateProgram');
	Route::get('admin/events/{event_id}/edit-contacts',						'EventsController@editContacts');
	Route::post('admin/events/{event_id}/update-contacts',					'EventsController@updateContacts');
	Route::get('admin/events/{event_id}/edit-seo-data',						'EventsController@editSeoData');
	Route::post('admin/events/{event_id}/update-seo-data',					'EventsController@updateSeoData');
	Route::get('admin/events/{event_id}/edit-logo',							'EventsController@editLogo');
	Route::post('admin/events/{event_id}/update-logo',						'EventsController@updateLogo');
	Route::get('admin/events/{event_id}/delete-logo',						'EventsController@deleteLogo');
	Route::get('admin/events/{event_id}/change-status',						'EventsController@changeStatus');
	Route::get('admin/events/{event_id}/event-interviews',					'EventsController@eventInterviews');
	Route::get('admin/events/{event_id}/manage-participants',				'EventsController@manageParticipants');
	Route::post('admin/events/add-company/{event_id}/{company_id}',			'EventsController@addCompany');
	Route::post('admin/events/remove-company/{event_id}/{company_id}',		'EventsController@removeCompany');
	Route::get('admin/events/{event_id}/manage-interviews',					'EventsController@manageInterviews');
	Route::post('admin/events/add-interview/{event_id}/{company_id}',		'EventsController@addInterview');
	Route::post('admin/events/remove-interview/{event_id}/{company_id}',	'EventsController@removeInterview');
	Route::get('admin/events/{event_id}/delete',							'EventsController@delete');
	Route::get('admin/events/{event_id}/event-restore',						'EventsController@restore');

	// Routes: admin/companies
	Route::get('admin/companies',											'CompaniesController@index');
	Route::get('admin/companies/{company_id}/show',							'CompaniesController@show');
	Route::get('admin/companies/new',										'CompaniesController@newCompany');
	Route::post('admin/companies/create',									'CompaniesController@create');
	Route::post('admin/companies/{company_id}/add-linkage',					'CompaniesController@addLinkage');
	Route::get('admin/companies/delete-linkage/{company_id}/{user_id}',		'CompaniesController@deleteLinkage');
	Route::get('admin/companies/{company_id}/edit-general-data',			'CompaniesController@editGeneralData');
	Route::post('admin/companies/{company_id}/update-general-data',			'CompaniesController@updateGeneralData');
	Route::get('admin/companies/{company_id}/edit-profile',					'CompaniesController@editProfile');
	Route::post('admin/companies/{company_id}/update-profile',				'CompaniesController@updateProfile');
	Route::get('admin/companies/{company_id}/edit-contacts',				'CompaniesController@editContacts');
	Route::post('admin/companies/{company_id}/update-contacts',				'CompaniesController@updateContacts');
	Route::get('admin/companies/{company_id}/edit-logo',					'CompaniesController@editLogo');
	Route::post('admin/companies/{company_id}/update-logo',					'CompaniesController@updateLogo');
	Route::get('admin/companies/{company_id}/delete-logo',					'CompaniesController@deleteLogo');
	Route::get('admin/companies/{company_id}/delete',						'CompaniesController@delete');
	Route::get('admin/companies/{company_id}/restore',						'CompaniesController@restore');

	// Routes: admin/organizers
	Route::get('admin/organizers',											'OrganizersController@index');
	Route::get('admin/organizers/{organizer_id}/show',						'OrganizersController@show');
	Route::get('admin/organizers/new',										'OrganizersController@newOrganizer');
	Route::post('admin/organizers/create',									'OrganizersController@create');
	Route::get('admin/organizers/{organizer_id}/edit-general-data',			'OrganizersController@editGeneralData');
	Route::post('admin/organizers/{organizer_id}/update-general-data',		'OrganizersController@updateGeneralData');
	Route::get('admin/organizers/{organizer_id}/edit-profile',				'OrganizersController@editProfile');
	Route::post('admin/organizers/{organizer_id}/update-profile',			'OrganizersController@updateProfile');
	Route::get('admin/organizers/{organizer_id}/edit-contacts',				'OrganizersController@editContacts');
	Route::post('admin/organizers/{organizer_id}/update-contacts',			'OrganizersController@updateContacts');
	Route::get('admin/organizers/{organizer_id}/edit-seo-data',				'OrganizersController@editSeoData');
	Route::post('admin/organizers/{organizer_id}/update-seo-data',			'OrganizersController@updateSeoData');
	Route::get('admin/organizers/{organizer_id}/edit-logo',					'OrganizersController@editLogo');
	Route::post('admin/organizers/{organizer_id}/update-logo',				'OrganizersController@updateLogo');
	Route::get('admin/organizers/{organizer_id}/delete-logo',				'OrganizersController@deleteLogo');
	Route::get('admin/organizers/{organizer_id}/delete',					'OrganizersController@delete');

	// Routes: admin/jobs
	Route::get('admin/jobs',												'JobsController@index');
	Route::get('admin/jobs/{job_id}/show',									'JobsController@show');
	Route::get('admin/jobs/{job_id}/approve-job',							'JobsController@approveJob');
	Route::get('admin/jobs/{job_id}/cancel-approval',						'JobsController@cancelApproval');
	Route::get('admin/jobs/{job_id}/change-status',							'JobsController@changeStatus');
	Route::get('admin/jobs/{job_id}/edit-data',								'JobsController@editData');
	Route::post('admin/jobs/{job_id}/update-data',							'JobsController@updateData');
	Route::get('admin/jobs/{job_id}/edit-seo-data',							'JobsController@editSeoData');
	Route::post('admin/jobs/{job_id}/update-seo-data',						'JobsController@updateSeoData');
	Route::get('admin/jobs/{job_id}/edit-settings',							'JobsController@editSettings');
	Route::post('admin/jobs/{job_id}/update-settings',						'JobsController@updateSettings');
	Route::get('admin/jobs/{job_id}/delete',								'JobsController@delete');
	Route::get('admin/jobs/{job_id}/restore',								'JobsController@restore');

	// Routes: admin/applicants
	Route::get('admin/applicants',											'ApplicantsController@index');
	Route::get('admin/applicants/{applicant_id}/show',						'ApplicantsController@show');

	// Routes: admin/applications
	Route::get('admin/applications',										'ApplicationsController@index');
	Route::get('admin/applications/{application_id}/show',					'ApplicationsController@show');
	Route::get('admin/applications/{application_id}/delete',				'ApplicationsController@delete');
	Route::get('admin/applications/{application_id}/restore',				'ApplicationsController@restore');

	// Routes: admin/regions
	Route::get('admin/regions',												'RegionsController@index');
	Route::get('admin/regions/{region_id}/edit',							'RegionsController@edit');
	Route::post('admin/regions/{region_id}/update',							'RegionsController@update');

	// Routes: admin/cities
	Route::get('admin/cities',												'CitiesController@index');
	Route::get('admin/cities/{city_id}/edit',								'CitiesController@edit');
	Route::post('admin/cities/{city_id}/update',							'CitiesController@update');

	// Routes: admin/articles
	Route::get('admin/articles',											'ArticlesController@index');
	Route::get('admin/articles/new',										'ArticlesController@compose');
	Route::post('admin/articles/create',									'ArticlesController@create');
	Route::get('admin/articles/{article_id}/edit',							'ArticlesController@edit');
	Route::post('admin/articles/{article_id}/update',						'ArticlesController@update');
	Route::get('admin/articles/{article_id}/delete-image',					'ArticlesController@deleteImage');
	Route::get('admin/articles/{article_id}/delete',						'ArticlesController@delete');

	// Routes: admin/settings
	Route::get('admin/settings',											'SettingsController@index');
	Route::get('admin/settings/show',										'SettingsController@show');
	Route::get('admin/settings/change-password',							'SettingsController@changePassword');
	Route::post('admin/settings/update-password',							'SettingsController@updatePassword');
	Route::get('admin/settings/change-email',								'SettingsController@changeEmail');
	Route::post('admin/settings/update-email',								'SettingsController@updateEmail');
});

/*
|--------------------------------------------------------------------------
| Routes: Company Area
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'Company', 'middleware' => 'auth:company'], function()
{
	// Routes: company/dashboard
	Route::get('company/dashboard', 													'DashboardController@index');

	// Routes: company/applications
	Route::get('company/applications', 													'ApplicationsController@index');
	Route::get('company/applications/event/{event_id}', 								'ApplicationsController@event');
	Route::get('company/applications/event-interviews/{event_id}', 						'ApplicationsController@eventInterviews');
	Route::get('company/applications/show/{event_id}/{application_id}', 				'ApplicationsController@show');
	Route::get('company/applications/applicant/{event_id}/{application_id}', 			'ApplicationsController@applicant');
	Route::get('company/applications/accept-application/{event_id}/{application_id}', 	'ApplicationsController@acceptApplication');
	Route::get('company/applications/reject-application/{event_id}/{application_id}', 	'ApplicationsController@acceptApplication');

	// Routes: company/jobs
	Route::get('company/jobs', 															'JobsController@index');
	Route::get('company/jobs/{job_id}/show', 											'JobsController@show');
	Route::get('company/jobs/new', 														'JobsController@newJob');
	Route::post('company/jobs/create/{company_id}',										'JobsController@create');

	// Routes: company/profile
	Route::get('company/profile', 														'ProfileController@index');
	Route::get('company/profile/{company_id}/show',										'ProfileController@show');
	Route::get('company/profile/{company_id}/edit-basics', 								'ProfileController@editBasics');
	Route::post('company/profile/{company_id}/update-basics', 							'ProfileController@updateBasics');
	Route::get('company/profile/{company_id}/edit-contacts', 							'ProfileController@editContacts');
	Route::post('company/profile/{company_id}/update-contacts',		 					'ProfileController@updateContacts');
	Route::get('company/profile/{company_id}/edit-logo',	 							'ProfileController@editLogo');
	Route::post('company/profile/{company_id}/update-logo',		 						'ProfileController@updateLogo');
	Route::get('company/profile/{company_id}/delete-logo',	 							'ProfileController@deleteLogo');

	// Routes: company/settings
	Route::get('company/settings',														'SettingsController@index');
	Route::get('company/settings/show',													'SettingsController@show');
	Route::get('company/settings/change-password',										'SettingsController@changePassword');
	Route::post('company/settings/update-password',										'SettingsController@updatePassword');
	Route::get('company/settings/change-email',											'SettingsController@changeEmail');
	Route::post('company/settings/update-email',										'SettingsController@updateEmail');

});

/*
|--------------------------------------------------------------------------
| Routes: Organizer Area
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'Organizer', 'middleware' => 'auth:organizer'], function()
{
	// Routes: organizer/dashboard
	Route::get('organizer/dashboard',	 													'DashboardController@index');

	// Routes: organizer/applications
	Route::get('organizer/applications', 													'ApplicationsController@index');
	Route::get('organizer/applications/event/{event_id}', 									'ApplicationsController@event');
	Route::post('organizer/applications/lock-interviews/{event_id}', 						'ApplicationsController@lockInterviews');
	Route::post('organizer/applications/close-applications/{event_id}', 					'ApplicationsController@closeApplications');
	Route::get('organizer/applications/show/{event_id}/{application_id}', 					'ApplicationsController@show');
	Route::get('organizer/applications/applicant/{event_id}/{application_id}', 				'ApplicationsController@applicant');
	Route::get('organizer/applications/approve-application/{event_id}/{application_id}', 	'ApplicationsController@approveApplication');
	Route::get('organizer/applications/disapprove-application/{event_id}/{application_id}', 'ApplicationsController@disapproveApplication');
	Route::get('organizer/applications/event-interviews/{event_id}', 						'ApplicationsController@eventInterviews');
	Route::post('organizer/applications/delete-interview/{event_id}/{application_id}',		'ApplicationsController@deleteInterview');
	Route::post('organizer/applications/arrange-interview/{event_id}/{application_id}',		'ApplicationsController@arrangeInterview');
	Route::post('organizer/applications/rearrange-interview/{event_id}/{application_id}',	'ApplicationsController@rearrangeInterview');

	// Routes: organizer/profile
	Route::get('organizer/profile', 													'ProfileController@index');
	Route::get('organizer/profile/new/{event_id}',										'ProfileController@newEvent');
	Route::post('organizer/profile/create/{event_id}',									'ProfileController@create');
	Route::get('organizer/profile/{event_id}/show', 									'ProfileController@show');
	Route::get('organizer/profile/{event_id}/edit-basics',								'ProfileController@editBasics');
	Route::post('organizer/profile/{event_id}/update-basics',							'ProfileController@updateBasics');
	Route::get('organizer/profile/{event_id}/edit-program',								'ProfileController@editProgram');
	Route::post('organizer/profile/{event_id}/update-program',							'ProfileController@updateProgram');
	Route::get('organizer/profile/{event_id}/edit-contacts',							'ProfileController@editContacts');
	Route::post('organizer/profile/{event_id}/update-contacts',							'ProfileController@updateContacts');
	Route::get('organizer/profile/{event_id}/edit-logo',								'ProfileController@editLogo');
	Route::post('organizer/profile/{event_id}/update-logo',								'ProfileController@updateLogo');
	Route::get('organizer/profile/{event_id}/delete-logo',								'ProfileController@deleteLogo');
	Route::post('organizer/profile/{event_id}/update-application-deadline',				'ProfileController@updateApplicationDeadline');
	Route::get('organizer/profile/{event_id}/manage-participants',						'ProfileController@manageParticipants');
	Route::post('organizer/profile/add-company/{event_id}/{company_id}',				'ProfileController@addCompany');
	Route::post('organizer/profile/remove-company/{event_id}/{company_id}',				'ProfileController@removeCompany');
	Route::get('organizer/profile/{event_id}/manage-interviews',						'ProfileController@manageInterviews');
	Route::post('organizer/profile/add-interview/{event_id}/{company_id}',				'ProfileController@addInterview');
	Route::post('organizer/profile/add-interview/{event_id}/{company_id}',				'ProfileController@addInterview');
	Route::post('organizer/profile/add-comment/{event_id}/{company_id}',				'ProfileController@addComment');

	// Routes: company/settings
	Route::get('organizer/settings',													'SettingsController@index');
	Route::get('organizer/settings/show',												'SettingsController@show');
	Route::get('organizer/settings/change-password',									'SettingsController@changePassword');
	Route::post('organizer/settings/update-password',									'SettingsController@updatePassword');
	Route::get('organizer/settings/change-email',										'SettingsController@changeEmail');
	Route::post('organizer/settings/update-email',										'SettingsController@updateEmail');

});

/*
|--------------------------------------------------------------------------
| Routes: Applicant Area
|--------------------------------------------------------------------------
*/

Route::group(['namespace' => 'Applicant', 'middleware' => 'auth:applicant'], function()
{
	// Routes: organizer/dashboard
	Route::get('applicant/dashboard',					'DashboardController@index');

	// Routes: applicant/applications
	Route::get('applicant/applications', 													'ApplicationsController@index');
	Route::get('applicant/applications/show', 												'ApplicationsController@show');
	Route::get('applicant/applications/{application_id}/show', 								'ApplicationsController@showSingle');
	Route::get('applicant/applications/event/{event_id}', 									'ApplicationsController@event');
	Route::get('applicant/applications/apply-for-interview/{event_id}/{company_id}', 		'ApplicationsController@applyForInterview');
	Route::post('applicant/applications/apply-for-interview/{event_id}/{company_id}', 		'ApplicationsController@submitInterviewApplication');

	// Routes: applicant/profile
	Route::get('applicant/profile', 										'ProfileController@index');
	Route::get('applicant/profile/show', 									'ProfileController@show');
	Route::get('applicant/profile/download', 								'ProfileController@download');
	Route::get('applicant/profile/edit-basics',								'ProfileController@editBasics');
	Route::post('applicant/profile/update-basics',							'ProfileController@updateBasics');
	Route::get('applicant/profile/show-education', 							'ProfileController@showEducation');
	Route::get('applicant/profile/add-education',							'ProfileController@addEducation');
	Route::post('applicant/profile/create-education',						'ProfileController@createEducation');
	Route::get('applicant/profile/edit-education/{education_id}',			'ProfileController@editEducation');
	Route::post('applicant/profile/update-education/{education_id}',		'ProfileController@updateEducation');
	Route::get('applicant/profile/delete-education/{education_id}',			'ProfileController@deleteEducation');
	Route::get('applicant/profile/show-experience',							'ProfileController@showExperience');
	Route::get('applicant/profile/add-experience',							'ProfileController@addExperience');
	Route::post('applicant/profile/create-experience',						'ProfileController@createExperience');
	Route::get('applicant/profile/edit-experience/{experience_id}',			'ProfileController@editExperience');
	Route::post('applicant/profile/update-experience/{experience_id}',		'ProfileController@updateExperience');
	Route::get('applicant/profile/delete-experience/{experience_id}',		'ProfileController@deleteExperience');
	Route::get('applicant/profile/edit-contacts',							'ProfileController@editContacts');
	Route::post('applicant/profile/update-contacts',						'ProfileController@updateContacts');
	Route::get('applicant/profile/edit-photo',								'ProfileController@editPhoto');
	Route::post('applicant/profile/update-photo',							'ProfileController@updatePhoto');
	Route::get('applicant/profile/delete-photo',							'ProfileController@deletePhoto');

	// Routes: applicant/settings
	Route::get('applicant/settings',										'SettingsController@index');
	Route::get('applicant/settings/show',									'SettingsController@show');
	Route::get('applicant/settings/change-password',						'SettingsController@changePassword');
	Route::post('applicant/settings/update-password',						'SettingsController@updatePassword');
	Route::get('applicant/settings/change-email',							'SettingsController@changeEmail');
	Route::post('applicant/settings/update-email',							'SettingsController@updateEmail');
	Route::get('applicant/settings/options',							    'SettingsController@options');
    Route::post('applicant/settings/update-options',						'SettingsController@updateOptions');

});


/*
|--------------------------------------------------------------------------
| Custom Validator
|--------------------------------------------------------------------------
*/

Validator::extend('alpha_dot', function($attribute, $value)
{
	// first character can only be a letter
	// last character can only be a letter or a number
	return preg_match('/^[A-Za-z][\pL\pN._-]+[A-Za-z\d]$/u', $value);
});
