<div id="nav-bar">
	<ul class="nav nav-pills nav-stacked">
		<li><h3>Profil</h3></li>
		<li {{ set_active('*show*') }} >
			{!! HTML::link('organizer/profile/'. $event->id .'/show', 'Profil anzeigen') !!}
		</li>
		<li {{ set_active('*edit-basics*') }} >
			{!! HTML::link('organizer/profile/'. $event->id .'/edit-basics', 'Profil bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-program*') }} >
			{!! HTML::link('organizer/profile/'. $event->id .'/edit-program', 'Programm bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-contacts*') }} >
			{!! HTML::link('organizer/profile/'. $event->id .'/edit-contacts', 'Kontaktdaten bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-logo*') }} >
			{!! HTML::link('organizer/profile/'. $event->id .'/edit-logo', 'Logo bearbeiten') !!}
		</li>
		<li><h3>Teilnehmer</h3></li>
		<li {{ set_active('*manage-participants*') }} >
			{!! HTML::link('organizer/profile/'. $event->id .'/manage-participants', 'Teilnehmer verwalten') !!}
		</li>
		@if($event->interviews)
		<li {{ set_active('*manage-interviews*') }} >
			{!! HTML::link('organizer/profile/'. $event->id .'/manage-interviews', 'Einzelgespräche verwalten') !!}
		</li>
		@endif
	</ul>
</div>