<div id="nav-bar">
	<ul class="nav nav-pills nav-stacked">
		<li><h3>Profil</h3></li>
		<li {{ set_active('*show*') }} >
			{!! HTML::link('admin/companies/'. $company->id .'/show', 'Profil anzeigen') !!}
		</li>
		<li {{ set_active('*edit-general-data*') }} >
			{!! HTML::link('admin/companies/'. $company->id .'/edit-general-data', 'Stammdaten bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-profile*') }} >
			{!! HTML::link('admin/companies/'. $company->id .'/edit-profile', 'Profil bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-contacts*') }} >
			{!! HTML::link('admin/companies/'. $company->id .'/edit-contacts', 'Kontaktdaten bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-logo*') }} >
			{!! HTML::link('admin/companies/'. $company->id .'/edit-logo', 'Logo bearbeiten') !!}
		</li>
	</ul>
</div>