<div id="nav-bar">
	<ul class="nav nav-pills nav-stacked">
		<li><h3>Einstellungen</h3></li>
		<li {{ set_active('*show*') }} >
			{!! HTML::link('organizer/settings/show', 'Übersicht') !!}
		</li>
		<li {{ set_active('*change-password*') }} >
			{!! HTML::link('organizer/settings/change-password', 'Passwort ändern') !!}
		</li>
		<li {{ set_active('*change-email*') }} >
			{!! HTML::link('organizer/settings/change-email', 'E-Mail ändern') !!}
		</li>
	</ul>
</div>