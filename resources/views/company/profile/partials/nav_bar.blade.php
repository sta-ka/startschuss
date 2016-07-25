<div id="nav-bar">
	<ul class="nav nav-pills nav-stacked">
		<li><h3>Profil</h3></li>
		<li {{ set_active('*show*') }} >
			{!! HTML::link('company/profile/'. $company->id .'/show', 'Profil anzeigen') !!}
		</li>
		<li {{ set_active('*edit-basics*') }} >
			{!! HTML::link('company/profile/'. $company->id .'/edit-basics', 'Profil bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-contacts*') }} >
			{!! HTML::link('company/profile/'. $company->id .'/edit-contacts', 'Kontaktdaten bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-logo*') }} >
			{!! HTML::link('company/profile/'. $company->id .'/edit-logo', 'Logo bearbeiten') !!}
		</li>
	</ul>
</div>