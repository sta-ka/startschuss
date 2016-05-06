<div id="nav-bar">
	<ul class="nav nav-pills nav-stacked">
		<li><h3>Profil</h3></li>
		<li {{ set_active('*show*') }} >
			{!! HTML::link('admin/events/'.$event->id.'/show', 'Übersicht') !!}
		</li>
		<li {{ set_active('*edit-general-data*') }} >
			{!! HTML::link('admin/events/'.$event->id.'/edit-general-data', 'Stammdaten bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-profile*') }} >
			{!! HTML::link('admin/events/'.$event->id.'/edit-profile', 'Profil bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-program*') }} >
			{!! HTML::link('admin/events/'.$event->id.'/edit-program', 'Programm bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-contacts*') }} >
			{!! HTML::link('admin/events/'.$event->id.'/edit-contacts', 'Kontaktdaten bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-seo-data*') }} >
			{!! HTML::link('admin/events/'.$event->id.'/edit-seo-data', 'Metadaten bearbeiten') !!}
		</li>
		<li {{ set_active('*edit-logo*') }} >
			{!! HTML::link('admin/events/'.$event->id.'/edit-logo', 'Logo bearbeiten') !!}
		</li>
		<li><h3>Teilnehmer</h3></li>
		<li {{ set_active('*manage-participants*') }} >
			{!! HTML::link('admin/events/'.$event->id.'/manage-participants', 'Teilnehmer verwalten') !!}
		</li>
		
		@if($event->interviews)
		<li {{ set_active('*manage-interviews*') }} >
			{!! HTML::link('admin/events/'.$event->id.'/manage-interviews', 'Einzelgespräche verwalten') !!}
		</li>
		<li {{ set_active('*event-interviews*') }} >
			{!! HTML::link('admin/events/'.$event->id.'/event-interviews', 'Einzelgespräche anzeigen') !!}
		</li>
		@endif
	</ul>
</div>