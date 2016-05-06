<div id="nav-bar">
	<ul class="nav nav-pills nav-stacked">
		<li><h3>Einstellungen</h3></li>
		<li {{ set_active('*show*')}} >
			{!! HTML::link('applicant/settings/show', 'Übersicht') !!}
		</li>
		<li {{ set_active('*change-password*')}} >
			{!! HTML::link('applicant/settings/change-password', 'Passwort ändern') !!}
		</li>
		<li {{ set_active('*change-email*')}} >
			{!! HTML::link('applicant/settings/change-email', 'E-Mail ändern') !!}
		</li>
		<li {{ set_active('*options*')}} >
			{!! HTML::link('applicant/settings/options', 'Optionen') !!}
		</li>
	</ul>
</div>