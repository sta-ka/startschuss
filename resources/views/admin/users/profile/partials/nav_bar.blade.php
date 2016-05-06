<div id="nav-bar">
	<ul class="nav nav-pills nav-stacked">
		<li><h3>Profil</h3></li>
		<li {{ set_active('*show*') }} >
			{!! HTML::link('admin/users/'.$user->id.'/show', 'Übersicht') !!}
		</li>
		<li {{ set_active('*edit*') }} >
			{!! HTML::link('admin/users/'.$user->id.'/edit', 'Nutzer bearbeiten') !!}
		</li>
		<li {{ set_active('*send-mail*') }} >
			{!! HTML::link('admin/users/'.$user->id.'/send-mail', 'Nutzer kontaktieren') !!}
		</li>
		<li {{ set_active('*statistics*') }} >
			{!! HTML::link('admin/users/'.$user->id.'/statistics', 'Statistik') !!}
		</li>
	</ul>
</div>