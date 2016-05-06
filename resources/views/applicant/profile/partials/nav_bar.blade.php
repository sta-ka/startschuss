<div id="nav-bar">
	<ul class="nav nav-pills nav-stacked">
		<li><h3>Profil</h3></li>
		<li {{ set_active('*show') }} >
			{!! HTML::link('applicant/profile/show', 'Profil anzeigen') !!}
		</li>
		<li {{ set_active('*edit-basics*') }} >
			{!! HTML::link('applicant/profile/edit-basics', 'Profil bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-contacts*') }} >
			{!! HTML::link('applicant/profile/edit-contacts', 'Kontaktdaten bearbeiten') !!}
		</li>
		<li {{ set_active('*education*') }} >
			{!! HTML::link('applicant/profile/show-education', 'Ausbildung') !!}
		</li>
		<li {{ set_active('*experience*') }} >
			{!! HTML::link('applicant/profile/show-experience', 'Berufserfahrung') !!}
		</li>
		<li {{ set_active('*edit-photo*') }} >
			{!! HTML::link('applicant/profile/edit-photo', 'Foto bearbeiten') !!}
		</li>
	</ul>
</div>