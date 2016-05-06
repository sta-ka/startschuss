<div id="nav-bar">
	<ul class="nav nav-pills nav-stacked">
		<li><h3>Profil</h3></li>
		<li {{ set_active('*show*') }} >
			{!! HTML::link('admin/organizers/'.$organizer->id.'/show', 'Profil anzeigen') !!}
		</li>
		<li {{ set_active('*edit-general-data*') }} >
			{!! HTML::link('admin/organizers/'.$organizer->id.'/edit-general-data', 'Stammdaten bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-profile*') }} >
			{!! HTML::link('admin/organizers/'.$organizer->id.'/edit-profile', 'Profil bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-contacts*') }} >
			{!! HTML::link('admin/organizers/'.$organizer->id.'/edit-contacts', 'Kontaktdaten bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-seo-data*') }} >
			{!! HTML::link('admin/organizers/'.$organizer->id.'/edit-seo-data', 'Metadaten bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-logo*') }} >
			{!! HTML::link('admin/organizers/'.$organizer->id.'/edit-logo', 'Logo bearbeiten') !!}
		</li>
	</ul>
</div>