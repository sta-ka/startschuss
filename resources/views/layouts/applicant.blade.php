<!DOCTYPE html> 
<html lang="de">
	<head>
		<meta charset="utf-8"/>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		
		<title>@yield('title') | startschuss-karriere.de</title>

		<link rel="shortcut icon" href="{{ URL::asset('assets/img/favicon.ico') }}" type="image/x-icon" />

        <link rel="stylesheet" href="{{ URL::asset('assets/css/styles.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('assets/css/backend/jquery.datatables.css') }}">


        @yield('metadata')
	</head>

	<body>
		<div id="wrap">
		
			<div id="header">
                @include('layouts.partials.header')

				<div class="navbar navbar-default navbar-static-top">
					<div class="navbar container_12">
						<ul class="nav navbar-nav navbar-left">
							<li {{ set_active('*dashboard*') }}>
								{!! HTML::link('applicant/dashboard', 'Dashboard') !!}
							</li>
							<li {{ set_active('*profile*') }}>
								{!! HTML::link('applicant/profile', 'Profil') !!}
							</li>
							<li {{ set_active('*applications*') }}>
								{!! HTML::link('applicant/applications/show', 'Meine Bewerbungen') !!}
							</li>
							<li {{ set_active('*settings*') }}>
								{!! HTML::link('applicant/settings', 'Einstellungen') !!}
							</li>
						</ul>
						@include('layouts.partials.statusbox')
					</div>
				</div>	
			</div>
			
			<div id="content">
				{!! Notification::display() !!}
				<div id="main" class="container_12">
					<div class="span12">
						@yield('content')
					</div>
				</div>
			</div>

		</div>

		@include('layouts.partials.footer_front')

		<script src="{{ URL::asset('assets/js/jquery.js') }}"></script>

		<script src="{{ URL::asset('assets/js/tinymce/tinymce.min.js') }}"></script>
		<script src="{{ URL::asset('assets/js/backend/general.js') }}"></script>

		@yield('scripts')
		
	</body>
</html>