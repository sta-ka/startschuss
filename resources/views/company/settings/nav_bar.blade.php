<div id="nav-bar">
	<ul class="nav nav-pills nav-stacked">
		<li><h3>Einstellungen</h3></li>
		<li {{ set_active('*show*') }} >
			{!! HTML::link('company/settings/show', 'Übersicht') !!}
		</li>
		<li {{ set_active('*change-password*') }} >
			{!! HTML::link('company/settings/change-password', 'Passwort ändern') !!}
		</li>
		<li {{ set_active('*change-email*') }} >
			{!! HTML::link('company/settings/change-email', 'E-Mail ändern') !!}
		</li>
	</ul>
</div>