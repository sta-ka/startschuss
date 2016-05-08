@if($user = Sentry::getUser())
	<?php
		$groupname = $user->getGroups()->first()->name;

        if(in_array($groupname, ['admin', 'organizer', 'company', 'applicant'])) {
            $link = $groupname;
        } else {
            $link = '';
        }

	?>

	<ul class="nav navbar-nav navbar-right">
		@if(isset($frontend) && isset($link))
			<li>{!! HTML::link($link . '/dashboard', 'Mein Konto') !!}</li>
			<li class="divider-vertical"></li>
		@endif

		<li>{!! HTML::linkRoute('logout', 'Logout') !!}</li>
	</ul>
@else
	<ul class="nav navbar-nav navbar-right">
		<li {{ set_active('login*') }}>
			{!! HTML::link('login', 'Login') !!}
		</li>
		<li class="divider-vertical"></li>
		<li {{ set_active('registrieren*') }}>
			{!! HTML::link('registrieren', 'Registrieren') !!}
		</li>							
	</ul>
@endif